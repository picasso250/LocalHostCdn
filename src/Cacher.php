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
        $api = new Api;
        $query = array('url' => $url);
        $ret = $api->get($this->api_url, $query);
        return $ret['content'];
    }
}
