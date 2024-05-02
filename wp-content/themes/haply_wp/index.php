<?php /*Template Name: Home*/
get_header();
echo '<div class="leftImg"><div class="container-fluid">';

if (THEME_NAME == 'black') {

    $custom_front_page_id = get_option('custom_front_page_id');

    if (is_front_page()) :
        query_posts("page_id=" . $custom_front_page_id);
    endif;

    while (have_posts()) : the_post();
        the_content();
    endwhile;
    //wp_reset_query();

    //get_template_part('home', THEME_NAME);
} else {
    //query_posts("page_id=2926");
    while (have_posts()) : the_post();
        the_content();
    endwhile;
    //wp_reset_query();


    //get_template_part('home', THEME_NAME);
}
?>
</div>
</div>
<section class="feature">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="about_sec">
                    <div class="line"></div>
                    <h2 class="h1"><?php
                                    if (THEME_NAME == 'black') {
                                        echo get_field('related_article_heading_geonote');
                                    } else {
                                        echo get_field('related_article_heading_haply');
                                    }

                                    ?></h2>

                </div>
            </div>
        </div>
        <div class="row">
            <?php

            /*$meta_query = array(
                array(
                    'key'     => 'manage_theme',
                    'value'   => THEME_NAME ? THEME_NAME : 'green', // THEME_NAME come form wp_config.php 
                    'compare' => 'LIKE',
                )
            );


            $args = array(
                'post_type' => 'epkb_post_type_1', // Your custom post type
                'posts_per_page' => '3', // Change the number to whatever you wish
                'post_status' => 'publish',
                'meta_query' => $meta_query,
            );*/


            if (THEME_NAME == 'black') {
                $active_theme = 'geonote';
            } else if (THEME_NAME == 'green') {
                $active_theme = 'haply';
            } else {
                $active_theme = 'null';
            }


            $categories = array();

            // Step 1: Retrieve categories with the active theme.
            $theme_categories = get_terms(array(
                'taxonomy' => 'epkb_post_type_1_category',
                'meta_query' => array(
                    array(
                        'key' => 'manage_theme',
                        'value' => $active_theme,
                        'compare' => 'like'
                    ),
                ),
                'fields' => 'ids',
            ));
            //print_r($theme_categories);die;
            if (!empty($theme_categories)) {
                $categories = $theme_categories;
            }

            // Step 2: Define arguments for WP_Query.
            $args = array(
                'post_type' => 'epkb_post_type_1', // Change this if you're using a custom post type.
                'posts_per_page' => 3, // Change this to limit the number of posts displayed.
                'tax_query' => array(
                    array(
                        'taxonomy' => 'epkb_post_type_1_category',
                        'field' => 'term_id',
                        'terms' => $categories,
                    ),
                ),
                'orderby' => 'date', // Default ordering.
                'order' => 'DESC',   // Default ordering.
            );


            $new_query = new WP_Query($args);
            if ($new_query->have_posts()) :
                while ($new_query->have_posts()) :
                    $new_query->the_post();
            ?>
                    <div class="col-lg-4">
                        <div class="feature-box">
                            <div class="img-style">
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                } else {
                                    $upload_dir   = wp_upload_dir();
                                    echo '<img class="img-fluid" src="' . $upload_dir['baseurl'] . '/2023/06/about-img1.png"/>';
                                } ?>

                            </div>

                            <div class="content-style">
                                <h3><?php the_title(); ?></h3>
                                <p><?php
                                    if (get_field('article_excerpt')) {
                                        echo get_field('article_excerpt');
                                    } else {
                                        echo wp_trim_words(get_the_excerpt(), '55', '...');
                                    }
                                    ?></p>


                                <div class="user">
                                    <div class="user-img">
                                        <?php $theAuthorId = get_the_author_meta('ID'); ?>
                                        <?php echo get_avatar($theAuthorId); ?>
                                    </div>

                                    <div class="user-info">
                                        <h5><?php echo get_author_name(); ?></h5>
                                        <h5><?php //echo get_the_date(); 
                                            ?><?php echo get_the_modified_time('d.m.Y') ?></h5>
                                    </div>
                                </div>

                                <a href="<?php echo get_post_permalink(); ?>" class="btn custom-btn"><?php esc_html_e('Read more', 'HaplyWP') ?></a>
                            </div>
                        </div>
                    </div>
            <?php endwhile;
                wp_reset_postdata();
            endif ?>

            <div class="col-lg-12">
                <div class="text-center">
                    <a href="<?php
                                if (THEME_NAME == 'black') {
                                    if (isset(get_field('related_article_button_geonote')['url'])) {
                                        echo get_field('related_article_button_geonote')['url'];
                                    }
                                } else {
                                    if (isset(get_field('related_article_button_haply')['url'])) {
                                        echo get_field('related_article_button_haply')['url'];
                                    }
                                }

                                ?>" class="btn hover-btn featureBtn"><?php
                                                                        if (THEME_NAME == 'black') {
                                                                            if (isset(get_field('related_article_button_geonote')['title'])) {
                                                                                echo get_field('related_article_button_geonote')['title'];
                                                                            }
                                                                        } else {
                                                                            if (isset(get_field('related_article_button_haply')['title'])) {
                                                                                echo get_field('related_article_button_haply')['title'];
                                                                            }
                                                                        }
                                                                        ?> </a>

                </div>

            </div>
        </div>
    </div>
</section>

<?php
get_footer();
