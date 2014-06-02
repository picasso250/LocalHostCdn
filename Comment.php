<?php
class Comment
{
    public $text;
    
    public function __construct($text)
    {
        $this->text = trim($text);
    }

    public function toText()
    {
        return '# '.$this->text;
    }
}
