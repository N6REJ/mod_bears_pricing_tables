
<?php
/**
 * Bears Pricing Tables - Default Template
 * Version : 2025.5.10
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

// Make sure we have a module ID
$bears_moduleid = isset($module->id) ? $module->id : 0;

$baseurl = Uri::base(); // Updated from JURI::base()

// Get parameters without default values - will use CSS variables as defaults
$bears_num_columns     = $params->get('bears_num_columns');
$bears_column_margin_y = $params->get('bears_column_margin_y');
$bears_column_margin_x = $params->get('bears_column_margin_x');
$bears_column_bg      = $params->get('bears_column_bg');
$bears_header_bg      = $params->get('bears_header_bg');
$bears_featured_bg   = $params->get('bears_featured_bg');
$bears_header_featured_bg = $params->get('bears_header_featured_bg');
$bears_title_color    = $params->get('bears_title_color');
$bears_featured_title_color = $params->get('bears_featured_title_color');
$bears_price_color    = $params->get('bears_price_color');
$bears_featured_price_color = $params->get('bears_featured_price_color');
$bears_pricesub_color = $params->get('bears_pricesub_color');
$bears_features_color = $params->get('bears_features_color');
$bears_button_color   = $params->get('bears_button_color');
$bears_button_hover_color = $params->get('bears_button_hover_color');
$bears_border_color   = $params->get('bears_border_color');
$bears_featured_border_color = $params->get('bears_featured_border_color');
$bears_border_style   = $params->get('bears_border_style', 'shadow');
$bears_featured_border_style = $params->get('bears_featured_border_style', 'shadow');
$bears_accent_color   = $params->get('bears_accent_color');
$bears_featured_accent_color = $params->get('bears_featured_accent_color');

// Font family settings
$bears_google_font_family = $params->get('bears_google_font_family', '');
$bears_font_weight = $params->get('bears_font_weight', '400');
$bears_title_font_size = $params->get('bears_title_font_size');
$bears_subtitle_font_size = $params->get('bears_subtitle_font_size');
$bears_price_font_size = $params->get('bears_price_font_size');
$bears_features_font_size = $params->get('bears_features_font_size');
$bears_button_font_size = $params->get('bears_button_font_size');

$column_ref      = array();
$bears_title      = array();
$bears_subtitle   = array();
$bears_price      = array();
$bears_features   = array();
$bears_buttontext = array();
$bears_buttonurl  = array();
$bears_featured  = array();

$max_columns = 15;
for ($i = 1; $i <= $max_columns; $i++) {
    if ($params->get('bears_title' . $i)) {
        $column_ref[]        = $i;
        $bears_title[$i]      = $params->get('bears_title' . $i);
        $bears_subtitle[$i]   = $params->get('bears_subtitle' . $i);
        $bears_price[$i]      = $params->get('bears_price' . $i);
        $bears_features[$i]   = $params->get('bears_features' . $i);
        $bears_buttontext[$i] = $params->get('bears_buttontext' . $i);
        $bears_buttonurl[$i]  = $params->get('bears_buttonurl' . $i);
        $bears_featured[$i]  = $params->get('bears_column_featured' . $i, 'no');
    }
}

// Get document
$document = Factory::getDocument();

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
    color: var(--bears-pricesub-color);
    font-size: var(--bears-subtitle-font-size);
    font-family: var(--bears-font-family, inherit);
    font-weight: var(--bears-font-weight, normal);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-features li {
    color: var(--bears-features-color);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-features {
    color: var(--bears-accent-color);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-features {
    color: var(--bears-featured-accent-color);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-select a,
.bears_pricing_tables' . $bears_moduleid . ' .plan-select a.btn {
    background-color: var(--bears-button-color);
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
body .bears_pricing_tables' . $bears_moduleid . ' .plan:not(.featured).border-shadow { 
    border: none !important; 
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) !important; 
}
body .bears_pricing_tables' . $bears_moduleid . ' .plan:not(.featured).border-solid { 
    border: 3px solid var(--bears-border-color) !important; 
    box-shadow: none !important; 
}
body .bears_pricing_tables' . $bears_moduleid . ' .plan:not(.featured).border-both { 
    border: 3px solid var(--bears-border-color) !important; 
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) !important; 
}
body .bears_pricing_tables' . $bears_moduleid . ' .plan:not(.featured).border-none { 
    border: none !important; 
    box-shadow: none !important; 
}

/* Border styles for featured plans */
body .bears_pricing_tables' . $bears_moduleid . ' .plan.featured.border-shadow { 
    border: none !important; 
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3) !important; 
    overflow: hidden; 
}
body .bears_pricing_tables' . $bears_moduleid . ' .plan.featured.border-solid { 
    border: 3px solid var(--bears-featured-border-color) !important; 
    box-shadow: none !important; 
    overflow: hidden; 
}
body .bears_pricing_tables' . $bears_moduleid . ' .plan.featured.border-both { 
    border: 3px solid var(--bears-featured-border-color) !important; 
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3) !important; 
    overflow: hidden; 
}
body .bears_pricing_tables' . $bears_moduleid . ' .plan.featured.border-none { 
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
if ($bears_header_bg !== null && $bears_header_bg !== '') {
    $css_overrides .= '--bears-header-bg: ' . $bears_header_bg . '; ';
}
if ($bears_featured_bg !== null && $bears_featured_bg !== '') {
    $css_overrides .= '--bears-featured-bg: ' . $bears_featured_bg . '; ';
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
if ($bears_pricesub_color !== null && $bears_pricesub_color !== '') {
    $css_overrides .= '--bears-pricesub-color: ' . $bears_pricesub_color . '; ';
}
if ($bears_features_color !== null && $bears_features_color !== '') {
    $css_overrides .= '--bears-features-color: ' . $bears_features_color . '; ';
}
if ($bears_button_color !== null && $bears_button_color !== '') {
    $css_overrides .= '--bears-button-color: ' . $bears_button_color . '; ';
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
if ($bears_accent_color !== null && $bears_accent_color !== '') {
    $css_overrides .= '--bears-accent-color: ' . $bears_accent_color . '; ';
}
if ($bears_featured_accent_color !== null && $bears_featured_accent_color !== '') {
    $css_overrides .= '--bears-featured-accent-color: ' . $bears_featured_accent_color . '; ';
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
    
    // Load Google Font
    $google_font_url = 'https://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $bears_google_font_family) . ':' . $bears_font_weight;
    $document->addStyleSheet($google_font_url);
}

// Add overrides if any exist
if (!empty($css_overrides)) {
    $bears_css .= '.bears_pricing_tables' . $bears_moduleid . ' { ' . $css_overrides . ' }';
}

// Add accent triangle if accent colors are specified
if ($bears_accent_color !== null && $bears_accent_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' header:after { border-color: ' . $bears_accent_color . ' transparent transparent transparent; }';
}
if ($bears_featured_accent_color !== null && $bears_featured_accent_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan.featured header:after { border-color: ' . $bears_featured_accent_color . ' transparent transparent transparent; }';
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
}

$document->addStyleDeclaration('.bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: ' . $column_width . '; }');
?>

<div class="bears_pricing_tables<?php echo $bears_moduleid; ?> bears_pricing_tables-outer">
	<div class="bears_pricing_tables-container">
        <?php
        $columnnr = 0;
        for ($i = 1; $i <= $bears_num_columns; $i++) {
            if (isset($column_ref[$columnnr])) {
                $cur_column = $column_ref[$columnnr];
                if (!empty($cur_column)) {
                    // Check if this column is marked as featured
                    $is_featured = isset($bears_featured[$cur_column]) && $bears_featured[$cur_column] == 'yes';
                    ?>
					<div class="bears_pricing_tables">
						<div class="plan<?php echo $is_featured ? ' featured' : ''; ?> border-<?php echo $is_featured ? $bears_featured_border_style : $bears_border_style; ?>">
							<header>
								<h4 class="plan-title">
                                    <?php echo htmlspecialchars($bears_title[$cur_column] ?? ''); ?>
								</h4>

								<div class="plan-cost">
									<span class="plan-price"><?php echo htmlspecialchars($bears_price[$cur_column] ?? ''); ?></span>
									<span class="plan-type"><?php echo htmlspecialchars($bears_subtitle[$cur_column] ?? ''); ?></span>
								</div>
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
                $columnnr++;
            }
        }
        ?>
	</div>
	<div class="clear"></div>
</div>
