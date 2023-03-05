<?php

require_once 'Entry.php';
require_once 'Channel.php';
require_once 'Database.php';

class Channels
{
    private static $urls;
    private static $options = array(
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true
    );

    public static function addURL($url)
    {
        self::$urls[] = $url;
    }

    public static function get()
    {
        $mh       = curl_multi_init();
        $chs      = array();
        $channels = array();
        $active = 0;

        foreach (self::$urls as $url) {
            $ch = curl_init($url);
            $chs[] = $ch;

            curl_setopt_array($ch, self::$options);
            curl_multi_add_handle($mh, $ch);
        }

        do {
            $result = curl_multi_exec($mh, $active);
        } while ($result == CURLM_CALL_MULTI_PERFORM);

        do {
            if (curl_multi_select($mh) != -1) {
                do {
                    $result = curl_multi_exec($mh, $active);
                } while ($result == CURLM_CALL_MULTI_PERFORM);
            }
        } while ($active && $result == CURLM_OK);

        foreach ($chs as $ch) {
            if (curl_errno($ch) == 0) {
                $content    = curl_multi_getcontent($ch);
                $channels[] = self::parseXML($content);
            }
        }
        return $channels;
    }

    private static function parseXML($xml)
    {
        try {
            $root = new SimpleXMLElement($xml);

            $url         = $root->channel->link;
            $title       = $root->channel->title;
            $description = $root->channel->description;
            $channel = new Channel($url, $title, $description);
            foreach ($root->channel->item as $item) {
                $entryUrl         = $item->link;
                $entryTitle       = $item->title;
                $entryDate        = strtotime($item->date);
                $entryDescription = $item->description;

                $entry = new Entry($channel, $entryUrl, $entryTitle, $entryDate, $entryDescription);
                $channel->addEntry($entry);

                $database = new Database();
                if ($database->getSimilar($entryTitle)) {
                    $database->insert($entryUrl, $entryTitle, $entryDate, $entryDescription);
                }
            }
            return $channel;
        } catch (\Throwable $th) {
            exit($th->getMessage());
        }
    }
}
