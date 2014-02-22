<?php

namespace AppVentus\FacebookGraphBundle\Feed;

use AppVentus\FacebookGraphBundle\Feed\FacebookFeedItem;

/**
* Facebook Feed
*/
class FacebookFeed
{

    private $title;
    private $link;
    private $description;
    private $items;

    public function __construct( $title,  $link,  $description)
    {
        $this->title       = $title;
        $this->link        = $link;
        $this->description = $description;
    }

    /**
     * Add a FacebookFeedItem
     *
     * @return FacebookFeed
     * @author lenybernard
     **/
    public function addItem(FacebookFeedItem $item)
    {
        $this->items[] = $item;
    }

    /**
     * Get FacebookFeedItems
     *
     * @return array
     * @author lenybernard
     **/
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get Title
     *
     * @return array
     * @author lenybernard
     **/
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get Description
     *
     * @return array
     * @author lenybernard
     **/
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get Link
     *
     * @return array
     * @author lenybernard
     **/
    public function getLink()
    {
        return $this->link;
    }
}
