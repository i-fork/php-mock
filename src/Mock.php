<?php


namespace KaywGeek;


use KaywGeek\Exceptions\ExecutionException;
use kaywGeek\Exceptions\InvalidArgumentException;

class Mock
{
    const FORMAT_ARRAY = 1;
    const FORMAT_OBJECT = 2;
    const FORMAT_JSON = 3;
    const FORMAT_STRING = 4;
    const FORMAT = [
        self::FORMAT_ARRAY,
        self::FORMAT_OBJECT,
        self::FORMAT_JSON,
        self::FORMAT_STRING,
    ];
    protected $file;
    protected $fileMaxLine;


    /**
     * 获取文件对象实例
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getFileMaxLine()
    {
        return $this->fileMaxLine;
    }

    /**
     * 按照指定格式返回指定数量的单词
     * @param int $length
     * @param MockWords $format
     * @return array|false|object|string
     */
    public function mockWords(int $format,int $length = 2)
    {
        if (!in_array($format, self::FORMAT)) {
            throw new InvalidArgumentException('The format parameter is invalid');
        }
        if ($length < 1) {
            throw new InvalidArgumentException('length It has to be greater than 1');
        }
        if ($length > 500) {
            throw new InvalidArgumentException('Maximum length is 500');
        }
        $arr = [];
        for ($i = 1; $i <= $length; $i++) {
            $arr[] = self::mockWord();
        }
        switch ($format) {
            case self::FORMAT_ARRAY:
            {
                return $arr;
            }
            case self::FORMAT_OBJECT:
            {
                return self::array2Obj($arr);
            }
            case self::FORMAT_JSON:
            {
                return json_encode($arr);
            }
            case self::FORMAT_STRING:
            {
                return implode(" ", $arr);
            }
            default:
            {
                throw new InvalidArgumentException('The format parameter is invalid');
            }
        }
    }

    /**
     * 生成一个单词
     * @return string
     */
    public function mockWord(): string
    {
        $this->file->seek(mt_rand(1, $this->fileMaxLine));
        return str_replace("\r\n","",$this->file->current());
    }

    /**
     * 数组转对象
     * @param array $arr
     * @return object
     */
    protected function array2Obj(array $arr): object
    {
        if (gettype($arr) != 'array') {
            throw new InvalidArgumentException('I\'m going to pass in an array');
        }
        foreach ($arr as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object') {
                $arr[$k] = (object)self::array2Obj($v);
            }
        }
        return (object)$arr;
    }

    /**
     * 初始化读取文件
     */
    protected function readFile(string $wordsPath)
    {
        if (!is_file($wordsPath)) {
            throw new ExecutionException('File not found');
        }
        try {
            $this->file = new \SplFileObject($wordsPath);
            $this->fileMaxLineAction($wordsPath);
        } catch (\kaywGeek\Exceptions\ExecutionException $exception) {
            throw $exception;
        }
    }

    /**
     * 文件指针获取最大行数
     * @param $wordsPath
     */
    public function fileMaxLineAction($wordsPath)
    {
        if (!is_file($wordsPath)) {
            throw new ExecutionException('File not found');
        }
        $fp = fopen($wordsPath, "r");
        $i = 0;
        while (!feof($fp)) {
            if ($data = fread($fp, 8192)) {
                $num = substr_count($data, "\n");
                $i += $num;
            }
        }
        fclose($fp);
        $this->fileMaxLine = $i;
    }


}