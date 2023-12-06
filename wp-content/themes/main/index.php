<?php
require_once __DIR__ . '/vendor/autoload.php';
$client = new \GuzzleHttp\Client();

$transient_key = 'my_plugin_states';

try {
    $response = $client->get('https://public.opendatasoft.com/api/explore/v2.1/catalog/datasets/georef-united-states-of-america-state/records?select=ste_name&limit=51&refine=ste_type%3A%22state%22');
    $data = json_decode($response->getBody(), true);

    echo '<ul>';
    if (isset($data['results'])) {
        echo '<h2>States of United States:</h2>';
        echo '<ul>';
        foreach ($data['results'] as $state) {
            echo '<li>' .$state["ste_name"][0]. '</li>';
        }
        echo '</ul>';
    } else {
        echo 'No states found in the API response.';
    }
    echo '</ul>';

} catch (\GuzzleHttp\Exception\RequestException $e) {
    echo 'Error: ' . $e->getMessage();
}