<?php
/**
 * Bears Pricing Tables
 * 
 * @version     2025.06.04.5
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
// Make sure module ID is available - Joomla always provides module->id
$moduleId = $module->id;
ModBearsPricingTablesHelper::loadModuleCSS($params, $moduleId);

// Get all parameters from helper
$params_array = ModBearsPricingTablesHelper::getParams($params);

// Get the template name to load
$templateName = ModBearsPricingTablesHelper::getTemplateName($params);

// Setup module data to be available in the template
$params_array['moduleId'] = $moduleId;

// Load the layout - IMPORTANT: Use the template name from the helper
require ModuleHelper::getLayoutPath('mod_bears_pricing_tables', $templateName);
