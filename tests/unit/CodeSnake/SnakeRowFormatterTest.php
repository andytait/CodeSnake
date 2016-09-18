<?php

namespace CodeSnake;

use CodeSnake\Snake\SnakeRowFormatter;
use PHPUnit\Framework\TestCase;

class SnakeRowFormatterTest extends TestCase
{
    /** @var SnakeRowFormatter */
    protected $snakeRowFormatter;

    public function setUp()
    {
        $this->snakeRowFormatter = new SnakeRowFormatter;
    }

    public function test_instance()
    {
        $this->assertInstanceOf(SnakeRowFormatter::class, $this->snakeRowFormatter);
    }

    public function getPhrases()
    {
        return [
            [
                "JAMES SINKS SAUSAGE ENEMA",
                [
                    ['J', 'A', 'M', 'E', 'S'],
                    [' ', ' ', ' ', ' ', 'I'],
                    [' ', ' ', ' ', ' ', 'N'],
                    [' ', ' ', ' ', ' ', 'K'],
                    [' ', ' ', ' ', ' ', 'S', 'A', 'U', 'S', 'A', 'G', 'E'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'N'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'E'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'M'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'A'],
                ]
            ],
            [
                "Stumble elephant tarantula ascot",
                [
                    ['S', 'T', 'U', 'M', 'B', 'L', 'E'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'L'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'E'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'P'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'H'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'A'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'N'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'T', 'A', 'R', 'A', 'N', 'T', 'U', 'L', 'A'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'S'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'C'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'O'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'T'],
                ]
            ],
            [
                "Netflix Xylophone elephant teapot",
                [
                    ['N', 'E', 'T', 'F', 'L', 'I', 'X'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'Y'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'L'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'O'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'P'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'H'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'O'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'N'],
                    [' ', ' ', ' ', ' ', ' ', ' ', 'E', 'L', 'E', 'P', 'H', 'A', 'N', 'T'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'E'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'A'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'P'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'O'],
                    [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 'T'],
                ]
            ]
        ];
    }

    /** @dataProvider getPhrases
     * @param $phrase
     * @param $wordSnake
     */
    public function testSplitPhraseWillReturnRows($phrase, $wordSnake)
    {
        $this->assertEquals(
            $wordSnake,
            $this->snakeRowFormatter->getSplitRows($phrase)
        );
    }
}