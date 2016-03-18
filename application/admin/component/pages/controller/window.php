<?php
/**
 * Nooku Platform - http://www.nooku.org/platform
 *
 * @copyright	Copyright (C) 2011 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/nooku/nooku-platform for the canonical source repository
 */

namespace Nooku\Platform\Pages;

use Nooku\Component\Pages;
use Nooku\Library;

/**
 * Window Controller
 *
 * @author  Johan Janssens <http://github.com/johanjanssens>
 * @package Nooku\Component\Pages
 */
class ControllerWindow extends Pages\ControllerWindow
{
    protected function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'toolbars'  => array(
                'actionbar',
                'menubar',
                'tabbar'
            ),
        ));

        parent::_initialize($config);
    }
}