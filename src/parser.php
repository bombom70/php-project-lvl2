<?php

namespace Gendiff\Parser;

use Symfony\Component\Yaml\Yaml;

function parser($data, $format)
{
    if ($format === 'json') {
        return json_decode($data);
    }
    if ($format === 'yml') {
        return Yaml::parse($data, Yaml::PARSE_OBJECT_FOR_MAP);
    }
}
