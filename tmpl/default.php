<?php
/**
 * Bears Pricing Tables
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

$bears_num_images     = $params->get('bears_num_images', 3);
$bears_image_margin_y = $params->get('bears_image_margin_y', 20);
$bears_image_margin_x = $params->get('bears_image_margin_x', 20);
$bears_column_bg      = $params->get('bears_column_bg', '#ffffff');
$bears_header_bg      = $params->get('bears_header_bg', '#2c3e50');
$bears_highlight_bg   = $params->get('bears_highlight_bg', '#e74c3c');
$bears_title_color    = $params->get('bears_title_color', '#ffffff');
$bears_price_color    = $params->get('bears_price_color', '#2c3e50');
$bears_pricesub_color = $params->get('bears_pricesub_color', '#95a5a6');
$bears_features_color = $params->get('bears_features_color', '#7f8c8d');
$bears_button_color   = $params->get('bears_button_color', '#3498db');

$image_ref      = array();
$bears_title      = array();
$bears_subtitle   = array();
$bears_price      = array();
$bears_features   = array();
$bears_buttontext = array();
$bears_buttonurl  = array();
$bears_highlight  = array();

$max_images = 15;
for ($i = 1; $i <= $max_images; $i++) {
    if ($params->get('bears_title' . $i)) {
        $image_ref[]        = $i;
        $bears_title[$i]      = $params->get('bears_title' . $i);
        $bears_subtitle[$i]   = $params->get('bears_subtitle' . $i);
        $bears_price[$i]      = $params->get('bears_price' . $i);
        $bears_features[$i]   = $params->get('bears_features' . $i);
        $bears_buttontext[$i] = $params->get('bears_buttontext' . $i);
        $bears_buttonurl[$i]  = $params->get('bears_buttonurl' . $i);
        $bears_highlight[$i]  = $params->get('bears_highlight' . $i);
    }
}

// Load CSS/JS
// Update for Joomla 5: Use Factory::getDocument() instead of JFactory
$document = Factory::getDocument();
$document->addStyleSheet(Uri::base() . 'modules/mod_bears_pricing_tables/css/default.css');

// Styling from module parameters
$bears_css = '';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { padding:' . $bears_image_margin_y . 'px ' . $bears_image_margin_x . 'px; }';
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
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .featured header:after { border-color: ' . $bears_header_bg . ' transparent transparent transparent; }';

// Put styling in header
$document->addStyleDeclaration($bears_css);

/* Columns */
if ($bears_num_images == '1') :
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 100%; } ';
    $document->addStyleDeclaration($style);
endif;
if ($bears_num_images == '2') :
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 50%; } ';
    $document->addStyleDeclaration($style);
endif;
if ($bears_num_images == '3') :
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 33.3%; } ';
    $document->addStyleDeclaration($style);
endif;
if ($bears_num_images == '4') :
    $style = ' .bears_pricing_tables' . $bears_moduleid . ' .bears_pricing_tables { width: 25%; } ';
    $document->addStyleDeclaration($style);
endif;
?>

<div class="bears_pricing_tables<?php echo $bears_moduleid; ?> bears_pricing_tables-outer">
    <div class="bears_pricing_tables-container">
    <?php
    $imagenr = 0;
    for ($i = 1; $i <= $bears_num_images; $i++) {
        if (isset($image_ref[$imagenr])) {
            $cur_img = $image_ref[$imagenr];
            if (!empty($cur_img)) {
                ?>
                <div class="bears_pricing_tables">
                    <div class="plan <?php
                    if (isset($bears_highlight[$cur_img]) && $bears_highlight[$cur_img] == 'yes') : ?>featured<?php
                    endif; ?>">
                        <header>
                            <h4 class="plan-title">
                                <?php echo htmlspecialchars($bears_title[$cur_img] ?? ''); ?>
                            </h4>
                            <div class="plan-cost">
                                <span class="plan-price"><?php echo htmlspecialchars($bears_price[$cur_img] ?? ''); ?></span>
                                <span class="plan-type"><?php echo htmlspecialchars($bears_subtitle[$cur_img] ?? ''); ?></span>
                            </div>
                        </header>

                        <ul class="plan-features dot">
                            <?php
                            if (!empty($bears_features[$cur_img])) {
                                $features = $bears_features[$cur_img];
                                
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
                            <a class="btn" href="<?php echo htmlspecialchars($bears_buttonurl[$cur_img] ?? '#'); ?>">
                                <?php echo htmlspecialchars($bears_buttontext[$cur_img] ?? ''); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            $imagenr++;
        }
    }
    ?>
    </div>
    <div class="clear"></div>
</div>
<?php
// Proper debugging code - uncomment to see what's in the features array
/*
echo '<pre style="text-align:left; background:#f5f5f5; padding:10px; margin:10px; border:1px solid #ccc;">';
echo "All features:<br>";
var_dump($bears_features);
echo '</pre>';
*/
?>
