<?php
/**
 * This file is part of the CarteBlanche PHP framework.
 *
 * (c) Pierre Cassat <me@e-piwi.fr> and contributors
 *
 * License Apache-2.0 <http://github.com/php-carteblanche/carteblanche/blob/master/LICENSE>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var \WebSyndication\Feed $xml */
if (!isset($xml) || empty($xml)) return '';
if (!isset($offset)) $offset = 0;
if (!isset($limit)) $limit = null;

$channel_image          = $xml->getTagItem('image');
$channel_title          = $xml->getTagItem('title');
$channel_date           = $xml->getTagItem('updated_date');
$channel_link           = $xml->getTagItem('link');
$channel_description    = $xml->getTagItem('description');
$channel_subtitle       = $xml->getTagItem('subtitle');

?>
<div class="<?php echo \WebSyndication\Helper::getClass('channel_wrapper'); ?>">

    <div class="<?php echo \WebSyndication\Helper::getClass('channel_title'); ?>">

<?php if (!empty($channel_link)) : ?>
        <a href="<?php echo $channel_link->content; ?>" title="<?php 
            echo (isset($channel_link->title) ? $channel_link->title->content : 'See online');
        ?>">
<?php endif; ?>

            <?php echo $channel_title->content; ?>

<?php if (!empty($channel_link)) : ?>
        </a>
<?php endif; ?>

    </div>

    <div class="<?php echo \WebSyndication\Helper::getClass('channel_content'); ?>">

<?php
// subtitle
if (!empty($channel_subtitle)) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('content_tag_template'),
        array('xml' => $channel_subtitle, 'alt_class' => \WebSyndication\Helper::getClass('channel_alt_class'))
    );
}

// description
if (!empty($channel_description)) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('content_tag_template'),
        array('xml' => $channel_description, 'alt_class' => \WebSyndication\Helper::getClass('channel_alt_class'))
    );
}

// image
if (!empty($channel_image)) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('image_tag_template'),
        array('xml' => $channel_image, 'alt_class' => \WebSyndication\Helper::getClass('channel_alt_class'))
    );
}
?>

    </div>

</div>

<?php
foreach ($xml->getItems($limit, $offset) as $item) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('feed_item_template'),
        array('xml' => $item, 'alt_class' => \WebSyndication\Helper::getClass('channel_alt_class'))
    );
}
?>
