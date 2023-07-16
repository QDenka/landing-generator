<?php

namespace QDenka\LandingGenerator\Services;

use QDenka\LandingGenerator\Entities\Storage;
use QDenka\LandingGenerator\Exceptions\FileException;

class FileService
{
    /**
     * @param string $path
     * @param string $content
     * @param string $name
     * @return bool
     * @throws FileException
     */
    public static function save(string $path, string $content, string $name): bool
    {
        try {
            $file = fopen($path . $name, 'w');
            fwrite($file, $content);
            fclose($file);
        } catch (\Exception $e) {
            throw new FileException($e->getMessage());
        }

        return true;
    }

    /**
     * @param string $name
     * @return string
     */
    public static function getFromStorage(string $name): string
    {
        return file_get_contents(Storage::PATH . $name);
    }
}