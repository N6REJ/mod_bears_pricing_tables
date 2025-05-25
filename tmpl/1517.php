
<?php
/**
 * Bears Pricing Tables - 1517 Template
 * Version : 2025.5.15
 * Created by : N6REJ
 * Email : troy@hallhome.us
 * URL : www.hallhome.us
 * License GPLv3.0 - http://www.gnu.org/licenses/gpl-3.0.html
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
$params_array = ModBearsPricingTablesHelper::getParams($params);

// Add moduleId to params_array for use in the template
$params_array['moduleId'] = $bears_moduleid;

// Get column references
$column_ref = array_keys(array_filter($params_array['bears_title']));

// Load module CSS with moduleId to ensure proper specificity
ModBearsPricingTablesHelper::loadModuleCSS($params, $bears_moduleid);

// IMPORTANT: All CSS is now loaded through the helper, so we remove all inline CSS that was here before
?>
<div class = "template-1517">
	<div class = "bears_pricing_tables-outer bears_pricing_tables-<?php
    echo $bears_moduleid; ?>">
		<!-- Add data-columns attribute for CSS targeting -->
		<div class = 'bears_pricing_tables-container' data-columns = "<?php
        echo $params_array['bears_num_columns']; ?>">
            <?php
            // Loop through the number of columns to display
            for ($i = 0; $i < $params_array['bears_num_columns']; $i++) {
                // Skip if this column index doesn't exist in our reference array
                if (!isset($column_ref[$i])) {
                    continue;
                }

                // Get the actual column number from our reference array
                $cur_column = $column_ref[$i];

                // Check if this column is marked as featured
                $is_featured = isset($params_array['bears_featured'][$cur_column]) && $params_array['bears_featured'][$cur_column] == 'yes';

                // Determine border style based on featured status
                $border_style = $is_featured ? $params_array['bears_featured_border_style'] : $params_array['bears_border_style'];

                // Add column-specific class for styling
                $columnClass = 'bears-column-' . $cur_column;
                ?>
				<div class = "bears_pricing_tables">
					<div class = "plan<?php
                    echo $is_featured ? ' featured' : ''; ?> border-<?php
                    echo $border_style; ?> <?php
                    echo $columnClass; ?>">
						<header>
                            <?php
                            if (!empty($params_array['header_iconClass'][$cur_column]) && str_starts_with($params_array['header_iconPosition'][$cur_column], 'top-')) {
                                ?>
								<div class = "plan-icon icon-<?php
                                echo htmlspecialchars($params_array['header_iconPosition'][$cur_column]); ?> <?php
                                echo $columnClass; ?>">
									<i class = "<?php
                                    echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($params_array['header_iconClass'][$cur_column])); ?>"></i>
								</div>
                                <?php
                            } ?>

							<h3 class = "plan-title">
                                <?php
                                echo htmlspecialchars($params_array['bears_title'][$cur_column] ?? ''); ?>
							</h3>

							<div class = "price">
                                <?php
                                if (!empty($params_array['header_iconClass'][$cur_column]) && $params_array['header_iconPosition'][$cur_column] === 'price-left') {
                                    ?>
									<div class = "plan-icon price-left <?php
                                    echo $columnClass; ?>">
										<i class = "<?php
                                        echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($params_array['header_iconClass'][$cur_column])); ?>"></i>
									</div>
                                    <?php
                                } ?>

								<div class = "plan-cost">
									<h1 class = "plan-price"><?php
                                        echo htmlspecialchars($params_array['bears_price'][$cur_column] ?? ''); ?></h1>
									<small class = "plan-type"><?php
                                        echo htmlspecialchars($params_array['bears_subtitle'][$cur_column] ?? ''); ?></small>
								</div>

                                <?php
                                if (!empty($params_array['header_iconClass'][$cur_column]) && $params_array['header_iconPosition'][$cur_column] === 'price-right') {
                                    ?>
									<div class = "plan-icon price-right <?php
                                    echo $columnClass; ?>">
										<i class = "<?php
                                        echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($params_array['header_iconClass'][$cur_column])); ?>"></i>
									</div>
                                    <?php
                                } ?>
							</div>

                            <?php
                            if (!empty($params_array['header_iconClass'][$cur_column]) && str_starts_with($params_array['header_iconPosition'][$cur_column], 'bottom-')) {
                                ?>
								<div class = "plan-icon icon-<?php
                                echo htmlspecialchars($params_array['header_iconPosition'][$cur_column]); ?> <?php
                                echo $columnClass; ?>">
									<i class = "<?php
                                    echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($params_array['header_iconClass'][$cur_column])); ?>"></i>
								</div>
                                <?php
                            }
                            ?>
						</header>

						<ul class='plan-features dot'>
                            <?php
                            if (!empty($params_array['bears_features'][$cur_column])) {
                                $features = $params_array['bears_features'][$cur_column];
                                $features_icon_class = !empty($params_array['features_icon_class'][$cur_column]) ?
                                    ModBearsPricingTablesHelper::formatIconClass($params_array['features_icon_class'][$cur_column]) : '';
                                $features_icon_position = !empty($params_array['features_icon_position'][$cur_column]) ?
                                    $params_array['features_icon_position'][$cur_column] : 'before';
                                $features_color = !empty($params_array['features_color'][$cur_column]) ?
                                    $params_array['features_color'][$cur_column] : '';

                                // Define the icon style if a color is specified
                                $icon_style = !empty($features_color) ? ' style="color: ' . htmlspecialchars($features_color) . ';"' : '';

                                // Normalize features to array of items
                                $feature_items = [];

                                // Handle different possible data structures
                                if (is_string($features) && !empty($features)) {
                                    // Check if it's a JSON string
                                    $decoded = json_decode($features);
                                    if (json_last_error() === JSON_ERROR_NONE && (is_array($decoded) || is_object($decoded))) {
                                        $feature_items = (array)$decoded;
                                    } else {
                                        // Plain string (single feature)
                                        $feature_items[] = $features;
                                    }
                                } elseif (is_array($features) || is_object($features)) {
                                    $feature_items = (array)$features;
                                }

                                // Render each feature item
                                foreach ($feature_items as $item) {
                                    $feature_text = '';

                                    // Extract the feature text based on item type
                                    if (is_object($item) && isset($item->bears_feature)) {
                                        $feature_text = $item->bears_feature;
                                    } elseif (is_string($item)) {
                                        $feature_text = $item;
                                    }

                                    // Skip empty features
                                    if (empty($feature_text)) {
                                        continue;
                                    }

                                    echo '<li>';
                                    // Icon before text
                                    if ($features_icon_class && $features_icon_position === 'before') {
                                        echo '<i class="' . htmlspecialchars($features_icon_class) . '"' . $icon_style . '></i> ';
                                    }

                                    // Feature text
                                    echo htmlspecialchars($feature_text);

                                    // Icon after text
                                    if ($features_icon_class && $features_icon_position === 'after') {
                                        echo ' <i class="' . htmlspecialchars($features_icon_class) . '"' . $icon_style . '></i>';
                                    }
                                    echo '</li>';
                                }
                            }
                            ?>
						</ul>

						<div class = "plan-select">
							<a class = "btn" href = "<?php
                            echo htmlspecialchars($params_array['bears_buttonurl'][$cur_column] ?? '#'); ?>">
                                <?php
                                echo htmlspecialchars($params_array['bears_buttontext'][$cur_column] ?? ''); ?>
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
