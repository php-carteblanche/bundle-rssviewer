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

/* @var \WebSyndication\Abstract\StdClass $xml */
if (!isset($xml) || empty($xml)) return '';

$item_image         = $xml->getTagItem('image');
$item_title         = $xml->getTagItem('title');
$item_date          = $xml->getTagItem('updated_date');
$item_link          = $xml->getTagItem('item_link');
$item_description   = $xml->getTagItem('description');
$item_subtitle      = $xml->getTagItem('subtitle');
$item_author        = $xml->getTagItem('author');
$item_categories    = $xml->getTagItem('category');
$item_media         = $xml->getTagItem('media');
$item_comments      = $xml->getTagItem('comments');

?>
<div class="<?php echo \WebSyndication\Helper::getClass('item_wrapper'); ?>">

    <div class="<?php echo \WebSyndication\Helper::getClass('item_title'); ?>">

<?php
// parent feed if so
if (isset($alt_class) &&
    $alt_class==\WebSyndication\Helper::getClass('collection_alt_class') &&
    property_exists($xml, 'parent')
) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('channel_tag_template'),
        array(
            'xml' => $xml->parent,
            'alt_class' => \WebSyndication\Helper::getClass('item_alt_class')
        )
    );
}
?>

<?php if (!empty($item_link)) : ?>
        <a href="<?php echo $item_link->content; ?>" title="<?php 
            echo (isset($item_link->title) ? $item_link->title->content : 'See online');
        ?>">
<?php endif; ?>

            <?php echo $item_title->content; ?>

<?php if (!empty($item_link)) : ?>
        </a>
<?php endif; ?>

    </div>

    <div class="<?php echo \WebSyndication\Helper::getClass('item_content'); ?>">

<?php
// date
if (!empty($item_date)) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('date_tag_template'),
        array('xml' => $item_date, 'alt_class' => \WebSyndication\Helper::getClass('item_alt_class'))
    );
}

// image
if (!empty($item_image)) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('image_tag_template'),
        array('xml' => $item_image, 'alt_class' => \WebSyndication\Helper::getClass('item_alt_class'))
    );
}

// subtitle
if (!empty($item_subtitle)) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('content_tag_template'),
        array('xml' => $item_subtitle, 'alt_class' => \WebSyndication\Helper::getClass('item_alt_class'))
    );
}

// description
if (!empty($item_description)) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('content_tag_template'),
        array('xml' => $item_description, 'alt_class' => \WebSyndication\Helper::getClass('item_alt_class'))
    );
}

// categories list
if (!empty($item_categories)) {
    echo \WebSyndication\Helper::renderView(
            \WebSyndication\Helper::getTemplate('categories_tag_template'),
            array('xml' => $item_categories, 'alt_class' => \WebSyndication\Helper::getClass('item_alt_class'))
    );
}

// author
if (!empty($item_author)) {
    echo \WebSyndication\Helper::renderView(
            \WebSyndication\Helper::getTemplate('person_tag_template'),
            array('xml' => $item_author, 'alt_class' => \WebSyndication\Helper::getClass('item_alt_class'))
    );
}

// comments
if (!empty($item_comments)) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('comments_tag_template'),
        array('xml' => $item_comments, 'alt_class' => \WebSyndication\Helper::getClass('item_alt_class'))
    );
}

// media
if (!empty($item_media)) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('media_tag_template'),
        array('xml' => $item_media, 'alt_class' => \WebSyndication\Helper::getClass('item_alt_class'))
    );
}
?>

    </div>

</div>
