<?php
/**
 * Kodekit Platform - http://www.timble.net/kodekit
 *
 * @copyright	Copyright (C) 2011 - 2016 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		MPL v2.0 <https://www.mozilla.org/en-US/MPL/2.0>
 * @link		https://github.com/timble/kodekit-platform for the canonical source repository
 */

namespace Kodekit\Platform\Activities;

use Kodekit\Library;
use Kodekit\Component\Activities;

/**
 * Activities Html View
 *
 * @author  Arunas Mazeika <http://github.com/amazeika>
 * @package Kodekit\Platform\Activities
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