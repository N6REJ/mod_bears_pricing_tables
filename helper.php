<?php
/**
 * Bears Pricing Tables
 *
 * @version     2025.05.11.14
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright   Copyright (c) 2025 N6REJ
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Router\Router;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Factory;

/**
 * Helper class for Bears Pricing Tables module
 */
class ModBearsPricingTablesHelper
{
    /**
     * Load the appropriate CSS file based on template selection
     *
     * @param   object  $params  The module parameters
     * @return  void
     */
    public static function loadTemplateCSS($params)
    {
        // Get the document
        $document = Factory::getDocument();
        
        // Get template selection
        $template = (int) $params->get('bears_template', 1);
        
        // Check if we should load CSS
        $loadCSS = (int) $params->get('load_stylesheet', 1);
        
        if ($loadCSS) {
            // Map template values to CSS files
            $templateFiles = [
                1 => 'default.css',
                2 => 'blue.css',
                3 => 'dark.css',
                4 => 'purple.css',
                5 => 'gray.css',
                6 => 'coins.css',
                7 => 'rounded.css',
                8 => 'circle.css',
                9 => 'simple.css',
                10 => 'white.css'
            ];
            
            // Get the CSS file for the selected template
            $cssFile = isset($templateFiles[$template]) ? $templateFiles[$template] : 'default.css';
            
            // Add the CSS file to the document
            $document->addStyleSheet(Uri::base() . 'modules/mod_bears_pricing_tables/css/' . $cssFile);
        }
    }
    
    /**
     * Get the appropriate template file based on template selection
     *
     * @param   object  $params  The module parameters
     * @return  string  The template file name without extension
     */
    public static function getTemplateName($params)
    {
        // Get template selection
        $template = (int) $params->get('bears_template', 1);
        
        // Map template values to template names
        $templateNames = [
            1 => 'default',
            2 => 'blue',
            3 => 'dark',
            4 => 'purple',
            5 => 'gray',
            6 => 'coins',
            7 => 'rounded',
            8 => 'circle',
            9 => 'simple',
            10 => 'white'
        ];
        
        // Return the template name for the selected template
        return isset($templateNames[$template]) ? $templateNames[$template] : 'default';
    }
}
