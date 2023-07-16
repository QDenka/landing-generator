<?php

namespace QDenka\LandingGenerator\Entities;

use QDenka\LandingGenerator\Exceptions\WordException;
use QDenka\LandingGenerator\Services\FileService;

class Text
{
    const WORD_LIST_URL = 'https://raw.githubusercontent.com/tadms/random/master/words.json';
    const WORD_LIST_FILENAME = 'words.json';

    /**
     * @param int $lettersFrom
     * @param int $lettersTo
     * @return array
     * @throws WordException
     */
    public static function getWordList(int $lettersFrom = 3, int $lettersTo = 5): array
    {
        if ($lettersFrom > $lettersTo) {
            throw new WordException('Letters from must be less than letters to');
        }

        $wordList = FileService::getFromStorage(self::WORD_LIST_FILENAME);
        $wordList = json_decode($wordList, true);

        if (empty($wordList)) {
            throw new WordException('Word list is empty');
        }

        if ($lettersFrom < self::getMinimalLength($wordList)) {
            throw new WordException('Word list with this length does not exist');
        }

        if ($lettersTo > self::getMaximumLength($wordList)) {
            throw new WordException('Word list with this length does not exist');
        }

        return self::mergeWordList($lettersFrom, $lettersTo, $wordList);
    }

    /**
     * @param array $list
     * @return int
     */
    private static function getMinimalLength(array $list): int
    {
        return min($list);
    }

    /**
     * @param array $list
     * @return int
     */
    private static function getMaximumLength(array $list): int
    {
        return max($list);
    }

    /**
     * @param int $letterFrom
     * @param int $letterTo
     * @param array $wordList
     * @return array
     */
    private static function mergeWordList(int $letterFrom, int $letterTo, array $wordList): array
    {
        $result = [];
        for ($i = $letterFrom; $i <= $letterTo; $i++) {
            $result = array_merge($result, $wordList[$i]);
        }

        return $result;
    }
}