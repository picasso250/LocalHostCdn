<?php

class Api
{
    public function get($url, $param = array())
    {
        $query = array('url' => $url);
        $url = $this->api_url.'?'.http_build_query($param);
        $ch = curl_init($url);
        curl_setopt($ch, CURL_RETURN_TRANSFER, true);
        $ret = curl_exec($ch);
        return json_decode($ret, true);
    }
}
