<?php

/*

* Template Name: Single post page

* Template Post Type: epkb_post_type_1

*/

get_header();

$my_taxo ='epkb_post_type_1_category';


$my_post= get_the_terms(get_the_ID(), $my_taxo);
$Updated_cat=[];
foreach($my_post as $key=>$categoryies){
    
    $Updated_cat[$key]['term_id'] = $categoryies->term_id;
    $Updated_cat[$key]['name'] = $categoryies->name;
    $Updated_cat[$key]['slug'] = $categoryies->slug;
    $Updated_cat[$key]['term_group'] = $categoryies->term_group;
    $Updated_cat[$key]['term_taxonomy_id'] = $categoryies->term_taxonomy_id;
    $Updated_cat[$key]['taxonomy'] = $categoryies->taxonomy;
    $Updated_cat[$key]['description'] = $categoryies->description;
    $Updated_cat[$key]['parent'] = $categoryies->parent;
    $Updated_cat[$key]['count'] = $categoryies->count;
    $Updated_cat[$key]['filter'] = $categoryies->filter;
    $Updated_cat[$key]['manage_theme'] = get_term_meta($categoryies->term_id, 'manage_theme', true);
    //$Updated_cat[$key]=
}
 
 
//print_r($Updated_cat);
$term = $my_post[0];


//print_r($Updated_cat);die;
if(THEME_NAME == 'black'){
    $themeaName='geonote';
  }else if(THEME_NAME == 'green'){
    $themeaName='haply';
   
  }else{
    $themeaName='null';
  }
  //echo $themeaName;
  $theme_match = array_search($themeaName, array_column($Updated_cat, 'manage_theme'));
  //print_r($theme_match);die;
  if ($theme_match === false) {
    ?>
        <script type="text/javascript">
        window.location.href = '<?php echo esc_url( home_url() ); ?>';
        </script>
    <?php
    exit;
  }
  
$term_url = get_term_link($term);








?>

<section class="hwto artical">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="artical">
                    <div class="artical-img">
                        <?php if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							}
							else {							
								$upload_dir   = wp_upload_dir();
        							echo '<img class="img-fluid" src="' . $upload_dir['baseurl'] . '/2023/06/about-img1.png" />';
							} ?>


                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">
                    <ul>
                        <?php
                            $pageid11 = (ICL_LANGUAGE_CODE=='da')?305:19;
                            $post2   = get_post($pageid11);
                            //print_r($post2);

                            $kb_config['breadcrumb_home_text']=$post2->post_title;
                            $main_page_url=home_url($post2->post_name);
                        ?>
                        <li><a href="<?= site_url($post2->post_name);?>">
                        <?php echo $post2->post_title?></a></li>

                        <?php /*if(have_posts()) : the_post();  
                                    $post_type = get_post_type(get_the_ID());   
                                    $taxonomies = get_object_taxonomies($post_type);   
                                    $taxonomy_names = wp_get_object_terms(get_the_ID(), $taxonomies,  array("fields" => "names")); 
                                    if(!empty($taxonomy_names)) :
                                    foreach($taxonomy_names as $tax_name) :?>
                        <li><a href="<?php echo $term_url;?>"><?php echo $tax_name;?></a></li>
                        <?php endforeach;
                                    endif;
                                endif; */ ?>
                                <?php 
                        $post_id = get_the_ID(); // Get the current post ID
                        $taxonomy = 'epkb_post_type_1_category'; // Replace 'your_taxonomy' with your actual taxonomy name

                        $terms = wp_get_post_terms($post_id, $taxonomy); // Get all terms associated with the post

                        $breadcrumb = array();
                        foreach ($terms as $term) {
                            $ancestors = get_ancestors($term->term_id, $taxonomy);
                            $ancestors = array_reverse($ancestors);
                            $ancestors[] = $term->term_id;

                            foreach ($ancestors as $ancestor_id) {
                                $ancestor = get_term($ancestor_id, $taxonomy);

                                if (!empty($ancestor) && !is_wp_error($ancestor) && property_exists($ancestor, 'name')) {
                                    $term_link = get_term_link($ancestor_id, $taxonomy);
                                    if (!is_wp_error($term_link)) {
                                        $breadcrumb[$ancestor->name] = $term_link;
                                    }
                                }
                            }
                        }

                        // Output breadcrumbs

                        foreach ($breadcrumb as $name => $link) {
                            echo '<li><a href="' . esc_url($link) . '">' . esc_html($name) . '</a></li>';
                        }
                        ?>
                        

                        <li><?= get_the_title();?></li>

                    </ul>

                    <?php //echo do_shortcode('[custom_breadcrumbs]'); 
                    //the_breadcrumb();
                    ?>
                </div>



