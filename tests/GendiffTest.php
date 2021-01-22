<?php

use PHPUnit\Framework\TestCase;
use function Gendiff\Differ\genDiff;

class GendiffTest extends TestCase
{
     /**
     * @dataProvider additionProvider
     */
    public function testGenDiff($filePath1, $filePath2, $filePathResult)
    {
        $result = genDiff($filePath1, $filePath2);
        $expected = file_get_contents($filePathResult);
        $this->assertSame($result, $expected);
    }

    public function additionProvider()
    {
        return [
            [__DIR__ . '/fixtures/file1.json', __DIR__ . '/fixtures/file2.json', __DIR__ . '/fixtures/result1.txt'],
            [__DIR__ . '/fixtures/file1.yml', __DIR__ . '/fixtures/file2.yml', __DIR__ . '/fixtures/result1.txt']
        ];
    }
}