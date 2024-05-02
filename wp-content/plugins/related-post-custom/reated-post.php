<?php
/*
Plugin Name: Custom Related Posts for epkb_post_type_1
Description: Allows selection of related posts with category filtering for epkb_post_type_1 custom post type.
Version: 1.0
Author: Your Name
*/

// Enqueue scripts and styles for Select2 and custom CSS
function custom_related_posts_enqueue_scripts()
{
    // Enqueue Select2 library
    wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), '4.0.13', true);
    wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', array(), '4.0.13');

    // Enqueue custom CSS file
    wp_enqueue_style('custom-related-posts-css', plugins_url('css/custom-related-posts.css', __FILE__), array(), '1.0');
}
add_action('admin_enqueue_scripts', 'custom_related_posts_enqueue_scripts');

// Add meta box to custom post type editor screen
function custom_related_posts_meta_box()
{
    add_meta_box(
        'custom_related_posts_meta_box',
        'Related Posts',
        'custom_related_posts_meta_box_content',
        'epkb_post_type_1', // Specify your custom post type slug here
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'custom_related_posts_meta_box');

// Callback function to display meta box content
function custom_related_posts_meta_box_content($post)
{
    // Get saved related posts
    $related_posts = get_post_meta($post->ID, '_related_posts', true) ? get_post_meta($post->ID, '_related_posts', true) : [];
   // print_r($related_posts);
?>

    <label for="related_posts">Select Related Posts:</label><br>
    <select name="related_posts[]" id="related_posts" multiple="multiple" style="width: 100%;">
        <?php
        /*$manage_theme = get_field('manage_theme'); // Retrieve the manage_theme value dynamically

        $meta_query = array();

        // Check if both values in $manage_theme exist
        if (isset($manage_theme[0]) && isset($manage_theme[1])) {
            $meta_query['relation'] = 'OR';

            // Add the first value to the meta query
            $meta_query[] = array(
                'key'     => 'manage_theme',
                'value'   => $manage_theme[0],
                'compare' => 'LIKE'
            );

            // Add the second value to the meta query
            $meta_query[] = array(
                'key'     => 'manage_theme',
                'value'   => $manage_theme[1],
                'compare' => 'LIKE'
            );
        } elseif (isset($manage_theme[0])) {
            // If only the first value exists, apply a meta query for that value
            $meta_query = array(
                array(
                    'key'     => 'manage_theme',
                    'value'   => $manage_theme[0],
                    'compare' => 'LIKE'
                )
            );
        }

        $posts = get_posts(
            array(
                'post_type'      => 'epkb_post_type_1',
                'posts_per_page' => -1,
                'meta_query'     => $meta_query,
            )
        );
        foreach ($posts as $p) {
            $selected = in_array($p->ID, $related_posts) ? 'selected="selected"' : '';
            echo '<option value="' . esc_attr($p->ID) . '" ' . $selected . '>' . esc_html($p->post_title) . '</option>';
        }*/
        ?>
    </select>
    <script>
        jQuery(document).ready(function($) {
            $('#related_posts').select2({
                placeholder: 'Select related posts',
                allowClear: true
            });


            const checkboxes = document.querySelectorAll('input[name="acf[field_652d05280e644][]"]');
            //console.log(checkboxes);
            // Function to handle checkbox change event
            function handleCheckboxChange() {
                // Array to store selected checkbox values
                const selectedValues = [];

                // Loop through each checkbox
                checkboxes.forEach(checkbox => {
                    // If checkbox is checked, add its value to selectedValues array
                    if (checkbox.checked) {
                        selectedValues.push(checkbox.value);
                    }
                });

                // Log selectedValues array to console
                //console.log("Selected Checkbox Values:", selectedValues);
                updateRelatedPosts(selectedValues);
            }

            // Add change event listener to each checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', handleCheckboxChange);
            });

            handleCheckboxChange();
            // Call handleCheckboxChange when the document is ready
            /*document.addEventListener("DOMContentLoaded", function() {
                // This code will run when the DOM is fully loaded
                console.log("DOM is ready");
                handleCheckboxChange();
            });*/

            // Function to update related posts via AJAX
            function updateRelatedPosts(selectedValues) {
                // Get the post ID and manage_theme value
                var postID = '<?php echo $post->ID ?>'; //$('#post_ID').val();
                var manageTheme = selectedValues;

                // Send an AJAX request to update related posts
                $.ajax({
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    type: 'POST',
                    data: {
                        action: 'show_related_posts',
                        post_id: postID,
                        manage_theme: manageTheme
                    },
                    success: function(response) {

                        var jsonArray = JSON.parse(response);
                        var selected = "<?php echo json_encode($related_posts); ?>";
                        selected = JSON.parse(selected);

                        // Update related posts UI if needed
                        const selectElement = document.getElementById('related_posts');
                        selectElement.innerHTML = '';

                        // Iterate over the response array and create <option> elements
                        jsonArray.forEach(post => {
                            // Create an <option> element
                            const option = document.createElement('option');

                            // Set the value and text of the <option> element
                            option.value = post.id;
                            option.textContent = post.title;
                            // Check if the current option's value is in the selected array
                            if (selected.includes(post.id)) {
                                option.selected = true; // Set the selected attribute
                            }
                            // Append the <option> element to the <select> element
                            selectElement.appendChild(option);
                        });

                    },
                    error: function(xhr, status, error) {
                        // Handle errors if needed
                    }
                });
            }
        });
    </script>