<!--
<div class="breadcrumb">
    <ul>
        <?php
        $pageid11 = (ICL_LANGUAGE_CODE == 'da') ? 305 : 19;
        $post2 = get_post($pageid11);
        
        $kb_config['breadcrumb_home_text'] = $post2->post_title;
        $main_page_url = home_url($post2->post_name);
        ?>
        <li><a href="<?= site_url($post2->post_name); ?>"><?php echo $post2->post_title ?></a></li>
        
        <?php
        // Get the current post ID
        $post_id = get_the_ID();
        
        // Generate category-based permalink
        $permalink = get_category_based_permalink($post_id);
        
        // Output breadcrumbs
        $categories = get_the_category($post_id);
        
        if (!empty($categories)) {
            foreach ($categories as $category) {
                echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
            }
        }
        ?>
        
        <li><a href="<?= $permalink ?>"><?= get_the_title(); ?></a></li>
    </ul>
</div>
-->



                <h1 class="wow slideInUp"><?= get_the_title();?></h1>
                <div class="date wow slideInUp">
                    <p>Redigeret <?php /*get_the_date();*/?> 
                    <?php //echo get_the_modified_time('F jS, Y')?>
                    <?php echo get_the_modified_time('d.m.Y')?>
                    </p>
                </div>

                <div class="hwto-user">
                    <div class="img-user wow slideInUp">
                        <?php $theAuthorId = get_the_author_meta('ID'); ?>
                        <?php echo get_avatar($theAuthorId);?>

                    </div>

                    <div class="user-info">
                        <p><?php echo get_the_author(); ?>
                            <span><?php echo get_the_author_meta('description'); ?></span>
                        </p>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="aticle-detail-page-share">
                    <div class="translate wow slideInUp">
                        <div id='google_translate_element'></div>
                        <?php echo do_shortcode('[google-translator]'); ?>
                        <img src="<?php echo get_template_directory_uri()?>/assets/img/gt-blk.png" alt="user" class="img-fluid">
                    </div>


                    <div class="hwto-social">
                        <p>Share this article</p>
                        <ul>
                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a href="https://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                            <li><a class="clipboard" target="_blank"><i class="fa-solid fa-link"></i></a></li>
                            <li><p class="copy"></p></li>
                        </ul>
                    </div>
                </div>

                


                <div class="article-content sssss" id="detail-wrap"><?php the_content();?></div>


                <?php
							$tip_content = get_field('tip_heading');
                    if ($tip_content) {
                        ?>
                                    <div class="tip">
                                        <h3><i class="fa-solid fa-lightbulb"></i> <?php echo get_field('tip_heading'); ?> </h3>
                                         <p> <?php echo get_field('tip_para'); ?></p>
                                     </div>
                                    <?php
                    } else {
                        // Alternative code here if the condition is not met
                    }
                    ?>
            </div>



            <!-- <div class="col-md-2">
                <div class="hwto-social">
                    <p>Share this article</p>
                    <ul>
                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>"
                                target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                        </li>
                        <li><a href="https://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank"><i
                                    class="fa-brands fa-facebook"></i></a></li>
                        <li><a class="clipboard" target="_blank"><i class="fa-solid fa-link"></i></a> </li>
                        <li>
                            <p class="copy"></p>
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
</section>



<section class="artical artical_related ">
    <div class="container-fluid">
    <div class="divider"></div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="wow slideInUp">Relaterede artikler</h1>
            </div>
        </div>
        <div class="row">

            <?php
      
$tes_art = get_field('related_articles');

