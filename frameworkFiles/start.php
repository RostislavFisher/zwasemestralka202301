<?php
include 'urls.php';

/**
 * start is a class that starts the server
 */
class start{

    /**
     * Starts the server
     */
    public function start()
    {
        global $urlpatterns;
        global $host;
        global $port;
        global $protocol;
        global $isParallel;
        global $parallelRequests;
        global $timeout;
        global $log;
        $socket = stream_socket_server("tcp://$host:$port", $errno, $errstr);

        if (!$socket) {
            echo "Failed to create socket: $errstr ($errno)\n";
            exit(1);
        }

        echo "Listening to http://$host:$port\n";

        while (true) {
            try{
            $client = stream_socket_accept($socket, -1);
            stream_set_timeout($client, $timeout);
            if ($client) {
                try {
                    $url = $this->get_url($client);
                    $toReturn = "";
                    $response = new HTTPResponse();
                    if ($url) {

                        $router = new Router();
                        $router->urlpatterns = $urlpatterns;
                        $data = new HTTPReceivedData($url, $client);
                        $objectToReturn = $router->route($data);
                        $toReturn = $objectToReturn->body;
                        $response->header->header = $objectToReturn->header->header;
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
                    if($log) Logging::log($url . "   " . $response->header->header["HTTP/1.1"]);

                }

        catch(Error $e){
            echo "Logging error";
            Logging::log($url . "   " . "Error: " . $e->getMessage());
            }


        }
            fclose($client);
        }

        catch(Error $e){
            echo "Logging error";
            Logging::log($url . "   " . "Error: " . $e->getMessage());
        }
        }


    }

    /**
     * Returns the URL of the HTTP request
     * @param $client: the client
     */
    function get_url($client)
    {
        return explode(' ', fgets($client))[1];
    }

}
