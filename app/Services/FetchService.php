<?php


namespace App\Services;


class FetchService
{
    /**
     * Fetch url
     *
     * @param string $url
     * @return string
     */
    public function fetch(string $url): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }
}
