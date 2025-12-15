<?php
class Log
{
    private $filename;
    private $filepath;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->filepath = $this->filename . ".txt";
    }

    public function log($text)
    {
        file_put_contents($this->filepath, date('Y-m-d H:i:s') . '(' . $_SERVER['REMOTE_ADDR']
            . ')' . "  {" . $text . "}" . PHP_EOL, FILE_APPEND);
    }
}
