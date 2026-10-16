<?php

/**
 * Bears Pricing Tables
 *
 * @version     2026.10.16.1
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright Copyright (C) 2026 Troy Hall (N6REJ)
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace N6REJ\Module\BearsPricingTables\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Input\Input;
use Joomla\Registry\Registry;

class Dispatcher implements DispatcherInterface, HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    /**
     * The module object
     *
     * @var    \stdClass
     * @since  2025.07.20
     */
    protected \stdClass $module;

    /**
     * The application object
     *
     * @var    CMSApplicationInterface
     * @since  2025.07.20
     */
    protected CMSApplicationInterface $app;

    /**
     * The input object
     *
     * @var    Input
     * @since  2025.07.20
     */
    protected Input $input;

    /**
     * Constructor.
     *
     * @param   \stdClass                $module  The module object
     * @param   CMSApplicationInterface  $app     The application object
     * @param   Input                    $input   The input object
     *
     * @since   2025.07.20
     */
    public function __construct(\stdClass $module, CMSApplicationInterface $app, Input $input)
    {
        $this->module = $module;
        $this->app    = $app;
        $this->input  = $input;
    }

    /**
     * Dispatch the module, preparing the data and rendering the layout.
     *
     * @return  void
     *
     * @since   2025.07.20
     */
    public function dispatch(): void
    {
        /** @var \N6REJ\Module\BearsPricingTables\Site\Helper\BearsPricingTablesHelper $helper */
        $helper = $this->getHelperFactory()->getHelper('BearsPricingTablesHelper');

        $module = $this->module;
        $params = new Registry($module->params);

        // Load admin CSS only in the backend (used for the module edit preview)
        if ($this->app->isClient('administrator')) {
            $wa = $this->app->getDocument()->getWebAssetManager();
            $wa->registerAndUseStyle(
                'mod_bears_pricing_tables.admin',
                'mod_bears_pricing_tables/css/admin.css'
            );
        }

        // Determine which template file should be rendered
        $templateName = $helper->getTemplateName($params);

        require ModuleHelper::getLayoutPath('mod_bears_pricing_tables', $templateName);
    }
}
