<?php
/**
 * Bears Pricing Tables
 * 
 * @version     2025.05.13.4
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

// Get the template name to load
$templateName = ModBearsPricingTablesHelper::getTemplateName($params);

// Load the layout
require ModuleHelper::getLayoutPath('mod_bears_pricing_tables', $templateName);
