<?php

namespace AppVentus\FacebookGraphBundle\Parser;

/**
* FacebookGraphParser
* @author lenybernard
*/
class FacebookGraphParser
{
    private $pageName;
    private $params;
    private $graphUrl;

    /**
     * @return FacebookGraphParser Return this
     */
    function __construct($pageName)
    {
        $this->graphUrl = 'https://graph.facebook.com/'.$pageName;
    }

    /**
     * This function will parse the page and collect all params into $this->params
     * @return FacebookGraphParser Return this
     */
    function parse() {
        $headers = @get_headers($this->getGraphUrl());
        if (strpos($headers[0],'200') === false) {
            return false;
        }
        $json = file_get_contents($this->getGraphUrl());
        $this->params = json_decode($json, true);

        return $this;

    }

    /**
     * get AppId function
     *
     * @return void
     **/
    public function get($name)
    {
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        } else {
            throw new \Exception(sprintf("%s does not exists (only %)", $name, array_keys($this->params)));
        }
    }

    /**
     * Get the facebook picture
     * @return string The picture web path
     */
    public function getFacebookPicture($width = 50, $height = 50) {
        $graphPictureUrl = $this->graphUrl."/picture?width=".$width."&height=".$height;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $graphPictureUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER , 1);

        $header  = curl_getinfo( $ch );

        $this->output = null;
        if(isset($header['url']))
            $this->output = $header['url'];

        curl_close($ch);

        return $this->output;
    }

    /**
     * get Graph Url function
     *
     * @return string
     **/
    public function getGraphUrl()
    {
        return $this->graphUrl;
    }
}
