<?php
/**
 * @package     Nooku_Server
 * @subpackage  Application
 * @copyright   Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

use Nooku\Library;
use Nooku\Component\Pages;

/**
 * Components Database Rowset Class
 *
 * @author      Johan Janssens <http://nooku.assembla.com/profile/johanjanssens>
 * @package     Nooku_Server
 * @subpackage  Application
 */
class ApplicationDatabaseRowsetPages extends Pages\DatabaseRowsetPages implements Library\ObjectSingleton
{
    protected $_active;
    protected $_home;

    public function __construct(Library\ObjectConfig $config )
    {
        parent::__construct($config);

        //TODO : Inject raw data using $config->data
        $pages = $this->getObject('com:pages.model.pages')
            ->published(true)
            ->application('site')
            ->fetch();

        $this->merge($pages);

        foreach($this as $page)
        {
            $path = array();
            foreach(explode('/', $page->path) as $id) {
                $path[] = $pages->find($id)->slug;
            }

            $page->route = implode('/', $path);
        }
    }

    public function getPage($id)
    {
        $page = $this->find($id);
        return $page;
    }

    public function getHome()
    {
        if(!isset($this->_home)) {
            $this->_home = $this->find(array('home' => 1));
        }

        return $this->_home;
    }

    public function setActive($active)
    {
        if(is_numeric($active)) {
            $this->_active = $this->find($active);
        } else {
            $this->_active = $active;
        }

        return $this;
    }

    public function getActive()
    {
        return $this->_active;
    }

    public function isAuthorized($id, Library\UserInterface $user)
    {
        $result = true;
        $page   = $this->find($id);

        // Return false if page not found.
        if(!is_null($page))
        {
            if($page->access)
            {
                // Return false if page has access set, but user is a guest.
                if($user->isAuthentic())
                {
                    // Return false if page has group set, but user is not in that group.
                    if($page->users_group_id && !in_array($user->getRole(), array(21, 23, 24, 25))
                        && !in_array($page->users_group_id, $user->getGroups()))
                    {
                        $result = false;
                    }
                }
                else $result = false;
            }
        }
        else $result = false;

        return $result;
    }
}