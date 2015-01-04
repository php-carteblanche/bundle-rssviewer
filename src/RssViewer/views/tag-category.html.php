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

$domain = $content = $html = $href_title = null;

if ($xml->hasAttribute('domain')) {
    $domain = $xml->getAttribute('domain');
} elseif ($xml->hasAttribute('scheme')) {
    $domain = $xml->getAttribute('scheme');
}

if ($xml->hasAttribute('term')) {
    $content = $xml->getAttribute('term');
    $html = $xml->getAttribute('term');
} else {
    $content = $xml->content;
    $html = $xml->getXmlValue();
}

if ($xml->hasAttribute('label')) {
    $href_title = $xml->getAttribute('label');
} else {
    $href_title = 'See online';
}

?>
<span class="<?php echo \WebSyndication\Helper::getClass('tag_category'); ?> <?php echo $alt_class; ?>" data-rel="<?php echo $content; ?>">
<?php if (!empty($domain)) : ?>
    <a href="<?php echo $domain; ?>" title="<?php echo $href_title; ?>">
<?php endif; ?>
    <?php echo $html; ?>
<?php if (!empty($domain)) : ?>
    </a>
<?php endif; ?>
</span>