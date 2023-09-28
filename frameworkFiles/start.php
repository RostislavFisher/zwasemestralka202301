<?php
include 'urls.php';
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
        $url = get_url($client);
        $toReturn = "<html><body>404</body></html>";

        $router = new Router();
        $router->urlpatterns = $urlpatterns;
        $toReturn = $router->route($url);

        $response = new HTTPResponse();
        $response->header->header["Content-Length"] = strlen($toReturn);
        $response->header->header["Content-Range"] = "1000-2000/*";
        $response->header->header["Accept-Ranges"] = "bytes";
        $response->body = $toReturn;
        Logging::log($url);
        fwrite($client, $response);

        fclose($client);
}}



function get_url($client) {
    return explode(' ', fgets($client))[1];
}

