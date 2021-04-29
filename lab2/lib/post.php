<?php

class Post
{
    private $name;
    private $description;
    private $author;
    private $datetime;
    private $filepath;

    function __construct($nameParam, $descParam, $authorParam, $dateParam, $fileParam)
    {
        $this->name = $nameParam;
        $this->description = $descParam;
        $this->author = $authorParam;
        $this->datetime = $dateParam;
        $this->filepath = $fileParam;
    }

    function getName() { return $this->name; }
    function getDescription() { return $this->description; }
    function getAuthor() { return $this->author; }
    function getDateTime() { return $this->datetime; }
    function getFilePath() { return $this->filepath; }
}