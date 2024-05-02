<?php
get_header();
?>
<style> 
	.is-hiddenn{display:none;}
</style>
<?php
$s=get_search_query();
/*$meta_query = array(
    array(
        'key'     => 'manage_theme',
        'value'   => THEME_NAME ? THEME_NAME : 'green', // THEME_NAME come form wp_config.php 
        'compare' => 'LIKE',
    )
);
$args = array(
    's' => $s,
    'post_type' => 'epkb_post_type_1',
    'meta_query' => $meta_query
);*/
// The Query


if(THEME_NAME == 'black'){
    $active_theme='geonote';
  }else if(THEME_NAME == 'green'){
    $active_theme='haply';
  }else{
    $active_theme='null';
  }
  
  //$active_theme = 'haply'; // Change this to dynamically retrieve the active theme.

  // Step 1: Retrieve categories with the active theme.
  $categories = get_terms( array(
      'taxonomy' => 'epkb_post_type_1_category',
      'meta_query' => array(
          array(
              'key' => 'manage_theme',
              'value' => $active_theme,
          ),
      ),
  ) );
//print_r($categories);
  // Step 2: Retrieve posts within matching categories.
  $the_query = new WP_Query( array(
    'post_type' => array( 'epkb_post_type_1' ), // Change this if you're using a custom post type.
    'posts_per_page' => -1, 
    's' => $s, // Use the retrieved search query
    'tax_query' => array(
        array(
            'taxonomy' => 'epkb_post_type_1_category',
            'field' => 'term_id',
            'terms' => wp_list_pluck( $categories, 'term_id' ),
        ),
    ),
    //'search' => true, // Enable searching in post titles and content.
    //'search_in_content'=>true,
    'search_columns' => array( 'post_title', 'post_content' ), // Include post_content in the search
) );

$the_query2 = new WP_Query( array(
    'post_type' => array( 'page' ), // Change this if you're using a custom post type.
    'posts_per_page' => -1, 
    's' => $s, // Use the retrieved search query
    
    //'search' => true, // Enable searching in post titles and content.
    //'search_in_content'=>true,
    'search_columns' => array( 'post_title', 'post_content' ), // Include post_content in the search
) );

//$the_query = new WP_Query( $args ); 
$count =  $the_query->post_count;

?>

