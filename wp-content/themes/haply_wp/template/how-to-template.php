<?php /* Template Name: How to page*/get_header();
?>
<section class="about mb-64">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="about_sec">
                        <div class="line" ></div>
                        <h1 class="h1"><?php the_title()?></h1>
                        <?php the_content();?>
                        <!--<h1 class="h1">How-to</h1>
                        <h4>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                            invidunt ut labore et dolore.</h4>--->
                        <div class="search">
                            <form class="search-form" id="search-category" method="get" action="">
                                <input class="form-control input_search" value="<?php echo @$_GET['search']?>"  name="search" id="how_keyword" onkeyup="how_fetch()" type="text" placeholder="Søg i kategorier">
                                 <!-- <input class="form-control search_input" id="keyword" onkeyup="fetch()" type="search" placeholder="Search in articles">-->
                                <button class="btn btn-search" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
							<div  id="how_to_datafetch"></div> 
                            <div class="search-wrap">
                            
                                <!-- <ul>
                                    <li><a href="search.html">Kundeklausuler indgået efter 1. januar 2016</a></li>
                                    <li><a href="search.html">Kundeklausuler for dummies</a></li>
                                    <li><a href="search.html">Professionelt salt og kundeservice</a></li>
                                    <li><a href="search.html">CX er det nye kundeservice</a></li>
                                    <li><a href="search.html">Styrk kundeoplevelsen med AI</a></li>
                                    <li><a href="search.html">AI er kommet for at blive i kunderelationer</a></li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="category">
        <div class="container-fluid">
            <div class="row">
            <?php
            
                /*$terms = get_terms(
                    array(
                        'taxonomy'   => 'epkb_post_type_1_category', // Custom Post Type Taxonomy Slug
                        'hide_empty' => false,
                        'parent'     => 0,
                        'orderby'    => 'name',
                        'order'      => 'asc',
                        'name__like' => @$_GET['search'],
                        'meta_query' => array(
                            'relation' => 'AND', // Ensuring all conditions are met
                            array(
                                'key'     => 'epkb_category_is_draft',
                                'value'   => 'draft',
                                'compare' => 'NOT LIKE', // Exclude terms where epkb_category_is_draft is set to 'draft'
                            ),
                            array(
                                'relation' => 'OR', // Adding OR relation for the two meta queries
                                array(
                                    'key'     => 'epkb_category_is_draft',
                                    'compare' => 'NOT EXISTS', // Include terms where epkb_category_is_draft field doesn't exist
                                ),
                                array(
                                    'key'     => 'manage_theme',
                                    'value'   => 'haply', // Only include terms where manage_theme is set to 'haply'
                                    'compare' => '=',
                                ),
                            ),
                        ),
                    )
                );
                */
                
                
                $terms = get_terms(
                    array(
                        'taxonomy'   => 'epkb_post_type_1_category', // Custom Post Type Taxonomy Slug
                        'hide_empty' => false,
                        'parent'     => 0,
                        'orderby'    => 'name',
                        'order'      => 'asc',
                        'name__like' => @$_GET['search'],
                        'meta_query' => array(
                            'relation' => 'AND', // Ensuring both conditions are met
                            array(
                                'key'     => 'epkb_category_is_draft',
                                'value'   => 'draft',
                                'compare' => 'NOT LIKE', // Exclude terms where epkb_category_is_draft is set to 'draft'
                            ),
                            array(
                                'key'     => 'manage_theme',
                                'value'   => (THEME_NAME == 'black')?'geonote':'haply', // Only include terms where manage_theme is set to 'haply'
                                'compare' => '=',
                            ),
                        ),
                    )
                );
              
                    foreach( $terms as $category ) {  
                           // vars
                    $queried_object = get_queried_object(); 
                    $taxonomy = $category->taxonomy;
                    $term_id = $category->term_id; 
                    //print_r($category);


                // get the thumbnail id using the queried category term_id
                $term_id =  $category->term_id; 
                 $image = get_field('image', $taxonomy . '_' . $term_id);
				 $video = get_field('video', $taxonomy . '_' . $term_id);
                //  $draft = get_field('epkb_category_is_draft', $taxonomy . '_' . $term_id);
                //  print_r($draft);
					echo '<div class="col-lg-3 col-md-6">
    <div class="category-box ssa">
        <div class="category-img">';
        
if ($video) {
    // Display the video if it's available
    echo $video ;
} else {
    // Display the image if the video is not available
   if ($image['url']) {
        echo '<img class="img-fluid" src="' . $image['url'] . '"/>';
    } else {
        $upload_dir   = wp_upload_dir();
        echo '<img class="img-fluid" src="' . $upload_dir['baseurl'] . '/2023/06/about-img1.png"/>';
    }
}
 $words='';
if(strlen($category->name) > 30){
   $words = " .. ";
}
echo '</div>

        <div class="content">
            <div class="category-content">
                <h3>' . substr($category->name, 0, 30) .$words. '</h3>
                <p>' . $category->description . '</p>
            </div>

            <div class="category-btn">
                <a href="' . get_category_link($category->term_id) . '" class="btn custom-btn">'.translate( 'Read more', 'HaplyWP' ).'</a>
            </div>
        </div>
    </div>
</div>';
                            } 
                            ?>
            </div>
                    

        </div>
    </section>

<?php get_footer();?>