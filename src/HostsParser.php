<?php

class HostsParser
{
    public $lines;
    public function parse($filename)
    {
        $lines = array();
        $file = fopen($filename, 'r');
        while (($line_text = fgets($file)) !== false) {
            $line = new Line();
            $line_text = trim($line_text);
            if (empty($line_text)) {
                $line->type = Line::TYPE_EMPTY;
            } elseif ($line_text[0] == '#') {
                $line->type = Line::TYPE_COMMENT;
                $line->comment = new Comment(substr($line_text, 1)); // auto trim
            } else {
                $line->type = Line::TYPE_MIX;
                $pos = strpos($line_text, '#');
                if ($pos === false) {
                    $line->map = new Map($line_text);
                } else {
                    $map_text = substr($line_text, 0, $pos);
                    $line->map = new Map($map_text);
                    $comment_text = substr($line_text, $pos+1);
                    $line->comment = new Comment($comment_text);
                }
            }
            $lines[] = $line;
        }
        return $this->lines = $lines;
    }

    public function addRule($ip, $host)
    {
        foreach ($this->lines as $i => $line) {
            if ($line->type == Line::TYPE_MIX) {
                if ($line->map->ip == $ip) {
                    if ($line->map->hostExists($host)) {
                        return true;
                    } else {
                        $line->map->addHost($host);
                        return $i;
                    }
                }
            }
        }
        $line = new Line();
        $line->type = Line::TYPE_MIX;
        $line->map = new Map($ip, $host);
        $this->lines[] = $line;
        return $i;
    }

    public function deleteRule($ip, $host)
    {
        foreach ($this->lines as $i => $line) {
            if ($line->type == Line::TYPE_MIX) {
                if ($line->map->ip == $ip) {
                    if ($line->map->hostExists($host)) {
                        // maybe we do not need to remove line
                        // because when use delete a ip rule and then add it (modify)
                        // it will go to the end of file
                        // and that sucks?
                        if (!$line->map->deleteHost($host)) {
                            $this->removeLine($i);
                        }
                        return $i;
                    } else {
                        throw new \Exception("no host '$host' in line $i ", 1);
                        return $i;
                    }
                }
            }
        }
        return false;
    }

    public function removeLine($i)
    {
        unset($this->lines[$i]);
    }

    public function format()
    {
        $lines = array_map(function ($line) {
            return $line->toText();
        }, $this->lines);
        return implode('\n', $lines);
    }

}
