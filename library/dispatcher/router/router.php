<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

namespace Nooku\Library;

/**
 * Dispatcher Router
 *
 * Provides route building and parsing functionality
 *
 * @author  Johan Janssens <http://nooku.assembla.com/profile/johanjanssens>
 * @package Nooku\Library\Dispatcher
 */
class DispatcherRouter extends Object implements DispatcherRouterInterface, ObjectMultiton
{
    /**
     * Function to convert a route to an internal URI
     *
     * @param   HttpUrlInterface  $url  The url.
     * @return  boolean
     */
    public function parse(HttpUrlInterface $url)
    {
        return true;
    }

    /**
     * Function to convert an internal URI to a route
     *
     * @param	HttpUrlInterface   $url	The internal URL
     * @return	boolean
     */
    public function build(HttpUrlInterface $url)
    {
        return true;
    }
}
