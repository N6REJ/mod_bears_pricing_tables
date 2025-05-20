
<?php
/**
 * Bears Pricing Tables - Default Template
 * Version : 2025.5.15
 * Created by : N6REJ
 * Email : troy@hallhome.us
 * URL : www.hallhome.us
 * License GPLv3.0 - http://www.gnu.org/licenses/gpl-3.0.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Update for Joomla 5: Use namespaced classes
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Factory;
use Joomla\CMS\Application\CMSApplication;
use Joomla\Registry\Registry;
use Joomla\CMS\HTML\HTMLHelper;

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

// Make sure we have a module ID
$bears_moduleid = isset($module->id) ? $module->id : 0;

$baseurl = Uri::base(); // Updated from JURI::base()


// Get processed parameters
$data = ModBearsPricingTablesHelper::getParams($params);

// Extract variables from the data array for easier access in the template
extract($data);;

// Add custom CSS for this specific module instance
$bears_css = '
/* Base styles using CSS variables */
.bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables {
    padding: var(--bears-column-margin-y) var(--bears-column-margin-x);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan {
    background-color: var(--bears-column-bg);
}
.bears_pricing_tables' . $bears_moduleid . ' header {
    background-color: var(--bears-header-bg);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan.featured {
    background-color: var(--bears-featured-bg);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan.featured header {
    background-color: var(--bears-header-featured-bg);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-title {
    color: var(--bears-title-color);
    font-size: var(--bears-title-font-size);
    font-family: var(--bears-font-family, inherit);
    font-weight: var(--bears-font-weight, normal);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-title {
    color: var(--bears-featured-title-color);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-price {
    color: var(--bears-price-color);
    font-size: var(--bears-price-font-size);
    font-family: var(--bears-font-family, inherit);
    font-weight: var(--bears-font-weight, normal);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-features li {
    color: var(--bears-features-color);
    font-size: var(--bears-features-font-size);
    font-family: var(--bears-font-family, inherit);
    font-weight: var(--bears-font-weight, normal);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-price {
    color: var(--bears-featured-price-color);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-type {
    color: var(--bears-subtitle-color);
    font-size: var(--bears-subtitle-font-size);
    font-family: var(--bears-font-family, inherit);
    font-weight: var(--bears-font-weight, normal);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-features li {
    color: var(--bears-features-color);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-features {
    color: var(--bears-accent-color);
    background-color: var(--bears-features-bg-color);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-features {
    color: var(--bears-featured-accent-color);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-select a,
.bears_pricing_tables' . $bears_moduleid . ' .plan-select a.btn {
    background-color: var(--bears-button-text-color);
    font-size: var(--bears-button-font-size);
    font-family: var(--bears-font-family, inherit);
    font-weight: var(--bears-font-weight, normal);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-select a:hover,
.bears_pricing_tables' . $bears_moduleid . ' .plan-select a.btn:hover {
    background-color: var(--bears-button-hover-color);
}
';

// Add CSS classes for border styles
$bears_css .= '
/* Border styles for regular plans */
.bears_pricing_tables' . $bears_moduleid . ' .plan:not(.featured).border-shadow { 
    border: none !important; 
    box-shadow: var(--bears-box-shadow) !important; 
}
.bears_pricing_tables' . $bears_moduleid . ' .plan:not(.featured).border-solid { 
    border: var(--bears-border-width) var(--bears-border-style) var(--bears-border-color) !important; 
    box-shadow: none !important; 
}
.bears_pricing_tables' . $bears_moduleid . ' .plan:not(.featured).border-both { 
    border: var(--bears-border-width) var(--bears-border-style) var(--bears-border-color) !important; 
    box-shadow: var(--bears-box-shadow) !important; 
}
.bears_pricing_tables' . $bears_moduleid . ' .plan:not(.featured).border-none { 
    border: none !important; 
    box-shadow: none !important; 
}

/* Border styles for featured plans */
.bears_pricing_tables' . $bears_moduleid . ' .plan.featured.border-shadow { 
    border: none !important; 
    box-shadow: var(--bears-box-shadow) !important; 
    overflow: hidden; 
}
.bears_pricing_tables' . $bears_moduleid . ' .plan.featured.border-solid { 
    border: var(--bears-border-width) var(--bears-border-style) var(--bears-featured-border-color) !important; 
    box-shadow: none !important; 
    overflow: hidden; 
}
.bears_pricing_tables' . $bears_moduleid . ' .plan.featured.border-both { 
    border: var(--bears-border-width) var(--bears-border-style) var(--bears-featured-border-color) !important; 
    box-shadow: var(--bears-box-shadow) !important; 
    overflow: hidden; 
}
.bears_pricing_tables' . $bears_moduleid . ' .plan.featured.border-none { 
    border: none !important; 
    box-shadow: none !important; 
    overflow: hidden; 
}';


// Override CSS variables with parameter values if they are set
$css_overrides = '';

// Only add CSS rules when parameters are explicitly set
if (!empty($bears_column_margin_y) && !empty($bears_column_margin_x)) {
    $css_overrides .= '--bears-column-margin-y: ' . $bears_column_margin_y . 'px; ';
    $css_overrides .= '--bears-column-margin-x: ' . $bears_column_margin_x . 'px; ';
}
if ($bears_column_bg !== null && $bears_column_bg !== '') {
    $css_overrides .= '--bears-column-bg: ' . $bears_column_bg . '; ';
}
if ($bears_column_featured_bg !== null && $bears_column_featured_bg !== '') {
    $css_overrides .= '--bears-column-featured-bg: ' . $bears_column_featured_bg . '; ';
}
if ($bears_header_bg !== null && $bears_header_bg !== '') {
    $css_overrides .= '--bears-header-bg: ' . $bears_header_bg . '; ';
}
if ($bears_header_featured_bg !== null && $bears_header_featured_bg !== '') {
    $css_overrides .= '--bears-header-featured-bg: ' . $bears_header_featured_bg . '; ';
}
if ($bears_title_color !== null && $bears_title_color !== '') {
    $css_overrides .= '--bears-title-color: ' . $bears_title_color . '; ';
}
if ($bears_featured_title_color !== null && $bears_featured_title_color !== '') {
    $css_overrides .= '--bears-featured-title-color: ' . $bears_featured_title_color . '; ';
}
if ($bears_price_color !== null && $bears_price_color !== '') {
    $css_overrides .= '--bears-price-color: ' . $bears_price_color . '; ';
}
if ($bears_featured_price_color !== null && $bears_featured_price_color !== '') {
    $css_overrides .= '--bears-featured-price-color: ' . $bears_featured_price_color . '; ';
}
if ($bears_subtitle_color !== null && $bears_subtitle_color !== '') {
    $css_overrides .= '--bears-subtitle-color: ' . $bears_subtitle_color . '; ';
}
if ($bears_features_color !== null && $bears_features_color !== '') {
    $css_overrides .= '--bears-features-color: ' . $bears_features_color . '; ';
}
if ($bears_button_bg_color !== null && $bears_button_bg_color !== '') {
    $css_overrides .= '--bears-button-bg-color: ' . $bears_button_bg_color . '; ';
}
if ($bears_button_text_color !== null && $bears_button_text_color !== '') {
    $css_overrides .= '--bears-button-text-color: ' . $bears_button_text_color . '; ';
}
if ($bears_button_hover_color !== null && $bears_button_hover_color !== '') {
    $css_overrides .= '--bears-button-hover-color: ' . $bears_button_hover_color . '; ';
}
if ($bears_border_color !== null && $bears_border_color !== '') {
    $css_overrides .= '--bears-border-color: ' . $bears_border_color . '; ';
}
if ($bears_featured_border_color !== null && $bears_featured_border_color !== '') {
    $css_overrides .= '--bears-featured-border-color: ' . $bears_featured_border_color . '; ';
}
if (!empty($bears_border_width)) {
    $css_overrides .= '--bears-border-width: ' . $bears_border_width . 'px; ';
} 
if (!empty($bears_border_style)) {
    $css_overrides .= '--bears-border-style: ' . $bears_border_style . '; ';
} 
if (!empty($bears_box_shadow)) {
    $css_overrides .= '--bears-box-shadow: ' . $bears_box_shadow . '; ';
} 
if ($bears_accent_color !== null && $bears_accent_color !== '') {
    $css_overrides .= '--bears-accent-color: ' . $bears_accent_color . '; ';
}
if ($bears_featured_accent_color !== null && $bears_featured_accent_color !== '') {
    $css_overrides .= '--bears-featured-accent-color: ' . $bears_featured_accent_color . '; ';
}
if (!empty($bears_features_bg_color)) {
    $css_overrides .= '--bears-features-bg-color: ' . $bears_features_bg_color . '; ';
}
if (!empty($bears_title_font_size)) {
    $css_overrides .= '--bears-title-font-size: ' . $bears_title_font_size . 'px; ';
}
if (!empty($bears_subtitle_font_size)) {
    $css_overrides .= '--bears-subtitle-font-size: ' . $bears_subtitle_font_size . 'px; ';
}
if (!empty($bears_price_font_size)) {
    $css_overrides .= '--bears-price-font-size: ' . $bears_price_font_size . 'px; ';
}
if (!empty($bears_features_font_size)) {
    $css_overrides .= '--bears-features-font-size: ' . $bears_features_font_size . 'px; ';
}
if (!empty($bears_button_font_size)) {
    $css_overrides .= '--bears-button-font-size: ' . $bears_button_font_size . 'px; ';
}
if (!empty($bears_google_font_family)) {
    $css_overrides .= '--bears-font-family: \'' . $bears_google_font_family . '\', sans-serif; ';
    $css_overrides .= '--bears-font-weight: ' . $bears_font_weight . '; ';
}

// Add column-specific icon CSS
$bears_css .= '
/* Icon styling for each column */
';
for ($i = 1; $i <= 5; $i++) {
    $bears_css .= '.bears_pricing_tables' . $bears_moduleid . ' .bears-column-' . $i . ' .plan:not(.featured) i {
    /* First try column-specific color, then global icon color, then title color */
    color: var(--bears-icon-color-' . $i . ', var(--bears-icon-color, var(--bears-title-color)));
    font-size: var(--bears-icon-size-' . $i . ', var(--bears-icon-size));
}
.bears_pricing_tables' . $bears_moduleid . ' .bears-column-' . $i . ' .plan.featured i {
    /* First try column-specific color, then featured title color */
    color: var(--bears-icon-color-' . $i . ', var(--bears-featured-title-color));
    font-size: var(--bears-icon-size-' . $i . ', var(--bears-icon-size));
}
';
}

// Load external CSS file for icons instead of inline CSS
$document->addStyleSheet(Uri::root() . 'modules/mod_bears_pricing_tables/css/icons.css');


// Add overrides if any exist
if (!empty($css_overrides)) {
    $bears_css .= '.bears_pricing_tables' . $bears_moduleid . ' { ' . $css_overrides . ' }';
    
    // Add icon-specific CSS variables if they exist in the parameters
    for ($i = 1; $i <= 5; $i++) {
        if (!empty($iconColor[$i])) {
            $bears_css .= '.bears_pricing_tables' . $bears_moduleid . ' .bears-column-' . $i . ' { --bears-icon-color-' . $i . ': ' . $iconColor[$i] . '; }';
        }
        if (!empty($iconSize[$i])) {
            $bears_css .= '.bears_pricing_tables' . $bears_moduleid . ' .bears-column-' . $i . ' { --bears-icon-size-' . $i . ': ' . $iconSize[$i] . 'px; }';
        }
    }
    
    // Add global icon variables if they exist
    if (!empty($bears_icon_color)) {
        $bears_css .= '.bears_pricing_tables' . $bears_moduleid . ' { --bears-icon-color: ' . $bears_icon_color . '; }';
    }
    if (!empty($bears_icon_size)) {
        $bears_css .= '.bears_pricing_tables' . $bears_moduleid . ' { --bears-icon-size: ' . $bears_icon_size . 'px; }';
    }
}

// Add accent triangle if accent colors are specified
if ($bears_accent_color !== null && $bears_accent_color !== '') {
    $bears_css .= '.bears_pricing_tables' . $bears_moduleid . ' header:after { border-color: ' . $bears_accent_color . ' transparent transparent transparent; }';
}
if ($bears_featured_accent_color !== null && $bears_featured_accent_color !== '') {
    $bears_css .= '.bears_pricing_tables' . $bears_moduleid . ' .plan.featured header:after { border-color: ' . $bears_featured_accent_color . ' transparent transparent transparent; }';
}

// Put styling in header
$document->addStyleDeclaration($bears_css);

/* Columns */
$column_width = '33.3%'; // Default to 3 columns
if ($bears_num_columns == '1') {
    $column_width = '100%';
} elseif ($bears_num_columns == '2') {
    $column_width = '50%';
} elseif ($bears_num_columns == '3') {
    $column_width = '33.3%';
} elseif ($bears_num_columns == '4') {
    $column_width = '25%';
} elseif ($bears_num_columns == '5') {
    $column_width = '20%';
}

$document->addStyleDeclaration('.bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: ' . $column_width . '; }');

// Make sure tables are responsive on mobile
$document->addStyleDeclaration('@media (max-width: 768px) { .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 100%; } }');

$document->addStyleSheet(Uri::root() . 'modules/mod_bears_pricing_tables/css/icons.css');
?>

<div class="bears_pricing_tables<?php echo $bears_moduleid; ?> bears_pricing_tables-outer">
	<div class="bears_pricing_tables-container">
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
            
            // We'll let CSS variables handle icon colors through the stylesheet
            // This simplifies the code and makes it more maintainable
            $icon_color_attr = '';
            ?>
			<div class="bears_pricing_tables">
				<div class="plan<?php echo $is_featured ? ' featured' : ''; ?> border-<?php echo $border_style; ?> <?php echo $columnClass; ?>">
					<header>
                        <?php
                        // Debug information for icon settings
                        echo '<!-- Debug: iconPosition for column ' . $cur_column . ': ' . ($iconPosition[$cur_column] ?? 'not set') . ' -->';
                        echo '<!-- Debug: iconClass for column ' . $cur_column . ': ' . ($iconClass[$cur_column] ?? 'not set') . ' -->';
                        echo '<!-- Debug: iconColor for column ' . $cur_column . ': ' . ($iconColor[$cur_column] ?? 'not set') . ' -->';
                        echo '<!-- Debug: iconSize for column ' . $cur_column . ': ' . ($iconSize[$cur_column] ?? 'not set') . ' -->';
                        echo '<!-- Debug: is_featured: ' . ($is_featured ? 'yes' : 'no') . ' -->';

                        if (!empty($iconClass[$cur_column])  && str_starts_with($iconPosition[$cur_column], 'top-')) {
                        ?>
							<div class="plan-icon icon-<?php echo htmlspecialchars($iconPosition[$cur_column]); ?> <?php echo $columnClass; ?>">
								<i class="<?php echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($iconClass[$cur_column])); ?>"></i>
							</div>
                        <?php } ?>

						<h3 class="plan-title">
                            <?php echo htmlspecialchars($bears_title[$cur_column] ?? ''); ?>
						</h3>

                        <?php if (!empty($iconClass[$cur_column])  && str_starts_with($iconPosition[$cur_column], 'center-')) {
                        ?>
							<div class="plan-icon icon-<?php echo htmlspecialchars($iconPosition[$cur_column]); ?> <?php echo $columnClass; ?>">
								<i class="<?php echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($iconClass[$cur_column])); ?>"></i>
							</div>
                        <?php } ?>

						<div class="price">
                            <?php if (!empty($iconClass[$cur_column])  && $iconPosition[$cur_column] === 'price-left') { 
                            ?>
								<div class="plan-icon price-left <?php echo $columnClass; ?>">
									<i class="<?php echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($iconClass[$cur_column])); ?>"></i>
								</div>
                            <?php } ?>

							<div class="plan-cost">
								<h1 class="plan-price"><?php echo htmlspecialchars($bears_price[$cur_column] ?? ''); ?></h1>
								<h4 class="plan-type"><?php echo htmlspecialchars($bears_subtitle[$cur_column] ?? ''); ?></h4>
							</div>

                            <?php if (!empty($iconClass[$cur_column])  && $iconPosition[$cur_column] === 'price-right') { 
                            ?>
								<div class="plan-icon price-right <?php echo $columnClass; ?>">
									<i class="<?php echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($iconClass[$cur_column])); ?>"></i>
								</div>
                            <?php } ?>
						</div>

                        <?php if (!empty($iconClass[$cur_column])  && str_starts_with($iconPosition[$cur_column], 'bottom-')) {
                        ?>
							<div class="plan-icon icon-<?php echo htmlspecialchars($iconPosition[$cur_column]); ?> <?php echo $columnClass; ?>">
								<i class="<?php echo htmlspecialchars(ModBearsPricingTablesHelper::formatIconClass($iconClass[$cur_column])); ?>"></i>
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
						<a class="btn" href="<?php echo htmlspecialchars($bears_buttonurl[$cur_column] ?? '#'); ?>">
                            <?php echo htmlspecialchars($bears_buttontext[$cur_column] ?? ''); ?>
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
