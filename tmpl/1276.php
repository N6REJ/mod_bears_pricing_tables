
<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_bears_pricing_tables
 *
 * @copyright   Copyright (C) 2023 BearDev. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

// Get module parameters
$bears_moduleid = $module->id;
$bears_num_columns = $params->get('bears_num_columns', 3);

// Get color settings
$bears_bg          = $params->get('bears_bg');
$bears_header_bg   = $params->get('bears_header_bg');
$bears_featured_bg = $params->get('bears_featured_bg');
$bears_header_featured_bg = $params->get('bears_header_featured_bg');
$bears_title_color = $params->get('bears_title_color');
$bears_featured_title_color = $params->get('bears_featured_title_color');
$bears_price_color    = $params->get('bears_price_color');
$bears_featured_price_color = $params->get('bears_featured_price_color');
$bears_price_subtitle_color = $params->get('bears_price_subtitle_color');
$bears_features_color = $params->get('bears_features_color');
$bears_button_text_color   = $params->get('bears_button_text_color');
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

// Icon settings
$bears_icon_size = $params->get('bears_icon_size', '36');
$bears_icon_color = $params->get('bears_icon_color', $bears_accent_color);
$bears_featured_icon_color = $params->get('bears_featured_icon_color', $bears_featured_accent_color);

$column_ref      = array();
$bears_title      = array();
$bears_subtitle   = array();
$bears_price      = array();
$bears_features   = array();
$bears_buttontext = array();
$bears_buttonurl  = array();
$bears_featured  = array();
$bears_icon = array();
$bears_icon_position = array();

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
        $bears_icon[$i] = $params->get('bears_icon' . $i, '');
        $bears_icon_position[$i] = $params->get('bears_icon_position' . $i, 'top-center');
    }
}

// Get document
$document = Factory::getDocument();

// Add custom CSS for this specific module instance
$bears_css = '
.bears_pricing_tables' . $bears_moduleid . ' {
    --bears-bg: #ffffff;
    --bears-header-bg: #f8f8f8;
    --bears-featured-bg: #ffffff;
    --bears-header-featured-bg: #f8f8f8;
    --bears-title-color: #333333;
    --bears-featured-title-color: #333333;
    --bears-price-color: #333333;
    --bears-featured-price-color: #333333;
    --bears-price_subtitle-color: #666666;
    --bears-features-color: #333333;
    --bears-button-color: #ffffff;
    --bears-button-hover-color: #ffffff;
    --bears-border-color: #dddddd;
    --bears-featured-border-color: #dddddd;
    --bears-accent-color: #3498db;
    --bears-featured-accent-color: #3498db;
    --bears-title-font-size: 24px;
    --bears-subtitle-font-size: 14px;
    --bears-price-font-size: 36px;
    --bears-features-font-size: 14px;
    --bears-button-font-size: 14px;
    --bears-font-family: inherit;
    --bears-font-weight: 400;
    --bears-icon-size: ' . $bears_icon_size . 'px;
    --bears-icon-color: ' . ($bears_icon_color ?: 'var(--bears-accent-color)') . ';
    --bears-featured-icon-color: ' . ($bears_featured_icon_color ?: 'var(--bears-featured-accent-color)') . ';
}

