<?php
/**
 * Bears Pricing Tables
 *
 * @version     2025.05.14.2
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
        $bears_template = $params->get('bears_template', '1276');
        $bears_num_columns = (int) $params->get('bears_num_columns', 3);
        $bears_column_margin_x = $params->get('bears_column_margin_x');
        $bears_column_margin_y = $params->get('bears_column_margin_y');
        $bears_column_bg = $params->get('bears_column_bg');
        $bears_column_featured_bg = $params->get('bears_column_featured_bg');
        $bears_header_bg = $params->get('bears_header_bg');
        $bears_header_featured_bg = $params->get('bears_header_featured_bg');
        $bears_title_color = $params->get('bears_title_color');
        $bears_title_font_size = $params->get('bears_title_font_size');
        $bears_price_font_size = $params->get('bears_price_font_size');
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
            $bears_featured[$i] = $params->get('bears_column_featured' . $i, 'no');
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
            'bears_price_font_size' => $bears_price_font_size,
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
     * @since   2025.5.10
     */
  public static function loadTemplateCSS($params)
  {
      // Get the document
      $document = Factory::getDocument();
      $app = Factory::getApplication();

      // Get template selection with default fallback
      $template = $params->get('bears_template', '1276');
      
      // Create CSS filename from template value
      $cssFile = $template . '.css';
      $cssPath = JPATH_SITE . '/modules/mod_bears_pricing_tables/css/' . $cssFile;
      
      // Debug information
      $app->enqueueMessage('Looking for CSS file: ' . $cssPath, 'notice');
      $app->enqueueMessage('CSS file exists: ' . (file_exists($cssPath) ? 'Yes' : 'No'), 'notice');
      
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
     * @since   2025.5.10
     */
    public static function getTemplateName($params)
    {
        // Get template selection with default fallback
        $template = $params->get('bears_template', '1276');
        
        // Check if the template file exists
        $templateFile = JPATH_SITE . '/modules/mod_bears_pricing_tables/tmpl/' . $template . '.php';
        
        // Debug information
        $app = Factory::getApplication();
        $app->enqueueMessage('Looking for template file: ' . $templateFile, 'notice');
        $app->enqueueMessage('Template file exists: ' . (file_exists($templateFile) ? 'Yes' : 'No'), 'notice');
        
        // If the template file doesn't exist, fall back to 1276.php (our renamed default)
        if (!file_exists($templateFile)) {
            $app->enqueueMessage('Falling back to 1276.php', 'notice');
            return '1276';
        }
        
        // Return the template value
        return $template;
    }
    /**
     * Load Google Fonts based on module parameters
     *
     * @param   object  $params  The module parameters
     * @return  void
     * @since   2025.5.10
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
