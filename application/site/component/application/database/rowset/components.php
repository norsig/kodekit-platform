<?php
/**
 * @package     Nooku_Server
 * @subpackage  Application
 * @copyright   Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

use Nooku\Library;

/**
 * Components Database Rowset Class
 *
 * @author      Johan Janssens <http://nooku.assembla.com/profile/johanjanssens>
 * @package     Nooku_Server
 * @subpackage  Application
 */
class ApplicationDatabaseRowsetComponents extends Library\DatabaseRowsetAbstract implements Library\ServiceInstantiatable
{
    public function __construct(Library\Config $config )
    {
        parent::__construct($config);

        //TODO : Inject raw data using $config->data
        $components = $this->getService('com:extensions.model.components')
            ->enabled(true)
            ->getRowset();

        $this->merge($components);
    }

    protected function _initialize(Library\Config $config)
    {
        $config->identity_column = 'name';
        parent::_initialize($config);
    }

    public static function getInstance(Library\Config $config, Library\ServiceManagerInterface $manager)
    {
        if (!$manager->has($config->service_identifier))
        {
            //Create the singleton
            $classname = $config->service_identifier->classname;
            $instance  = new $classname($config);
            $manager->set($config->service_identifier, $instance);
        }

        return $manager->get($config->service_identifier);
    }

    public function getComponent($name)
    {
        $component = $this->find('com_'.$name);
        return $component;
    }

    public function isEnabled($name)
    {
        $result = false;
        if($component = $this->find('com_'.$name)) {
            $result = (bool) $component->enabled;
        }

        return $result;
    }

    public function __get($name)
    {
        return $this->getComponent($name);
    }
}