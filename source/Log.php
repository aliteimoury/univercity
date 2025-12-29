<?php
class Log
{
    private $filename;
    private $filepath;

    public function __construct($filename)
    {
        $filename = $filename .".txt";
        $this->filename = $filename;
        $this->filepath = "Log/" . $this->filename;
    }

    public function Printlog($text)
    {
        $text =date("Y-m-d H:i:s").":".$text;
        file_put_contents($this->filepath, $text . PHP_EOL, FILE_APPEND);
    }
}
