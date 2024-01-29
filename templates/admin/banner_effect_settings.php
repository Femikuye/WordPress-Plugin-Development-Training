<div class="wrap">
    <?php settings_errors();
    ?>

    <h3>Banner Effect Settings</h3>

    <form method="post" action="options.php">
        <?php
        settings_fields('phemrise_plugin_biem_settings');
        do_settings_sections('phemrise_banner_effect_settings');
        submit_button();
        ?>
    </form>
</div>