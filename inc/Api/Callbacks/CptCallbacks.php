<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Api\Callbacks;

class CptCallbacks
{
    public function cptSettings($input)
    {
        $existing_cpt = get_option('phemrise_plugin_cpt');
        if ($_POST['delete']) {
            unset($existing_cpt[$_POST['delete']]);
            return $existing_cpt;
        }
        if ($_POST['update']) {
            return $existing_cpt;
        }
        if ($existing_cpt == null || count($existing_cpt) === 0) {
            $existing_cpt = array();
            $existing_cpt[$input['post_type_id']] = $input;
            return $existing_cpt;
        }
        foreach ($existing_cpt as $k => $value) {
            if ($input['post_type_id'] === $k) {
                $existing_cpt[$k] = $input;
            } else {
                $existing_cpt[$input['post_type_id']] = $input;
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
            $options = get_option('phemrise_plugin_cpt');
            if (isset($options[$_POST['update']])) {
                $option = $options[$_POST['update']];
            }
        }

        if ($label == 'public_status' || $label == 'has_archive') {
            echo '<input type="checkbox" value="1" name="' . $option_name . '[' . $label . ']" ' . (is_array($option) && isset($option[$label]) ? "checked" : "") . '>';
        } else {
            echo '<input type="text" value="' . (is_array($option) && isset($option[$label]) ? $option[$label] : "") . '" name="' . $option_name . '[' . $label . ']" required>';
        }
    }
}
