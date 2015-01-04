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

$is_image = \WebSyndication\Helper::isImage($xml->type->content);
$image_id = uniqid();
$content_length = $xml->length->content;

?>
<?php if ($is_image) : ?>
<script type="text/javascript">
$(function(){
    $("#<?php echo $image_id; ?>")
        .tooltip({
            track: true,
            position: {
                my: "center+20 top+20",
                at: "center+20 top+20"
            },
            content: function() {
                var element = $(this), src = element.attr("rel");
                if (src) { return "<img class='tooltip-img' alt='media' src='" + src + "'>"; }
            }
        });
});
</script>
<?php endif; ?>
<div class="<?php echo \WebSyndication\Helper::getClass('tag_media'); ?> <?php echo $alt_class; ?>">
    Related media&nbsp;:&nbsp;
    <a href="<?php echo $xml->url->content; ?>" title="See online"<?php
        if ($is_image) echo ' id="'.$image_id.'" rel="'.$xml->url->content.'"';
    ?>><?php
        echo \WebSyndication\Helper::getFilename($xml->url->content);
    ?></a>
     (<em>Document type <?php
        echo $xml->type->content
        .' - '
        .' length '
        .\Library\Helper\File::getTransformedFilesize($content_length)
        ;
    ?></em>)
</div>
