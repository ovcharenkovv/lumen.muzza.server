<?php namespace App\Services\Shoutcast;

use Exception;
use GuzzleHttp\Client;

/**
 * Class ShoutcastClient
 * @package App\Services\Shoutcast
 */
class ShoutcastClient
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @param $stationId
     * @return mixed
     * @throws Exception
     */
    public function getStationObject($stationId)
    {
        $response = $this->client->post('http://www.shoutcast.com/Player/GetCurrentTrack', [
            'query' => ['stationID' => $stationId]
        ]);

        $json = $response->json(['object' => true]);

        if (!$json->Station) {
            throw new Exception('Station not found');
        }

        return $json->Station;
    }

}