<?php
/**
 * Bears Pricing Tables
 *
 * @version     2025.05.15
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright   Copyright (c) 2025 N6REJ
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Get module ID for unique CSS
$bears_moduleid = $module->id;

// Extract parameters
$bears_num_columns = $params_array['bears_num_columns'];
$bears_title = $params_array['bears_title'];
$bears_price = $params_array['bears_price'];
$bears_subtitle = $params_array['bears_subtitle'];
$bears_features = $params_array['bears_features'];
$bears_featured = $params_array['bears_featured'];
$bears_buttontext = $params_array['bears_buttontext'];
$bears_buttonurl = $params_array['bears_buttonurl'];

// Get color parameters
$bears_column_margin_x = $params->get('bears_column_margin_x', 20);
$bears_column_margin_y = $params->get('bears_column_margin_y', 10);
$bears_column_bg = $params->get('bears_column_bg', '');
$bears_featured_bg = $params->get('bears_column_featured_bg', '');
$bears_header_bg = $params->get('bears_header_bg', '');
$bears_header_featured_bg = $params->get('bears_header_featured_bg', '');
$bears_title_color = $params->get('bears_title_color', '');
$bears_featured_title_color = $params->get('bears_featured_title_color', '');
$bears_price_color = $params->get('bears_price_color', '');
$bears_featured_price_color = $params->get('bears_featured_price_color', '');
$bears_pricesub_color = $params->get('bears_pricesub_color', '');
$bears_features_color = $params->get('bears_features_color', '');
$bears_button_color = $params->get('bears_button_color', '');
$bears_button_hover_color = $params->get('bears_button_hover_color', '');
$bears_border_color = $params->get('bears_border_color', '');
$bears_featured_border_color = $params->get('bears_featured_border_color', '');
$bears_accent_color = $params->get('bears_accent_color', '');
$bears_featured_accent_color = $params->get('bears_featured_accent_color', '');
$bears_border_style = $params->get('bears_border_style', 'shadow');
$bears_featured_border_style = $params->get('bears_featured_border_style', 'shadow');

// Get font parameters
$bears_google_font_family = $params->get('bears_google_font_family', '');
$bears_font_weight = $params->get('bears_font_weight', '400');
$bears_title_font_size = $params->get('bears_title_font_size', '');
$bears_subtitle_font_size = $params->get('bears_subtitle_font_size', '');
$bears_price_font_size = $params->get('bears_price_font_size', '');
$bears_features_font_size = $params->get('bears_features_font_size', '');
$bears_button_font_size = $params->get('bears_button_font_size', '');

// Define CSS variables
$bears_css = '
:root {
    --bears-transition-speed: 0.3s;
    --bears-border-width: 3px;
    --bears-border-style: solid;
}

.bears_pricing_tables' . $bears_moduleid . ' {
    --bears-column-margin-x: ' . $bears_column_margin_x . 'px;
    --bears-column-margin-y: ' . $bears_column_margin_y . 'px;
    --bears-column-bg: #ffffff;
    --bears-featured-bg: #ffffff;
    --bears-header-bg: #f5f5f5;
    --bears-header-featured-bg: #e74c3c;
    --bears-title-color: #333333;
    --bears-featured-title-color: #ffffff;
    --bears-price-color: #e74c3c;
    --bears-featured-price-color: #ffffff;
    --bears-pricesub-color: #888888;
    --bears-features-color: #333333;
    --bears-button-color: #e74c3c;
    --bears-button-hover-color: #c0392b;
    --bears-border-color: #dddddd;
    --bears-featured-border-color: #e74c3c;
    --bears-accent-color: #e74c3c;
    --bears-featured-accent-color: #c0392b;
    --bears-title-font-size: 24px;
    --bears-subtitle-font-size: 14px;
    --bears-price-font-size: 36px;
    --bears-features-font-size: 14px;
    --bears-button-font-size: 16px;
}

.bears_pricing_tables' . $bears_moduleid . ' .plan {
    background-color: var(--bears-column-bg);
    border-radius: 4px;
    margin: var(--bears-column-margin-y) var(--bears-column-margin-x);
    overflow: hidden;
    transition: all var(--bears-transition-speed) ease;
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.featured {
    background-color: var(--bears-featured-bg);
    transform: scale(1.05);
    z-index: 2;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}

.bears_pricing_tables' . $bears_moduleid . ' header {
    background-color: var(--bears-header-bg);
    color: var(--bears-title-color);
    padding: 20px;
    position: relative;
    text-align: center;
    margin-bottom: 40px;
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.featured header {
    background-color: var(--bears-header-featured-bg);
    color: var(--bears-featured-title-color);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-title {
    color: var(--bears-title-color);
    font-size: var(--bears-title-font-size);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-title {
    color: var(--bears-featured-title-color);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-price {
    color: var(--bears-price-color);
    font-size: var(--bears-price-font-size);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-price {
    color: var(--bears-featured-price-color);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-type {
    color: var(--bears-pricesub-color);
    font-size: var(--bears-subtitle-font-size);
}

.bears_pricing_tables' . $bears_moduleid . ' .plan-features {
    color: var(--bears-accent-color);
}
.bears_pricing_tables' . $bears_moduleid . ' .plan-features li {
    color: var(--bears-features-color);
    font-size: var(--bears-features-font-size);
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

// Add Google Font if specified
if (!empty($bears_google_font_family)) {
    $document = JFactory::getDocument();
    $document->addStyleSheet('https://fonts.googleapis.com/css2?family=' . str_replace(' ', '+', $bears_google_font_family) . ':wght@' . $bears_font_weight . '&display=swap');
    $bears_css .= '
    .bears_pricing_tables' . $bears_moduleid . ' {
        --bears-font-family: "' . $bears_google_font_family . '", sans-serif;
        --bears-font-weight: ' . $bears_font_weight . ';
        font-family: var(--bears-font-family);
        font-weight: var(--bears-font-weight);
    }
    ';
}

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

// Add CSS overrides if any
if (!empty($css_overrides)) {
    $bears_css .= '.bears_pricing_tables' . $bears_moduleid . ' { ' . $css_overrides . ' }';
}

// Add specific CSS for accent color
if ($bears_accent_color !== null && $bears_accent_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' header:after { border-color: ' . $bears_accent_color . ' transparent transparent transparent; }';
}

// Add specific CSS for featured accent color
if ($bears_featured_accent_color !== null && $bears_featured_accent_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan.featured header:after { border-color: ' . $bears_featured_accent_color . ' transparent transparent transparent; }';
}

// Add CSS to document
JFactory::getDocument()->addStyleDeclaration($bears_css);
?>

<div class="bears_pricing_tables-container" data-columns="<?php echo $bears_num_columns; ?>">
    <?php for ($i = 1; $i <= $bears_num_columns; $i++): ?>
        <?php if (!empty($bears_title[$i])): ?>
            <?php
            // Determine if this column is featured
            $featured_class = ($bears_featured[$i] == 'yes') ? ' featured' : '';
            $border_class = ($bears_featured[$i] == 'yes') ? ' border-' . $bears_featured_border_style : ' border-' . $bears_border_style;
            ?>
			<div class="bears_pricing_tables bears_pricing_tables<?php echo $bears_moduleid; ?>">
				<div class="plan<?php echo $featured_class . $border_class; ?>">
					<header>
						<div class="header-top-row">
							<h3 class="plan-title"><?php echo $bears_title[$i]; ?></h3>
						</div>

                        <?php if (!empty($bears_price[$i])): ?>
							<div class="header-middle-row">
								<div class="plan-cost">
									<span class="plan-price"><?php echo $bears_price[$i]; ?></span>
                                    <?php if (!empty($bears_subtitle[$i])): ?>
										<span class="plan-type"><?php echo $bears_subtitle[$i]; ?></span>
                                    <?php endif; ?>
								</div>
							</div>
                        <?php endif; ?>

						<div class="header-bottom-row">
							<!-- Header bottom row content -->
						</div>
					</header>

                    <?php if (!empty($bears_features[$i])): ?>
						<ul class="plan-features">
                            <?php foreach ($bears_features[$i] as $feature): ?>
								<li><?php echo $feature->feature_text; ?></li>
                            <?php endforeach; ?>
						</ul>
                    <?php endif; ?>

                    <?php if (!empty($bears_buttontext[$i]) && !empty($bears_buttonurl[$i])): ?>
						<div class="plan-select">
							<a href="<?php echo $bears_buttonurl[$i]; ?>" class="btn"><?php echo $bears_buttontext[$i]; ?></a>
						</div>
                    <?php endif; ?>
				</div>
			</div>
        <?php endif; ?>
    <?php endfor; ?>
	<div class="clear"></div>
</div>
