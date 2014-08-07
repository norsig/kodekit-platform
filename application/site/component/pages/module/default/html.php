<?php
/**
 * Nooku Platform - http://www.nooku.org/platform
 *
 * @copyright	Copyright (C) 2011 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;
use Nooku\Component\Pages;

/**
 * Default Module Html View
 *
 * @author  Johan Janssens <http://github.com/johanjanssens>
 * @package Component\Pages
 */
class PagesModuleDefaultHtml extends Pages\ModuleDefaultHtml
{
    protected function _actionRender(Library\ViewContext $context)
    {
        // Load language
        $this->getObject('translator')->import($this->getIdentifier()->package);
        return parent::_actionRender($context);
    }
}