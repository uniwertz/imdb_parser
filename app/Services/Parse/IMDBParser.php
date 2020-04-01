<?php


namespace App\Services\Parse;

use App\Services\XPathService;
use Illuminate\Support\Arr;

class IMDBParser extends AbstractParser
{
    /**
     * @var bool
     */
    protected $sourceIsSet = false;

    /**
     * @var string
     */
    private $sourceId = 'imdb';

    /**
     * @var XPathService
     */
    protected $parser;

    public function __construct()
    {
        $this->parser = new XPathService();
    }

    /**
     * Get all attributes according to parse_map.php config
     *
     * @return array
     */
    public function getAttributes(): array
    {
        if ($this->sourceIsSet === false){
            throw new \Error('Cannot retrieve attributes! Source is empty.');
        }

        $map = config("parse_map.{$this->sourceId}");

        $jsonMetadata = $this->parser->getNodeText('//script[@type="application/ld+json"]');
        $jsonData = json_decode($jsonMetadata, true);

        $result = [];
        foreach ($map as $attribute => $settings) {
            if (!empty($settings['disabled']))
                continue;

            // Trying to get value from json
            $jsonValue = Arr::get(
                $jsonData ?? [],
                $settings['path'] ?? -1,
                null
            );

            // Trying to get value from html
            $htmlValue = $this->parser->getAttributeFromHTML(
                $settings['query'] ?? null,
                $settings['regexp'] ?? null
            );

            $result[$attribute] = $jsonValue ?? $htmlValue;

            if ($result[$attribute] === null) {
                \Log::notice('Received empty attribute', [
                    'sourceId' => $this->sourceId,
                    'key' => $attribute
                ]);
            }
        }

        return $result;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source): void
    {
        $this->parser->setHtml($source);
        $this->sourceIsSet = true;
    }
}