if (!empty($tes_art)) {
            // $tes_art is not empty
            // Your code here if $tes_art is not empty
            // echo '<pre>';
            // print_r($tes_art);
            ?>

            <?php
              global $post; ?>
            <?php foreach( $tes_art as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
                    <a href="<?php the_permalink(); ?>">
                        <div class="artical-related-bx wow slideInUp">
                        <div class="img-style">
                            <?php
                            $image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID, 'medium'));
  $image = $image_attributes[0];
                            //echo get_the_post_thumbnail( $post->ID ); 
                            if($image){
                            ?>
                            <img src="<?php echo $image;?>" alt="<?php echo $post->post_title ?>">
                            <?php }else{
                            $upload_dir   = wp_upload_dir();
							echo '<img class="img-fluid" src="' . $upload_dir['baseurl'] . '/2023/06/about-img1.png"/>'; }
                    ?>
                            </div>
                            <div class="content-style">
                                <div class="date">
                                    <p><?php the_author(); ?></p>
                                    <p><?php echo get_the_date(); ?></p>
                                </div>
                                <h5><?php echo wp_trim_words(get_the_title(), 10, '...') ?></h5>
                            </div>
                        </div>
                    </a>
                </div>



              
                <?php endforeach; ?>
                <?php wp_reset_postdata();?>
                <?php
                
            } else {
            // $tes_art is empty
            // Default arguments for related posts from the same category
            if(THEME_NAME == 'black'){
                $active_theme='geonote';
            } else if(THEME_NAME == 'green'){
                $active_theme='haply';
            } else {
                $active_theme='null';
            }
            
            // Retrieve categories with the active theme.
            $theme_categories = get_terms( array(
                'taxonomy' => 'epkb_post_type_1_category',
                'meta_query' => array(
                    array(
                        'key' => 'manage_theme',
                        'value' => $active_theme,
                        'compare'=> 'like'
                    ),
                ),
                'fields' => 'ids',
            ) );
            
            // Prepare category IDs for query.
            $categories = !empty($theme_categories) ? $theme_categories : array();
            
            $args = array(
                'post_type' => 'epkb_post_type_1', // Change this if you're using a custom post type.
                'posts_per_page' => 8, // Change this to limit the number of posts displayed.
                'tax_query' => array(
                    array(
                        'taxonomy' => 'epkb_post_type_1_category',
                        'field' => 'term_id',
                        'terms' => $categories,
                    ),
                ),
                'orderby' => 'date', // Default ordering.
                'order' => 'DESC',   // Default ordering.
                'no_found_rows' => true,
                'post_status' => 'publish',
            );
            
            // Exclude the current post if available.
            if (function_exists('get_the_ID') && get_the_ID()) {
                $args['post__not_in'] = array(get_the_ID());
            }
            
            $related_cats_post = new WP_Query($args);
            
            if ($related_cats_post->have_posts()) {
                // Your loop to display posts here.
                while ($related_cats_post->have_posts()) {
                    $related_cats_post->the_post();
                // Your code for displaying related posts from the same category
                // This is the same code as you had before
                ?>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <a href="<?php the_permalink(); ?>">
                        <div class="artical-related-bx wow slideInUp">
                            <div class="img-style">
                                <?php if ( has_post_thumbnail() ) {
                                    the_post_thumbnail('medium');
                                }
                                else {							
                                    $upload_dir   = wp_upload_dir();
                                    echo '<img class="img-fluid" src="' . $upload_dir['baseurl'] . '/2023/06/about-img1.png"/>';
                                } ?>
                            </div>
                            <div class="content-style">
                                <div class="date">
                                    <p><?php the_author(); ?></p>
                                    <p><?php echo get_the_date(); ?></p>
                                </div>
                                <h5><?php echo wp_trim_words(get_the_title(), 10, '...') ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                }
            }
        }
        ?>



            </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
var $temp = $("<input>");
var $url = $(location).attr('href');
$('.clipboard').on('click', function() {
    $("body").append($temp);
    $temp.val($url).select();
    document.execCommand("copy");
    $temp.remove();
    $(".copy").text("URL copied!");
})
</script>

<script>
	jQuery(document).ready(function(){
    jQuery(".navbar ul li a").each(function(){
    var urla = window.location.pathname;
    console.log(jQuery(this)[0].innerText);
    if(jQuery(this)[0].innerText=='Vejledninger' || jQuery(this)[0].innerText=='Guides' || jQuery(this)[0].innerText=='Produkter'){
      jQuery(this).parent().addClass("active");
    }
        /*if(jQuery(this).attr("href")=="www.xyz.com/other/link1")
            jQuery(this).addClass("active");*/
    })
})
	</script>
<?php get_footer();?>