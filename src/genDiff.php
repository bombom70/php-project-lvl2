<?php

namespace Differ\Differ;

use function Differ\Parsers\parseData;
use function Differ\Builder\builder;
use function Differ\Formatters\render;

function genDiff(string $pathToFile1, string $pathToFile2, string $format = 'stylish'): string
{
    $content1 = file_get_contents($pathToFile1);
    $content2 = file_get_contents($pathToFile2);
    $format1 = pathinfo($pathToFile1);
    $format2 = pathinfo($pathToFile2);
    $data1 = parseData($content1, $format1['extension']);
    $data2 = parseData($content2, $format2['extension']);

    $ast = builder($data1, $data2);
    return render($ast, $format);
}
