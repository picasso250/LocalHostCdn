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
        $this->assertEquals('127.0.0.1', $this->lines[1]->map->ip);
        unlink($filename);
    }
}
