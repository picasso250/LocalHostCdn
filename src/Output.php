<?php

class Output
{
    public function output($path)
    {
        $paser = new ExtParser($path);
        $ext = $paser->getExt();
        header('type: '.$this->getTypeHeader($ext));
        echo file_get_contents($path);
    }

    public $map = array(
        'js' => 'application/javascript',
        'css' => 'xx',
        'htm' => 'text/html',
        'html' => 'text/html',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
    );
    public function getTypeHeader($ext)
    {
        if (empty($ext)) {
            return 'text/html';
        }
        $ext = strtolower($ext);
        if (isset($map[$ext])) {
            return $map[$ext];
        }
        return 'text/html';
    }
}
