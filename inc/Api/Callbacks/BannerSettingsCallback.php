<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Api\Callbacks;

class BannerSettingsCallback
{
    public function settings($input)
    {
        return $input;
    }
    public function sectionSetting()
    {
        return "Set The banner Default Background";
    }
    public function fieldSettings($params)
    {
        $label = $params['label_for'];
        $option = get_option('phemrise_plugin_biem_setter');
        if ($label == 'image_url') {
            echo '
            <input type="hidden" value="' . (is_array($option) && isset($option[$label]) ? $option[$label] : "") . '" name="phemrise_plugin_biem_setter[' . $label . ']" class="biem-image-input">
            <div class="biem-image-display js-biem-bg-image-banner-picker">
            <img src="' . (is_array($option) && isset($option[$label]) ? $option[$label] : "") . '"/>
            </div> ';
        } else if ($label == 'overlay_text') {
            echo '<textarea class="form-control" style="width:50%;" rows="4" name="phemrise_plugin_biem_setter[' . $label . ']" required> ' . (is_array($option) && isset($option[$label]) ? $option[$label] : "") . ' </textarea>';
        } else if ($label == 'baner_height' || $label == 'items_height') {
            echo '<input type="number" style="width:50%;" value="' . (is_array($option) && isset($option[$label]) ? $option[$label] : "") . '" name="phemrise_plugin_biem_setter[' . $label . ']" required';
        }
    }
}
