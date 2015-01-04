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

$channel_title          = $xml->getTagItem('title');
$channel_link           = $xml->getTagItem('link');
$channel_subtitle       = $xml->getTagItem('subtitle');
$channel_image          = $xml->getTagItem('image');

?>
<div class="<?php echo \WebSyndication\Helper::getClass('tag_channel'); ?> <?php echo $alt_class; ?>">

    <?php if (!empty($channel_link)) : ?>
    <a href="<?php echo $channel_link->content; ?>" title="<?php
            echo (isset($channel_subtitle) ? $channel_subtitle->content : 'See online');
        ?>">
    <?php endif; ?>

    <?php if (!empty($channel_image)) : ?>
            <?php echo \WebSyndication\Helper::renderView(
                \WebSyndication\Helper::getTemplate('image_tag_template'),
                array(
                    'xml' => $channel_image, 'alt_class' => 'channel',
                    'max_width'=>\WebSyndication\Helper::getOption('thumbs_max_width'),
                    'max_height'=>\WebSyndication\Helper::getOption('thumbs_max_height'),
                )
            ); ?>
    <?php endif; ?>

        <?php echo $channel_title->content; ?>

    <?php if (!empty($channel_link)) : ?>
    </a>
    <?php endif; ?>

</div>
