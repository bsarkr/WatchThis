<?php

namespace app\models;

class Movie {
    public $id; 
    public $title;
    public $streamingAvailability;
    public $genres;
    public $rating;

    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'] ?? 'Unknown Title';
        $this->streamingAvailability = $data['streamingInfo'] ?? [];
        $this->genres = $data['genres'] ?? [];
        $this->rating = $data['rating'] ?? null;
    }
}