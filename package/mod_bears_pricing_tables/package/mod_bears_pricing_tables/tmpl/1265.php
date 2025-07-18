<?php
/**
 * Bears Pricing Tables - 1265 Template
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
<div class = "template-1265">
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

                // Add column-specific class for styling
                $columnClass = 'bears-column-' . $cur_column;
                ?>
				<div class = "bears_pricing_tables">
					<div class = "plan<?php
                    echo $is_featured ? ' featured' : ''; ?> <?php
                    echo $columnClass; ?>">
						<header>
                            <?php
                            if (!empty($params_array['header_icon_class'][$cur_column]) && str_starts_with($params_array['header_icon_position'][$cur_column], 'top-')) {
                                // Prepare inline style for header icon if color is set
                                $header_icon_color = !empty($params_array['header_icon_color'][$cur_column]) ?
                                    ' style="color: ' . htmlspecialchars($params_array['header_icon_color'][$cur_column]) . ';"' : '';
                                ?>
								<div class = "plan-icon icon-<?php
                                echo htmlspecialchars($params_array['header_icon_position'][$cur_column]); ?> <?php
                                echo $columnClass; ?>">
									<i class = "<?php
                                    echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($params_array['header_icon_class'][$cur_column])); ?>"<?php
                                    echo $header_icon_color; ?>></i>
								</div>
                                <?php
                            } ?>

							<div class = "price">
                                <?php
                                if (!empty($params_array['header_icon_class'][$cur_column]) && $params_array['header_icon_position'][$cur_column] === 'price-left') {
                                    // Prepare inline style for header icon if color is set
                                    $header_icon_color = !empty($params_array['header_icon_color'][$cur_column]) ?
                                        ' style="color: ' . htmlspecialchars($params_array['header_icon_color'][$cur_column]) . ';"' : '';
                                    ?>
									<div class = "plan-icon price-left <?php
                                    echo $columnClass; ?>">
										<i class = "<?php
                                        echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($params_array['header_icon_class'][$cur_column])); ?>"<?php
                                        echo $header_icon_color; ?>></i>
									</div>
                                    <?php
                                } ?>

								<div class = "wrapper">
									<h4 class = 'plan-title'>
                                        <?php
                                        echo htmlspecialchars($params_array['bears_title'][$cur_column] ?? ''); ?>
									</h4>

									<div class = "plan-cost">
										<h1 class = "plan-price"><?php
                                            echo htmlspecialchars($params_array['bears_price'][$cur_column] ?? ''); ?></h1>
										<small class = "plan-type"><?php
                                            echo htmlspecialchars($params_array['bears_subtitle'][$cur_column] ?? ''); ?></small>
									</div>
								</div>

                                <?php
                                if (!empty($params_array['header_icon_class'][$cur_column]) && $params_array['header_icon_position'][$cur_column] === 'price-right') {
                                    // Prepare inline style for header icon if color is set
                                    $header_icon_color = !empty($params_array['header_icon_color'][$cur_column]) ?
                                        ' style="color: ' . htmlspecialchars($params_array['header_icon_color'][$cur_column]) . ';"' : '';
                                    ?>
									<div class = "plan-icon price-right <?php
                                    echo $columnClass; ?>">
										<i class = "<?php
                                        echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($params_array['header_icon_class'][$cur_column])); ?>"<?php
                                        echo $header_icon_color; ?>></i>
									</div>
                                    <?php
                                } ?>
							</div>

                            <?php
                            if (!empty($params_array['header_icon_class'][$cur_column]) && str_starts_with($params_array['header_icon_position'][$cur_column], 'bottom-')) {
                                // Prepare inline style for header icon if color is set
                                $header_icon_color = !empty($params_array['header_icon_color'][$cur_column]) ?
                                    ' style="color: ' . htmlspecialchars($params_array['header_icon_color'][$cur_column]) . ';"' : '';
                                ?>
								<div class = "plan-icon icon-<?php
                                echo htmlspecialchars($params_array['header_icon_position'][$cur_column]); ?> <?php
                                echo $columnClass; ?>">
									<i class = "<?php
                                    echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($params_array['header_icon_class'][$cur_column])); ?>"<?php
                                    echo $header_icon_color; ?>></i>
								</div>
                                <?php
                            }
                            ?>
						</header>

                        <?php
                        // Determine if we should use FontAwesome list format based on whether an icon class is specified
                        $icon_class = !empty($params_array['features_icon_class'][$cur_column]) ?
                            ModBearsPricingTablesHelper::formatIconClass($params_array['features_icon_class'][$cur_column]) : '';
                        $icon_color = !empty($params_array['features_icon_color'][$cur_column]) ?
                            $params_array['features_icon_color'][$cur_column] : '';

                        // Prepare inline style for icon if color is set
                        $icon_style = !empty($icon_color) ? ' style="color: ' . htmlspecialchars($icon_color) . ';"' : '';

                        // Always use plan-features class and add fa-ul only if icon class is specified
                        $list_class = !empty($icon_class) ? 'plan-features fa-ul centered-features' : 'plan-features';
                        ?>
						<div class = "features">
							<ul class = "<?php
                            echo $list_class; ?>">
                                <?php
                                if (!empty($params_array['bears_features'][$cur_column])) {
                                    $features = $params_array['bears_features'][$cur_column];

                                    // Handle the features data from the subform
                                    $features_items = is_string($features) ? json_decode($features) : $features;

                                    // Ensure we have an iterable
                                    if (!is_array($features_items) && !is_object($features_items)) {
                                        $features_items = [$features_items];
                                    }

                                    // Render each feature
                                    foreach ($features_items as $item) {
                                        $feature_text = '';

                                        // Get the text (always from bears_feature property when using subform)
                                        if (is_object($item) && isset($item->bears_feature)) {
                                            $feature_text = $item->bears_feature;
                                        } elseif (is_string($item)) {
                                            $feature_text = $item;
                                        }

                                        // Output the feature text if not empty
                                        if (!empty($feature_text)) {
                                            echo '<li>';

                                            // Create a span to wrap the content for centering
                                            echo '<span class="features-content">';

                                            // Add icon with fa-li span if icon class is specified
                                            if (!empty($icon_class)) {
                                                echo '<span class="fa-li"><i class="' . htmlspecialchars($icon_class) . '"' . $icon_style . '></i></span>';
                                            }

                                            echo htmlspecialchars($feature_text);
                                            echo '</span>';
                                            echo '</li>';
                                        }
                                    }
                                }
                                ?>
							</ul>
						</div>
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
