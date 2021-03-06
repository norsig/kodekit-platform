<?php
/**
 * Kodekit Component - http://www.timble.net/kodekit
 *
 * @copyright      Copyright (C) 2011 - 2016 Timble CVBA and Contributors. (http://www.timble.net)
 * @license        MPL v2.0 <https://www.mozilla.org/en-US/MPL/2.0>
 * @link           https://github.com/timble/kodekit-categories
 */

namespace Kodekit\Component\Categories;

use Kodekit\Library;

/**
 * Categorizable Database Behavior
 *
 * @author  Johan Janssens <http://github.com/johanjanssens>
 * @package Kodekit\Component\Categories
 */
class DatabaseBehaviorCategorizable extends Library\DatabaseBehaviorAbstract
{
    /**
     * Get the category
     *
     * @return Library\DatabaseRowsetInterface
     */
    public function getCategory()
    {
        $model = $this->getObject('com:categories.model.categories');

        if (!$this->isNew())
        {
            //Get the category
            $category = $model->table($this->getTable()->getName())
                ->id($this->categories_category_id)
                ->fetch();
        }
        else $category = $model->fetch();

        return $category;
    }

    /**
     * Modify the select query
     *
     * If the query's params information includes a category property, auto-join the terms tables with the query and
     * select all the rows that are part of the category.
     *
     * @param Library\DatabaseContext $context
     */
    protected function _beforeSelect(Library\DatabaseContext $context)
    {
        $query  = $context->query;
        $params = $context->query->params;

        //Join the categories table
        $query->join(array('categories' => 'categories'), 'categories.categories_category_id = tbl.categories_category_id');
        $query->columns(array('category_title' => 'categories.title'));

        //Filter based on the category
        if ($params->has('category') && is_numeric($params->get('category')))
        {
            $query->where('tbl.categories_category_id IN :categories_category_id')
                  ->bind(array('categories_category_id' => (array)$params->get('category')));
        }
    }
}