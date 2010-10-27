<?php
/**
 * @version		$Id$
 * @category	Nooku
 * @package     Nooku_Components
 * @subpackage  Terms
 * @copyright	Copyright (C) 2009 - 2010 Timble CVBA and Contributors. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.nooku.org
 */

/**
 * Description
 *   
 * @author   	Johan Janssens <johan@nooku.org>
 * @category	Nooku
 * @package    	Nooku_Components
 * @subpackage 	Terms
 */
// Check if Koowa is active
if(!defined('KOOWA')) {
	JError::raiseWarning(0, JText::_("Koowa wasn't found. Please install the Koowa plugin and enable it."));
	return;
}

// Factory mappings
KFactory::map('site::com.terms.controller.term', 'admin::com.terms.controller.terms');

// Create the controller dispatcher
KFactory::get('admin::com.terms.dispatcher')->dispatch(KRequest::get('get.view', 'cmd', 'terms'));