<?php

namespace app\services;

class StreamingServiceApi{

    private $apiKey;

    public function __construct() {
        $this->apiKey = 'a510d81c18msha0252262d20951fp129c91jsn6acb9fed9921';
    }

    public function getMovies($title = 'batman', $country = 'us', $showType = 'movie') {
        $url = "https://streaming-availability.p.rapidapi.com/shows/search/title";
        $queryParams = http_build_query([
            'title' => $title,
            'country' => $country,
            'show_type' => $showType
        ]);
    
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "$url?$queryParams",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: streaming-availability.p.rapidapi.com",
                "x-rapidapi-key: " . $this->apiKey,
                "Accept: application/json"
            ]
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        $data = json_decode($response, true);
        return $data['shows'] ?? [];
    }
}