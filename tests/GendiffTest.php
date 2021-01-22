<?php

use PHPUnit\Framework\TestCase;
use function Gendiff\Differ\genDiff;

class GendiffTest extends TestCase
{
    protected $filePath1;
    protected $filePath2;
    protected $expected;

    public function setUp(): void
    {
        $this->filePath1 = __DIR__ . '/fixtures/file1.json';
        $this->filePath2 = __DIR__ . '/fixtures/file2.json';
        $this->expected = file_get_contents(__DIR__ . '/fixtures/result1.txt');
        // var_dump($this->filePath1);
        // var_dump($this->filePath2);
        // var_dump($this->expected);
    }

    public function testValue(): void
    {
        $result = genDiff($this->filePath1, $this->filePath2);
        var_dump($result);
        var_dump($this->expected);
        $this->assertSame($result, $this->expected);
    }
}