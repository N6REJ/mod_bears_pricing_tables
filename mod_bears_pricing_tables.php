<?php
/**
 * Bears Pricing Tables
 * 
 * @version     2025.05.16
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

// Get the application instance
$app = Factory::getApplication();
// Load admin CSS only in backend
if ($app->isClient('administrator')) {
    /** @var WebAssetManager $wa */
    $wa = $app->getDocument()->getWebAssetManager();
    $wa->registerAndUseStyle(
        'mod_bears_pricing_tables.admin',
        'mod_bears_pricing_tables/css/admin.css'
    );
}

// Include helper file
require_once __DIR__ . '/helper.php';

// Load the appropriate CSS file based on template selection
ModBearsPricingTablesHelper::loadTemplateCSS($params);

// Get all parameters from helper
$params_array = ModBearsPricingTablesHelper::getParams($params);

// Extract parameters
$bears_num_columns = $params_array['bears_num_columns'];
$bears_title = $params_array['bears_title'];
$bears_price = $params_array['bears_price'];
$bears_subtitle = $params_array['bears_subtitle'];
$bears_features = $params_array['bears_features'];
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

// Load the layout
require ModuleHelper::getLayoutPath('mod_bears_pricing_tables', $templateName);
