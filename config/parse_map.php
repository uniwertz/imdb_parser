<?php

return [
    'imdb' => [
        //1. Title
        'title' => [
            'path' => 'name',
            'query' => '//div[@class="originalTitle"]',
            'regexp' => '/^\h*(.+)\h+\(original title\)\h*$/ui'
        ],

        //3. Release date
        'poster' => [
            'disabled' => true,
            'path' => null,
            'query' => '',
            'regexp' => '',
            'type' => 'file'
        ],

        'release_date' => [
            'path' => null,
            'query' => "//*[text() = 'Release Date:']/..",
            'regexp' => '/Release\h+Date:\h+(\d+\h+\w+\h+\d{4})/ui'
        ],

        //4. Rating
        'rating' => [
            'path' => 'aggregateRating.ratingValue',
            'query' => "",
            'regexp' => ''
        ],

        //5. "Genres"
        'genres' => [
            'path' => 'genre',
            'query' => "",
            'regexp' => ''
        ],

        //6. "Director"
        'director' => [
            'path' => 'director.name',
            'query' => "",
            'regexp' => ''
        ],
    ]
];
