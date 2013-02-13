<?php
/**
 * @package     Nooku_Server
 * @subpackage  Languages
 * @copyright   Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

/**
 * Translatable Controller Behavior Class
 *
 * @author      Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package     Nooku_Server
 * @subpackage  Languages
 */

class ComLanguagesControllerBehaviorTranslatable extends KDatabaseBehaviorAbstract
{
    protected function _beforeControllerGet(KCommandContext $context)
    {
        $model = $this->getModel();
        if($model->getTable()->isTranslatable())
        {
            $state = $model->getState();
            if(!isset($state->translated)) {
                $state->insert('translated', 'boolean');
            }
        }
    }
}