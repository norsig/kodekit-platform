<?php
/**
 * Kodekit Platform - http://www.timble.net/kodekit
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		MPL v2.0 <https://www.mozilla.org/en-US/MPL/2.0>
 * @link		https://github.com/timble/kodekit-platform for the canonical source repository
 */

return array(

    'aliases'  => array(
        'com:articles.model.categories' => 'com:categories.model.categories',
    ),

    'identifiers' => array(

        'com:articles.controller.article'  => array(
            'behaviors'  => array(
                'com:varnish.controller.behavior.cachable',
                'com:tags.controller.behavior.taggable'
            ),
        ),

       'com:articles.model.articles'  => array(
            'behaviors'  => array(
                'com:tags.model.behavior.taggable'
            ),
        ),
    )
);