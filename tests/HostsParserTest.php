<?php

class HostsParserTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $parser = new HostsParser();
        $filename = tempnam(__DIR__, 'xc');
        $content = '
        #hello
        127.0.0.1 locahost #hz
        ';
        file_put_contents($filename, $content);
        $parser->parse($filename);
        $lines = $parser->lines;
        $map = $lines[2];
        $ip = $map->ip;
        $this->assertEquals('127.0.0.1', $ip);
        unlink($filename);
    }
}
