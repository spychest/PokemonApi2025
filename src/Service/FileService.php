<?php

namespace App\Service;

class FileService
{
    public function readJsonFile(string $path): array
    {
        $json = file_get_contents($path);
        return json_decode($json, true);
    }
}