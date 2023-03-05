<?php
require_once 'Entry.php';

class Channel
{
    private $url;
    private $title;
    private $description;
    private $entries = array();

    function __construct($url, $title, $desc)
    {
        $this->url         = $url;
        $this->title       = $title;
        $this->description = $desc;
    }

    public function getURL()
    {
        return $this->url;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function addEntry(Entry $e)
    {
        $this->entries[] = $e;
    }

    public function getEntries()
    {
        return $this->entries;
    }
}
