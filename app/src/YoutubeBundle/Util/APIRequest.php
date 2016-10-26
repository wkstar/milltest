<?php 
namespace YoutubeBundle\Util;
use \GuzzleHttp\Client;

class APIRequest
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get($url)
    {
        $response = $this->client->get($url);
        $body = (string) $response->getBody();
        $json = json_decode($body, true);
        if (json_last_error()) {
            throw new \Exception(json_last_error_msg());
        }
        return $json;
    }
}