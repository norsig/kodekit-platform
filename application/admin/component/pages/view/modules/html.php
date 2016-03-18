<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/nooku/nooku-platform for the canonical source repository
 */

namespace Nooku\Platform\Pages;

use Nooku\Library;

/**
 * Modules Html View
 *
 * @author  Stian Didriksen <http://github.com/stipsan>
 * @package Component\Pages
 */
class ViewModulesHtml extends Library\ViewHtml
{
    protected function _actionRender(Library\ViewContext $context)
	{
        $context->data->positions = $this->getModel()->fetch()->getPositions();

        return parent::_actionRender($context);
	}

    protected function _beforeRender(Library\ViewContext $context)
    {
        //Load language files for each module
        if($this->getLayout() == 'list')
        {
            foreach($this->getModel()->fetch() as $module)
            {
                $package = $module->getIdentifier()->package;
                $domain  = $module->getIdentifier()->domain;

                if($domain) {
                    $identifier = 'com://'.$domain.'/'.$package;
                } else {
                    $identifier = 'com:'.$package;
                }

                $this->getObject('translator')->load($identifier);
            }
        }
    }
}