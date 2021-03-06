<?php
/**
 * Kodekit Component - http://www.timble.net/kodekit
 *
 * @copyright   Copyright (C) 2011 - 2016 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     MPL v2.0 <https://www.mozilla.org/en-US/MPL/2.0>
 * @link        https://github.com/timble/kodekit-pages for the canonical source repository
 */

namespace Kodekit\Component\Pages;

use Kodekit\Library;

/**
 * Tabbar Controller Toolbar
 *
 * @author  Johan Janssens <http://github.com/johanjanssens>
 * @package Kodekit\Component\Pages
 */
class ControllerToolbarTabbar extends Library\ControllerToolbarAbstract
{
    /**
     * Initializes the config for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param   Library\ObjectConfig $config Configuration options
     * @return  void
     */
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'type'  => 'tabbar',
        ));

        parent::_initialize($config);
    }

    /**
     * Add a command
     *
     * Disable the tabbar only for singular views that are editable.
     *
     * @param   string	$name The command name
     * @param	mixed	$config Parameters to be passed to the command
     * @return  Library\ControllerToolbarCommand
     */
    public function addCommand($name, $config = array())
    {
        $command = parent::addCommand($name, $config);

        $controller = $this->getController();

        if($controller->isEditable() && !$controller->getView()->isCollection()) {
            $command->disabled = true;
        }

        return $command;
    }

    /**
     * Get the list of commands
     *
     * @return  array
     */
    public function getCommands()
    {
        $menu = $this->getObject('pages.menus')->find(array('slug' => 'menubar'));

        if(count($menu))
        {
            $component  = $this->getObject('dispatcher')->getIdentifier()->package;
            $controller = $this->getObject('dispatcher')->getController()->getIdentifier()->name;

            $pages = $this->getObject('pages')->find(array(
                'pages_menu_id'  => $menu->id,
                'component'      => $component,
            ));

            foreach($pages as $page)
            {
                if($page->canAccess())
                {
                    $this->addCommand($page->title, array(
                        'id'       => $page->id,
                        'href'     => $page->getLink(),
                        'active'   => (string) $controller == Library\StringInflector::singularize($page->view),
                        'path'     => $page->getPath(),
                        'hidden'   => $page->hidden,
                    ));
                }
            }
        }

        return parent::getCommands();
    }
}