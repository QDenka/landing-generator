<?php

namespace QDenka\LandingGenerator\Generators;

use QDenka\LandingGenerator\Entities\Text;
use QDenka\LandingGenerator\Exceptions\WordException;

class TextGenerator
{
    private array $wordList;

    /**
     * @throws WordException
     */
    private function __construct()
    {
        $this->wordList = Text::getWordList();
    }

    public function generate(int $wordsCount): string
    {
        $result = [];
        for ($i = 0; $i < $wordsCount; $i++) {
            $result[] = $this->wordList[array_rand($this->wordList)];
        }

        return implode(' ', $result);
    }
}