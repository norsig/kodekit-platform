<?php
/**
 * Nooku Platform - http://www.nooku.org/platform
 *
 * @copyright	Copyright (C) 2011 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/nooku/nooku-platform for the canonical source repository
 */

namespace Nooku\Platform\Users;

use Nooku\Library;

/**
 * User Html View
 *
 * @author  Gergo Erdosi <http://github.com/gergoerdosi>
 * @package Component\Users
 */
class ViewUserHtml extends Library\ViewHtml
{
    protected function _fetchData(Library\ViewContext $context)
    {
        $page = $this->getObject('pages')->getActive();

        $context->data->page            = $page;
        $context->data->password_length = $this->getObject('com:users.model.entity.password')->getLength();

        parent::_fetchData($context);
    }
}