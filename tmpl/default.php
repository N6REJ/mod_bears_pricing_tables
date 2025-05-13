<?php
/**
 * Bears Pricing Tables - Purple Template
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

$bears_num_columns     = $params->get('bears_num_columns', 3);
$bears_column_margin_y = $params->get('bears_column_margin_y', 20);
$bears_column_margin_x = $params->get('bears_column_margin_x', 20);
$bears_column_bg      = $params->get('bears_column_bg', '#ffffff');
$bears_header_bg      = $params->get('bears_header_bg', '#8e44ad');
$bears_highlight_bg   = $params->get('bears_highlight_bg', '#9b59b6');
$bears_title_color    = $params->get('bears_title_color', '#ffffff');
$bears_price_color    = $params->get('bears_price_color', '#8e44ad');
$bears_pricesub_color = $params->get('bears_pricesub_color', '#95a5a6');
$bears_features_color = $params->get('bears_features_color', '#7f8c8d');
$bears_button_color   = $params->get('bears_button_color', '#8e44ad');

// Font family settings
$bears_title_font     = $params->get('bears_title_font', '');
$bears_price_font     = $params->get('bears_price_font', '');
$bears_subtitle_font  = $params->get('bears_subtitle_font', '');
$bears_features_font  = $params->get('bears_features_font', '');
$bears_button_font    = $params->get('bears_button_font', '');

$column_ref      = array();
$bears_title      = array();
$bears_subtitle   = array();
$bears_price      = array();
$bears_features   = array();
$bears_buttontext = array();
$bears_buttonurl  = array();
$bears_highlight  = array();
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
        $bears_highlight[$i]  = $params->get('bears_highlight' . $i);
        $bears_icon[$i]      = $params->get('bears_icon' . $i);
        $bears_icon_location[$i] = $params->get('bears_icon_location' . $i, 'center-center');
        $bears_icon_color[$i] = $params->get('bears_icon_color' . $i, '');
        $bears_title_font[$i] = $params->get('bears_title_font' . $i, '');
        $bears_price_font[$i] = $params->get('bears_price_font' . $i, '');
        $bears_subtitle_font[$i] = $params->get('bears_subtitle_font' . $i, '');
        $bears_features_font[$i] = $params->get('bears_features_font' . $i, '');
        $bears_button_font[$i] = $params->get('bears_button_font' . $i, '');
    }
}

// Note: CSS is now loaded by the helper class, so we don't need to add:
// $document->addStyleSheet(Uri::base() . 'modules/mod_bears_pricing_tables/css/default.css');

// Get document
$document = Factory::getDocument();

// Styling from module parameters
$bears_css = '';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { padding:' . $bears_column_margin_y . 'px ' . $bears_column_margin_x . 'px; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan { background-color:' . $bears_column_bg . '; box-shadow: inset 0 0 0 5px ' . $bears_header_bg . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' header { background-color: ' . $bears_header_bg . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' header:after { border-color: ' . $bears_header_bg . ' transparent transparent transparent; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-title { color:' . $bears_title_color . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-price { color:' . $bears_price_color . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-type { color:' . $bears_pricesub_color . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-features { color:' . $bears_features_color . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-select a, .bears_pricing_tables' . $bears_moduleid . ' .plan-select a.btn { background-color: ' . $bears_button_color . '; color: #ffffff; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-select a:hover, .bears_pricing_tables' . $bears_moduleid . ' .plan-select a.btn:hover { background-color: ' . $bears_button_color . '; opacity: 0.9; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .featured.plan { }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .featured header { background-color: ' . $bears_highlight_bg . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .featured header:after { border-color: ' . $bears_highlight_bg . ' transparent transparent transparent; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-icon { font-size: 24px; margin: 10px; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .icon-center-center { text-align: center; display: block; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .icon-top-left { float: left; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .icon-top-center { text-align: center; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .icon-top-right { float: right; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .icon-middle-left { float: left; margin-right: 10px; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .icon-middle-right { float: right; margin-left: 10px; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .icon-bottom-left { float: left; clear: both; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .icon-bottom-center { text-align: center; clear: both; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .icon-bottom-right { float: right; clear: both; }';

// Put styling in header
$document->addStyleDeclaration($bears_css);

/* Columns */
if ($bears_num_columns == '1') :
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 100%; } ';
    $document->addStyleDeclaration($style);
endif;
if ($bears_num_columns == '2') :
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 50%; } ';
    $document->addStyleDeclaration($style);
endif;
if ($bears_num_columns == '3') :
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 33.3%; } ';
    $document->addStyleDeclaration($style);
endif;
if ($bears_num_columns == '4') :
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 25%; } ';
    $document->addStyleDeclaration($style);
endif;
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
						<div class="plan <?php
                        if (isset($bears_highlight[$cur_column]) && $bears_highlight[$cur_column] == 'yes') : ?>featured<?php
                        endif; ?>">
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
</div></qodoArtifact>
