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

/* @var \WebSyndication\FeedsCollection $xml */
if (!isset($xml) || empty($xml)) return '';
if (!isset($offset)) $offset = 0;
if (!isset($limit)) $limit = null;

?>
<div class="<?php echo \WebSyndication\Helper::getClass('collection_wrapper'); ?>">

<?php
foreach ($xml->getItems($limit, $offset) as $item) {
    echo \WebSyndication\Helper::renderView(
        \WebSyndication\Helper::getTemplate('feed_item_template'),
        array('xml' => $item, 'alt_class' => \WebSyndication\Helper::getClass('collection_alt_class'))
    );
}
?>

</div>