<section class="about mb-64 <?php if($count==0){ echo "search-not-found";}?>"> <!--notfound-->
         <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="about_sec">
                        <div class="line wow slideInUp" data-wow-delay=".7s"></div>
                    <?php  
                    _e("<h1 class='h1 wow slideInUp'> Din søgning på '".get_query_var('s')."' gav  $count resultater </h1>");
                    ?>
                        <div class="search" id="search-category">
                            <form class="search-form wow slideInUp" action="/" method="get">
                                <input class="form-control search_input" name="s" value="<?php echo $_GET['s']?>"  id="myInput22" type="text" placeholder="Søg i artikler">
                                <button class="btn btn-search" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>

                            <!-- <div class="search-wrap">
                                <ul>
                                    <li><a href="search.html">Kundeklausuler indgået efter 1. januar 2016</a></li>
                                    <li><a href="search.html">Kundeklausuler for dummies</a></li>
                                    <li><a href="search.html">Professionelt salt og kundeservice</a></li>
                                    <li><a href="search.html">CX er det nye kundeservice</a></li>
                                    <li><a href="search.html">Styrk kundeoplevelsen med AI</a></li>
                                    <li><a href="search.html">AI er kommet for at blive i kunderelationer</a></li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="category">
        <div class="container-fluid">
            <div class="row grid grid-2">
                <?php
                if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                $the_query->the_post();
                 ?>
                   <div class="col-lg-6 box col-md-12">
                    <div class="category-box">
                        <div class="category-img">
                        <?php 
                        global $post;
                        $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));   ?>
                        <?php if ($feat_image) { ?>
                                <img src="<?php echo $feat_image; ?>" alt="no-img" class="img-fluid">
                            <?php } else {
                                $upload_dir   = wp_upload_dir();
                                echo '<img class="img-fluid" src="' . $upload_dir['baseurl'] . '/2023/06/about-img1.png"/>';
                            } ?>
                  
                        </div>

                        <div class="content">
                            <div class="category-content">
                                <?php 
                                $p = get_page($id);
                                //print_r($p);

                                ?>
                                <?php if(ICL_LANGUAGE_CODE=='en'){  $ID=19; } 
                                    else if(ICL_LANGUAGE_CODE=='da'){  $ID=305; }?>
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
                                    echo '<ul class="search-list-category">';
                                    $kk=0;
                                    foreach ($breadcrumb as $name => $link) {
                                        if($kk!=0){
                                            echo '<li> - </li>';
                                        }
                                        echo '<li><a href="' . esc_url($link) . '">' . esc_html($name) . '</a></li>';
                                        $kk++;
                                    }
                                    echo '</ul>';
                                    ?>
                                        <!-- <p><small><?php //echo get_the_title( $ID ); ?> : <?php echo get_the_category_list(' - ')?></small></p>-->
                                            <h3 class="highlight-text"><?php the_title(); ?></h3>
                                            <?php $the_query->post_modified; ?>

                                            <p><?php $content = get_field('article_excerpt');
                                        echo $content ? substr($content, 0, 100)
                                        :strip_tags(substr(get_the_content(), 0, 100));
                                    ?>
                                    
                                            <?php //echo wp_trim_words( get_the_content(), 40, '...' );?></p>
                                        </div>

                                        <div class="category-btn">
                                            <a href="<?php the_permalink(); ?>" class="btn custom-btn">
                                            <?php if(ICL_LANGUAGE_CODE=='en'){ echo get_theme_mod( 'article_button_en1' ) ; } 
                                            else if(ICL_LANGUAGE_CODE=='da'){ echo get_theme_mod( 'article_button_de1' ) ; }?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        }
                         if ( $the_query2->have_posts() ) {
                            while ( $the_query2->have_posts() ) {
                            $the_query2->the_post();
                             ?>
                               <div class="col-lg-6 box col-md-12">
                                <div class="category-box">
                                    <div class="category-img">
                                    <?php 
                                    global $post;
                                    $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));   ?>
                                    <?php if ($feat_image) { ?>
                                            <img src="<?php echo $feat_image; ?>" alt="no-img" class="img-fluid">
                                        <?php } else {
                                            $upload_dir   = wp_upload_dir();
                                            echo '<img class="img-fluid" src="' . $upload_dir['baseurl'] . '/2023/06/about-img1.png"/>';
                                        } ?>
                              
                                    </div>
            
                                    <div class="content">
                                        <div class="category-content">
                                            <?php 
                                            $p = get_page($id);
                                            //print_r($p);
            
                                            ?>
                                            <?php if(ICL_LANGUAGE_CODE=='en'){  $ID=19; } 
                                                else if(ICL_LANGUAGE_CODE=='da'){  $ID=305; }?>
                                            <?php 
                                                $post_id = get_the_ID(); // Get the current post ID
                                               
                                                
            
                                                // Output breadcrumbs
                                                echo '<ul class="search-list-category">';
                                                    echo '<li><a href="' . home_url() . '">Home</a> - </li>';                                                   
                                                    echo '<li><a href="' . esc_url($link) . '">' . esc_html(get_the_title()) . '</a></li>';
                                                   
                                                
                                                echo '</ul>';
                                                ?>
                                                   
                                                        <h3 class="highlight-text"><?php the_title(); ?></h3>
                                                        <?php $the_query->post_modified; ?>
            
                                                        <p><?php strip_tags(substr(get_the_content(), 0, 100));
                                                ?>
                                                
                                                        <?php //echo wp_trim_words( get_the_content(), 40, '...' );?></p>
                                                    </div>
            
                                                    <div class="category-btn">
                                                        <a href="<?php the_permalink(); ?>" class="btn custom-btn">
                                                        <?php if(ICL_LANGUAGE_CODE=='en'){ echo get_theme_mod( 'article_button_en1' ) ; } 
                                                        else if(ICL_LANGUAGE_CODE=='da'){ echo get_theme_mod( 'article_button_de1' ) ; }?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                            
                           
                }
                
                if (!$the_query->have_posts() && !$the_query2->have_posts()) :

                    
            ?>
                <h2 style='font-weight:bold;color:#000'>Ingen resultater</h2>
      
                <p class="mt-3">Ingen indhold matchede dine søgekriterier. Prøv igen med nogle andre søgeord.</p>
        
            <?php endif; ?>
            </div>
        </div>
    </section>
<script>

let cards = document.querySelectorAll('.box')
    
function liveSearch() {
    let search_query = document.getElementById("myInput").value;
    
    //Use innerText if all contents are visible
    //Use textContent for including hidden elements
    for (var i = 0; i < cards.length; i++) {
        if(cards[i].textContent.toLowerCase()
                .includes(search_query.toLowerCase())) {
            cards[i].classList.remove("is-hiddenn");
        } else {
            cards[i].classList.add("is-hiddenn");
        }
    }
}

//A little delay
let typingTimer;               
let typeInterval = 300;  
let searchInput = document.getElementById('myInput');

searchInput.addEventListener('keyup', () => {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(liveSearch, typeInterval);
});
</script>
<?php
get_footer();

?>