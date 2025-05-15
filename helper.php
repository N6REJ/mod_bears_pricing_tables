<?php
/**
 * Bears Pricing Tables
 *
 * @version     2025.05.15
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright   Copyright (c) 2025 N6REJ
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @since       2025.5.10
 */

defined('_JEXEC') or die;

use Joomla\CMS\Router\Router;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Factory;
use Joomla\CMS\Application\CMSApplication;

/**
 * Helper class for Bears Pricing Tables module
 *
 * @since  2025.5.10
 */
class ModBearsPricingTablesHelper
{
    /**
     * Get module parameters for the template
     *
     * @param   object  $params  The module parameters
     * @return  array   Array of parameters for the template
     * @since   2025.5.10
     */
    public static function getParams($params)
    {
        // Get global parameters
        $bears_template = $params->get('bears_template', 'default');
        $bears_num_columns = (int) $params->get('bears_num_columns', 3);
        $bears_column_margin_x = $params->get('bears_column_margin_x');
        $bears_column_margin_y = $params->get('bears_column_margin_y');
        $bears_column_bg = $params->get('bears_column_bg');
        $bears_column_featured_bg = $params->get('bears_column_featured_bg');
        $bears_header_bg = $params->get('bears_header_bg');
        $bears_header_featured_bg = $params->get('bears_header_featured_bg');
        $bears_title_color = $params->get('bears_title_color');
        $bears_title_font_size = $params->get('bears_title_font_size');
        $bears_subtitle_font_size = $params->get('bears_subtitle_font_size');
        $bears_price_font_size = $params->get('bears_price_font_size');
        $bears_features_font_size = $params->get('bears_features_font_size');
        $bears_button_font_size = $params->get('bears_button_font_size');
        $bears_price_color = $params->get('bears_price_color');
        $bears_featured_price_color = $params->get('bears_featured_price_color');
        $bears_pricesub_color = $params->get('bears_pricesub_color');
        $bears_features_color = $params->get('bears_features_color');
        $bears_border_color = $params->get('bears_border_color');
        $bears_border_style = $params->get('bears_border_style');
        $bears_featured_border_color = $params->get('bears_featured_border_color');
        $bears_featured_border_style = $params->get('bears_featured_border_style');
        $bears_accent_color = $params->get('bears_accent_color');
        $bears_featured_accent_color = $params->get('bears_featured_accent_color');
        $bears_button_color = $params->get('bears_button_color');
        $bears_button_hover_color = $params->get('bears_button_hover_color');
        
        // Get font parameters
        $bears_google_font_family = $params->get('bears_google_font_family', 'Crimson Text');
        $bears_font_weight = $params->get('bears_font_weight', '400');
        
        // Initialize arrays for column-specific parameters
        $bears_title = array();
        $bears_icon_class = array();
        $bears_icon_color = array();
        $bears_icon_location = array();
        $bears_price = array();
        $bears_subtitle = array();
        $bears_features = array();
        $bears_featured = array();
        $bears_buttontext = array();
        $bears_buttonurl = array();

        // Get parameters for each column
        for ($i = 1; $i <= 4; $i++) {
            $bears_title[$i] = $params->get('bears_title' . $i, '');
            $bears_icon_class[$i] = $params->get('bears_icon' . $i, '');
            $bears_icon_color[$i] = $params->get('bears_icon_color' . $i, '#424242');
            $bears_icon_location[$i] = $params->get('bears_icon_location' . $i, 'none');
            $bears_price[$i] = $params->get('bears_price' . $i, '');
            $bears_subtitle[$i] = $params->get('bears_subtitle' . $i, '');
            $bears_features[$i] = $params->get('bears_features' . $i, array());
            $bears_featured[$i] = $params->get('bears_column_featured' . $i, 'no');
            $bears_buttontext[$i] = $params->get('bears_buttontext' . $i, '');
            $bears_buttonurl[$i] = $params->get('bears_buttonurl' . $i, '');
        }
        
        return array(
            // Global parameters
            'bears_template' => $bears_template,
            'bears_num_columns' => $bears_num_columns,
            'bears_column_margin_x' => $bears_column_margin_x,
            'bears_column_margin_y' => $bears_column_margin_y,
            'bears_column_bg' => $bears_column_bg,
            'bears_column_featured_bg' => $bears_column_featured_bg,
            'bears_header_bg' => $bears_header_bg,
            'bears_header_featured_bg' => $bears_header_featured_bg,
            'bears_title_color' => $bears_title_color,
            'bears_title_font_size' => $bears_title_font_size,
            'bears_subtitle_font_size' => $bears_subtitle_font_size,
            'bears_price_font_size' => $bears_price_font_size,
            'bears_features_font_size' => $bears_features_font_size,
            'bears_button_font_size' => $bears_button_font_size,
            'bears_price_color' => $bears_price_color,
            'bears_featured_price_color' => $bears_featured_price_color,
            'bears_pricesub_color' => $bears_pricesub_color,
            'bears_features_color' => $bears_features_color,
            'bears_border_color' => $bears_border_color,
            'bears_border_style' => $bears_border_style,
            'bears_featured_border_color' => $bears_featured_border_color,
            'bears_featured_border_style' => $bears_featured_border_style,
            'bears_accent_color' => $bears_accent_color,
            'bears_featured_accent_color' => $bears_featured_accent_color,
            'bears_button_color' => $bears_button_color,
            'bears_button_hover_color' => $bears_button_hover_color,
            
            // Font parameters
            'bears_google_font_family' => $bears_google_font_family,
            'bears_font_weight' => $bears_font_weight,
            
            // Column-specific parameters
            'bears_title' => $bears_title,
            'bears_icon_class' => $bears_icon_class,
            'bears_icon_color' => $bears_icon_color,
            'bears_icon_location' => $bears_icon_location,
            'bears_price' => $bears_price,
            'bears_subtitle' => $bears_subtitle,
            'bears_features' => $bears_features,
            'bears_featured' => $bears_featured,
            'bears_buttontext' => $bears_buttontext,
            'bears_buttonurl' => $bears_buttonurl,
        );
    }

