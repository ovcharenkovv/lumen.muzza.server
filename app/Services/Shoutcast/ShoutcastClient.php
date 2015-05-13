<?php namespace App\Services\Shoutcast;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

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
    public function getCachedStationObject($stationId)
    {

        $cacheKey = 'station-' . $stationId;

        $station = Cache::get($cacheKey);

        if (is_null($station)) {
            $station = $this->getStationObject($stationId);
            Cache::put($cacheKey, $station, getenv("STATION_OBJECT_CACHE_TIME"));
        }

        return $station;
    }

    /**
     * @param $stationId
     * @return mixed
     * @throws Exception
     */
    public function getStationObject($stationId)
    {
        $response = $this->client->post(getenv('SHOUTCAST_GET_CURRENT_STATION_URL'), [
            'query' => ['stationID' => $stationId]
        ]);

        $json = $response->json(['object' => true]);

        if (!$json->Station) {
            throw new Exception('Station not found');
        }

        return $json->Station;
    }

}