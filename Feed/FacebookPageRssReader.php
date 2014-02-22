<?php

namespace AppVentus\FacebookGraphBundle\Feed;

use AppVentus\FacebookGraphBundle\Feed\FacebookFeed;
use AppVentus\FacebookGraphBundle\Feed\FacebookFeedItem;

/**
* Facebook Page Rss Reader
*/
class FacebookPageRssReader
{
    private $url;

    /**
     * Construct the reader by giving him the facebook page name to parse
     */
    function __construct($pageId)
    {
        $this->url = "http://www.facebook.com/feeds/page.php?id=".$pageId."&format=rss20";
    }

    /**
     * Get items
     *
     * @return array
     * @author lenybernard
     **/
    public function getFeed($nb = 20)
    {
        ini_set('user_agent', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9');
        $xml = simplexml_load_file($this->url); // Load the XML file

        // This creates an array called "entry" that puts each <item> in FB's
        // XML format into the array
        $entry = $xml->channel->item;

        // We instanciate a facebook feed object to get all feed items
        $facebookFeed = new FacebookFeed(
            $xml->channel->title,
            $xml->channel->link,
            $xml->channel->description
        );

        // Now we'll loop through are array. I just have it going up to 3 items
        // for this example.
        for ($i = 0; $i < 3; $i++) {
            $item = new FacebookFeedItem(
                $entry[$i]->title,
                $entry[$i]->link,
                $entry[$i]->description,
                strtotime($entry[$i]->pubDate),
                $entry[$i]->author);

            $facebookFeed->addItem($item);
        }

        // Finally, we return (or in this case echo) our formatted string with our
        // Facebook page feed data in it!
        return $facebookFeed;
    }
}
