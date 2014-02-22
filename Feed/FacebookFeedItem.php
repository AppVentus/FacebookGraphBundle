<?php

namespace AppVentus\FacebookGraphBundle\Feed;

/**
* Facebook Feed Item
*/
class FacebookFeedItem
{

    function __construct($title, $link, $description, $publishedAt, $author)
    {
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
        $this->publishedAt = $publishedAt;
        $this->author = $author;
    }
}
