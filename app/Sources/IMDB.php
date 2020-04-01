<?php


namespace App\Sources;

use App\Services\FetchService;
use App\Services\Parse\IMDBParser;

class IMDB
{
    const URL_PATTERN = 'https://www.imdb.com/title/';

    /**
     * Get movie attributes from IMDB.com (by inner IMDB id)
     *
     * @param string $id
     * @return array
     */
    public function getAttributesById(string $id): array
    {
        // Fetch source url
        $fetcher = new FetchService();
        $html = $fetcher->fetch(self::URL_PATTERN . $id);

        // Parse source page
        $parser = new IMDBParser();
        $parser->setSource($html);

        $attributes = $parser->getAttributes();

        return $attributes;
    }
}