    /**
     * Load the appropriate CSS file based on template selection
     *
     * @param   object  $params  The module parameters
     * @return  void
     * @since   2025.5.10
     */
    public static function loadTemplateCSS($params)
    {
        // Get the document
        $document = Factory::getDocument();
        $app = Factory::getApplication();

        // Get template selection with default fallback
        $template = $params->get('bears_template', 'default');
        
        // Create CSS filename from template value
        $cssFile = $template . '.css';
        
        // Debug information
        $cssPath = dirname(__DIR__) . '/mod_bears_pricing_tables/css/' . $cssFile;
        
        // Add the CSS file to the document
        $document->addStyleSheet(Uri::base() . 'modules/mod_bears_pricing_tables/css/' . $cssFile);

        // Load Google Font directly if enabled
        $useGoogleFont = $params->get('bears_use_google_font', '0');
        
        if ($useGoogleFont == '1') {
            // Get font parameters
            $fontFamily = $params->get('bears_google_font_family', 'Crimson Text');
            $fontWeight = $params->get('bears_font_weight', '400');
            
            // Format font family for URL (replace spaces with +)
            $fontFamilyFormatted = str_replace(' ', '+', $fontFamily);
            
            // Add Google Font to document
            $document->addStyleSheet("https://fonts.googleapis.com/css?family={$fontFamilyFormatted}:{$fontWeight}&display=swap");
        }
    }
    
    /**
     * Get the appropriate template file based on template selection
     *
     * @param   object  $params  The module parameters
     * @return  string  The template file name without extension
     * @since   2025.5.10
     */
    public static function getTemplateName($params)
    {
        // Get template selection with default fallback
        $template = $params->get('bears_template', 'default');
        
        // Get application
        $app = Factory::getApplication();
        
        // Check if the template file exists
        $templateFile = dirname(__DIR__) . '/mod_bears_pricing_tables/tmpl/' . $template . '.php';

        // If the template file doesn't exist, fall back to default.php
        if (!file_exists($templateFile)) {
            $app->enqueueMessage('Falling back to default.php', 'notice');
            return 'default';
        }
        
        // Return the template value
        return $template;
    }
    
}
