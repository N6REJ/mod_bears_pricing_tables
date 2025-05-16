
<?php
/**
 * Bears Pricing Tables - White Template
 * 
 * @version     2025.05.16.2
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright   Copyright (c) 2025 N6REJ
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

// Get document
$document = Factory::getDocument();

// Add module ID for unique styling
$bears_moduleid = $module->id;

// Get number of columns
$bears_num_columns = $params->get('bears_num_columns', 4);

// Get border styles
$bears_border_style = $params->get('bears_border_style', 'shadow');
$bears_featured_border_style = $params->get('bears_featured_border_style', 'shadow');

// Get column margins
$bears_column_margin_x = $params->get('bears_column_margin_x', '10');
$bears_column_margin_y = $params->get('bears_column_margin_y', '10');

// Get colors
$bears_column_bg = $params->get('bears_column_bg', '');
$bears_header_bg = $params->get('bears_header_bg', '');
$bears_featured_bg = $params->get('bears_featured_bg', '');
$bears_header_featured_bg = $params->get('bears_header_featured_bg', '');
$bears_title_color = $params->get('bears_title_color', '');
$bears_featured_title_color = $params->get('bears_featured_title_color', '');
$bears_price_color = $params->get('bears_price_color', '');
$bears_featured_price_color = $params->get('bears_featured_price_color', '');
$bears_pricesub_color = $params->get('bears_pricesub_color', '');
$bears_features_color = $params->get('bears_features_color', '');
$bears_border_color = $params->get('bears_border_color', '');
$bears_featured_border_color = $params->get('bears_featured_border_color', '');
$bears_accent_color = $params->get('bears_accent_color', '');
$bears_featured_accent_color = $params->get('bears_featured_accent_color', '');
$bears_button_color = $params->get('bears_button_color', '');
$bears_button_bg_color = $params->get('bears_button_bg_color', '');
$bears_button_hover_color = $params->get('bears_button_hover_color', '');

// Get font settings (Google Fonts are loaded by helper.php)
$bears_google_font_family = $params->get('bears_google_font_family', '');
$bears_font_weight = $params->get('bears_font_weight', '400');
$bears_title_font_size = $params->get('bears_title_font_size', '');
$bears_subtitle_font_size = $params->get('bears_subtitle_font_size', '');
$bears_price_font_size = $params->get('bears_price_font_size', '');
$bears_features_font_size = $params->get('bears_features_font_size', '');
$bears_button_font_size = $params->get('bears_button_font_size', '');

// Prepare column data
$bears_title = [];
$bears_subtitle = [];
$bears_price = [];
$bears_features = [];
$bears_buttontext = [];
$bears_buttonurl = [];
$bears_featured = [];

$max_columns = 15;
for ($i = 1; $i <= $max_columns; $i++) {
    if ($params->get('bears_title' . $i)) {
        $bears_title[$i] = $params->get('bears_title' . $i);
        $bears_subtitle[$i] = $params->get('bears_subtitle' . $i);
        $bears_price[$i] = $params->get('bears_price' . $i);
        $bears_features[$i] = $params->get('bears_features' . $i);
        $bears_buttontext[$i] = $params->get('bears_buttontext' . $i);
        $bears_buttonurl[$i] = $params->get('bears_buttonurl' . $i);
        $bears_featured[$i] = $params->get('bears_column_featured' . $i, 'no');
    }
}

// Build CSS overrides
$css_overrides = '';

// Add font family if specified (Google Fonts are loaded by helper.php)
if (!empty($bears_google_font_family)) {
    $css_overrides .= '--bears-font-family: "' . $bears_google_font_family . '", Arial, sans-serif; ';
    $css_overrides .= '--bears-font-weight: ' . $bears_font_weight . '; ';
}

// Add font sizes if specified
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

// Add colors if specified
if (!empty($bears_column_bg)) {
    $css_overrides .= '--bears-column-bg: ' . $bears_column_bg . '; ';
}
if (!empty($bears_header_bg)) {
    $css_overrides .= '--bears-header-bg: ' . $bears_header_bg . '; ';
}
if (!empty($bears_featured_bg)) {
    $css_overrides .= '--bears-featured-bg: ' . $bears_featured_bg . '; ';
}
if (!empty($bears_header_featured_bg)) {
    $css_overrides .= '--bears-header-featured-bg: ' . $bears_header_featured_bg . '; ';
}
if (!empty($bears_title_color)) {
    $css_overrides .= '--bears-title-color: ' . $bears_title_color . '; ';
}
if (!empty($bears_featured_title_color)) {
    $css_overrides .= '--bears-featured-title-color: ' . $bears_featured_title_color . '; ';
}
if (!empty($bears_price_color)) {
    $css_overrides .= '--bears-price-color: ' . $bears_price_color . '; ';
}
if (!empty($bears_featured_price_color)) {
    $css_overrides .= '--bears-featured-price-color: ' . $bears_featured_price_color . '; ';
}
if (!empty($bears_pricesub_color)) {
    $css_overrides .= '--bears-pricesub-color: ' . $bears_pricesub_color . '; ';
}
if (!empty($bears_features_color)) {
    $css_overrides .= '--bears-features-color: ' . $bears_features_color . '; ';
}
if (!empty($bears_border_color)) {
    $css_overrides .= '--bears-border-color: ' . $bears_border_color . '; ';
}
if (!empty($bears_featured_border_color)) {
    $css_overrides .= '--bears-featured-border-color: ' . $bears_featured_border_color . '; ';
}
if (!empty($bears_accent_color)) {
    $css_overrides .= '--bears-accent-color: ' . $bears_accent_color . '; ';
}
if (!empty($bears_featured_accent_color)) {
    $css_overrides .= '--bears-featured-accent-color: ' . $bears_featured_accent_color . '; ';
}
if (!empty($bears_button_color)) {
    $css_overrides .= '--bears-button-color: ' . $bears_button_color . '; ';
}
if (!empty($bears_button_bg_color)) {
    $css_overrides .= '--bears-button-bg-color: ' . $bears_button_bg_color . '; ';
}
if (!empty($bears_button_hover_color)) {
    $css_overrides .= '--bears-button-hover-color: ' . $bears_button_hover_color . '; ';
}

// Add margins if specified
if (!empty($bears_column_margin_x)) {
    $css_overrides .= '--bears-column-margin-x: ' . $bears_column_margin_x . 'px; ';
}
if (!empty($bears_column_margin_y)) {
    $css_overrides .= '--bears-column-margin-y: ' . $bears_column_margin_y . 'px; ';
}

// Add overrides if any exist
if (!empty($css_overrides)) {
    $document->addStyleDeclaration('.bears_pricing_tables' . $bears_moduleid . ' { ' . $css_overrides . ' }');
}

// First load the main CSS file
$document->addStyleSheet(Uri::base() . 'modules/mod_bears_pricing_tables/css/white.css');
?>

<div class="bears_pricing_tables-outer bears_pricing_tables<?php echo $bears_moduleid; ?>">
	<div class="bears_pricing_tables-container columns-<?php echo $bears_num_columns; ?>">
        <?php
        for ($i = 1; $i <= $max_columns; $i++) {
            if (isset($bears_title[$i]) && !empty($bears_title[$i])) {
                // Check if this column is marked as featured
                $is_featured = isset($bears_featured[$i]) && $bears_featured[$i] == 'yes';
                ?>
				<div class="bears_pricing_tables">
					<div class="plan<?php echo $is_featured ? ' featured' : ''; ?> border-<?php echo $is_featured ? $bears_featured_border_style : $bears_border_style; ?>">
						<header>
							<h4 class="plan-title">
                                <?php echo htmlspecialchars($bears_title[$i] ?? ''); ?>
							</h4>

							<div class="plan-cost">
								<span class="plan-price"><?php echo htmlspecialchars($bears_price[$i] ?? ''); ?></span>
								<span class="plan-type"><?php echo htmlspecialchars($bears_subtitle[$i] ?? ''); ?></span>
							</div>
						</header>

						<ul class="plan-features">
                            <?php
                            if (!empty($bears_features[$i])) {
                                $features = $bears_features[$i];

                                // Process features based on their structure
                                if (is_object($features)) {
                                    // Handle subform data structure
                                    foreach ($features as $key => $item) {
                                        if (is_object($item) && isset($item->bears_feature)) {
                                            echo '<li><i class="fa fa-check"></i> ' . htmlspecialchars($item->bears_feature) . '</li>';
                                        }
                                    }
                                } elseif (is_array($features)) {
                                    // Handle array of features
                                    foreach ($features as $item) {
                                        if (is_object($item) && isset($item->bears_feature)) {
                                            echo '<li><i class="fa fa-check"></i> ' . htmlspecialchars($item->bears_feature) . '</li>';
                                        } elseif (is_string($item)) {
                                            echo '<li><i class="fa fa-check"></i> ' . htmlspecialchars($item) . '</li>';
                                        }
                                    }
                                } elseif (is_string($features)) {
                                    // Try to decode if it's a JSON string
                                    $decoded = json_decode($features);
                                    if (json_last_error() === JSON_ERROR_NONE && (is_array($decoded) || is_object($decoded))) {
                                        foreach ($decoded as $item) {
                                            if (is_object($item) && isset($item->bears_feature)) {
                                                echo '<li><i class="fa fa-check"></i> ' . htmlspecialchars($item->bears_feature) . '</li>';
                                            } elseif (is_string($item)) {
                                                echo '<li><i class="fa fa-check"></i> ' . htmlspecialchars($item) . '</li>';
                                            }
                                        }
                                    } else {
                                        // It's just a plain string, split by line breaks
                                        $feature_items = explode("\n", $features);
                                        foreach ($feature_items as $feature) {
                                            $feature = trim($feature);
                                            if ($feature !== '') {
                                                // Check if feature starts with "no:" to mark as unavailable
                                                $is_no = false;
                                                if (strpos($feature, 'no:') === 0) {
                                                    $is_no = true;
                                                    $feature = substr($feature, 3);
                                                }

                                                echo '<li><i class="fa ' . ($is_no ? 'fa-times' : 'fa-check') . '"></i> ' . htmlspecialchars($feature) . '</li>';
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
						</ul>

						<div class="plan-select">
							<a href="<?php echo htmlspecialchars($bears_buttonurl[$i] ?? '#'); ?>">
                                <?php echo htmlspecialchars($bears_buttontext[$i] ?? ''); ?>
							</a>
						</div>
					</div>
				</div>
                <?php
            }
        }
        ?>
	</div>
</div>
