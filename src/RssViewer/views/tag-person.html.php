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

$author_name = $author_uri = $author_email = null;
if (isset($xml->name)) {
    $author_name = $xml->name->content;
    if (isset($xml->uri)) {
        $author_uri = $xml->uri->content;
    }
    if (isset($xml->email)) {
        $author_email = $xml->email->content;
    }
} else {
    $author_email = $xml->content;
    $author_name = $xml->content;
}

?>
<span class="<?php echo \WebSyndication\Helper::getClass('tag_person'); ?> <?php echo $alt_class; ?>">
    Author&nbsp;:&nbsp;
<?php if (!empty($author_uri) || !empty($author_email)) : ?>
    <a href="<?php
    echo (!empty($author_uri) ? $author_uri : 'mailto:'.$author_email);
?>" title="<?php
    echo (!empty($author_uri) ? 'See online' : 'Contact this email');
?>">
<?php endif; ?>
        <?php echo $author_name; ?>
<?php if (!empty($author_url) || !empty($author_email)) : ?>
    </a>
<?php endif; ?>
</span>
