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
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\WebAsset\WebAssetManager;

// The $params variable is provided by Joomla when the module is loaded
/** @var Joomla\Registry\Registry $params */
/** @var stdClass $module */

// Include helper file
require_once __DIR__ . '/helper.php';

// Get the application instance
$app = Factory::getApplication();

// Load admin CSS only in backend (will be loaded after other CSS for proper overrides)
if ($app->isClient('administrator')) {
    /** @var WebAssetManager $wa */
    $wa = $app->getDocument()->getWebAssetManager();
    $wa->registerAndUseStyle(
        'mod_bears_pricing_tables.admin',
        'mod_bears_pricing_tables/css/admin.css'
    );
}

// Load all module CSS with proper ordering
ModBearsPricingTablesHelper::loadModuleCSS($params);

// Get all parameters from helper
$params_array = ModBearsPricingTablesHelper::getParams($params);

// Extract parameters
$bears_num_columns = $params_array['bears_num_columns'];
$bears_title = $params_array['bears_title'];
$bears_price = $params_array['bears_price'];
$bears_subtitle = $params_array['bears_subtitle'];
$bears_featured = $params_array['bears_featured'];
$bears_buttontext = $params_array['bears_buttontext'];
$bears_buttonurl = $params_array['bears_buttonurl'];

// Extract font parameters
$bears_google_font_family = $params_array['bears_google_font_family'];
$bears_font_weight = $params_array['bears_font_weight'];
$bears_title_font_size = $params_array['bears_title_font_size'];
$bears_subtitle_font_size = $params_array['bears_subtitle_font_size'];
$bears_price_font_size = $params_array['bears_price_font_size'];
$bears_features_font_size = $params_array['bears_features_font_size'];
$bears_button_font_size = $params_array['bears_button_font_size'];

// Get the template name to load
$templateName = ModBearsPricingTablesHelper::getTemplateName($params);

// Make sure module ID is available for the template
$moduleId = isset($module->id) ? $module->id : mt_rand(10000, 99999);

// Setup an array of variables to be available in the template
$template_vars = [
    // Module info
    'moduleId' => $moduleId,
    'numColumns' => $bears_num_columns,
    'columnRef' => array_keys(array_filter($bears_title)),
    'columnnr' => count(array_filter($bears_title)),
    
    // Column content
    'title' => $bears_title,
    'subtitle' => $bears_subtitle,
    'price' => $bears_price,
    'featured' => $bears_featured,
    'buttonText' => $bears_buttontext,
    'buttonUrl' => $bears_buttonurl,
    
    // Font parameters
    'googleFontFamily' => $bears_google_font_family,
    'fontWeight' => $bears_font_weight,
    'titleFontSize' => $bears_title_font_size,
    'subtitleFontSize' => $bears_subtitle_font_size,
    'priceFontSize' => $bears_price_font_size,
    'featuresFontSize' => $bears_features_font_size,
    'buttonFontSize' => $bears_button_font_size,
];

// Extract variables for older templates that access them directly
extract($template_vars);

// Load the layout - IMPORTANT: Use the template name from the helper
require ModuleHelper::getLayoutPath('mod_bears_pricing_tables', $templateName);
