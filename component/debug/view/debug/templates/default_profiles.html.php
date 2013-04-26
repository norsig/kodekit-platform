<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Timble CVBA and Contributors. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git
 */
?>

<table class="adminlist">
	<thead>
    	<tr>
    		<th class="-koowa-sortable"><?= @text('Identifier') ?></th>
    		<th class="-koowa-sortable"><?= @text('Event'); ?></th>
    		<th class="-koowa-sortable"><?= @text('Time'); ?></th>
    		<th class="-koowa-sortable"><?= @text('Memory'); ?></th>
    	</tr>
  	</thead>
  	<tbody>
  		<? foreach ( $events as $event ) : ?>
  		<tr>  
			<td class="-koowa-sortable"><?= $event['target'] ?></td>
			<td class="-koowa-sortable"><?= $event['target'] ?></td>
            <td class="-koowa-sortable"><?= $event['message'] ?></td>
            <td class="-koowa-sortable" data-comparable="<?= $event['time'] ?>"><?= sprintf('%.3f', $event['time']).' seconds' ?></td>
            <td class="-koowa-sortable"><?= $event['memory'] ?></td>
        </tr>
         <? endforeach; ?>
  	</tbody>
</table>