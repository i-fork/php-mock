![](D:\xampp\htdocs\english-words\logo.png)

![GitHub](https://img.shields.io/github/license/kayw-geek/php-mock)![Packagist Downloads](https://img.shields.io/packagist/dm/kayw-geek/php-mock)![GitHub top language](https://img.shields.io/github/languages/top/kayw-geek/php-mock)![Scrutinizer coverage (GitHub/BitBucket)](https://img.shields.io/scrutinizer/coverage/g/kayw-geek/php-mock/main)

#### 简介

> 这个库提供了生成英文单词和句子，它支持自定义词库，支持自定义返回单词\句子长度以及返回类型（字符串、数组、对象、json），它不会因为自定义的大文件词库导致你的内存不够用，轻量级快速帮你生成数据。

#### 安装

```shell
composer require kayw-geek/php-mock -vvv
```

#### 使用

```php
//mock 单个单词
$mockWord = new \KaywGeek\MockWords();
$mockWord->mockWord();
//mock 单条句子
$mockSentence = new \KaywGeek\MockSentence();
$mockSentence->mockWord();

//mock 指定格式指定数量的单词
//参数1 想要返回的指定格式 
/**
  * FORMAT_ARRAY;
  * FORMAT_OBJECT;
  * FORMAT_JSON;
  * FORMAT_STRING; 
  */
//参数2 想要返回的长度
$mockWord->mockWords(\KaywGeek\MockWords::FORMAT_ARRAY,5);
$mockSentence->mockWords(\KaywGeek\MockWords::FORMAT_JSON,6);

//自定义词库使用
$filePath = 'custom-words.txt';
$mockSentence = new \KaywGeek\MockSentence($filePath);
```



#### 测试覆盖率

![coverage](D:\xampp\htdocs\english-words\coverage.png)

