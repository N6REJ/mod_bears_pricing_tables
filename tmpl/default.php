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

// Get parameters with fallbacks to CSS variables
$bears_num_columns     = $params->get('bears_num_columns');
$bears_column_margin_y = $params->get('bears_column_margin_y') ?: '10';
$bears_column_margin_x = $params->get('bears_column_margin_x') ?: '20';
$bears_column_bg      = $params->get('bears_column_bg');
$bears_header_bg      = $params->get('bears_header_bg');
$bears_featured_bg   = $params->get('bears_featured_bg');
$bears_header_featured_bg = $params->get('bears_header_featured_bg');
$bears_title_color    = $params->get('bears_title_color');
$bears_price_color    = $params->get('bears_price_color');
$bears_featured_price_color = $params->get('bears_featured_price_color');
$bears_pricesub_color = $params->get('bears_pricesub_color');
$bears_features_color = $params->get('bears_features_color');
$bears_button_color   = $params->get('bears_button_color');
$bears_button_hover_color = $params->get('bears_button_hover_color');
$bears_border_color   = $params->get('bears_border_color');
$bears_featured_border_color = $params->get('bears_featured_border_color');
$bears_border_style   = $params->get('bears_border_style', 'solid');
$bears_featured_border_style = $params->get('bears_featured_border_style', 'solid');
$bears_accent_color   = $params->get('bears_accent_color');
$bears_featured_accent_color = $params->get('bears_featured_accent_color');

// Debug output - uncomment if needed
// echo "<!-- Featured border color: " . var_dump($bears_highlight_border_color) . " -->";

// Font family settings
$bears_title_font     = $params->get('bears_title_font');
$bears_title_font_size = $params->get('bears_title_font_size');
$bears_price_font     = $params->get('bears_price_font');
$bears_price_font_size = $params->get('bears_price_font_size');
$bears_subtitle_font  = $params->get('bears_subtitle_font');
$bears_features_font  = $params->get('bears_features_font');
$bears_button_font    = $params->get('bears_button_font');

$column_ref      = array();
$bears_title      = array();
$bears_subtitle   = array();
$bears_price      = array();
$bears_features   = array();
$bears_buttontext = array();
$bears_buttonurl  = array();
$bears_featured  = array();
$bears_icon      = array();
$bears_icon_location = array();
$bears_icon_color = array();
$bears_title_font = array();
$bears_price_font = array();
$bears_subtitle_font = array();
$bears_features_font = array();
$bears_button_font = array();

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
        $bears_featured[$i]  = $params->get('bears_featured' . $i);
        $bears_icon[$i]      = $params->get('bears_icon' . $i);
        $bears_icon_location[$i] = $params->get('bears_icon_location' . $i);
        $bears_icon_color[$i] = $params->get('bears_icon_color' . $i, '');
        $bears_title_font[$i] = $params->get('bears_title_font' . $i, '');
        $bears_price_font[$i] = $params->get('bears_price_font' . $i, '');
        $bears_subtitle_font[$i] = $params->get('bears_subtitle_font' . $i, '');
        $bears_features_font[$i] = $params->get('bears_features_font' . $i, '');
        $bears_button_font[$i] = $params->get('bears_button_font' . $i, '');
    }
}

// Get document
$document = Factory::getDocument();

// Add custom CSS for this specific module instance
$bears_css = '';

// Only add CSS rules when parameters are explicitly set
// Add padding values if specified
if (!empty($bears_column_margin_y) && !empty($bears_column_margin_x)) {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { padding:' . $bears_column_margin_y . 'px ' . $bears_column_margin_x . 'px; }';
}

// Add column background color if specified (including "transparent")
if ($bears_column_bg !== null && $bears_column_bg !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan { background-color:' . $bears_column_bg . '; }';
}

// Add header background color if specified (including "transparent")
if ($bears_header_bg !== null && $bears_header_bg !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' header { background-color: ' . $bears_header_bg . '; }';
}

// Apply border styles based on selection
if ($bears_border_style === 'shadow') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan:not(.featured) { border: none !important; box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) !important; }';
} else if ($bears_border_style === 'solid' && $bears_border_color !== null && $bears_border_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan:not(.featured) { border: 3px solid ' . $bears_border_color . ' !important; box-shadow: none !important; }';
} else {
    // None option or no color specified for solid
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan:not(.featured) { border: none !important; box-shadow: none !important; }';
}

// Apply featured border styles based on selection
if ($bears_featured_border_style === 'shadow') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan.featured { border: none !important; box-shadow: 0 0 20px rgba(0, 0, 0, 0.3) !important; }';
} else if ($bears_featured_border_style === 'solid' && $bears_featured_border_color !== null && $bears_featured_border_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan.featured { border: 3px solid ' . $bears_featured_border_color . ' !important; box-shadow: none !important; }';
} else {
    // None option or no color specified for solid
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan.featured { border: none !important; box-shadow: none !important; }';
}

