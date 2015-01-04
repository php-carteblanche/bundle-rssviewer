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

namespace RssViewer\Controller;

use \CarteBlanche\CarteBlanche;
use \CarteBlanche\App\Container;
use \CarteBlanche\Abstracts\AbstractController;

use \WebSyndication\FeedsCollection;

use \GitApi\GitApi;
use \GitApi\Repository;


/**
 * @author  Piero Wbmstr <me@e-piwi.fr>
 */
class RssViewer extends AbstractController
{

    /**
     * The RSS feed used for tests
     */
    var $test_feed_url = 'http://spip.ateliers-pierrot.fr/rss/breves?lang=en';

    /**
     * The actual feeds URLs
     */
    var $feeds;

    /**
     * The actual feeds collection
     */
    var $feeds_collection;

    /**
     * The directory where to search the views files
     */
    static $views_dir = 'RssViewer/views/';

    protected function _getFeedsUrls()
    {
        if (empty($this->feeds)) {
            $_feeds = $this->getContainer()->get('request')->getUrlArg('feed_url');

            if (empty($_feeds)) {
                $_feeds = $this->getContainer()->get('session')->get('feed_url');
            }

            $cfg = CarteBlanche::getContainer()->get('config')
                ->get('feeds');
            if (empty($_feeds) && !empty($cfg)) {
                $_feeds = isset($cfg['default']) ? $cfg['default'] : null;
            }

            if (empty($_feeds)) $_feeds = $this->test_feed_url;
            $this->feeds = explode(',', $_feeds);
        }
        return $this->feeds;
    }

    protected function _getFeedsCollection()
    {
        if (empty($this->feeds_collection)) {
            $this->feeds_collection = new \WebSyndication\FeedsCollection(
                $this->_getFeedsUrls()
            );
        }
        return $this->feeds_collection;
    }

    /**
     */
    public function indexAction()
    {
        return $this->homeAction();
    }

    public function homeAction($dir = null)
    {
        $_feeds = $this->_getFeedsCollection();
        $_feeds->read();

        return array(self::$views_dir.'home', array(
            'title'         => 'RSS Viewer',
            'feeds'         => $_feeds,
            'categories'    => $_feeds->getItemsCategories(),
            'items'         => $_feeds->getItems(),
        ));
    }

    public function rawAction($object = null)
    {
        $_git = GitApi::open($this->_getRepositoryPath());
        $history = $_git->getCommitsHistory();
        $infos = $_git->getFilesInfo();
        $tree = $_git->getRecursiveTree();

        $raw = $_git->getRaw($object);

        $file_path = $last = null;
        foreach($tree as $item) {
            if ($item['object']===$object) {
                $file_path = $item['path'];
            }
        }
        if (isset($infos[$file_path]) && isset($history[$infos[$file_path]])) {
            $last = $history[$infos[$file_path]];
        }

        return array(self::$views_dir.'raw', array(
            'title'=>'GIT Viewer',
            'git_path'=>$_git->getRepositoryPath(),
            'file_raw'=>$raw,
            'is_img'=>$_git->isImageContent($raw),
            'img_data'=>$_git->getRawImageData($raw),
            'file_path'=>$file_path,
            'git_history'=>$history,
            'git_last'=>$last
        ));
    }

    public function historyAction()
    {
        $_git = GitApi::open($this->_getRepositoryPath());
        $history = $_git->getCommitsHistory();
        $infos = $_git->getFilesInfo();
        $tree = $_git->getTree();
        $last = $_git->getLastCommitInfos();

        foreach ($history as $i=>$entry) {
            if (!isset($history[$i]['changes'])) {
                $history[$i]['changes'] = $_git->getCommitChanges($i);
            }
        }

        return array(self::$views_dir.'history', array(
            'title'=>'GIT Viewer',
            'git_path'=>$_git->getRepositoryPath(),
            'git_history'=>$history,
            'git_filesinfos'=>$infos,
            'git_last'=>$last,
            'git_tree'=>$tree
        ));
    }

}

// Endfile