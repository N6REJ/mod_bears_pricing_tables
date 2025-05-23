
<?php
/**
 * Bears Pricing Tables - White Template
 * 
 * @version     2025.05.23.2
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright   Copyright (c) 2025 N6REJ
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Update for Joomla 5: Use namespaced classes
use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\Registry\Registry;

// Make sure $app is defined
$app = Factory::getApplication();

// Make sure $document is defined
$document = Factory::getDocument();

// Make sure $module is defined
if (!isset($module)) {
    $module = $app->input->get('module');
}

// Make sure $params is defined
if (!isset($params)) {
    if (isset($module->params)) {
        $params = new Registry($module->params);
    } else {
        $params = new Registry();
    }
}

// Include the helper file
require_once dirname(__DIR__) . '/helper.php';

// Make sure we have a valid module ID
$bears_moduleid = $module->id;

$baseurl = Uri::base(); // Updated from JURI::base()

// Get processed parameters
$data = ModBearsPricingTablesHelper::getParams($params);

// Extract variables from the data array for easier access in the template
extract($data);

// Load module CSS with moduleId to ensure proper specificity
ModBearsPricingTablesHelper::loadModuleCSS($params, $bears_moduleid);

// IMPORTANT: All CSS is now loaded through the helper, so we remove all inline CSS that was here before
?>
<div class="template-white">
	<div class="bears_pricing_tables<?php echo $bears_moduleid; ?> bears_pricing_tables-outer">
		<!-- Add data-columns attribute for CSS targeting -->
		<div class="bears_pricing_tables-container" data-columns="<?php echo $bears_num_columns; ?>">
            <?php
            // Loop through the number of columns to display
            for ($i = 0; $i < $bears_num_columns; $i++) {
                // Skip if this column index doesn't exist in our reference array
                if (!isset($column_ref[$i])) {
                    continue;
                }

                // Get the actual column number from our reference array
                $cur_column = $column_ref[$i];

                // Check if this column is marked as featured
                $is_featured = isset($bears_featured[$cur_column]) && $bears_featured[$cur_column] == 'yes';

                // Determine border style based on featured status
                $border_style = $is_featured ? $bears_featured_border_style : $bears_border_style;

                // Add column-specific class for styling
                $columnClass = 'bears-column-' . $cur_column;
                ?>
				<div class="bears_pricing_tables">
					<div class="plan<?php
                    echo $is_featured ? ' featured' : ''; ?> border-<?php
                    echo $border_style; ?> <?php
                    echo $columnClass; ?>">
						<header>
                            <?php
                            if (!empty($iconClass[$cur_column]) && str_starts_with($iconPosition[$cur_column], 'top-')) {
                                ?>
								<div class="plan-icon icon-<?php
                                echo htmlspecialchars($iconPosition[$cur_column]); ?> <?php
                                echo $columnClass; ?>">
									<i class="<?php
                                    echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($iconClass[$cur_column])); ?>"></i>
								</div>
                                <?php
                            } ?>

							<h3 class="plan-title">
                                <?php
                                echo htmlspecialchars($bears_title[$cur_column] ?? ''); ?>
							</h3>

                            <?php
                            if (!empty($iconClass[$cur_column]) && str_starts_with($iconPosition[$cur_column], 'center-')) {
                                ?>
								<div class="plan-icon icon-<?php
                                echo htmlspecialchars($iconPosition[$cur_column]); ?> <?php
                                echo $columnClass; ?>">
									<i class="<?php
                                    echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($iconClass[$cur_column])); ?>"></i>
								</div>
                                <?php
                            } ?>

							<div class="price">
                                <?php
                                if (!empty($iconClass[$cur_column]) && $iconPosition[$cur_column] === 'price-left') {
                                    ?>
									<div class="plan-icon price-left <?php
                                    echo $columnClass; ?>">
										<i class="<?php
                                        echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($iconClass[$cur_column])); ?>"></i>
									</div>
                                    <?php
                                } ?>

								<div class="plan-cost">
									<h1 class="plan-price"><?php
                                        echo htmlspecialchars($bears_price[$cur_column] ?? ''); ?></h1>
									<h4 class="plan-type"><?php
                                        echo htmlspecialchars($bears_subtitle[$cur_column] ?? ''); ?></h4>
								</div>

                                <?php
                                if (!empty($iconClass[$cur_column]) && $iconPosition[$cur_column] === 'price-right') {
                                    ?>
									<div class="plan-icon price-right <?php
                                    echo $columnClass; ?>">
										<i class="<?php
                                        echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($iconClass[$cur_column])); ?>"></i>
									</div>
                                    <?php
                                } ?>
							</div>

                            <?php
                            if (!empty($iconClass[$cur_column]) && str_starts_with($iconPosition[$cur_column], 'bottom-')) {
                                ?>
								<div class="plan-icon icon-<?php
                                echo htmlspecialchars($iconPosition[$cur_column]); ?> <?php
                                echo $columnClass; ?>">
									<i class="<?php
                                    echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($iconClass[$cur_column])); ?>"></i>
								</div>
                                <?php
                            }
                            ?>
						</header>

						<ul class="plan-features dot">
                            <?php
                            if (!empty($bears_features[$cur_column])) {
                                $features = $bears_features[$cur_column];

                                // Process features based on their structure
                                if (is_object($features)) {
                                    // Handle subform data structure
                                    foreach ($features as $key => $item) {
                                        if (is_object($item) && isset($item->bears_feature)) {
                                            echo '<li>' . htmlspecialchars($item->bears_feature) . '</li>';
                                        }
                                    }
                                } elseif (is_array($features)) {
                                    // Handle array of features
                                    foreach ($features as $item) {
                                        if (is_object($item) && isset($item->bears_feature)) {
                                            echo '<li>' . htmlspecialchars($item->bears_feature) . '</li>';
                                        } elseif (is_string($item)) {
                                            echo '<li>' . htmlspecialchars($item) . '</li>';
                                        }
                                    }
                                } elseif (is_string($features)) {
                                    // Try to decode if it's a JSON string
                                    $decoded = json_decode($features);
                                    if (json_last_error() === JSON_ERROR_NONE && (is_array($decoded) || is_object($decoded))) {
                                        foreach ($decoded as $item) {
                                            if (is_object($item) && isset($item->bears_feature)) {
                                                echo '<li>' . htmlspecialchars($item->bears_feature) . '</li>';
                                            } elseif (is_string($item)) {
                                                echo '<li>' . htmlspecialchars($item) . '</li>';
                                            }
                                        }
                                    } else {
                                        // It's just a plain string
                                        echo '<li>' . htmlspecialchars($features) . '</li>';
                                    }
                                }
                            }
                            ?>
						</ul>

						<div class="plan-select">
							<a class="btn" href="<?php
                            echo htmlspecialchars($bears_buttonurl[$cur_column] ?? '#'); ?>">
                                <?php
                                echo htmlspecialchars($bears_buttontext[$cur_column] ?? ''); ?>
							</a>
						</div>
					</div>
				</div>
                <?php
            }
            ?>
		</div>
		<div class = "clear"></div>
	</div>
</div>
