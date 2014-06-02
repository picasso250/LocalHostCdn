<?php

class NameParser
{
    public function __construct($name)
    {
        $name = str_replace('\\', '/', $name);
        $arr = parse_url($name);
        $this->raw = $arr['path'];
    }
    
    public function getExt()
    {
        $name = $this->getName();
        $pos = strrpos($this->raw, '.');
        if ($pos === false) {
            return '';
        }
        return substr($this->raw, $pos+1);
    }

    public function getName()
    {
        $arr = explode('/', $this->raw);
        return array_pop($arr);
    }
}
