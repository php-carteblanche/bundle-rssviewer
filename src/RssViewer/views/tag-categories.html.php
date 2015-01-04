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

?>
<div class="<?php echo \WebSyndication\Helper::getClass('tag_categories'); ?> <?php echo $alt_class; ?>">
    Categories&nbsp;:&nbsp;
<?php
foreach($xml->content as $i=>$_cat) {
    echo \WebSyndication\Helper::renderView(
            \WebSyndication\Helper::getTemplate('category_tag_template'),
            array('xml' => $_cat, 'alt_class' => $alt_class)
    );
    $i++;
    if ($i<count($xml->content)) echo ', ';
}
?>
</div>
