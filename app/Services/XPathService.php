<?php


namespace App\Services;

class XPathService
{
    /**
     * @var string
     */
    protected $html;

    /**
     * @var \DOMDocument
     */
    protected $document;

    /**
     * @var \DOMXPath
     */
    protected $xpath;

    /**
     * Build document and xpath
     *
     * @return void
     */
    protected function buildXpath(): void
    {
        $this->document = new \DOMDocument('1.0', 'UTF-8');

        $internalErrors = libxml_use_internal_errors(true);
        $this->document->loadHTML($this->html);
        libxml_use_internal_errors($internalErrors);

        $this->xpath = new \DOMXPath($this->document);
    }

    /**
     * Parse html code to find attribute value
     *
     * @param string $query
     * @param string $regexp
     *
     * @return mixed|null
     */
    public function getAttributeFromHTML(string $query, ?string $regexp): ?string
    {
        try {
            $nodeText = $this->getNodeText($query);
            if (!empty($regexp)) {
                preg_match($regexp, $nodeText, $matches);
            }
            $result = $matches[1] ?? $nodeText;
        } catch (\Error $e) {
            $result = null;
        }

        return $result;
    }


    public function getNodeText(string $query): ?string
    {
        try {
            $result = trim($this->xpath->query($query)->item(0)->textContent);
        } catch (\ErrorException $e){
            $result = null;
        }
        return $result;
    }

    /**
     * @param string $html
     */
    public function setHtml(string $html): void
    {
        $this->html = $html;
        $this->buildXpath();
    }
}
