<?php

namespace hosts;

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
        $this->hosts = array_filter($arr);
    }

    public function fromIpHost($ip, $host)
    {
        $this->ip = $ip;
        $this->hosts = array($host);
    }

    public function hostExists($host)
    {
        return in_array($host, $this->hosts);
    }

    public function addHost($host)
    {
        $this->hosts[] = $host;
    }

    public function deleteHost($host)
    {
        $this->hosts = array_diff($this->hosts, array($host));
        return !empty($this->hosts);
    }

    public function toText()
    {
        return $this->ip."\t".implode("\t", $this->hosts);
    }
}
