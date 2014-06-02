<?php

class HostsParserTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $parser = new \hosts\HostsParser();
        $filename = tempnam(__DIR__, 'xc');
        $content = '
        #hello
        127.0.0.1 localhost xiaochi #hz
        ';
        file_put_contents($filename, $content);
        $parser->parse($filename);
        unlink($filename);

        $lines = $parser->lines;
        $line = $lines[2];
        $map = $line->map;
        $ip = $map->ip;
        $this->assertEquals('127.0.0.1', $ip);
        $comment = $line->comment;
        $this->assertEquals('hz', $comment->text);

        $parser->deleteRule('127.0.0.1', 'xiaochi');
        $this->assertEquals(array('localhost'), $map->hosts);
    }
}
