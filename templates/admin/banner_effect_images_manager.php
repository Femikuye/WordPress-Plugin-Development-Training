<div class="wrap">
    <?php settings_errors();

    $banner_images = get_option('phemrise_plugin_biem');
    ?>

    <ul class="nav nav-tabs">
        <li class="<?php echo !isset($_POST['update']) ? "active" :  ""; ?>">
            <a href="#tab-1">All Banner Images</a>
        </li>
        <li class="<?php echo isset($_POST['update']) ? "active" :  ""; ?>">
            <a href="#tab-2"> <?php echo isset($_POST['update']) ? "Update " :  "New "; ?> Banner Image</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="tab-1" class="tab-pane <?php echo !isset($_POST['update']) ? "active" :  ""; ?>">
            <?php
            if (!empty($banner_images)) { ?>
                <table>
                    <!-- <thead> -->
                    <tr class="ph-tr">
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Options</th>
                    </tr>
                    <!-- </thead> -->
                    <!-- <tbody> -->
                    <?php foreach ($banner_images as $post) {
                    ?>
                        <tr class="ph-tr">
                            <td><img class="biem-thumbnail" src="<?php echo $post['image'] ?>" /></td>
                            <td><?php echo $post['image_title'] ?></td>
                            <td><?php echo $post['image_description'] ?></td>
                            <td>
                                <form method="post" class="inline-block" action="">
                                    <?php
                                    settings_fields('phemrise_plugin_biem_settings');
                                    echo '<input type="hidden" value="' . $post['image_id'] . '" name="update">';
                                    submit_button('Update', 'primary small', 'submit', false);
                                    ?>
                                </form>
                                |
                                <form method="post" class="inline-block" action="options.php">
                                    <?php
                                    settings_fields('phemrise_plugin_biem_settings');
                                    echo '<input type="hidden" value="' . $post['image_id'] . '" name="delete">';
                                    submit_button('Delete', 'delete small', 'submit', false, array(
                                        'onclick' => 'return confirm("Are you sure you want to delete this banner image?");'
                                    ));
                                    ?>
                                </form>

                            </td>
                        </tr>
                    <?php } ?>
                    <!-- </tbody> -->
                </table>
            <?php } ?>
        </div>
        <div id="tab-2" class="tab-pane <?php echo isset($_POST['update']) ? "active" :  ""; ?>">
            <h3><?php echo isset($_POST['update']) ? "Update " :  "Add New "; ?>Banner Image</h3>
            <?php if (isset($_POST['update'])) { ?>
                <form method="post" action="options.php">
                    <?php
                    settings_fields('phemrise_plugin_biem_images_settings');
                    do_settings_sections('phemrise_banner_effect_images');
                    submit_button();
                    ?>
                </form>
            <?php } elseif (is_array($banner_images) && count($banner_images) < 4) { ?>
                <form method="post" action="options.php">
                    <?php
                    settings_fields('phemrise_plugin_biem_images_settings');
                    do_settings_sections('phemrise_banner_effect_images');
                    submit_button();
                    ?>
                </form>
            <?php } else { ?>
                <h3 class="text-dander">Sorry! You can not add more than 4 banner images</h3>
            <?php } ?>
        </div>
    </div>
</div>