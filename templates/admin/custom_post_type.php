<div class="wrap">
    <h1>Custom Post Type Page</h1>
    <?php settings_errors() ?>

    <ul class="nav nav-tabs">
        <li class="<?php echo !isset($_POST['update']) ? "active" :  ""; ?>">
            <a href="#tab-1">All Post Types</a>
        </li>
        <li class="<?php echo isset($_POST['update']) ? "active" :  ""; ?>">
            <a href="#tab-2"> <?php echo isset($_POST['update']) ? "Update " :  "New "; ?> Post Type</a>
        </li>
        <li class="">
            <a href="#tab-3">Export</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="tab-1" class="tab-pane <?php echo !isset($_POST['update']) ? "active" :  ""; ?>">
            <?php
            $post_types = get_option('phemrise_plugin_cpt');
            if (!empty($post_types)) { ?>
                <table>
                    <!-- <thead> -->
                    <tr class="ph-tr">
                        <th>Post Name</th>
                        <th>Post Plural Name</th>
                        <th>Has Archive</th>
                        <th>Public Status</th>
                        <th>Options</th>
                    </tr>
                    <!-- </thead> -->
                    <!-- <tbody> -->
                    <?php foreach ($post_types as $post) {
                        $has_achive = isset($post['has_archive']) ? ($post['has_archive'] ? 'True' : 'False') : 'False';
                        $public_status = isset($post['public_status']) ? ($post['public_status'] ? 'True' : 'False') : 'False';
                    ?>
                        <tr class="ph-tr">
                            <td><?php echo $post['single_name'] ?></td>
                            <td><?php echo $post['name'] ?></td>
                            <td><?php echo $has_achive;  ?></td>
                            <td><?php echo $public_status; ?></td>
                            <td>
                                <form method="post" class="inline-block" action="">
                                    <?php
                                    settings_fields('phemrise_plugin_cpt_settings');
                                    echo '<input type="hidden" value="' . $post['post_type_id'] . '" name="update">';
                                    submit_button('Update', 'primary small', 'submit', false);
                                    ?>
                                </form>
                                |
                                <form method="post" class="inline-block" action="options.php">
                                    <?php
                                    settings_fields('phemrise_plugin_cpt_settings');
                                    echo '<input type="hidden" value="' . $post['post_type_id'] . '" name="delete">';
                                    submit_button('Delete', 'delete small', 'submit', false, array(
                                        'onclick' => 'return confirm("Are you sure you want to delete this custom post type?");'
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
            <h3><?php echo isset($_POST['update']) ? "Update " :  "Add New "; ?> Post Type</h3>
            <form method="post" action="options.php">
                <?php
                settings_fields('phemrise_plugin_cpt_settings');
                do_settings_sections('phemrise_cpt');
                submit_button();
                ?>
            </form>
        </div>
        <div id="tab-3" class="tab-pane">
            <h3>Export Data</h3>
        </div>
    </div>
</div>