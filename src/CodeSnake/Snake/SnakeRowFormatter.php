<?php

namespace CodeSnake\Snake;

use Illuminate\Support\Collection;

/**
 * Class SnakeRowFormatter
 * @package CodeSnake\Snake
 */
class SnakeRowFormatter
{
    /**
     * @var bool
     */
    protected $horizontal = true;

    /**
     * @var int
     */
    protected $spacesToPrepend = 0;

    /**
     * @param string $phrase
     * @return array
     */
    public function getSplitRows(string $phrase):array
    {
        $phraseWords = Collection::make(explode(' ', strtoupper($phrase)));

        $firstWord = $phraseWords->first();
        $wordSnakeRows = [];

        foreach ($phraseWords as $key => $word) {
            $splitLetters = str_split($word);

            if ($word === $firstWord) {
                $wordSnakeRows[] = $splitLetters;
            } else {
                if ($this->horizontal) {
                    // Horizontal printing

                    // Take off first letter
                    array_shift($splitLetters);

                    // Append to last row of existing vertical
                    $wordSnakeRows[count($wordSnakeRows) - 1] = array_merge(
                        $wordSnakeRows[count($wordSnakeRows) - 1],
                        $splitLetters
                    );

                    $wordSnakeRows[] = $this->getSpacesToPrepend() + $splitLetters;
                } else {
                    // Vertical printing

                    // Remove first letter
                    array_shift($splitLetters);

                    $this->spacesToPrepend = $this->spacesToPrepend - 2;

                    for ($i = 0; $i < count($splitLetters); $i++) {
                        $currentLetter = $splitLetters[$i];
                        $wordSnakeRows[] = array_merge($this->getSpacesToPrepend(), [$currentLetter]);
                    }

                    if ($key == 1) {
                        $this->spacesToPrepend = $this->spacesToPrepend + 2;
                    }
                }
            }

            // Add to number of spaces to prepend
            if ($this->horizontal) {
                $this->spacesToPrepend += count($splitLetters);
            }

            // Flip state of horizontal printing after each processed word
            $this->horizontal = !$this->horizontal;
        }

        // Remove rogue empty row I can’t track down reason for existence
        foreach ($wordSnakeRows as $wordSnakeRowKey => $wordSnakeRowValues) {
            if (count(array_unique($wordSnakeRowValues)) === 1 && end($wordSnakeRowValues) === " ") {
                unset($wordSnakeRows[$wordSnakeRowKey]);
            }
        }

        return array_values($wordSnakeRows);
    }

    /**
     * @return array
     */
    protected function getSpacesToPrepend():array
    {
        $row = [];
        for ($i = 0; $i <= $this->spacesToPrepend; $i++) {
            array_push($row, ' ');
        }

        return $row;
    }
}