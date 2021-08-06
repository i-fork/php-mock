<?php


namespace KaywGeek;


class MockSentence extends Mock
{
    protected  $wordsPath = __DIR__ . '/../text/sentence.txt';

    public function __construct($wordsPath = '')
    {
        $this->wordsPath = $wordsPath === '' ? $this->wordsPath : $wordsPath;
        $this->readFile($this->wordsPath);
    }
}