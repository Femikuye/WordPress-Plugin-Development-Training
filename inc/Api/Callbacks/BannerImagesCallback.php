<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Api\Callbacks;

class BannerImagesCallback
{
    public function settings($input)
    {
        $existing_cpt = get_option('phemrise_plugin_biem');
        // add_settings_error('phemrise_plugin_biem_settings', 'phemrise_banner_images_effect', 'An error ocured');
        // var_dump($input);
        // die;
        if ($_POST['delete']) {
            unset($existing_cpt[$_POST['delete']]);
            return $existing_cpt;
        }
        if ($_POST['update']) {
            return $existing_cpt;
        }
        if ($existing_cpt == null || count($existing_cpt) === 0) {
            if (isset($input['image_id'])) {
                $existing_cpt = array();
                $existing_cpt[$input['image_id']] = $input;
            }
            return $existing_cpt;
        }
        foreach ($existing_cpt as $k => $value) {
            if ($input['image_id'] === $k) {
                $existing_cpt[$k] = $input;
            } else {
                $existing_cpt[$input['image_id']] = $input;
            }
        }
        return $existing_cpt;
    }
    public function sectionSetting()
    {
        return "Set Your Custom Post Type Here";
    }
    public function fieldSettings($params)
    {
        $option_name = $params['option_name'];
        $label = $params['label_for'];
        $option = null;
        if (isset($_POST['update'])) {
            $options = get_option($option_name);
            if (isset($options[$_POST['update']])) {
                $option = $options[$_POST['update']];
            }
        }
        if ($label == 'image') {
            echo '
            <input type="hidden" value="' . (is_array($option) && isset($option[$label]) ? $option[$label] : "") . '" name="' . $option_name . '[' . $label . ']" class="biem-image-input">
            <div class="biem-image-display js-biem-image-banner-picker">
            <img src="' . (is_array($option) && isset($option[$label]) ? $option[$label] : "") . '"/>
            </div>
            ';
        } else if ($label == 'image_description') {
            echo '<textarea class="form-control" style="width:50%;" rows="4" name="' . $option_name . '[' . $label . ']" required> ' . (is_array($option) && isset($option[$label]) ? $option[$label] : "") . ' </textarea>';
        } else if ($label == 'image_id') {
            echo '<input type="hidden" value="' . (is_array($option) && isset($option[$label]) ? $option[$label] : uniqid()) . '" name="' . $option_name . '[' . $label . ']" >';
        } else if ($label == 'image_title') {
            echo '<input type="text" style="width:50%;" value="' . (is_array($option) && isset($option[$label]) ? $option[$label] : "") . '" name="' . $option_name . '[' . $label . ']" required>';
        }
    }
}
