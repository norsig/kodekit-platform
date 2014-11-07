<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

namespace Nooku\Component\Varnish;

use Nooku\Library;

/**
 * Dispatcher Varnishable Behavior
 *
 * @author  Dave Li <http://nooku.assembla.com/profile/daveli>
 * @package Component\Varnish
 */
class ControllerBehaviorCacheable extends Library\BehaviorAbstract
{
	protected $_varnish;

	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		if(!isset($this->_varnish)) {
			$this->_varnish = $this->getObject('com:varnish.database.row.socket');
			$this->_varnish->connect();
		}
	}

	protected function _afterAdd(Library\ControllerContextInterface $context)
	{
		$identifier = $this->getMixer()->getIdentifier();

		$this->_varnish->ban('obj.http.x-entities == '. $identifier);
	}

	protected function _beforeEdit(Library\ControllerContextInterface $context)
	{
		$identifier = $this->getMixer()->getIdentifier();

		$modified = $this->getModel()->getTable()->filter($context->request->data->toArray());

		//TODO: Make this configurable
		$columns = array('enabled', 'published', 'ordering');

		foreach($columns as $column) {
			if (array_key_exists($column, $modified)) {
				$this->_varnish->ban('obj.http.x-entities == '. $identifier);
				break;
			}
		}
	}

	protected function _afterEdit(Library\ControllerContextInterface $context)
	{
		$entity		= $context->result;

		$modified = $this->getModel()->getTable()->filter($context->request->data->toArray());
		$identifier = $this->getMixer()->getIdentifier();

		if($modified) {
			$varnish = $this->getObject('com:varnish.database.row.socket');
			$varnish->connect();
			$varnish->ban('obj.http.x-entities ~ '. $identifier.':'.$entity->id);
		}
	}
}