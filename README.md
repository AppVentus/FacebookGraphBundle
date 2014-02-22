FacebookGraphBundle
===================

Want to get the PageId, the PageFeed, the page picture or anything else ? You're in the right place

Please add this bundle to your project with to composer :

    php composer.phar require appventus/facebook-graph-bundle:dev-master
    
Then declare it in your AppKernel by adding this line :

    new AppVentus\FacebookGraphBundle\AppVentusFacebookGraphBundle(),



Examples
====

Sometimes, you need the page id (for example to get the rss feed with the url  https://www.facebook.com/feeds/page.php?id=YOUPAGEID&format=rss20) :

    $facebookGraphParser = new AppVentus\FacebookGraphBundle\Parser\FacebookGraphParser('AppVentus');
    $facebookGraphParser->parse();
    $pageId = $facebookGraphParser->getParam('id');

To continue the rss example, sometimes you need to get the RSS Feed :

    $rssReader = new FacebookPageRssReader($festival->getFacebookPageId());
    $festival->feed = $rssReader->getFeed();
    
Then you'll have a FacebookFeed Object containing the title, link, description and all the items (FacebookFeedItem composed by a title, a description, a link, a publication date and a author). So in your custom twig view, you could display them like this :

    <h2>
        <a href="{{ feed.link }}">
            <img src="{{ facebookPictureUrl #See next example # }}">
        </a>
        {{ feed.title }}</small>
    </h2>
    <ul class="facebook-feed-items">
    {% for item in feed.items %}
        <li class="row">
            <em>{{ item.publishedAt|date('d/m/Y') }}</em>
            <p>
                {{ item.description|raw }}
            </p>
            <a href="{{ item.link }}">Voir le post direct sur Facebook</a>
        </li>
    {% endfor %}
    </ul>

Sometimes, you need the page picture :

    $facebookGraphParser = new AppVentus\FacebookGraphBundle\Parser\FacebookGraphParser('AppVentus');
    $facebookPictureUrl = $facebookGraphParser->getFacebookPicture(35, 35);
    
Feel free to fork and add your own needs, it's more fun together ;)
