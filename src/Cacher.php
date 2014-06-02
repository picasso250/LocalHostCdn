<?php

class Cacher
{
    public function getPath($url)
    {
        $content = $this->fetch($url);
        $searcher = new Searcher;
        $path = $searcher->getPath($url);
        file_put_contents($path, $content);
    }

    public function fetch($url)
    {
        $query = array('url' => $url);
        $url = $this->api_url.'?'.http_build_query($query);
        $ch = curl_init($url);
        curl_setopt($ch, CURL_RETURN_TRANSFER, true);
        return curl_exec($ch);
    }
}
