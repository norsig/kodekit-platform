<?
/**
 * @category	Nooku
 * @package     Nooku_Server
 * @subpackage  Cache
 * @copyright   Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */
?>
 <!--
<script src="media://js/koowa.js" />
<style src="media://css/koowa.css" />
-->

<ktml:module position="toolbar">
    <?= @helper('toolbar.render', array('toolbar' => $toolbar))?>
</ktml:module>

<form action="" method="get" class="-koowa-grid">	
<table>
	<thead>
		<tr>
			<th width="1">
                <?= @helper( 'grid.checkall'); ?>
            </th>
			<th>
				<?= @helper('grid.sort',  array('column' => 'name')); ?>
			</th>
			<th width="1">
				<?= @helper('grid.sort',  array('column' => 'count', 'title' => 'Num Files')); ?>
			</th>
			<th width="1">
				<?= @helper('grid.sort',  array('column' => 'size')); ?>
			</th>
		</tr>
	</thead>
	<tfoot>
			<tr>
				<td colspan="13">
					<?= @helper('com:application.paginator.pagination', array('total' => $total)); ?>
				</td>
			</tr>
		</tfoot>
	<tbody>
	<? foreach($groups as $group) : ?>
		<tr>
			<td align="center">
				<?= @helper( 'grid.checkbox' , array('row' => $group)); ?>
			</td>
			<td>
				<a href="<?= @route('view=keys&group='.$group->name); ?>"><?= $group->name; ?></a>
			</td>
			<td align="center">
				<?= $group->count; ?>
			</td>
			<td align="center">
				<?= number_format($group->size / 1024, 2) ?>
			</td>
		</tr>
	<? endforeach; ?>
	</tbody>
</table>
</form>