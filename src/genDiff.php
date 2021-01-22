<?php

namespace Gendiff\Differ;

use function Gendiff\Parser\parser;

function genDiff(string $pathToFile1, string $pathToFile2): string
{
    $content1 = file_get_contents($pathToFile1);
    $content2 = file_get_contents($pathToFile2);
    $format1 = pathinfo($pathToFile1);
    $format2 = pathinfo($pathToFile2);
    $data1 = parser($content1, $format1['extension']);
    $data2 = parser($content2, $format2['extension']);
    $coll = array_merge((array) $data1, (array) $data2);
    $keys = array_keys($coll);
    sort($keys);
    $result = array_reduce($keys, function ($acc, $key) use ($data1, $data2) {
        if (array_key_exists($key, $data1) && array_key_exists($key, $data2)) {
            if ($data1->$key === $data2->$key) {
                $acc[] = "    {$key}: {$data1->$key}";
                return $acc;
            }
            $acc[] = "  - {$key}: {$data1->$key}\n  + {$key}: {$data2->$key}";
            return $acc;
        }
        if (array_key_exists($key, $data1) && !array_key_exists($key, $data2)) {
            $val1 = gettype($data1->$key) === 'boolean' ? var_export($data1->$key, true) : $data1->$key;
            $acc[] = "  - {$key}: {$val1}";
            return $acc;
        }
        if (!array_key_exists($key, $data1) && array_key_exists($key, $data2)) {
            $val2 = gettype($data2->$key) === 'boolean' ? var_export($data2->$key, true) : $data2->$key;
            $acc[] = "  + {$key}: {$val2}";
            return $acc;
        }
    }, []);
    $ast = implode("\n", $result);

    return "{\n{$ast}\n}";
}
