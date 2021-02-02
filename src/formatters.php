<?php

namespace Differ\Formatters;

function render(array $ast, string $format): string
{
    switch ($format) {
        case 'plain':
            return Plain\render($ast);
        case 'stylish':
            return Stylish\render($ast);
        case 'json':
            return Json\render($ast);
        default:
            throw new \Exception("Unknown format: '{$format}'!");
    }
}
