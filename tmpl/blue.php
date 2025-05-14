<?php
// No direct access
defined('_JEXEC') or die;

$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan { background-color:' . $bears_column_bg . '; box-shadow: inset 0 0 0 5px ' . $bears_header_bg . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' header { background-color: ' . $bears_header_bg . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' header:after { border-color: ' . $bears_header_bg . ' transparent transparent transparent; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-title { color:' . $bears_title_color . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-price { color:' . $bears_price_color . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-type { color:' . $bears_pricesub_color . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-features { color:' . $bears_features_color . '; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-select a, .bears_pricing_tables' . $bears_moduleid . ' .plan-select a.btn { background-color: ' . $bears_button_color . '; color: #ffffff; }';
$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .plan-select a:hover, .bears_pricing_tables' . $bears_moduleid . ' .plan-select a.btn:hover { background-color: ' . $bears_button_color . '; opacity: 0.9; }';

// Add border color overrides if specified in admin
if (!empty($bears_border_color)) {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' { border: 3px solid ' . $bears_border_color . '; }';
}

if (!empty($bears_featured_border_color)) {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .featured.plan { border: 3px solid ' . $bears_featured_border_color . ' !important; }';
} else {
    $bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .featured.plan { }';
}

$bears_css .= ' .bears_pricing_tables' . $bears_moduleid . ' .featured header { background-color: ' . $bears_highlight_bg . '; }';
?>
