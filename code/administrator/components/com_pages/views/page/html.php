<?php
/**
 * @version     $Id: html.php 3031 2011-10-09 14:21:07Z johanjanssens $
 * @category    Nooku
 * @package     Nooku_Server
 * @subpackage  Pages
 * @copyright   Copyright (C) 2011 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

/**
 * Page Html View Class
 *
 * @author      Johan Janssens <http://nooku.assembla.com/profile/johanjanssens>
 * @category    Nooku
 * @package     Nooku_Server
 * @subpackage  Pages
 */

class ComPagesViewPageHtml extends ComDefaultViewHtml
{
    public function display()
    {
        // Load languages.
        $language   = JFactory::getLanguage();
        $components = $this->getModel()->getComponents();

        foreach($components as $component) {
            $language->load($component->option);
        }
        
        // Get available and assigned modules.
        $available = $this->getService('com://admin/extensions.model.modules')
            ->enabled(true)
            ->application('site')
            ->getList();
        
        $query = $this->getService('koowa:database.query.select')
            ->where('pages_page_id IN :id')
            ->bind(array('id' => array((int) $this->getModel()->getItem()->id, 0)));
        
        $assigned = $this->getService('com://admin/pages.database.table.modules')
            ->select($query);
        
        $this->assign('modules', (object) array('available' => $available, 'assigned' => $assigned));

        return parent::display();
    }
}
