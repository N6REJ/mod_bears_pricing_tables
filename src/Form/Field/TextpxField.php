<?php
/**
 * Bears Pricing Tables
 *
 * @version     2026.10.16
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright Copyright (C) 2026 Troy Hall (N6REJ)
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace N6REJ\Module\BearsPricingTables\Site\Form\Field;

\defined('_JEXEC') or die;

use Joomla\CMS\Form\Field\TextField;

class TextpxField extends TextField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  1.0.0
     */
    protected $type = 'Textpx';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   1.0.0
     */
    protected function getInput(): string
    {
        // Add custom classes
        $this->class = $this->class ? $this->class . ' form-control' : 'form-control';

        // Set placeholder
        $this->hint = $this->hint ?: '0px';

        // Get the parent input
        $input = parent::getInput();

        // Wrap with input group
        return '<div class="input-group">'
            . $input
            . '<span class="input-group-text">px</span>'
            . '</div>';
    }
}
