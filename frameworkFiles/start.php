<?php
include 'urls.php';

class start{
    public function start()
    {
        global $urlpatterns;
        $host = '127.0.0.1';
        $port = 80;
        $socket = stream_socket_server("tcp://$host:$port", $errno, $errstr);

        if (!$socket) {
            echo "Failed to create socket: $errstr ($errno)\n";
            exit(1);
        }

        echo "Listening to http://$host:$port\n";

        while (true) {
            $client = stream_socket_accept($socket, -1);
            if ($client) {
                $url = $this->get_url($client);
                $toReturn = "";
                $response = new HTTPResponse();
                if ($url) {

                    $router = new Router();
                    $router->urlpatterns = $urlpatterns;
                    $data = new HTTPReceivedData($url, $client);
                    $toReturn = $router->route($data);
                    if($router->result == 200){
                        $response->header->header["HTTP/1.1"] = "200 OK";
                    }
                    if($router->result == 404){
                        $response->header->header["HTTP/1.1"] = "404 Not Found";
                        $response->header->header["Content-Length"] = strlen($toReturn);
                    }
                    $response->header->header["Content-Length"] = strlen($toReturn);
                    $response->header->header["Content-Range"] = "1000-2000/*";
                    $response->header->header["Accept-Ranges"] = "bytes";
                }

                $response->body = $toReturn;
                fwrite($client, $response);
                fclose($client);
                Logging::log($url . "   " . $response->header->header["HTTP/1.1"]);

            }
        }

    }

    function get_url($client)
    {
        return explode(' ', fgets($client))[1];
    }

}
