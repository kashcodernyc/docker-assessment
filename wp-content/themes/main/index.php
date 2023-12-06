<?php

require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

class ApiDataFetcher
{
    private $cacheFile;
    private $cacheDuration;

    public function __construct()
    {
        // Set the cache file path
        $this->cacheFile = __DIR__ . '/cached_data.json';
    }

    public function fetchData()
    {
        $cacheDuration = 3600; // Cache for 1 hour

        // Attempt to get data from cache
        $cachedData = $this->getCachedData();

        if ($cachedData === false) {
            // Fetch data from the API
            try {
                $client = new Client();
                $response = $client->get('https://public.opendatasoft.com/api/explore/v2.1/catalog/datasets/georef-united-states-of-america-state/records?select=ste_name&limit=51&refine=ste_type%3A%22state%22');
                $data = json_decode($response->getBody(), true);

                if (isset($data['results'])) {
                    // Store data in the cache file
                    $this->storeDataInCache($data);

                    // Output the states
                    $this->outputStates($data);
                } else {
                    echo 'No states found in the API response.';
                }

            } catch (\GuzzleHttp\Exception\RequestException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            // Use cached data
            $this->outputStates($cachedData);
        }
    }

    private function getCachedData()
    {
        // Attempt to get data from cache file
        if (file_exists($this->cacheFile) && time() - filemtime($this->cacheFile) < $this->cacheDuration) {
            return json_decode(file_get_contents($this->cacheFile), true);
        }

        return false;
    }

    private function storeDataInCache($data)
    {
        // Store data in the cache file
        file_put_contents($this->cacheFile, json_encode($data));
    }

    private function outputStates($data)
    {
        echo '<ul>';
        echo '<h2>States of United States:</h2>';
        echo '<ul>';
        foreach ($data['results'] as $state) {
            echo '<li>' . $state["ste_name"][0] . '</li>';
        }
        echo '</ul>';
        echo '</ul>';
    }
}

$apiDataFetcher = new ApiDataFetcher();
$apiDataFetcher->fetchData();
