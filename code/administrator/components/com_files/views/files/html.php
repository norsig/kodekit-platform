<?php
/**
 * @version     $Id$
 * @package     Nooku_Components
 * @subpackage  Files
 * @copyright   Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

/**
 * Files Html View Class
 *
 * @author      Ercan Ozkaya <http://nooku.assembla.com/profile/ercanozkaya>
 * @category	Nooku
 * @package     Nooku_Server
 * @subpackage  Files
 */

class ComFilesViewFilesHtml extends ComDefaultViewHtml
{
	protected function _initialize(KConfig $config)
	{
		$config->auto_assign = false;

		parent::_initialize($config);
	}

	public function display()
	{
	    $state = $this->getModel()->getState();
	    if (empty($state->limit)) {
	        $state->limit = $this->getService('application')->getCfg('list_limit');
	    }
	    
	    // TODO: take this out when JURI::root() returns correct results
	    $this->assign('sitebase' , trim(str_replace('administrator/', '/', JURI::root()), '/'));
		$this->assign('token'    , $this->getService('application.session')->getToken());
		$this->assign('container', $this->getModel()->getState()->container);

		return parent::display();
	}
}
