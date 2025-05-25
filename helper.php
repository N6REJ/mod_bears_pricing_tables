<?php
/**
 * Bears Pricing Tables
 *
 * @version     2025.05.24
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright   Copyright (c) 2025 N6REJ
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @since       2025.5.10
 */

defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Router;
use Joomla\CMS\Uri\Uri;
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
     * @param   object  $params       The module parameters
     * @param   bool    $useDefaults  Whether to use default values or not (defaults rely on CSS variables)
     *
     * @return  array   Array of parameters for the template
     * @since   2025.5.10
     */
    public static function getParams($params, $useDefaults = false)
    {
        // Get template (always provide default) - this is essential for module operation
        $bears_template = $params->get('bears_template', '1276');

        // Get number columns with default value
        $bears_num_columns = (int)$params->get('bears_num_columns', 3);

        // CSS-variable backed parameters - use null to allow CSS variables as defaults
        $bears_column_margin_x            = $params->get('bears_column_margin_x');
        $bears_column_margin_y            = $params->get('bears_column_margin_y');
        $bears_column_background          = $params->get('bears_column_background');
        $bears_column_featured_background = $params->get('bears_column_featured_background');
        $bears_header_background          = $params->get('bears_header_background');
        $bears_header_featured_background = $params->get('bears_header_featured_background');
        $bears_title_color                = $params->get('bears_title_color');
        $bears_featured_title_color       = $params->get('bears_featured_title_color');
        $bears_title_font_size            = $params->get('bears_title_font_size');
        $bears_subtitle_font_size         = $params->get('bears_subtitle_font_size');
        $bears_price_font_size            = $params->get('bears_price_font_size');
        $bears_features_font_size         = $params->get('bears_features_font_size');
        $bears_button_font_size           = $params->get('bears_button_font_size');
        $bears_price_color                = $params->get('bears_price_color');
        $bears_featured_price_color       = $params->get('bears_featured_price_color');
        $bears_subtitle_color             = $params->get('bears_subtitle_color');
        $bears_features_color             = $params->get('bears_features_color');
        $bears_featured_features_color    = $params->get('bears_featured_features_color');
        $bears_border_color               = $params->get('bears_border_color');
        $bears_featured_border_color      = $params->get('bears_featured_border_color');
        $bears_accent_color               = $params->get('bears_accent_color');
        $bears_featured_accent_color      = $params->get('bears_featured_accent_color');
        $bears_button_text_color          = $params->get('bears_button_text_color');
        $bears_button_background_color    = $params->get('bears_button_background_color');
        $bears_button_hover_color         = $params->get('bears_button_hover_color');

        // Parameters with explicit defaults that might vary by template
        $bears_border_style          = $params->get('bears_border_style');
        $bears_featured_border_style = $params->get('bears_featured_border_style');

        // Font parameters with proper defaults
        $bears_google_font_family = $params->get('bears_google_font_family');
        $bears_font_weight        = $params->get('bears_font_weight');
        $bears_use_google_font    = $params->get('bears_use_google_font');

        // Initialize arrays for column-specific parameters
        $bears_title         = array();
        $bears_price         = array();
        $bears_subtitle      = array();
        $bears_features      = array();
        $bears_featured      = array();
        $bears_buttontext    = array();
        $bears_buttonurl     = array();
        $bears_icon_class    = array();
        $bears_icon_size     = array();
        $bears_icon_position = array();
        $bears_icon_color    = array();

        // Initialize column reference array and counter
        $column_ref  = array();
        $columnnr    = 0;
        $max_columns = 5;

        // Get parameters for each column
        for ($i = 1; $i <= $max_columns; $i++) {
            $title                   = $params->get('bears_title' . $i, '');
            $bears_title[$i]         = $title;
            $bears_price[$i]         = $params->get('bears_price' . $i, '');
            $bears_subtitle[$i]      = $params->get('bears_subtitle' . $i, '');
            $bears_features[$i]      = $params->get('bears_features' . $i, array());
            $bears_featured[$i]      = $params->get('bears_column_featured' . $i, 'no');
            $bears_buttontext[$i]    = $params->get('bears_buttontext' . $i, '');
            $bears_buttonurl[$i]     = $params->get('bears_buttonurl' . $i, '');
            $bears_icon_class[$i]    = $params->get('bears_icon_class' . $i, '');
            $bears_icon_size[$i]     = $params->get('bears_icon_size' . $i, '');
            $bears_icon_position[$i] = $params->get('bears_icon_position' . $i);
            $bears_icon_color[$i]    = $params->get('bears_icon_color' . $i, '');

            // Build the column reference array based on which columns have titles
            if (!empty($title)) {
                $column_ref[$columnnr] = $i;
                $columnnr++;
            }
        }

        return array(
            // Global parameters
            'bears_template'                   => $bears_template,
            'bears_num_columns'                => $bears_num_columns,
            'bears_column_margin_x'            => $bears_column_margin_x,
            'bears_column_margin_y'            => $bears_column_margin_y,
            'bears_column_background'          => $bears_column_background,
            'bears_column_featured_background' => $bears_column_featured_background,
            'bears_header_background'          => $bears_header_background,
            'bears_header_featured_background' => $bears_header_featured_background,
            'bears_title_color'                => $bears_title_color,
            'bears_featured_title_color'       => $bears_featured_title_color,
            'bears_title_font_size'            => $bears_title_font_size,
            'bears_subtitle_font_size'         => $bears_subtitle_font_size,
            'bears_price_font_size'            => $bears_price_font_size,
            'bears_features_font_size'         => $bears_features_font_size,
            'bears_button_font_size'           => $bears_button_font_size,
            'bears_price_color'                => $bears_price_color,
            'bears_featured_price_color'       => $bears_featured_price_color,
            'bears_subtitle_color'             => $bears_subtitle_color,
            'bears_features_color'             => $bears_features_color,
            'bears_featured_features_color'    => $bears_featured_features_color,
            'bears_border_color'               => $bears_border_color,
            'bears_border_style'               => $bears_border_style,
            'bears_featured_border_color'      => $bears_featured_border_color,
            'bears_featured_border_style'      => $bears_featured_border_style,
            'bears_accent_color'               => $bears_accent_color,
            'bears_featured_accent_color'      => $bears_featured_accent_color,
            'bears_button_text_color'          => $bears_button_text_color,
            'bears_button_background_color'    => $bears_button_background_color,
            'bears_button_hover_color'         => $bears_button_hover_color,
            'bears_use_google_font'            => $bears_use_google_font,

            // Font parameters
            'bears_google_font_family'         => $bears_google_font_family,
            'bears_font_weight'                => $bears_font_weight,

            // Column-specific parameters
            'bears_title'                      => $bears_title,
            'bears_price'                      => $bears_price,
            'bears_subtitle'                   => $bears_subtitle,
            'bears_features'                   => $bears_features,
            'bears_featured'                   => $bears_featured,
            'bears_buttontext'                 => $bears_buttontext,
            'bears_buttonurl'                  => $bears_buttonurl,

            // Icon parameters
            'iconClass'                        => $bears_icon_class,
            'iconSize'                         => $bears_icon_size,
            'iconPosition'                     => $bears_icon_position,
            'iconColor'                        => $bears_icon_color,

            // Column reference array for template use
            'column_ref'                       => $column_ref,
            'columnnr'                         => $columnnr,
        );
    }


    /**
     * Load all module CSS files in the correct order
     *
     * @param   object  $params    The module parameters
     * @param   int     $moduleId  The module ID for increased CSS specificity (required)
     *
     * @return  void
     * @since   2025.5.20
     * @throws  \InvalidArgumentException  If moduleId is not provided
     */
    public static function loadModuleCSS($params, $moduleId)
    {
        // Ensure we have a valid module ID
        if (empty($moduleId)) {
            throw new \InvalidArgumentException('Module ID is required for CSS specificity');
        }

        // Get the document
        $document = Factory::getDocument();

        // 1. First, load FontAwesome directly
        $document->addStyleSheet(Uri::base() . 'media/system/css/joomla-fontawesome.css', ['version' => 'auto']);

        // 2. Next, load icons.css with base styles
        $iconsCssPath = 'modules/mod_bears_pricing_tables/css/icons.css';
        $document->addStyleSheet(Uri::root(true) . '/' . $iconsCssPath, ['version' => 'auto']);
        
        // 3. Load the generic column-widths.css before any template-specific CSS
        $columnCssPath = 'modules/mod_bears_pricing_tables/css/column-widths.css';
        $document->addStyleSheet(Uri::root(true) . '/' . $columnCssPath, ['version' => 'auto']);

        // 4. Next, load the template CSS file (template-specific defaults)
        $template = self::getTemplateName($params);
        $templateCssPath = 'modules/mod_bears_pricing_tables/css/' . $template . '.css';
        $document->addStyleSheet(Uri::root(true) . '/' . $templateCssPath, ['version' => 'auto']);

        // 5. Finally, add our custom CSS variables with high specificity to override everything
        $css = self::generateCustomCSS($params, $moduleId);
        if (!empty($css)) {
            $document->addStyleDeclaration($css);
        }
    }


    /**
     * Get the appropriate template file based on template selection
     *
     * @param   object  $params  The module parameters
     *
     * @return  string  The template file name without extension
     * @since   2025.5.10
     */
    public static function getTemplateName($params)
    {
        // Get template selection with default fallback
        $template = $params->get('bears_template', '1276');

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
     * Generate custom CSS based on module parameters
     *
     * @param   object  $params    The module parameters
     * @param   int     $moduleId  The module ID for instance-specific CSS (required)
     *
     * @return  string  The custom CSS
     * @since   2025.5.10
     * @throws  \InvalidArgumentException  If moduleId is not provided
     */
    public static function generateCustomCSS($params, $moduleId)
    {
        // Ensure we have a valid module ID for specificity
        if (empty($moduleId)) {
            throw new \InvalidArgumentException('Module ID is required for CSS specificity');
        }

        // Start with a module-specific CSS variable container with high specificity
        $css = '.bears_pricing_tables' . $moduleId . ' {';

        // Add custom CSS variables
        if ($params->get('bears_column_background')) {
            $css .= '--bears-column-background: ' . $params->get('bears_column_background') . ';';
        }
        if ($params->get('bears_column_featured_background')) {
            $css .= '--bears-column-featured-background: ' . $params->get('bears_column_featured_background') . ';';
        }
        if ($params->get('bears_header_background')) {
            $css .= '--bears-header-background: ' . $params->get('bears_header_background') . ';';
        }
        if ($params->get('bears_header_featured_background')) {
            $css .= '--bears-header-featured-background: ' . $params->get('bears_header_featured_background') . ';';
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
        if ($params->get('bears_subtitle_color')) {
            $css .= '--bears-subtitle-color: ' . $params->get('bears_subtitle_color') . ';';
        }
        if ($params->get('bears_features_color')) {
            $css .= '--bears-features-color: ' . $params->get('bears_features_color') . ';';
        }
        if ($params->get('bears_featured_features_color')) {
            $css .= '--bears-featured-features-color: ' . $params->get('bears_featured_features_color') . ';';
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
            $css .= '--bears-button-text-color: ' . $params->get('bears_button_text_color') . ';';
        }
        if ($params->get('bears_button_background_color')) {
            $css .= '--bears-button-background-color: ' . $params->get('bears_button_background_color') . ';';
        }
        if ($params->get('bears_button_hover_color')) {
            $css .= '--bears-button-hover-color: ' . $params->get('bears_button_hover_color') . ';';
        }

        // Additional CSS variables
        if ($params->get('bears_box_shadow')) {
            $css .= '--bears-box-shadow: ' . $params->get('bears_box_shadow') . ';';
        }

        // Add 'px' to size-related fields if they don't already have a unit
        if ($params->get('bears_border_radius')) {
            $borderRadius = $params->get('bears_border_radius');
            if (!preg_match('/[a-z%]$/i', $borderRadius)) {
                $borderRadius .= 'px';
            }
            $css .= '--bears-border-radius: ' . $borderRadius . ';';
        }

        if ($params->get('bears_border_width')) {
            $borderWidth = $params->get('bears_border_width');
            if (!preg_match('/[a-z%]$/i', $borderWidth)) {
                $borderWidth .= 'px';
            }
            $css .= '--bears-border-width: ' . $borderWidth . ';';
        }

        if ($params->get('bears_transition_speed')) {
            $transitionSpeed = $params->get('bears_transition_speed');
            if (!preg_match('/[a-z]$/i', $transitionSpeed)) {
                $transitionSpeed .= 's';
            }
            $css .= '--bears-transition-speed: ' . $transitionSpeed . ';';
        }

        // Column-specific icon colors
        for ($i = 1; $i <= 5; $i++) {
            $iconColor = $params->get('bears_icon_color' . $i);
            if (!empty($iconColor)) {
                $css .= '--bears-icon-color-' . $i . ': ' . $iconColor . ';';
            }
        }

        // Font sizes - add 'px' if not already present
        if ($params->get('bears_title_font_size')) {
            $titleFontSize = $params->get('bears_title_font_size');
            if (!preg_match('/[a-z%]$/i', $titleFontSize)) {
                $titleFontSize .= 'px';
            }
            $css .= '--bears-title-font-size: ' . $titleFontSize . ';';
        }

        if ($params->get('bears_subtitle_font_size')) {
            $subtitleFontSize = $params->get('bears_subtitle_font_size');
            if (!preg_match('/[a-z%]$/i', $subtitleFontSize)) {
                $subtitleFontSize .= 'px';
            }
            $css .= '--bears-subtitle-font-size: ' . $subtitleFontSize . ';';
        }

        if ($params->get('bears_price_font_size')) {
            $priceFontSize = $params->get('bears_price_font_size');
            if (!preg_match('/[a-z%]$/i', $priceFontSize)) {
                $priceFontSize .= 'px';
            }
            $css .= '--bears-price-font-size: ' . $priceFontSize . ';';
        }

        if ($params->get('bears_features_font_size')) {
            $featuresFontSize = $params->get('bears_features_font_size');
            if (!preg_match('/[a-z%]$/i', $featuresFontSize)) {
                $featuresFontSize .= 'px';
            }
            $css .= '--bears-features-font-size: ' . $featuresFontSize . ';';
        }

        if ($params->get('bears_button_font_size')) {
            $buttonFontSize = $params->get('bears_button_font_size');
            if (!preg_match('/[a-z%]$/i', $buttonFontSize)) {
                $buttonFontSize .= 'px';
            }
            $css .= '--bears-button-font-size: ' . $buttonFontSize . ';';
        }

        // Margins - add 'px' if not already present
        if ($params->get('bears_column_margin_x')) {
            $columnMarginX = $params->get('bears_column_margin_x');
            if (!preg_match('/[a-z%]$/i', $columnMarginX)) {
                $columnMarginX .= 'px';
            }
            $css .= '--bears-column-margin-x: ' . $columnMarginX . ';';
        }

        if ($params->get('bears_column_margin_y')) {
            $columnMarginY = $params->get('bears_column_margin_y');
            if (!preg_match('/[a-z%]$/i', $columnMarginY)) {
                $columnMarginY .= 'px';
            }
            $css .= '--bears-column-margin-y: ' . $columnMarginY . ';';
        }

        $css .= '}';

        // Add Google Font if specified - still use module-specific selector
        if ($params->get('bears_use_google_font', '0') == '1' && $params->get('bears_google_font_family')) {
            $fontFamily = $params->get('bears_google_font_family', 'Raleway');
            $fontWeight = $params->get('bears_font_weight', '400');

            // Add Google Font import
            $css = '@import url("https://fonts.googleapis.com/css2?family=' . str_replace(' ', '+', $fontFamily) . ':wght@' . $fontWeight . '&display=swap");' . "\n" . $css;

            // Apply font family to the pricing tables with module ID for specificity
            $css .= "\n" . '.bears_pricing_tables' . $moduleId . ' { font-family: "' . $fontFamily . '", sans-serif; font-weight: ' . $fontWeight . '; }';
        }

        // Add all component-specific CSS rules with module ID for specificity
        $css .= '
    /* Base styles for module ' . $moduleId . ' */
    .bears_pricing_tables' . $moduleId . ' .bears_pricing_tables {
        padding: var(--bears-column-margin-y) var(--bears-column-margin-x);
    }
    .bears_pricing_tables' . $moduleId . ' .plan {
        background-color: var(--bears-column-background);
    }
    .bears_pricing_tables' . $moduleId . ' header {
        background-color: var(--bears-header-background);
    }
    .bears_pricing_tables' . $moduleId . ' .plan.featured {
        background-color: var(--bears-column-featured-background);
    }
    .bears_pricing_tables' . $moduleId . ' .plan.featured header {
        background-color: var(--bears-header-featured-background);
    }
    .bears_pricing_tables' . $moduleId . ' .plan-title {
        color: var(--bears-title-color);
        font-size: var(--bears-title-font-size);
    }
    .bears_pricing_tables' . $moduleId . ' .plan.featured .plan-title {
        color: var(--bears-featured-title-color);
    }
    .bears_pricing_tables' . $moduleId . ' .plan-price {
        color: var(--bears-price-color);
        font-size: var(--bears-price-font-size);
    }
    .bears_pricing_tables' . $moduleId . ' .plan.featured .plan-price {
        color: var(--bears-featured-price-color);
    }
    .bears_pricing_tables' . $moduleId . ' .plan-type {
        color: var(--bears-subtitle-color);
        font-size: var(--bears-subtitle-font-size);
    }
    .bears_pricing_tables' . $moduleId . ' .plan-features li {
        color: var(--bears-features-color);
        font-size: var(--bears-features-font-size);
    }
    .bears_pricing_tables' . $moduleId . ' .plan.featured .plan-features li {
        color: var(--bears-featured-features-color);
    }
    .bears_pricing_tables' . $moduleId . ' .plan-features {
        color: var(--bears-accent-color);
        background-color: var(--bears-column-featured-background-color);
    }
    .bears_pricing_tables' . $moduleId . ' .plan.featured .plan-features {
        color: var(--bears-featured-accent-color);
    }
    .bears_pricing_tables' . $moduleId . ' .plan-select a,
    .bears_pricing_tables' . $moduleId . ' .plan-select a.btn {
        color: var(--bears-button-text-color);
        background-color: var(--bears-button-background-color);
        font-size: var(--bears-button-font-size);
    }
    .bears_pricing_tables' . $moduleId . ' .plan-select a:hover,
    .bears_pricing_tables' . $moduleId . ' .plan-select a.btn:hover {
        background-color: var(--bears-button-hover-color);
    }
    
    /* Border styles for regular plans */
    .bears_pricing_tables' . $moduleId . ' .plan:not(.featured).border-shadow { 
        border: none !important; 
        box-shadow: var(--bears-box-shadow) !important; 
    }
    .bears_pricing_tables' . $moduleId . ' .plan:not(.featured).border-solid { 
        border: var(--bears-border-width) var(--bears-border-style) var(--bears-border-color) !important; 
        box-shadow: none !important; 
    }
    .bears_pricing_tables' . $moduleId . ' .plan:not(.featured).border-both { 
        border: var(--bears-border-width) var(--bears-border-style) var(--bears-border-color) !important; 
        box-shadow: var(--bears-box-shadow) !important; 
    }
    .bears_pricing_tables' . $moduleId . ' .plan:not(.featured).border-none { 
        border: none !important; 
        box-shadow: none !important; 
    }
    
    /* Border styles for featured plans */
    .bears_pricing_tables' . $moduleId . ' .plan.featured.border-shadow { 
        border: none !important; 
        box-shadow: var(--bears-box-shadow) !important; 
        overflow: hidden; 
    }
    .bears_pricing_tables' . $moduleId . ' .plan.featured.border-solid { 
        border: var(--bears-border-width) var(--bears-border-style) var(--bears-featured-border-color) !important; 
        box-shadow: none !important; 
        overflow: hidden; 
    }
    .bears_pricing_tables' . $moduleId . ' .plan.featured.border-both { 
        border: var(--bears-border-width) var(--bears-border-style) var(--bears-featured-border-color) !important; 
        box-shadow: var(--bears-box-shadow) !important; 
        overflow: hidden; 
    }
    .bears_pricing_tables' . $moduleId . ' .plan.featured.border-none { 
        border: none !important; 
        box-shadow: none !important; 
        overflow: hidden; 
    }';

        // Add column-specific icon sizes and colors with module-specific selectors
        for ($i = 1; $i <= 5; $i++) {
            $iconSize  = $params->get('bears_icon_size' . $i);
            $iconClass = $params->get('bears_icon_class' . $i);

            if (!empty($iconSize)) {
                // Add 'px' to the size if it doesn't already have a unit
                if (!preg_match('/[a-z%]$/i', $iconSize)) {
                    $iconSize .= 'px';
                }

                if (!empty($iconClass)) {
                    // Extract the base class (fa, fas, far, fab) and the specific icon name
                    $classes   = explode(' ', trim($iconClass));
                    $baseClass = $classes[0]; // e.g., 'fas'

                    // Apply the size to the specific icon within this column - with module ID for specificity
                    $css .= "\n" . '.bears_pricing_tables' . $moduleId . ' .bears-column-' . $i . ' i.' . $baseClass . ' { font-size: ' . $iconSize . '; }';
                } else {
                    // Fallback: if icon size is specified but no specific class, apply to all icons in the column
                    $css .= "\n" . '.bears_pricing_tables' . $moduleId . ' .bears-column-' . $i . ' i, ' .
                        '.bears_pricing_tables' . $moduleId . ' .bears-column-' . $i . ' .fa, ' .
                        '.bears_pricing_tables' . $moduleId . ' .bears-column-' . $i . ' .fas, ' .
                        '.bears_pricing_tables' . $moduleId . ' .bears-column-' . $i . ' .far, ' .
                        '.bears_pricing_tables' . $moduleId . ' .bears-column-' . $i . ' .fab { font-size: ' . $iconSize . '; }';
                }
            }
        }

        // Icon-specific CSS variables with module-specific selectors
        for ($i = 1; $i <= 5; $i++) {
            if (!empty($params->get('bears_icon_color' . $i))) {
                $css .= "\n" . '.bears_pricing_tables' . $moduleId . ' .bears-column-' . $i . ' { --bears-icon-color-' . $i . ': ' . $params->get('bears_icon_color' . $i) . '; }';
            }
            if (!empty($params->get('bears_icon_size' . $i))) {
                $iconSize = $params->get('bears_icon_size' . $i);
                if (!preg_match('/[a-z%]$/i', $iconSize)) {
                    $iconSize .= 'px';
                }
                $css .= "\n" . '.bears_pricing_tables' . $moduleId . ' .bears-column-' . $i . ' { --bears-icon-size-' . $i . ': ' . $iconSize . '; }';
            }
        }

        // Add global icon variables with module-specific selectors
        if (!empty($params->get('bears_icon_color'))) {
            $css .= "\n" . '.bears_pricing_tables' . $moduleId . ' { --bears-icon-color: ' . $params->get('bears_icon_color') . '; }';
        }
        if (!empty($params->get('bears_icon_size'))) {
            $iconSize = $params->get('bears_icon_size');
            if (!preg_match('/[a-z%]$/i', $iconSize)) {
                $iconSize .= 'px';
            }
            $css .= "\n" . '.bears_pricing_tables' . $moduleId . ' { --bears-icon-size: ' . $iconSize . '; }';
        }

        // Module-specific column count attribute
        $bears_num_columns = (int)$params->get('bears_num_columns', 3);
        $css .= "\n" . '.bears_pricing_tables' . $moduleId . ' .bears_pricing_tables-container { data-columns: "' . $bears_num_columns . '"; }';

        // Add accent triangle if accent colors are specified
        if ($params->get('bears_accent_color') !== null && $params->get('bears_accent_color') !== '') {
            $css .= "\n" . '.bears_pricing_tables' . $moduleId . ' header:after { border-color: ' . $params->get('bears_accent_color') . ' transparent transparent transparent; }';
        }
        if ($params->get('bears_featured_accent_color') !== null && $params->get('bears_featured_accent_color') !== '') {
            $css .= "\n" . '.bears_pricing_tables' . $moduleId . ' .plan.featured header:after { border-color: ' . $params->get(
                    'bears_featured_accent_color'
                ) . ' transparent transparent transparent; }';
        }

        return $css;
    }

    /**
     * Helper function to format icon class correctly for FontAwesome 5/6
     *
     * @param   string  $iconClass  The icon class to format
     *
     * @return  string  Properly formatted icon class
     * @since   2025.5.20
     */
    public static function formatIconClass($iconClass)
    {
        if (empty($iconClass)) {
            return '';
        }

        // If class already has fa/fas/far/fab prefix with space, return as is
        if (preg_match('/^(fa|fas|far|fab|fa-solid|fa-regular|fa-brands)\s+/', $iconClass)) {
            return $iconClass;
        }

        // If class starts with fa- but doesn't have a prefix, add fas
        if (strpos($iconClass, 'fa-') === 0) {
            return 'fas ' . $iconClass;
        }

        // Default case: add fa- prefix and fas class
        return 'fas fa-' . $iconClass;
    }
}
