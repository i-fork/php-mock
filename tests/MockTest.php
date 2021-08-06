<?php

class MockTest extends \PHPUnit\Framework\TestCase
{

    public function testMockWord()
    {
        $mock = new \KaywGeek\MockWords();
        $words = $mock->mockWord();
        $this->assertIsString($words);
    }

    public function testMockWordFormat()
    {
        $mock = new \KaywGeek\MockWords();
        $wordsArr = $mock->mockWords(\KaywGeek\MockWords::FORMAT_ARRAY);
        $this->assertIsArray($wordsArr);
        $this->assertIsObject($mock->mockWords(\KaywGeek\MockWords::FORMAT_OBJECT));
        $this->assertIsString($mock->mockWords(\KaywGeek\MockWords::FORMAT_STRING));
        $this->assertIsString($mock->mockWords(\KaywGeek\MockWords::FORMAT_JSON));
//        fwrite(STDERR,print_r($mock->mockWords(\KaywGeek\MockWords::FORMAT_JSON),true));
    }

    public function testMockSentence()
    {
        $mock = new \KaywGeek\MockSentence();
        $this->assertIsString($mock->mockWord());
    }

    public function testMockSentenceFormat()
    {
        $mock = new \KaywGeek\MockSentence();
        $this->assertIsArray($mock->mockWords(\KaywGeek\Mock::FORMAT_ARRAY));
        $this->assertIsObject($mock->mockWords(\KaywGeek\Mock::FORMAT_OBJECT));
        $this->assertIsString($mock->mockWords(\KaywGeek\Mock::FORMAT_STRING));
        $this->assertIsString($mock->mockWords(\KaywGeek\Mock::FORMAT_JSON));

    }
}