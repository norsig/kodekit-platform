<?php
/**
 * Kodekit Component - http://www.timble.net/kodekit
 *
 * @copyright      Copyright (C) 2011 - 2016 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license        MPL v2.0 <https://www.mozilla.org/en-US/MPL/2.0>
 * @link           https://github.com/timble/kodekit-users for the canonical source repository
 */

namespace Kodekit\Component\Users;

use Kodekit\Library;

/**
 * Activatable Controller Behavior
 *
 * @author  Arunas Mazeika <http://github.com/amazeika>
 * @package Kodekit\Component\Users
 */
class ControllerBehaviorActivatable extends Library\ControllerBehaviorAbstract
{
    /**
     * Determines whether new created items will be forced for activation.
     *
     * @var mixed bool
     */
    protected $_force;


    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->_force  = $config->force;
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'force'  => true,
        ));

        parent::_initialize($config);
    }

    protected function _beforeActivate(Library\ControllerContextModel $context)
    {
        $result = true;
        $row    = $this->getModel()->fetch();

        $activation = $context->request->data->get('activation', 'alnum');
        $row        = $this->getModel()->fetch();

        if ($activation !== $row->activation) {
            $result = false;
        }

        return $result;
    }

    protected function _actionActivate(Library\ControllerContextModel $context)
    {
        $result = true;

        $row = $this->getModel()->fetch();
        $row->setProperties(array('activation' => '', 'enabled' => 1));

        if (!$row->save()) {
            $context->error = $row->getStatusMessage();
            $result         = false;
        }

        return $result;
    }

    protected function _beforeAdd(Library\ControllerContextModel $context)
    {
        // Force activation on new records.
        if ($this->_force) {
            $context->request->data->enabled = 0;
        }

        if (!$context->request->data->enabled) {
            $context->request->data->activation = $this->getObject('com:users.model.entity.password')->createPassword(32);
        }
    }

    protected function _afterEdit(Library\ControllerContextModel $context)
    {
        $row = $context->result;

        // Reset activation token if necessary.
        if ($row->enabled && $row->activation)
        {
            $row->activation = '';
            $row->save();
        }
    }
}