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
<span class="<?php echo \WebSyndication\Helper::getClass('tag_date'); ?> <?php echo $alt_class; ?>">
    <abbr title="<?php echo $xml->content->format('c'); ?>">
        <?php echo $xml->content->format(\WebSyndication\Helper::getOption('date_format', 'd, M Y H:i:s')); ?>
    </abbr>
</span>
