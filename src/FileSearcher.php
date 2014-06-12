<?php

class FileSearcher
{
    public function getPath($url)
    {
        $parser = new ExtParser();
        $ext = $parser->getExt();
        return '/'.md5($url).basename($url);
    }
}
