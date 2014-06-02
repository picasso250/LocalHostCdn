<?php

class Map
{
    public $ip;
    public $hosts;
    
    public function __construct($text, $host = null)
    {
        if ($host === null) {
            $this->fromString($text);
        } else {
            $this->fromIpHost($text, $host);
        }
    }

    public function fromString($text)
    {
        $arr = preg_split('/\s+/', $text);
        if (count($arr) < 2) {
            throw new \Exception("'$text' illeagal text", 1);
        }
        $this->ip = array_shift($arr);
        $this->hosts = $arr;
    }

    public function fromIpHost($ip, $host)
    {
        $this->ip = $ip;
        $this->hosts = array($host);
    }
}
