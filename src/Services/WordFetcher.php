<?php

namespace QDenka\LandingGenerator\Services;

use QDenka\LandingGenerator\Entities\Storage;
use QDenka\LandingGenerator\Entities\Text;
use QDenka\LandingGenerator\Exceptions\FileException;

class WordFetcher
{
    /**
     * @return bool
     * @throws FileException
     */
    public function fetch(): bool
    {
        $wordList = HttpRequester::init()->get(Text::WORD_LIST_URL);

        return FileService::save(Storage::PATH, $wordList, Text::WORD_LIST_FILENAME);
    }
}