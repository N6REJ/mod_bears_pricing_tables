<?php
/**
 * Bears Pricing Tables
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

use Joomla\CMS\Router\Router;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Factory;

/**
 * Helper class for Bears Pricing Tables module
 */
class ModBearsPricingTablesHelper
{
    /**
     * Get module parameters for the template
     *
     * @param   object  $params  The module parameters
     * @return  array   Array of parameters for the template
     */
    public static function getParams($params)
    {
        $bears_num_columns = (int) $params->get('bears_num_columns', 3);
        
        // Initialize arrays
        $bears_title = array();
        $bears_icon_class = array();
        $bears_icon_color = array();
        $bears_icon_location = array();
        $bears_price = array();
        $bears_subtitle = array();
        $bears_features = array();
        $bears_highlight = array();
        $bears_buttontext = array();
        $bears_buttonurl = array();
        
        // Font arrays
        $bears_use_google_font = array();
        $bears_google_font_url = array();
        $bears_title_font = array();
        $bears_subtitle_font = array();
        $bears_price_font = array();
        $bears_features_font = array();
        $bears_button_font = array();
        
        // Get parameters for each column
        for ($i = 1; $i <= 4; $i++) {
            $bears_title[$i] = $params->get('bears_title' . $i, '');
            $bears_icon_class[$i] = $params->get('bears_icon' . $i, '');
            $bears_icon_color[$i] = $params->get('bears_icon_color' . $i, '#424242');
            $bears_icon_location[$i] = $params->get('bears_icon_location' . $i, 'none');
            $bears_price[$i] = $params->get('bears_price' . $i, '');
            $bears_subtitle[$i] = $params->get('bears_subtitle' . $i, '');
            $bears_features[$i] = $params->get('bears_features' . $i, array());
            $bears_highlight[$i] = $params->get('bears_highlight' . $i, 'no');
            $bears_buttontext[$i] = $params->get('bears_buttontext' . $i, '');
            $bears_buttonurl[$i] = $params->get('bears_buttonurl' . $i, '');
            
            // Get font parameters
            $bears_use_google_font[$i] = $params->get('bears_use_google_font' . $i, 'no');
            $bears_google_font_url[$i] = $params->get('bears_google_font_url' . $i, '');
            $bears_title_font[$i] = $params->get('bears_title_font' . $i, '');
            $bears_subtitle_font[$i] = $params->get('bears_subtitle_font' . $i, '');
            $bears_price_font[$i] = $params->get('bears_price_font' . $i, '');
            $bears_features_font[$i] = $params->get('bears_features_font' . $i, '');
            $bears_button_font[$i] = $params->get('bears_button_font' . $i, '');
        }
        
        return array(
            'bears_num_columns' => $bears_num_columns,
            'bears_title' => $bears_title,
            'bears_icon_class' => $bears_icon_class,
            'bears_icon_color' => $bears_icon_color,
            'bears_icon_location' => $bears_icon_location,
            'bears_price' => $bears_price,
            'bears_subtitle' => $bears_subtitle,
            'bears_features' => $bears_features,
            'bears_highlight' => $bears_highlight,
            'bears_buttontext' => $bears_buttontext,
            'bears_buttonurl' => $bears_buttonurl,
            'bears_use_google_font' => $bears_use_google_font,
            'bears_google_font_url' => $bears_google_font_url,
            'bears_title_font' => $bears_title_font,
            'bears_subtitle_font' => $bears_subtitle_font,
            'bears_price_font' => $bears_price_font,
            'bears_features_font' => $bears_features_font,
            'bears_button_font' => $bears_button_font
        );
    }

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
        
        // Load Google Fonts if needed
        self::loadGoogleFonts($params);
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
    /**
     * Load Google Fonts based on module parameters
     *
     * @param   object  $params  The module parameters
     * @return  void
     */
    public static function loadGoogleFonts($params)
    {
        $document = Factory::getDocument();
        $loadedFonts = array();
        
        // Check each column for Google Fonts
        for ($i = 1; $i <= 4; $i++) {
            $useGoogleFont = $params->get('bears_use_google_font' . $i, 'no');
            
            if ($useGoogleFont === 'yes') {
                // Get all font selections for this column
                $titleFont = $params->get('bears_title_font' . $i, '');
                $subtitleFont = $params->get('bears_subtitle_font' . $i, '');
                $priceFont = $params->get('bears_price_font' . $i, '');
                $featuresFont = $params->get('bears_features_font' . $i, '');
                $buttonFont = $params->get('bears_button_font' . $i, '');
                
                // Add each font to the loadedFonts array to avoid duplicates
                if (!empty($titleFont) && !in_array($titleFont, $loadedFonts)) {
                    $loadedFonts[] = $titleFont;
                }
                
                if (!empty($subtitleFont) && !in_array($subtitleFont, $loadedFonts)) {
                    $loadedFonts[] = $subtitleFont;
                }
                
                if (!empty($priceFont) && !in_array($priceFont, $loadedFonts)) {
                    $loadedFonts[] = $priceFont;
                }
                
                if (!empty($featuresFont) && !in_array($featuresFont, $loadedFonts)) {
                    $loadedFonts[] = $featuresFont;
                }
                
                if (!empty($buttonFont) && !in_array($buttonFont, $loadedFonts)) {
                    $loadedFonts[] = $buttonFont;
                }
            } else {
                // Check if a custom Google Font URL is provided
                $googleFontUrl = $params->get('bears_google_font_url' . $i, '');
                
                if (!empty($googleFontUrl)) {
                    $document->addStyleSheet($googleFontUrl);
                }
            }
        }
        
        // Load all selected Google Fonts in a single request
        if (!empty($loadedFonts)) {
            $fontString = implode('|', array_map('urlencode', $loadedFonts));
            $document->addStyleSheet('https://fonts.googleapis.com/css?family=' . $fontString . '&display=swap');
        }
    }
}
