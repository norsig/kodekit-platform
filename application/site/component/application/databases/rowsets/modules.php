<?php
/**
 * @package     Nooku_Server
 * @subpackage  Application
 * @copyright   Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

/**
 * Modules Database Rowset Class
 *
 * @author      Johan Janssens <http://nooku.assembla.com/profile/johanjanssens>
 * @package     Nooku_Server
 * @subpackage  Application
 */
class ComApplicationDatabaseRowsetModules extends KDatabaseRowsetAbstract implements KServiceInstantiatable
{
    public function __construct(KConfig $config )
    {
        parent::__construct($config);

        //TODO : Inject raw data using $config->data
        $page = $this->getService('application.pages')->getActive();

        $modules = $this->getService('com://admin/pages.model.modules')
            ->application('site')
            ->published(true)
            ->access((int) $this->getService('user')->isAuthentic())
            ->page($page->id)
            ->getRowset();

        $this->merge($modules);
    }

    protected function _initialize(KConfig $config)
    {
        $config->identity_column = 'id';
        parent::_initialize($config);
    }

    public static function getInstance(KConfigInterface $config, KServiceManagerInterface $manager)
    {
        if (!$manager->has($config->service_identifier))
        {
            $classname = $config->service_identifier->classname;
            $instance  = new $classname($config);
            $manager->set($config->service_identifier, $instance);
        }

        return $manager->get($config->service_identifier);
    }
}