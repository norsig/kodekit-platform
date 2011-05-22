<?php
/**
 * @version     $Id$
 * @category	Nooku
 * @package     Nooku_Server
 * @subpackage  Modules
 * @copyright   Copyright (C) 2011 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

/**
 * Next Toolbar Button Class
 * 
 * @author    	Stian Didriksen <http://nooku.assembla.com/profile/stiandidriksen>
 * @category	Nooku
 * @package     Nooku_Server
 * @subpackage  Modules
 */

class ComModulesToolbarButtonNew extends ComDefaultToolbarButtonNew
{
    /**
     * Initializes the options for the object
     *
     * Must include @helper('behavior.modal') in view, to load the modal behavior
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param   object  An optional KConfig object with configuration options
     * @return  void
     */
    protected function _initialize(KConfig $config)
    {
        $config->append(array(
            'attribs' => array(
                'class' => 'toolbar modal',
                'rel'   => '{handler: \'url\', ajaxOptions:{method:\'get\'}}'
            )
        ));

        parent::_initialize($config);
    }

	public function getLink()
	{
		return 'index.php?option=com_modules&view=modules&layout=list&new=1&tmpl=component';
	}
}