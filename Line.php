<?php

class Line
{
    const TYPE_EMPTY = 1;
    const TYPE_COMMENT = 2;
    const TYPE_MIX = 3;

    public $type;
    public $comment;
    public $map;

    public function toText()
    {
        switch ($this->type) {
            case Line::TYPE_EMPTY:
                return '';
                break;
            case Line::TYPE_COMMENT:
                return $this->comment->toText();
            case Line::TYPE_MIX:
                return $this->map->toText().' '.$this->comment->toText();
            default:
                throw new \Exception("unrecognize line type $this->type", 2);
                break;
        }
        return false;
    }

}