.bears_pricing_tables' . $bears_moduleid . ' .plan {
    background-color: var(--bears-bg);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan header {
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
    font-family: var(--bears-font-family);
    font-weight: var(--bears-font-weight);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-title {
    color: var(--bears-featured-title-color);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-price {
    color: var(--bears-price-color);
    font-size: var(--bears-price-font-size);
    font-family: var(--bears-font-family);
    font-weight: var(--bears-font-weight);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-price {
    color: var(--bears-featured-price-color);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-type {
    color: var(--bears-price_subtitle-color);
    font-size: var(--bears-subtitle-font-size);
    font-family: var(--bears-font-family);
    font-weight: var(--bears-font-weight);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-features li {
    color: var(--bears-features-color);
    font-size: var(--bears-features-font-size);
    font-family: var(--bears-font-family);
    font-weight: var(--bears-font-weight);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-select .btn {
    background-color: var(--bears-accent-color);
    color: var(--bears-button-color);
    font-size: var(--bears-button-font-size);
    font-family: var(--bears-font-family);
    font-weight: var(--bears-font-weight);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-select .btn {
    background-color: var(--bears-featured-accent-color);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-select .btn:hover {
    color: var(--bears-button-hover-color);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.border-solid {
    border: 1px solid var(--bears-border-color);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.featured.border-solid {
    border: 1px solid var(--bears-featured-border-color);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.border-shadow {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.featured.border-shadow {
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}

/* Icon styling */
.bears_pricing_tables' . $bears_moduleid . ' .plan-icon {
    display: flex;
    font-size: var(--bears-icon-size);
    color: var(--bears-icon-color);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-icon {
    color: var(--bears-featured-icon-color);
}

/* Icon positioning */
.bears_pricing_tables' . $bears_moduleid . ' .plan-header-wrapper {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-icon.position-top-left {
    justify-content: flex-start;
    margin-bottom: 10px;
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-icon.position-top-center {
    justify-content: center;
    margin-bottom: 10px;
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-icon.position-top-right {
    justify-content: flex-end;
    margin-bottom: 10px;
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-icon.position-center-right {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-icon.position-bottom-right {
    justify-content: flex-end;
    margin-top: 10px;
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-icon.position-bottom-center {
    justify-content: center;
    margin-top: 10px;
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-icon.position-bottom-left {
    justify-content: flex-start;
    margin-top: 10px;
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-icon.position-center-left {
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-icon.position-center-center {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}
';

// CSS overrides based on parameters
$css_overrides = '';
if ($bears_bg !== null && $bears_bg !== '') {
    $css_overrides .= '--bears-bg: ' . $bears_bg . '; ';
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
if ($bears_price_subtitle_color !== null && $bears_price_subtitle_color !== '') {
    $css_overrides .= '--bears-price_subtitle-color: ' . $bears_price_subtitle_color . '; ';
}
if ($bears_features_color !== null && $bears_features_color !== '') {
    $css_overrides .= '--bears-features-color: ' . $bears_features_color . '; ';
}
if ($bears_button_text_color !== null && $bears_button_text_color !== '') {
    $css_overrides .= '--bears-button-color: ' . $bears_button_text_color . '; ';
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
if (!empty($bears_price_font_size)) {
    $css_overrides .= '--bears-price-font-size: ' . $bears_price_font_size . 'px; ';
}
if (!empty($bears_features_font_size)) {
    $css_overrides .= '--bears-features-font-size: ' . $bears_features_font_size . 'px; ';
}
if (!empty($bears_button_font_size)) {
    $css_overrides .= '--bears-button-font-size: ' . $bears_button_font_size . 'px; ';
}
if (!empty($bears_icon_font_size)) {
    $css_overrides .= '--bears-icon-font-size: ' . $bears_icon_font_size . 'px; ';
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
} elseif ($bears_num_columns == '5') {
    $column_width = '20%';
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
								<div class="plan-header-wrapper">
									<h4 class="plan-title">
                                        <?php echo htmlspecialchars($bears_title[$cur_column] ?? ''); ?>
									</h4>
                                    <?php
                                    // Display icon if set
                                    if (!empty($bears_icon[$cur_column])) {
                                        $icon_position = !empty($bears_icon_position[$cur_column]) ? $bears_icon_position[$cur_column] : 'top-center';
                                        ?>
										<div class="plan-icon position-<?php echo $icon_position; ?>">
                                            <?php
                                            // Check if the icon value already contains the full HTML tag
                                            if (strpos($bears_icon[$cur_column], '<i class') === 0) {
                                                echo $bears_icon[$cur_column];
                                            } else {
                                                echo '<i class="' . htmlspecialchars($bears_icon[$cur_column]) . '"></i>';
                                            }
                                            ?>
										</div>
                                    <?php } ?>
									<div class="plan-cost">
										<span class="plan-price"><?php echo htmlspecialchars($bears_price[$cur_column] ?? ''); ?></span>
										<span class="plan-type"><?php echo htmlspecialchars($bears_subtitle[$cur_column] ?? ''); ?></span>
									</div>
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
