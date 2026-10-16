<?php

/**
 * Bears Pricing Tables
 *
 * @version     2026.10.16
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright Copyright (C) 2026 Troy Hall (N6REJ)
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\HelperFactory;
use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class () implements ServiceProviderInterface {
    public function register(Container $container): void
    {
        $container->registerServiceProvider(new ModuleDispatcherFactory('\\N6REJ\\Module\\BearsPricingTables'));
        $container->registerServiceProvider(new HelperFactory('\\N6REJ\\Module\\BearsPricingTables\\Site\\Helper'));
        $container->registerServiceProvider(new Module());
    }
};
