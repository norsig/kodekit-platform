<?php
class ComLanguagesControllerToolbarTable extends ComDefaultControllerToolbarDefault
{
    public function onAfterControllerBrowse(KEvent $event)
    {
        parent::onAfterControllerBrowse($event);
        
        $this->reset();
    }
}