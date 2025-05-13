<?php
/**
 * Bears Pricing Tables
 *
 * @version     2025.05.13
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
                1 => 'default.css',    // 1 - Default ( Large Accent )
                2 => 'blue.css',       // 2 - Blue ( Rounded )
                3 => 'dark.css',       // 3 - Dark ( Small Accent )
                4 => 'purple.css',     // 4 - Purple ( Wedge Accent )
                5 => 'orange.css',     // 5 - Orange ( With Icon )
                6 => 'coins.css',      // 6 - Coins ( Blue )
                7 => 'offset.css',     // 7 - Offset ( Accent color )
                8 => 'burgundy.css',   // 8 - Burgundy ( Coin Pricing )
                9 => 'simple.css',     // 9 - Simple ( Blue on white )
                10 => 'white.css',     // 10 - White ( Black and White )
                11 => 'small.css'      // 11 - Small ( Small Title )
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
            1 => 'default',    // 1 - Default ( Large Accent )
            2 => 'blue',       // 2 - Blue ( Rounded )
            3 => 'dark',       // 3 - Dark ( Small Accent )
            4 => 'purple',     // 4 - Purple ( Wedge Accent )
            5 => 'orange',     // 5 - Orange ( With Icon )
            6 => 'coins',      // 6 - Coins ( Blue )
            7 => 'offset',     // 7 - Offset ( Accent color )
            8 => 'burgundy',   // 8 - Burgundy ( Coin Pricing )
            9 => 'simple',     // 9 - Simple ( Blue on white )
            10 => 'white',     // 10 - White ( Black & White )
            11 => 'small'      // 11 - Small ( Small Title )
        ];
        
        // Return the template name for the selected template
        return isset($templateNames[$template]) ? $templateNames[$template] : 'default';
    }
}
