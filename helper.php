<?php
/**
 * Bears Pricing Tables
 *
 * @version     2025.05.17
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
use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Version;

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
        $bears_button_text_color = $params->get('bears_button_text_color');
        $bears_button_bg_color = $params->get('bears_button_bg_color');
        $bears_button_hover_color = $params->get('bears_button_hover_color');
        $bears_global_icon_color = $params->get('bears_icon_color');
        
        // Get font parameters
        $bears_google_font_family = $params->get('bears_google_font_family', 'Crimson Text');
        $bears_font_weight = $params->get('bears_font_weight', '400');
        
        // Initialize arrays for column-specific parameters
        $bears_title = array();
        $bears_price = array();
        $bears_subtitle = array();
        $bears_features = array();
        $bears_featured = array();
        $bears_buttontext = array();
        $bears_buttonurl = array();
        $bears_icon_class = array();
        $bears_icon_size = array();
        $bears_icon_position = array();
        $bears_icon_color = array();

        // Get parameters for each column
        for ($i = 1; $i <= 5; $i++) {
            $bears_title[$i] = $params->get('bears_title' . $i, '');
            $bears_price[$i] = $params->get('bears_price' . $i, '');
            $bears_subtitle[$i] = $params->get('bears_subtitle' . $i, '');
            $bears_features[$i] = $params->get('bears_features' . $i, array());
            $bears_featured[$i] = $params->get('bears_column_featured' . $i, 'no');
            $bears_buttontext[$i] = $params->get('bears_buttontext' . $i, '');
            $bears_buttonurl[$i] = $params->get('bears_buttonurl' . $i, '');
            $bears_icon_class[$i] = $params->get('bears_icon_class' . $i, '');
            $bears_icon_size[$i] = $params->get('bears_icon_size' . $i, '');
            $bears_icon_position[$i] = $params->get('bears_icon_position' . $i, 'top-center');
            $bears_icon_color[$i] = $params->get('bears_icon_color' . $i, '');
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
            'bears_button_text_color' => $bears_button_text_color,
            'bears_button_bg_color' => $bears_button_bg_color,
            'bears_button_hover_color' => $bears_button_hover_color,
            'bears_icon_color' => $bears_global_icon_color,

            // Font parameters
            'bears_google_font_family' => $bears_google_font_family,
            'bears_font_weight' => $bears_font_weight,
            
            // Column-specific parameters
            'bears_title' => $bears_title,
            'bears_price' => $bears_price,
            'bears_subtitle' => $bears_subtitle,
            'bears_features' => $bears_features,
            'bears_featured' => $bears_featured,
            'bears_buttontext' => $bears_buttontext,
            'bears_buttonurl' => $bears_buttonurl,
            'bears_icon_class' => $bears_icon_class,
            'bears_icon_size' => $bears_icon_size,
            'bears_icon_position' => $bears_icon_position,
            'bears_icon_color' => $bears_icon_color,
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
        
        // Get template name using the safe method
        $template = self::getTemplateName($params);
        
        // Add the base CSS file
        $document->addStyleSheet(Uri::base() . 'modules/mod_bears_pricing_tables/css/' . $template . '.css');
        
        // Add icons CSS file
        $document->addStyleSheet(Uri::base() . 'modules/mod_bears_pricing_tables/css/icons.css');
        
        // Check if FontAwesome is needed and load it if not already loaded
        self::loadFontAwesome();
        
        // Add custom CSS variables
        $css = self::generateCustomCSS($params);
        if (!empty($css)) {
            $document->addStyleDeclaration($css);
        }
    }
    
    /**
     * Load FontAwesome if it's not already loaded by the template
     *
     * @return  void
     * @since   2025.5.18
     */
    public static function loadFontAwesome()
    {
        // Get the document
        $document = Factory::getDocument();
        
        // Get the WebAsset Manager
        $wa = $document->getWebAssetManager();
        
        // Check if FontAwesome is already available as a WebAsset
        if ($wa->assetExists('style', 'fontawesome')) {
            // Use Joomla's built-in FontAwesome
            $wa->useStyle('fontawesome');
            return;
        }
        
        // Check if FontAwesome is already loaded by looking for it in the document head
        $headData = $document->getHeadData();
        $styleSheets = $headData['styleSheets'];
        $fontAwesomeLoaded = false;
        
        // Check if any of the loaded stylesheets contain 'font-awesome' in their URL
        foreach ($styleSheets as $url => $attributes) {
            if (stripos($url, 'font-awesome') !== false) {
                $fontAwesomeLoaded = true;
                break;
            }
        }
        
        // If FontAwesome is not loaded, try multiple approaches
        if (!$fontAwesomeLoaded) {
            // First try: Load from Joomla's media directory
            if (file_exists(JPATH_ROOT . '/media/vendor/fontawesome-free/css/fontawesome.min.css')) {
                $document->addStyleSheet(Uri::root(true) . '/media/vendor/fontawesome-free/css/fontawesome.min.css');
                $document->addStyleSheet(Uri::root(true) . '/media/vendor/fontawesome-free/css/solid.min.css');
            } 
            // Second try: Load from CDN as a fallback
            else {
                $document->addStyleSheet('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', 
                    array('integrity' => 'sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==', 
                          'crossorigin' => 'anonymous', 
                          'referrerpolicy' => 'no-referrer'));
            }
            
            // Add a debug message to help troubleshoot
            $document->addScriptDeclaration("console.log('Bears Pricing Tables: FontAwesome loaded from " . 
                (file_exists(JPATH_ROOT . '/media/vendor/fontawesome-free/css/fontawesome.min.css') ? 
                "Joomla media directory" : "CDN") . "');");
        }
    }
    
    /**
     * Generate custom CSS based on module parameters
     *
     * @param   object  $params  The module parameters
     * @return  string  The custom CSS
     * @since   2025.5.10
     */
    public static function generateCustomCSS($params)
    {
        $css = '.bears_pricing_tables {';
        
        // Add custom CSS variables
        if ($params->get('bears_column_bg')) {
            $css .= '--bears-column-bg: ' . $params->get('bears_column_bg') . ';';
        }
        if ($params->get('bears_column_featured_bg')) {
            $css .= '--bears-column-featured-bg: ' . $params->get('bears_column_featured_bg') . ';';
        }
        if ($params->get('bears_header_bg')) {
            $css .= '--bears-header-bg: ' . $params->get('bears_header_bg') . ';';
        }
        if ($params->get('bears_header_featured_bg')) {
            $css .= '--bears-header-featured-bg: ' . $params->get('bears_header_featured_bg') . ';';
        }
        if ($params->get('bears_title_color')) {
            $css .= '--bears-title-color: ' . $params->get('bears_title_color') . ';';
        }
        if ($params->get('bears_price_color')) {
            $css .= '--bears-price-color: ' . $params->get('bears_price_color') . ';';
        }
        if ($params->get('bears_featured_price_color')) {
            $css .= '--bears-featured-price-color: ' . $params->get('bears_featured_price_color') . ';';
        }
        if ($params->get('bears_pricesub_color')) {
            $css .= '--bears-pricesub-color: ' . $params->get('bears_pricesub_color') . ';';
        }
        if ($params->get('bears_features_color')) {
            $css .= '--bears-features-color: ' . $params->get('bears_features_color') . ';';
        }
        if ($params->get('bears_border_color')) {
            $css .= '--bears-border-color: ' . $params->get('bears_border_color') . ';';
        }
        if ($params->get('bears_border_style')) {
            $css .= '--bears-border-style: ' . $params->get('bears_border_style') . ';';
        }
        if ($params->get('bears_featured_border_color')) {
            $css .= '--bears-featured-border-color: ' . $params->get('bears_featured_border_color') . ';';
        }
        if ($params->get('bears_featured_border_style')) {
            $css .= '--bears-featured-border-style: ' . $params->get('bears_featured_border_style') . ';';
        }
        if ($params->get('bears_accent_color')) {
            $css .= '--bears-accent-color: ' . $params->get('bears_accent_color') . ';';
        }
        if ($params->get('bears_featured_accent_color')) {
            $css .= '--bears-featured-accent-color: ' . $params->get('bears_featured_accent_color') . ';';
        }
        if ($params->get('bears_button_text_color')) {
            $css .= '--bears-button-color: ' . $params->get('bears_button_text_color') . ';';
        }
        if ($params->get('bears_button_bg_color')) {
            $css .= '--bears-button-bg-color: ' . $params->get('bears_button_bg_color') . ';';
        }
        if ($params->get('bears_button_hover_color')) {
            $css .= '--bears-button-hover-color: ' . $params->get('bears_button_hover_color') . ';';
        }
        if ($params->get('bears_icon_color')) {
            $css .= '--bears-icon-color: ' . $params->get('bears_icon_color') . ';';
        }
        
        // Column-specific icon colors
        for ($i = 1; $i <= 5; $i++) {
            $iconColor = $params->get('bears_icon_color' . $i);
            if (!empty($iconColor)) {
                $css .= '--bears-icon-color-' . $i . ': ' . $iconColor . ';';
            }
        }
        
        // Font sizes
        if ($params->get('bears_title_font_size')) {
            $css .= '--bears-title-font-size: ' . $params->get('bears_title_font_size') . 'px;';
        }
        if ($params->get('bears_subtitle_font_size')) {
            $css .= '--bears-subtitle-font-size: ' . $params->get('bears_subtitle_font_size') . 'px;';
        }
        if ($params->get('bears_price_font_size')) {
            $css .= '--bears-price-font-size: ' . $params->get('bears_price_font_size') . 'px;';
        }
        if ($params->get('bears_features_font_size')) {
            $css .= '--bears-features-font-size: ' . $params->get('bears_features_font_size') . 'px;';
        }
        if ($params->get('bears_button_font_size')) {
            $css .= '--bears-button-font-size: ' . $params->get('bears_button_font_size') . 'px;';
        }
        
        // Margins
        if ($params->get('bears_column_margin_x')) {
            $css .= '--bears-column-margin-x: ' . $params->get('bears_column_margin_x') . 'px;';
        }
        if ($params->get('bears_column_margin_y')) {
            $css .= '--bears-column-margin-y: ' . $params->get('bears_column_margin_y') . 'px;';
        }
        
        $css .= '}';
        
        // Add Google Font if specified
        if ($params->get('bears_use_google_font', '0') == '1' && $params->get('bears_google_font_family')) {
            $fontFamily = $params->get('bears_google_font_family', 'Raleway');
            $fontWeight = $params->get('bears_font_weight', '400');
            
            // Add Google Font import
            $css = '@import url("https://fonts.googleapis.com/css2?family=' . str_replace(' ', '+', $fontFamily) . ':wght@' . $fontWeight . '&display=swap");' . "\n" . $css;
            
            // Apply font family to the pricing tables
            $css .= "\n" . '.bears_pricing_tables { font-family: "' . $fontFamily . '", sans-serif; font-weight: ' . $fontWeight . '; }';
        }
        
        // Add column-specific icon sizes if specified
        for ($i = 1; $i <= 5; $i++) {
            $iconSize = $params->get('bears_icon_size' . $i);
            if (!empty($iconSize)) {
                $css .= "\n" . '.bears_pricing_tables .bears-column-' . $i . ' i, ' .
                       '.bears_pricing_tables .bears-column-' . $i . ' .fa, ' .
                       '.bears_pricing_tables .bears-column-' . $i . ' .fas, ' .
                       '.bears_pricing_tables .bears-column-' . $i . ' .far, ' .
                       '.bears_pricing_tables .bears-column-' . $i . ' .fab { font-size: ' . $iconSize . '; }';
            }
        }
        
        return $css;
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

        // If the template file doesn't exist, fall back to white.php
        if (!file_exists($templateFile)) {
            // Get application
            $app = Factory::getApplication();
            $app->enqueueMessage('Template "' . $template . '" not found, falling back to white.php', 'notice');
            return 'white';
        }
        
        // Return the template value
        return $template;
    }

    /**
     * Method to generate CSS for the module - DEPRECATED, use generateCustomCSS instead
     * Kept for backward compatibility
     *
     * @param   \Joomla\Registry\Registry  $params  Module parameters
     * @return  string                     CSS code
     * @since   2025.5.18
     * @deprecated
     */
    public static function getCSS($params)
    {
        return self::generateCustomCSS($params);
    }
    
    /**
     * Process icon positions to split into horizontal and vertical components
     *
     * @param   array   $iconPositions  Array of icon positions
     * @return  array   Array containing horizontal and vertical position arrays
     * @since   2025.5.18
     */
    public static function processIconPositions($iconPositions)
    {
        $iconHorz = array();
        $iconVert = array();
        
        foreach ($iconPositions as $i => $position) {
            if (!empty($position)) {
                // Handle special cases like 'price-left' and 'price-right'
                if ($position === 'price-left' || $position === 'price-right') {
                    $iconVert[$i] = 'price';
                    $iconHorz[$i] = str_replace('price-', '', $position);
                } else {
                    $positionParts = explode('-', $position);
                    // First part is vertical (top, center, bottom)
                    $iconVert[$i] = isset($positionParts[0]) ? $positionParts[0] : 'center';
                    // Second part is horizontal (left, center, right)
                    $iconHorz[$i] = isset($positionParts[1]) ? $positionParts[1] : 'center';
                }
            } else {
                $iconVert[$i] = 'center';
                $iconHorz[$i] = 'center';
            }
        }
        
        return array(
            'horizontal' => $iconHorz,
            'vertical' => $iconVert
        );
    }
}
