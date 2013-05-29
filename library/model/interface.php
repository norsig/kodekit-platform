<?php
/**
 * @package     Koowa_Model
 * @copyright   Copyright (C) 2007 - 2012 Johan Janssens. All rights reserved.
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

namespace Nooku\Library;

/**
 * Model Interface
 *
 * @author      Johan Janssens <johan@nooku.org>
 * @package     Koowa_Model
 */
interface ModelInterface
{
    /**
     * Fetch a row or a rowset based on the model state
     *
     * @param integer  $mode The database fetch style.
     * @return DatabaseRow(set)Interface
     */
    public function fetch($mode = Database::FETCH_ROWSET);

    /**
     * Reset the model data and state
     *
     * @param  boolean $default If TRUE use defaults when resetting the state. Default is TRUE
     * @return ModelAbstract
     */
    public function reset($default = true);

    /**
     * Set the model state values
     *
     * @param  array $values Set the state values
     * @return ModelAbstract
     */
    public function setState(array $values);

    /**
     * Method to get state object
     *
     * @return  ModelStateInterface  The model state object
     */
    public function getState();

    /**
     * State Change notifier
     *
     * This function is called when the state has changed.
     *
     * @param  string 	$name  The state name being changed
     * @return void
     */
    public function onStateChange($name);

    /**
     * Get the total amount of items
     *
     * @return  int
     */
    public function getTotal();

    /**
     * Get the model paginator object
     *
     * @return  ModelPaginator  The model paginator object
     */
    public function getPaginator();
}