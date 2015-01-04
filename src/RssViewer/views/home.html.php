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

if (empty($feeds)) return '';

?>

<div class="page-header">
    <h1>
<?php foreach ($feeds->getFeedsRegistry() as $i=>$feed) : ?>
        <?php echo $feed->getFeedUrl().' ('.$feed->getProtocol().' '.$feed->getVersion().') '; ?>
<?php endforeach; ?>
    </h1>
</div>


