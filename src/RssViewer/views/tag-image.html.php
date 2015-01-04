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

if (!isset($xml) || empty($xml)) return '';
if (!isset($alt_class)) $alt_class = '';

$image_src = $image_alt = $image_description = $image_link = null;
$image_src = (isset($xml->url) ? $xml->url->content : $xml->content);
if (isset($image->link)) $image_link = $image->link->content;
if (isset($image->description)) $image_description = $image->description->content;
if (isset($image->title)) $image_alt = $image->title->content;

$width = $height = 0;
if (!empty($xml->width)) $width = $xml->width->content;
if (!empty($xml->height)) $height = $xml->height->content;
if ($width===0 || $height===0) {
    list($width, $height) = \WebSyndication\Helper::getImageSize($image_src);
}
if (!empty($max_width) || !empty($max_height)) {
    list($width, $height) = \WebSyndication\Helper::imageResize($width, $height, $max_width, $max_height);
}
?>
<div class="<?php echo \WebSyndication\Helper::getClass('tag_image'); ?> <?php echo $alt_class; ?>">

<?php if (!empty($image_link)) : ?>
    <a href="<?php echo $image_link; ?>"
        title="<?php echo (!empty($image_description) ? $image_description : 'See online'); ?>">
<?php endif; ?>

    <img src="<?php echo $image_src; ?>" alt="<?php 
        echo (!empty($image_alt) ? $image_alt : 'img');
    ?>" 
<?php if ($width!==0 && $height!==0) : ?>
        width="<?php echo $width; ?>"
        height="<?php echo $height; ?>"
        style="width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;"
<?php elseif ($width!==0) : ?>
        width="<?php echo $width; ?>"
        style="width:<?php echo $width; ?>px;"
<?php elseif ($height!==0) : ?>
        height="<?php echo $height; ?>"
        style="height:<?php echo $height; ?>px;"
<?php endif; ?>
         />

<?php if (!empty($image_link)) : ?>
    </a>
<?php endif; ?>

</div>
