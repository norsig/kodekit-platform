<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Timble CVBA and Contributors. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git
 */

namespace Nooku\Component\Extensions;

use Nooku\Library;

/**
 * Settings Model
 *
 * @author  Johan Janssens <http://nooku.assembla.com/profile/johanjanssens>
 * @package Nooku\Component\Extensions
 */
class ModelSettings extends Library\ModelAbstract
{
    public function __construct(Library\Config $config)
    {
        parent::__construct($config);

        $this->getState()
             ->insert('name', 'cmd', null, true);        
    }
     
    public function getRow()
    {
        if(isset($this->getRowset()->{$this->getState()->name})) {
            $row = $this->getRowset()->{$this->getState()->name};
        } else {
            $row = $this->getRowset()->getRow();
        }
        
        return $row;
    }
    
    public function getRowset()
    {
        if (!isset($this->_rowset))
        {
            $rowset = $this->getService('com:extensions.database.rowset.settings');
            
            //Insert the system configuration settings
            $rowset->insert($this->getService('com:extensions.database.row.setting_system'));
                        
            //Insert the component configuration settings
            $components = $this->getService('com:extensions.model.components')->enabled(1)->getRowset();

            foreach($components as $component)
            {
                $path  = $this->getService('loader')->getApplication('admin');
                $path .= '/component/'.substr($component->name, 4).'/resources/config/settings.xml';

                if(file_exists($path))
                {
                    $config = array(
                        'name' => strtolower(substr($component->name, 4)),
                        'path' => file_exists($path) ? $path : '',
                        'id'   => $component->id,
                        'data' => $component->params->toArray(),
                    );

                    $row = $this->getService('com:extensions.database.row.setting_component', $config);

                    $rowset->insert($row);
                }
            }
             
            $this->_rowset = $rowset;
        }

        return $this->_rowset;
    }
}  