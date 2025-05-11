<?php
/**
 * Bears Pricing Tables - Blue Template
 * 
 * @version     1.0.2
 * @package     Bears Pricing Tables
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright   Copyright (c) 2023 N6REJ
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

// Get number of columns to display
$numColumns = $params->get('bears_num_columns', 3);
?>

<div class="blue_pricing_tables<?php echo $moduleclass_sfx; ?>">
    <?php for ($i = 1; $i <= $numColumns; $i++) : ?>
        <?php
        $title = $params->get('bears_title' . $i, '');
        
        // Skip if no title
        if (empty($title)) continue;
        
        $price = $params->get('bears_price' . $i, '');
        $subtitle = $params->get('bears_subtitle' . $i, '');
        $highlight = $params->get('bears_highlight' . $i, 'no');
        $buttonText = $params->get('bears_buttontext' . $i, '');
        $buttonUrl = $params->get('bears_buttonurl' . $i, '');
        $features = $params->get('bears_features' . $i, array());
        ?>
        
        <div class="column<?php echo ($highlight == 'yes') ? ' highlight' : ''; ?>">
            <div class="header">
                <h3 class="title"><?php echo $title; ?></h3>
                <div class="price"><?php echo $price; ?></div>
                <?php if (!empty($subtitle)) : ?>
                    <div class="subtitle"><?php echo $subtitle; ?></div>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($features) && is_object($features)) : ?>
                <ul class="features">
                    <?php foreach ($features as $feature) : ?>
                        <?php if (is_object($feature) && isset($feature->feature_text)) : ?>
                            <li><i class="ion-checkmark-round"></i> <?php echo $feature->feature_text; ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <?php if (!empty($buttonText) && !empty($buttonUrl)) : ?>
                <div class="button">
                    <a href="<?php echo $buttonUrl; ?>"><?php echo $buttonText; ?></a>
                </div>
            <?php endif; ?>
        </div>
    <?php endfor; ?>
</div>