<?php
}

// Save related posts when custom post type is saved
function save_custom_related_posts($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['related_posts'])) {
        $related_posts = array_map('intval', $_POST['related_posts']);
        update_post_meta($post_id, '_related_posts', $related_posts);
    } else {
        delete_post_meta($post_id, '_related_posts');
    }
}
add_action('save_post_epkb_post_type_1', 'save_custom_related_posts');

// AJAX handler function to update related posts based on manage_theme
function show_related_posts_ajax()
{
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $manage_theme = isset($_POST['manage_theme']) ? $_POST['manage_theme'] : '';

    // Construct meta query based on manage_theme value


    $meta_query = array();

    // Check if both values in $manage_theme exist
    if (isset($manage_theme[0]) && isset($manage_theme[1])) {
        $meta_query['relation'] = 'OR';

        // Add the first value to the meta query
        $meta_query[] = array(
            'key'     => 'manage_theme',
            'value'   => $manage_theme[0],
            'compare' => 'LIKE'
        );

        // Add the second value to the meta query
        $meta_query[] = array(
            'key'     => 'manage_theme',
            'value'   => $manage_theme[1],
            'compare' => 'LIKE'
        );
    } elseif (isset($manage_theme[0])) {
        // If only the first value exists, apply a meta query for that value
        $meta_query = array(
            array(
                'key'     => 'manage_theme',
                'value'   => $manage_theme[0],
                'compare' => 'LIKE'
            )
        );
    }

    $related_posts = get_posts(
        array(
            'post_type'      => 'epkb_post_type_1',
            'posts_per_page' => -1,
            'meta_query'     => $meta_query,
        )
    );

    // Update related posts meta for the current post
    $related_post_ids = array();
    foreach ($related_posts as $related_post) {
        $related_post_ids[] = ['id' => $related_post->ID, 'title' => $related_post->post_title];
    }
    //print_r($related_post_ids);
    //update_post_meta($post_id, '_related_posts', $related_post_ids);
    echo json_encode($related_post_ids);
    wp_die(); // Terminate AJAX request
}
add_action('wp_ajax_show_related_posts', 'show_related_posts_ajax');

// Display related posts in admin area for custom post type
function display_custom_related_posts()
{
    global $post;
    if ($post->post_type === 'epkb_post_type_1') {
        $related_posts = get_post_meta($post->ID, '_related_posts', true);
        if (!empty($related_posts)) {
            echo '<h3>Related Posts</h3>';
            echo '<ul>';
            foreach ($related_posts as $related_post_id) {
                $related_post = get_post($related_post_id);
                if ($related_post) {
                    echo '<li><a href="' . esc_url(get_edit_post_link($related_post_id)) . '">' . esc_html($related_post->post_title) . '</a></li>';
                }
            }
            echo '</ul>';
        }
    }
}
add_action('edit_form_after_title', 'display_custom_related_posts');
