<?php
/**
 * Nooku Platform - http://www.nooku.org/platform
 *
 * @copyright	Copyright (C) 2011 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

namespace Nooku\Component\Application;

use Nooku\Library;

/**
 * Title Template Filter
 *
 * @author  Johan Janssens <http://github.com/johanjanssens>
 * @package Nooku\Component\Application
 */
class TemplateFilterTitle extends Library\TemplateFilterTitle
{
    public function render(&$text)
    {
        $title = $this->_parseTags($text);
        $text = str_replace('<ktml:title>', $title, $text);
    }
}