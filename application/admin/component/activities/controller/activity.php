<?php
/**
 * Nooku Platform - http://www.nooku.org/platform
 *
 * @copyright	Copyright (C) 2011 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/nooku/nooku-platform for the canonical source repository
 */

namespace Nooku\Platform\Activities;

use Nooku\Library;
use Nooku\Component\Activities;

/**
 * Activities Html View
 *
 * @author  Arunas Mazeika <http://github.com/amazeika>
 * @package Nooku\Component\Activities
 */
class ControllerActivity extends Activities\ControllerActivity
{
    /**
     * Overridden for avoiding
     */
    public function getRequest()
    {
        return Library\ControllerModel::getRequest();
    }
}