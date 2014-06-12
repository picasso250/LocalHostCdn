<?php

class Local
{
    public function check()
    {
        $url = Config::get('api.url.check');
        $api = new Api;
        $ret = $api->get($url);
        return $ret['list'];
    }
}