// Add featured background if specified (including "transparent")
if ($bears_featured_bg !== null && $bears_featured_bg !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan.featured { background-color: ' . $bears_featured_bg . '; }';
}

// Add header featured background if specified (including "transparent")
if ($bears_header_featured_bg !== null && $bears_header_featured_bg !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan.featured header { background-color: ' . $bears_header_featured_bg . '; }';
}

// Add title color if specified (including "transparent")
if ($bears_title_color !== null && $bears_title_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-title { color:' . $bears_title_color . '; }';
}

// Add title font size if specified
if (!empty($bears_title_font_size)) {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-title { font-size:' . $bears_title_font_size . 'px; }';
}

// Add price font size if specified
if (!empty($bears_price_font_size)) {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-price { font-size:' . $bears_price_font_size . 'px; }';
}

// Add price color if specified (including "transparent")
if ($bears_price_color !== null && $bears_price_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-price { color:' . $bears_price_color . '; }';
}

// Add featured price color if specified (including "transparent")
if ($bears_featured_price_color !== null && $bears_featured_price_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-price { color:' . $bears_featured_price_color . '; }';
}

// Add subtitle color if specified (including "transparent")
if ($bears_pricesub_color !== null && $bears_pricesub_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-type { color:' . $bears_pricesub_color . '; }';
}

// Add features color if specified (including "transparent")
if ($bears_features_color !== null && $bears_features_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-features li { color:' . $bears_features_color . '; }';
}

// Add accent colors if specified (including "transparent")
if ($bears_accent_color !== null && $bears_accent_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-features { color:' . $bears_accent_color . '; }';
}

if ($bears_featured_accent_color !== null && $bears_featured_accent_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan.featured .plan-features { color:' . $bears_featured_accent_color . '; }';
}

// Add button color if specified (including "transparent")
if ($bears_button_color !== null && $bears_button_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-select a, .bears_pricing_tables' . $bears_moduleid . ' .plan-select a.btn { background-color: ' . $bears_button_color . '; }';
}

// Add button hover color if specified (including "transparent")
if ($bears_button_hover_color !== null && $bears_button_hover_color !== '') {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-select a:hover, .bears_pricing_tables' . $bears_moduleid . ' .plan-select a.btn:hover { background-color: ' . $bears_button_hover_color . '; }';
}

// Put styling in header
$document->addStyleDeclaration($bears_css);

/* Columns */
if ($bears_num_columns == '1') {
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 100%; } ';
    $document->addStyleDeclaration($style);
} elseif ($bears_num_columns == '2') {
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 50%; } ';
    $document->addStyleDeclaration($style);
} elseif ($bears_num_columns == '3') {
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 33.3%; } ';
    $document->addStyleDeclaration($style);
} elseif ($bears_num_columns == '4') {
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 25%; } ';
    $document->addStyleDeclaration($style);
}
?>

