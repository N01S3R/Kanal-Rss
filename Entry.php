<?php
require_once 'Channel.php';

class Entry
{
    private $channel;
    private $url;
    private $title;
    private $date;
    private $description;

    public function __construct(Channel $c, $url, $title, $date, $desc)
    {
        $this->channel     = $c;
        $this->url         = $url;
        $this->title       = $title;
        $this->date        = $date;
        $this->description = $desc;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function getURL()
    {
        return $this->url;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
