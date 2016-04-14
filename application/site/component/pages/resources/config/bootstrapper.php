<?php
/**
 * Kodekit Platform - http://www.timble.net/kodekit
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		MPL v2.0 <https://www.mozilla.org/en-US/MPL/2.0>
 * @link		https://github.com/timble/kodekit-platform for the canonical source repository
 */

return array(

    'identifiers' => array(

        'com:pages.controller.module'  => array(
            'behaviors'  => array('com:varnish.controller.behavior.cachable'),
        ),

        'com:pages.controller.window'  => array(
            'behaviors'  => array('com:varnish.controller.behavior.cachable'),
        ),

        'com:pages.template.locator.component'  => array(
            'override_path' => APPLICATION_BASE.'/public/theme/bootstrap/templates/view'
        ),

        'com:pages.template.locator.module'  => array(
            'override_path' => APPLICATION_BASE.'/public/theme/bootstrap/templates/modules'
        ),
    )
);

