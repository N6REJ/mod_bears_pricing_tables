<?php
/**
 * Bears Pricing Tables - Google Font Field
 * 
 * @version     2025.05.14.1
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright   Copyright (c) 2025 N6REJ
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

/**
 * Form Field class for Google Fonts
 */
class JFormFieldGooglefont extends FormField
{
    /**
     * The form field type.
     *
     * @var    string
     */
    protected $type = 'googlefont';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     */
    protected function getInput()
    {
        // Initialize variables
        $html = [];
        $options = [];
        $attr = '';
        $fontList = [];
        
        // Get the field attributes
        $attr .= !empty($this->class) ? ' class="' . $this->class . '"' : '';
        $attr .= !empty($this->size) ? ' size="' . $this->size . '"' : '';
        $attr .= !empty($this->onchange) ? ' onchange="' . $this->onchange . '"' : '';
        $attr .= $this->required ? ' required' : '';
        
        // Check if we have local font files in elements folder
        $localFonts = $this->getLocalFonts();
        
        if (!empty($localFonts)) {
            // Use local fonts if available
            $fontList = $localFonts;
        } else {
            // Use Google Fonts from JSON file
            $fontList = $this->getGoogleFonts();
        }
        
        // Add the default option
        $options[] = HTMLHelper::_('select.option', '', Text::_('JSELECT'));
        
        // Add the font options
        foreach ($fontList as $font) {
            $fontName = is_array($font) ? $font['family'] : $font;
            $options[] = HTMLHelper::_('select.option', $fontName, $fontName);
        }
        
        // Add styles for font preview
        $document = Factory::getDocument();
        $document->addStyleDeclaration('
            .font-preview-wrapper {
                position: relative;
                display: inline-block;
                width: 100%;
            }
            .font-preview {
                margin-top: 5px;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
                background-color: #f9f9f9;
                font-size: 16px;
                display: none;
            }
        ');
        
        // Add JavaScript for font preview
        $document->addScriptDeclaration('
            document.addEventListener("DOMContentLoaded", function() {
                var fontSelects = document.querySelectorAll(".googlefont-select");
                fontSelects.forEach(function(select) {
                    select.addEventListener("change", function() {
                        var fontName = this.value;
                        var previewDiv = this.nextElementSibling;
                        
                        if (fontName) {
                            // Load the font
                            var link = document.createElement("link");
                            link.rel = "stylesheet";
                            link.href = "https://fonts.googleapis.com/css?family=" + encodeURIComponent(fontName) + "&display=swap";
                            document.head.appendChild(link);
                            
                            // Update the preview
                            previewDiv.style.fontFamily = fontName;
                            previewDiv.style.display = "block";
                            previewDiv.textContent = "The quick brown fox jumps over the lazy dog";
                        } else {
                            previewDiv.style.display = "none";
                        }
                    });
                    
                    // Trigger change event for initial value
                    if (select.value) {
                        var event = new Event("change");
                        select.dispatchEvent(event);
                    }
                });
            });
        ');
        
        // Build the select list
        $html[] = '<div class="font-preview-wrapper">';
        $html[] = HTMLHelper::_('select.genericlist', $options, $this->name, trim($attr), 'value', 'text', $this->value, $this->id);
        $html[] = '<div class="font-preview"></div>';
        $html[] = '</div>';
        
        return implode('', $html);
    }
    
    /**
     * Get local font files from elements folder
     *
     * @return  array  Array of font names
     */
    protected function getLocalFonts()
    {
        $fonts = [];
        $fontDir = JPATH_ROOT . '/modules/mod_bears_pricing_tables/elements/fonts';
        
        if (is_dir($fontDir)) {
            $files = scandir($fontDir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && is_dir($fontDir . '/' . $file)) {
                    $fonts[] = $file;
                }
            }
        }
        
        return $fonts;
    }
    
    /**
     * Get Google Fonts from JSON file
     *
     * @return  array  Array of font data
     */
    protected function getGoogleFonts()
    {
        $fonts = [];
        $jsonFile = JPATH_ROOT . '/modules/mod_bears_pricing_tables/elements/webfonts.json';
        
        if (file_exists($jsonFile)) {
            $jsonData = file_get_contents($jsonFile);
            $fontData = json_decode($jsonData, true);
            
            if (isset($fontData['items']) && is_array($fontData['items'])) {
                $fonts = $fontData['items'];
            }
        }
        
        return $fonts;
    }
}
