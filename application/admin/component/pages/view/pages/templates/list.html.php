<script src="media://pages/js/pages-list.js" />

<nav class="scrollable">
    <? foreach(@object('com:pages.model.menus')->sort('title')->application('site')->getRowset() as $menu) : ?>
        <? $menu_pages = @object('com:pages.model.pages')->getRowset()->find(array('pages_menu_id' => $menu->id)) ?>
        <? if(count($menu_pages)) : ?>
            <h3><?= $menu->title ?></h3>
            <? $first = true; $last_depth = 0; ?>

            <? foreach($menu_pages as $page) : ?>
                <? $depth = substr_count($page->path, '/') ?>
                <? switch($page->type) :
                    case 'component': ?>
                        <a class="level<?= $depth ?>" href="<?= @route(preg_replace('%layout=table%', 'layout=default', $page->getLink()->getQuery()).'&Itemid='.$page->id) ?>">
                            <span><?= $page->title ?></span>
                        </a>
                        <? break ?>

                    <? case 'menulink': ?>
                        <? $page_linked = @object('application.pages')->getPage($page->getLink()->query['Itemid']); ?>
                        <a href="<?= $page_linked->getLink() ?>">
                            <span><?= $page->title ?></span>
                        </a>
                        <? break ?>

                    <? case 'separator': ?>
                        <span class="separator"><span><?= $page->title ?></span></span>
                        <? break ?>

                    <? case 'url': ?>
                        <a href="<?= $page->getLink() ?>">
                            <span><?= $page->title ?></span>
                        </a>
                        <? break ?>

                    <? case 'redirect': ?>
                        <a href="<?= $page->route ?>">
                            <span><?= $page->title ?></span>
                        </a>
                    <? endswitch ?>
            <? endforeach ?>
        <? endif; ?>
    <? endforeach ?>
</nav>