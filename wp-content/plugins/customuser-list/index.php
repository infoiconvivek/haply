<?php
/*
Plugin Name: User Management Plugin
Description: This plugin adds user management functionality.
Version: 1.0
Author: Your Name
*/

// Define constants
define('UM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('UM_PLUGIN_URL', plugin_dir_url(__FILE__));
global $wpdb;
define('UM_TABLE_NAME', $wpdb->prefix . 'user_management');

// Create custom table
function um_create_table() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = UM_TABLE_NAME;
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id mediumint(9) NOT NULL,
        user_order mediumint(9) NOT NULL,
        designation varchar(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'um_create_table');

// Save user order
function um_save_order() {
    global $wpdb;
    $order = $_POST['user'];
    $count = 1;
    print_r($_POST['user']);
    foreach ($order as $user_id) {
    echo $user_id;
        $wpdb->update(
            UM_TABLE_NAME,
            array('user_order' => $count),
            array('id' => $user_id)
        );
        $count++;
    }
    die();
}

// Add admin menu
function um_add_admin_menu() {
    add_menu_page('User Management', 'User Management', 'manage_options', 'user-management', 'um_admin_page');
}

add_action('admin_menu', 'um_add_admin_menu');

// Admin page content
function um_admin_page() {
    global $wpdb;

    // Handle form submission
    if(isset($_POST['um_submit'])) {
        $user_id = intval($_POST['user_id']);
        $designation = sanitize_text_field($_POST['designation']);
        
        // Insert user data
        $wpdb->insert(UM_TABLE_NAME, array(
            'user_id' => $user_id,
            'user_order' => 1,
            'designation' => $designation,
        ));
        echo "User added successfully!";
    }
// Handle user deletion
    if(isset($_GET['delete_user'])) {
        $user_to_delete = intval($_GET['delete_user']);
        $wpdb->delete(UM_TABLE_NAME, array('user_id' => $user_to_delete));
        echo "User deleted successfully!";
    }
    // Get WordPress users
    $wp_users = get_users();
    ?>

    <div class="wrap">
        <h2>Add User</h2>
        <form method="post" action="">
            <label for="user_id">Select User:</label>
            <select id="user_id" name="user_id">
                <?php foreach ($wp_users as $user) {
                    echo "<option value='" . $user->ID . "'>" . $user->user_login . "</option>";
                } ?>
            </select><br>
            <label for="designation">Designation:</label>
            <input type="text" id="designation" name="designation"><br>
            <input type="submit" name="um_submit" value="Add User">
        </form>
    </div>
     
    <?php
    //ob_start();
    echo um_display_user_list();
    //return ob_get_clean();
}

// Display user list with draggable functionality in admin
function um_display_user_list() {
    global $wpdb;
    $users = $wpdb->get_results("SELECT * FROM " . UM_TABLE_NAME . " ORDER BY user_order ASC"); // Change 'id' to the column you want to order by

    // Display user data in a draggable table
    ?>
    <div class="wrap">
        <h2>User List</h2>
        <table id="sortable" class="wp-list-table widefat striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user) {
                    $user_info = get_userdata($user->user_id);
                    $user_avatar = get_avatar($user->user_id, 64);
                    echo "<tr id='user-{$user->id}'>";
                    echo "<td>{$user->user_order} - {$user->id}</td>";
                    echo "<td>{$user_info->display_name}</td>";
                    echo "<td>{$user->designation}</td>";
                    echo "<td><a href='?page=user-management&delete_user={$user->user_id}'>Delete</a></td>";
                    echo "</tr>";
                } ?>
            </tbody>
        </table>
    </div>
    <script>
    jQuery(function($) {
        $( "#sortable tbody" ).sortable({
            update: function(event, ui) {
                var order = $(this).sortable('serialize');
                console.log(order);
                $.post(ajaxurl, order + '&action=um_save_order');
            }
        });
    });
    </script>
    <?php
}

add_action('wp_ajax_um_save_order', 'um_save_order');
function um_display_different_users_shortcode($atts) {
    global $wpdb;
    $users = $wpdb->get_results("SELECT * FROM " . UM_TABLE_NAME . " ORDER BY user_order ASC"); // Change 'id' to the column you want to order by


    
    
    // You can customize the HTML and CSS here to display users differently
    $output = '<section class="module-supporters"><div class="container-fluid">';
    $output .= '<div class="row">
            <div class="col-lg-12">
                <div class="content-left">
                	<h2>Vores supportere tager hånd om dig.<br> Fordi vi er bedre sammen.</h2>
                 </div>
            </div>';
    foreach($users as $user) {
        $user_info = get_userdata($user->user_id);
        $user_avatar = get_avatar($user->user_id, 64); // Adjust the avatar size as needed

	$output .= '<div class="col-xl-3 col-lg-4 col-md-6"><div class="supporters">
                	<div class="img-wrap">
                		' . $user_avatar . '
                	</div>
                    <div class="user-info">
                        <p class="fw-bold">' . $user_info->display_name . '</p>
                        <p>' .  $user->designation . '</p>
                    </div>
                </div>
            </div>';
            
            
        //$output .= '<div class="um-user">';
        //$output .= '<div class="um-user-avatar">' . $user_avatar . '</div>';
        //$output .= '<h3>' . $user_info->display_name . '</h3>';
        //$output .= '<p>' . $user->designation . '</p>';
        //$output .= '</div></div>';
    }
    
    $output .= '</div></div></section>';
    return $output;
}


add_shortcode('different_users', 'um_display_different_users_shortcode');
