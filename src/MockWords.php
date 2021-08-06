<?php
namespace KaywGeek;

use kaywGeek\Exceptions\InvalidArgumentException;

class MockWords extends Mock
{
    protected  $wordsPath = __DIR__ . '/../text/words.txt';
    public function __construct($wordsPath = '')
    {
        $this->wordsPath = $wordsPath === '' ? $this->wordsPath : $wordsPath;
        $this->readFile($this->wordsPath);
    }

}