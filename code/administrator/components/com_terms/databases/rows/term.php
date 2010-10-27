<?php
/**
 * @version		$Id: dashboard.php 176 2010-10-27 03:39:39Z johanjanssens $
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
class ComTermsDatabaseRowTerm extends KDatabaseRowDefault
{
	/**
     * Save the term in the database.
     *
     * If the term does not exist yet it will be created. A relationship for 
     * the term will also be added to the terms_relations table based on the
     * row_id and table_name information.
     *
     * @return	TermsRowTerm
     */
    public function save()
    {
   		//Add the term	
 		if(!$this->load()) {
 			parent::save();
 		} 
 		
 		//Add a relation		
    	$relation = KFactory::tmp('admin::com.terms.database.row.relation');
    	$relation->terms_term_id = $this->id; 
   		$relation->row           = $this->row;
    	$relation->table         = $this->table;
    	
    	if(!$relation->load()) {		
    		$relation->save();
		}
    																	
        return true;
    }
    
	/**
     * Deletes the term form the database.
     * 
     * If only one relationship exists in the actual term will also be deleted. 
     * Otherwise only the relation will be removed.
     *
     * @return TermsRowTerm
     */
    public function delete()
    {		
    	//Delete the term
    	$relation = KFactory::tmp('admin::com.terms.database.row.relation');
    	$relation->terms_term_id = $this->id; 		
    	
    	if($relation->count() == 1) {
			parent::delete();
		}
    	
    	//Delete the relation
    	$relation = KFactory::tmp('admin::com.terms.database.row.relation', array('new' => false));
    	$relation->terms_term_id = $this->id; 
   		$relation->row           = $this->row;
    	$relation->table         = $this->table;
    	$relation->delete();
    	
        return true;
    }
}