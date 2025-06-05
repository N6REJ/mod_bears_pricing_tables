<?php
/**
 * Bears Pricing Tables
 *
 * @version     2025.06.05
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright   Copyright (c) 2025 N6REJ
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

use Joomla\CMS\Form\Field\TextField;

class JFormFieldTextpx extends TextField
{
    protected $type = 'Textpx';

    protected function getInput()
    {
        // Add custom classes
        $this->class = $this->class ? $this->class . ' form-control' : 'form-control';
        
        // Set placeholder
        $this->hint = $this->hint ?: '0px';

        // Get the parent input
        $input = parent::getInput();
        
        // Wrap with input group
        return '<div class="input-group">
            ' . $input . '
            <span class="input-group-text">px</span>
        </div>';
    }
}