<div class="bears_pricing_tables<?php echo $bears_moduleid; ?> bears_pricing_tables-outer">
	<div class="bears_pricing_tables-container">
        <?php
        $columnnr = 0;
        for ($i = 1; $i <= $bears_num_columns; $i++) {
            if (isset($column_ref[$columnnr])) {
                $cur_column = $column_ref[$columnnr];
                if (!empty($cur_column)) {
                    ?>
					<div class="bears_pricing_tables">
						<div class="plan<?php if (isset($bears_featured[$cur_column]) && $bears_featured[$cur_column] == 'yes') : ?> featured<?php endif; ?>">
							<header>
                                <?php if (!empty($bears_icon[$cur_column]) && $bears_icon_location[$cur_column] == 'top-left'): ?>
									<div class="plan-icon icon-top-left">
										<i class="<?php echo htmlspecialchars($bears_icon[$cur_column]); ?>"<?php echo !empty($bears_icon_color[$cur_column]) ? ' style="color: ' . htmlspecialchars($bears_icon_color[$cur_column]) . ';"' : ''; ?>></i>
									</div>
                                <?php endif; ?>

                                <?php if (!empty($bears_icon[$cur_column]) && $bears_icon_location[$cur_column] == 'top-center'): ?>
									<div class="plan-icon icon-top-center">
										<i class="<?php echo htmlspecialchars($bears_icon[$cur_column]); ?>"<?php echo !empty($bears_icon_color[$cur_column]) ? ' style="color: ' . htmlspecialchars($bears_icon_color[$cur_column]) . ';"' : ''; ?>></i>
									</div>
                                <?php endif; ?>

                                <?php if (!empty($bears_icon[$cur_column]) && $bears_icon_location[$cur_column] == 'top-right'): ?>
									<div class="plan-icon icon-top-right">
										<i class="<?php echo htmlspecialchars($bears_icon[$cur_column]); ?>"<?php echo !empty($bears_icon_color[$cur_column]) ? ' style="color: ' . htmlspecialchars($bears_icon_color[$cur_column]) . ';"' : ''; ?>></i>
									</div>
                                <?php endif; ?>

                                <?php if (!empty($bears_icon[$cur_column]) && $bears_icon_location[$cur_column] == 'middle-left'): ?>
									<div class="plan-icon icon-middle-left">
										<i class="<?php echo htmlspecialchars($bears_icon[$cur_column]); ?>"<?php echo !empty($bears_icon_color[$cur_column]) ? ' style="color: ' . htmlspecialchars($bears_icon_color[$cur_column]) . ';"' : ''; ?>></i>
									</div>
                                <?php endif; ?>

								<h4 class="plan-title" <?php echo !empty($bears_title_font[$cur_column]) ? 'style="font-family: \'' . htmlspecialchars($bears_title_font[$cur_column]) . '\', sans-serif;"' : ''; ?>>
                                    <?php echo htmlspecialchars($bears_title[$cur_column] ?? ''); ?>
								</h4>

                                <?php if (!empty($bears_icon[$cur_column]) && $bears_icon_location[$cur_column] == 'middle-right'): ?>
									<div class="plan-icon icon-middle-right">
										<i class="<?php echo htmlspecialchars($bears_icon[$cur_column]); ?>"<?php echo !empty($bears_icon_color[$cur_column]) ? ' style="color: ' . htmlspecialchars($bears_icon_color[$cur_column]) . ';"' : ''; ?>></i>
									</div>
                                <?php endif; ?>

								<div class="plan-cost">
									<span class="plan-price" <?php echo !empty($bears_price_font[$cur_column]) ? 'style="font-family: \'' . htmlspecialchars($bears_price_font[$cur_column]) . '\', sans-serif;"' : ''; ?>><?php echo htmlspecialchars($bears_price[$cur_column] ?? ''); ?></span>
									<span class="plan-type" <?php echo !empty($bears_subtitle_font[$cur_column]) ? 'style="font-family: \'' . htmlspecialchars($bears_subtitle_font[$cur_column]) . '\', sans-serif;"' : ''; ?>><?php echo htmlspecialchars($bears_subtitle[$cur_column] ?? ''); ?></span>
								</div>

                                <?php if (!empty($bears_icon[$cur_column]) && $bears_icon_location[$cur_column] == 'bottom-left'): ?>
									<div class="plan-icon icon-bottom-left">
										<i class="<?php echo htmlspecialchars($bears_icon[$cur_column]); ?>"<?php echo !empty($bears_icon_color[$cur_column]) ? ' style="color: ' . htmlspecialchars($bears_icon_color[$cur_column]) . ';"' : ''; ?>></i>
									</div>
                                <?php endif; ?>

                                <?php if (!empty($bears_icon[$cur_column]) && $bears_icon_location[$cur_column] == 'bottom-center'): ?>
									<div class="plan-icon icon-bottom-center">
										<i class="<?php echo htmlspecialchars($bears_icon[$cur_column]); ?>"<?php echo !empty($bears_icon_color[$cur_column]) ? ' style="color: ' . htmlspecialchars($bears_icon_color[$cur_column]) . ';"' : ''; ?>></i>
									</div>
                                <?php endif; ?>

                                <?php if (!empty($bears_icon[$cur_column]) && $bears_icon_location[$cur_column] == 'bottom-right'): ?>
									<div class="plan-icon icon-bottom-right">
										<i class="<?php echo htmlspecialchars($bears_icon[$cur_column]); ?>"<?php echo !empty($bears_icon_color[$cur_column]) ? ' style="color: ' . htmlspecialchars($bears_icon_color[$cur_column]) . ';"' : ''; ?>></i>
									</div>
                                <?php endif; ?>
							</header>

                            <?php if (!empty($bears_icon[$cur_column]) && $bears_icon_location[$cur_column] == 'center-center'): ?>
								<div class="plan-icon icon-center-center">
									<i class="<?php echo htmlspecialchars($bears_icon[$cur_column]); ?>"<?php echo !empty($bears_icon_color[$cur_column]) ? ' style="color: ' . htmlspecialchars($bears_icon_color[$cur_column]) . ';"' : ''; ?>></i>
								</div>
                            <?php endif; ?>

							<ul class="plan-features dot" <?php echo !empty($bears_features_font[$cur_column]) ? 'style="font-family: \'' . htmlspecialchars($bears_features_font[$cur_column]) . '\', sans-serif;"' : ''; ?>>
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
								<a class="btn" href="<?php echo htmlspecialchars($bears_buttonurl[$cur_column] ?? '#'); ?>" <?php echo !empty($bears_button_font[$cur_column]) ? 'style="font-family: \'' . htmlspecialchars($bears_button_font[$cur_column]) . '\', sans-serif;"' : ''; ?>>
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
