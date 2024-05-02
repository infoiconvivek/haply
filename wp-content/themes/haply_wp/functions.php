<?php

function register_my_menu() {
   register_nav_menu('header-menu',__( 'haply main menu' ));
     //register_nav_menu('language-menu',__( 'Language Menu' ));
     register_nav_menu('footer-menu',__( 'footer menu' ));
     
     register_nav_menu('header-menu-geonote',__( 'geonote main menu' ));    
     register_nav_menu('footer-menu-geonote',__( 'geonote footer menu' ));
}
add_action( 'init', 'register_my_menu' );

/**
 * Enqueue scripts and styles.
 */
function esf_scripts() {
    wp_enqueue_style( 'esf-style', get_stylesheet_uri(), array(), '' );
    wp_style_add_data( 'esf-style', 'rtl', 'replace' );

    //wp_enqueue_script( 'block-image-content', get_template_directory_uri() . '/blocks/block-image-content.js', array(), _S_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'esf_scripts' );

// function add_additional_class_on_li($classes, $item, $args) {
//     if(isset($args->add_li_class)) {
//         $classes[] = $args->add_li_class;
//     }
//     return $classes;
// }
// add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}

// Our custom post type function
// function create_posttype() {
  
//     register_post_type( 'products',
//         array(
//             'labels' => array(
//                 'name' => __( 'Products' ),
//                 'singular_name' => __( 'Product' )
//             ),
//             'public'       => true,
//             'has_archive'  => true,
//             'rewrite'      => array('slug' => 'products'),
//             'show_in_rest' => true,
//             'taxonomies'   => array( 'category' ),
//                     // Features this CPT supports in Post Editor
//              'supports'    => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields','tags' ),
//              'tax_query' => array(
//                 array(
//                   'taxonomy' => 'product',
//                   'field' => 'slug',
//                   'terms' => 'board'
//                 ),
//                 ),
  
//         )
//     );
// }
// // Hooking up our function to theme setup
// add_action( 'init', 'create_posttype' );
add_theme_support('post-thumbnails');
add_theme_support( 'custom-logo' );
add_theme_support( 'block-templates' );

//vivek
add_theme_support( 'align-wide' );
add_theme_support( 'align-full' );
add_theme_support( 'wp-block-styles' );
add_theme_support( 'editor-styles' );
add_editor_style( 'editor-style.css' );

// end vivek
add_action('customize_register', 'transparent_logo_customize_register');
function transparent_logo_customize_register($wp_customize)
{

  $wp_customize->add_setting('footer_logo');
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
    'label'    => __('Footer Logo', 'HaplyWP'),
    'section'  => 'title_tagline',
    'settings' => 'footer_logo',
    'priority'       => 8,
  )));
}

add_action('customize_register', 'feb_logo_customize_register');
function feb_logo_customize_register($wp_customize)
{


$wp_customize->add_section( 'footer' , array(
  'title' => __( 'Footer Haply', 'HaplyWP' ),
  'priority' => 105, // Before Widgets.
) );

 /* $wp_customize->add_setting('facebook_social');
  
  $wp_customize->add_control( 'social_facebook', array(
 'label'      => __('Facebook', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'facebook_social',
 'type'       => 'text',
 ) );
 */
 
 $wp_customize->add_setting('social_linkedin');
  $wp_customize->add_control( 'social_linkedin', array(
 'label'      => __('linked in', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'social_linkedin',
 'type'       => 'text',
 ) );
 
 
  $wp_customize->add_setting('footer_address');
  $wp_customize->add_control( 'footer_address', array(
 'label'      => __('Address', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'footer_address',
 'type'       => 'text',
 ) );
 
  $wp_customize->add_setting('footer_cvr');
  $wp_customize->add_control( 'footer_cvr', array(
 'label'      => __('CVR-nr', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'footer_cvr',
 'type'       => 'text',
 ) );
 $wp_customize->add_setting('footer_tlf');
  $wp_customize->add_control( 'footer_tlf', array(
 'label'      => __('Tlf', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'footer_tlf',
 'type'       => 'text',
 ) );
 $wp_customize->add_setting('footer_email');
  $wp_customize->add_control( 'footer_email', array(
 'label'      => __('E-mail', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'footer_email',
 'type'       => 'text',
 ) );
 $wp_customize->add_setting('footer_faktura');
  $wp_customize->add_control( 'footer_faktura', array(
 'label'      => __('Faktura', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'footer_faktura',
 'type'       => 'text',
 ) );
 
 ////happly
 
 $wp_customize->add_section( 'geonote_footer' , array(
  'title' => __( 'Footer Geonote', 'HaplyWP' ),
  'priority' => 106, // Before Widgets.
) );

 /* $wp_customize->add_setting('geonote_facebook_social');
  
  $wp_customize->add_control( 'geonote_social_facebook', array(
 'label'      => __('Facebook', 'dcs'),
 'section'    => 'geonote_footer',
 'settings'   => 'geonote_facebook_social',
 'type'       => 'text',
 ) );
 */
 
 $wp_customize->add_setting('geonote_social_linkedin');
  $wp_customize->add_control( 'geonote_social_linkedin', array(
 'label'      => __('linked in', 'dcs'),
 'section'    => 'geonote_footer',
 'settings'   => 'geonote_social_linkedin',
 'type'       => 'text',
 ) );
 
 
  $wp_customize->add_setting('geonote_footer_address');
  $wp_customize->add_control( 'geonote_footer_address', array(
 'label'      => __('Address', 'dcs'),
 'section'    => 'geonote_footer',
 'settings'   => 'geonote_footer_address',
 'type'       => 'text',
 ) );
 
  $wp_customize->add_setting('geonote_footer_cvr');
  $wp_customize->add_control( 'geonote_footer_cvr', array(
 'label'      => __('CVR-nr', 'dcs'),
 'section'    => 'geonote_footer',
 'settings'   => 'geonote_footer_cvr',
 'type'       => 'text',
 ) );
 $wp_customize->add_setting('geonote_footer_tlf');
  $wp_customize->add_control( 'geonote_footer_tlf', array(
 'label'      => __('Tlf', 'dcs'),
 'section'    => 'geonote_footer',
 'settings'   => 'geonote_footer_tlf',
 'type'       => 'text',
 ) );
 $wp_customize->add_setting('geonote_footer_email');
  $wp_customize->add_control( 'geonote_footer_email', array(
 'label'      => __('E-mail', 'dcs'),
 'section'    => 'geonote_footer',
 'settings'   => 'geonote_footer_email',
 'type'       => 'text',
 ) );
 $wp_customize->add_setting('geonote_footer_faktura');
  $wp_customize->add_control( 'geonote_footer_faktura', array(
 'label'      => __('Faktura', 'dcs'),
 'section'    => 'geonote_footer',
 'settings'   => 'geonote_footer_faktura',
 'type'       => 'text',
 ) );
 
 /////
 
 
 
 
 $wp_customize->add_section( 'header' , array(
  'title' => __( 'Header', 'HaplyWP' ),
  'priority' => 106, 
) );

  $wp_customize->add_setting('header_link_text_en');
 $wp_customize->add_control( 'header_link_text_en', array(
 'label'      => __('Header link text haply', 'dcs'),
 'section'    => 'header',
 'settings'   => 'header_link_text_en',
 'type'       => 'text',
 ) );
 
 $wp_customize->add_setting('header_link_en');
 $wp_customize->add_control( 'header_link_en', array(
 'label'      => __('Header link haply', 'dcs'),
 'section'    => 'header',
 'settings'   => 'header_link_en',
 'type'       => 'url',
 ) );
 
 $wp_customize->add_setting('header_link_text_de');
 $wp_customize->add_control( 'header_link_text_de', array(
 'label'      => __('Header link text geonote', 'dcs'),
 'section'    => 'header',
 'settings'   => 'header_link_text_de',
 'type'       => 'text',
 ) );
 
 $wp_customize->add_setting('header_link_de');
 $wp_customize->add_control( 'header_link_de', array(
 'label'      => __('Header link geonote', 'dcs'),
 'section'    => 'header',
 'settings'   => 'header_link_de',
 'type'       => 'url',
 ) );
 
 
 $wp_customize->add_section( 'buttons' , array(
  'title' => __( 'Buttons', 'HaplyWP' ),
  'priority' => 107, // Before Widgets.
) );
 
 $wp_customize->add_setting('article_button_de1');
  $wp_customize->add_control( 'article_button_de1', array(
 'label'      => __('Article button DA', 'dcs'),
 'section'    => 'buttons',
 'settings'   => 'article_button_de1',
 'type'       => 'text',
 ) );
 
 $wp_customize->add_setting('article_button_en1');
  $wp_customize->add_control( 'article_button_en1', array(
 'label'      => __('Article button EN', 'dcs'),
 'section'    => 'buttons',
 'settings'   => 'article_button_en1',
 'type'       => 'text',
 ) );
 
 

 
 
  /*$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'feb_logo', array(
    'label'    => __('Linkedin url', 'store-front'),
    'section'  => 'footer',
    'settings' => 'footer_social',
    'priority'       => 4,
  )));*/
}

// $args = array(
//     'post_type' => 'custom_type', // Your custom post type
//     'posts_per_page' => '8', // Change the number to whatever you wish
//     'order_by' => 'date', // Some optional sorting
//     'order' => 'ASC', 
//     );
//     $new_query = new WP_Query ($args);
//     if ($new_query->have_posts()) {
//         while($new_query->have_posts()){
//             $new_query->the_post();
//             the_title();
//             the_post_thumbnail('thumbnail');
//             // Get a list of post's categories
//             $categories = get_the_category($post->ID);
//             foreach ($categories as $category) {
//                 echo $category->name;
//             }
//         }
//     }
//     wp_reset_postdata();
    
?>
<?php 
/*
 ==================
 Simple Ajax Search
======================   
*/
// add the ajax fetch js
add_action( 'wp_footer', 'fetch_ajax' );
function fetch_ajax() {
?>
<script type="text/javascript">
function fetch(){
  var searchText =jQuery('#keyword').val();
  if(searchText){    
    jQuery("#searchform span").css({ "background-color": "<?php echo THEME_NAME == 'black' ? '#000000' : '#fff' ?>", 'color': '#ffffff' });
    jQuery("#searchform span i").css({ "color": "<?php echo THEME_NAME == 'black' ? '#fff' : '#129e41' ?>" });
    jQuery(this).css({ "background-color": "#ffff", "color": "<?php echo THEME_NAME == 'black' ? '#000000' : '#129e41' ?>" });
    jQuery("#searchform input").removeAttr('placeholder').css("border", "1px solid <?php echo THEME_NAME == 'black' ? '#000000' : '#ffffff' ?>");
        

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'data_fetch',keyword: searchText },
        success: function(data) {
            //console.log(data);
        
            jQuery('#datafetch_header').html(data);
            // apply bold test on search list
            const listItems = document.querySelectorAll('#datafetch_header li');
            listItems.forEach(item => {
                const text = item.textContent.toLowerCase();

                if (text.includes(searchText)) {
                    // Add 'bold' class to match
                    item.classList.add('bold');
                } else {
                    // Remove 'bold' class if not a match
                    item.classList.remove('bold');
                }
            });
            //end search list


        }
    });
  }
}
</script>

<?php
}


// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){

    /*$the_query = new WP_Query( array( 'posts_per_page' => -1, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'epkb_post_type_1' ) );
    if( $the_query->have_posts() ) :?>
      <ul class="navbar-nav">
      <?php while( $the_query->have_posts() ): $the_query->the_post(); ?>
            <li><a href="<?php echo the_permalink(); ?>"><?php the_title();?></a></li>
        <?php endwhile; ?>
     </ul>

       <?php wp_reset_postdata();  
    endif;*/
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
    $posts_query = new WP_Query( array(
        'post_type' => array( 'epkb_post_type_1', 'page' ), // Change this if you're using a custom post type.
        'posts_per_page' => -1, 
        's' => esc_attr( $_POST['keyword'] ),
        'tax_query' => array(
            array(
                'taxonomy' => 'epkb_post_type_1_category',
                'field' => 'term_id',
                'terms' => wp_list_pluck( $categories, 'term_id' ),
            ),
        ),
       // 'search' => true,
        'search_columns' => array( 'post_title', 'post_content' ),
    ) );

    // Output posts.
    if ( $posts_query->have_posts() ) {
      echo '<ul class="navbar-nav">';
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();            
            echo '<li><a href="'.get_permalink().'">'. get_the_title().'</a></li>';
        }
        wp_reset_postdata();

        $posts_query2 = new WP_Query( array(
          'post_type' => array( 'page' ), // Change this if you're using a custom post type.
          'posts_per_page' => -1, 
          's' => esc_attr( $_POST['keyword'] ),
        ));
        while ( $posts_query2->have_posts() ) {
          $posts_query2->the_post();            
          echo '<li><a href="'.get_permalink().'">'. get_the_title().'</a></li>';
        }
        wp_reset_postdata();
        echo '</ul>';
    } else {
        // No posts found.
    }


    wp_die(); 
}
?>
<?php
/*
 ==================
 How To Page Simple Ajax Search
======================   
*/
// add the ajax fetch js
add_action( 'wp_footer', 'how_fetch_ajax' );
function how_fetch_ajax() {
$qobj = json_encode(get_queried_object());
?>

<script type="text/javascript">
function how_fetch(){

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'how_data_fetch',keyword: jQuery('#how_keyword').val() },
        success: function(data) {
            //console.log(data);
        
            jQuery('#how_to_datafetch').html(data);
                
        }
    });
}

function how_fetch_articles(evnt){

  jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'how_data_fetch_articles',keyword: jQuery(evnt).val() ,'termObj': <?php echo $qobj;?>},
        success: function(data) {
            console.log(data);      
            jQuery('#how_to_datafetch_article').html(data);
                
        }
    });
}

</script>

<?php
}

// the ajax function
add_action('wp_ajax_how_data_fetch' , 'how_data_fetch');
add_action('wp_ajax_nopriv_how_data_fetch','how_data_fetch');
function how_data_fetch(){
 $search_text=$_POST['keyword'];
$terms = get_terms(
  array(
         'taxonomy'   => 'epkb_post_type_1_category', // Custom Post Type Taxonomy Slug
         'hide_empty' => false,
         'order'         => 'desc',
         'hierarchical' => true,
         'parent' => 0,
        'name__like'    => $search_text,
        'meta_query' => array(
          'relation' => 'OR',
          array(
              'key'     => 'epkb_category_is_draft',
              'value'   => 'draft',
              'compare' => 'NOT LIKE', // Exclude terms where epkb_category_is_draft is set to 'draft'
          ),
          array(
              'key'     => 'epkb_category_is_draft',
              'compare' => 'NOT EXISTS', // Include terms where epkb_category_is_draft field doesn't exist
          ),
      ),
     )
  );

  foreach( $terms as $category ) {  
         // vars
  $queried_object = get_queried_object(); 
  $taxonomy = $category->taxonomy;
  $term_id = $category->term_id; 

  ?>

      <a href="<?php echo get_category_link($category->term_id);?>" class="highlight-text"><?php echo  $category->name;?> </a>


 <?php }

  wp_die();

}



/* Aitcle Archive page custom serch */
add_action('wp_ajax_how_data_fetch_articles' , 'how_data_fetch_articles');
add_action('wp_ajax_nopriv_how_data_fetch_articles','how_data_fetch_articles');
/* Aitcle Archive page custom serch */
function how_data_fetch_articles(){

    $search=$_POST['keyword'];
     $qobj = $_POST['termObj'];
     //print_r($qobj); // debugging only
     $manage_theme = get_term_meta($qobj['term_id'], 'manage_theme', true);	


     if(THEME_NAME == 'black'){
      $themeaName='geonote';
    }else if(THEME_NAME == 'green'){
      $themeaName='haply';
    }else{
      $themeaName='';
    }
    
    //echo $manage_theme.'__'.$themeaName;
    if ($manage_theme==$themeaName) {
        
    
    $meta_query = array(
    array(
        'key'     => 'manage_theme',
        'value'   => THEME_NAME?THEME_NAME:'green', // THEME_NAME come form wp_config.php 
        'compare' => 'LIKE',
        )
    );
    // concatenate the query
    $args = array(
      'posts_per_page' => -1,
      'orderby' => 'rand',
      'public'   => true,
       's' => $search,
       'suppress_filters' => false,
      'tax_query' => array(
        array(
          'taxonomy' => $qobj['taxonomy'],
          'field' => 'id',
          'terms' => $qobj['term_id'],
   
        )
      ),
      //'meta_query' => $meta_query,
    );
    
    $random_query = new WP_Query( $args );
    // var_dump($random_query); // debugging only

    if ($random_query->have_posts()) {
        while ($random_query->have_posts()) {
          $random_query->the_post();
          echo '<a href="'.get_the_permalink().'" class="highlight-text">'.get_the_title().'</a>';
        }
    }else{
      echo 'Der vises ingen artikler';
    }
  }

    die;
    
}


/* Archive aritcle page seach end*/




/* svg  image */
add_filter( 'mime_types', 'cc_adding_mime_types_support', 99);

function cc_adding_mime_types_support( $mimes ) {

    if(!defined('ALLOW_UNFILTERED_UPLOADS')) {
        define('ALLOW_UNFILTERED_UPLOADS', true);
    }
    $mimes['svg']  = 'image/svg+xml';

  
    return $mimes;
}

function my_plugin_body_class($classes)
{
  $classes[] = BODY_CLASS;
  return $classes;
}

add_filter('body_class', 'my_plugin_body_class');

/**
 * Disable Multiple Plugin updates 
 */

add_filter( 'site_transient_update_plugins', 'disable_multiple_plugin_updates' );

 function disable_multiple_plugin_updates( $value ) {

    $pluginsToDisableUpdates = [
        'echo-knowledge-base/echo-knowledge-base.php',
        'add-search-to-menu/add-search-to-menu.php',
        'require-kb-category/require-kb-category.php',
        'leira-letter-avatar/leira-letter-avatar.php'
    ];

    if ( isset($value) && is_object($value) ) {
        foreach ( $pluginsToDisableUpdates as $plugin) {
            if ( isset( $value->response[$plugin] ) ) {
                unset( $value->response[$plugin] );
            }
        }
    }
    return $value;
}

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    #nav-menu-header .menu-name,
    #nav-menu-header select {
      margin-left: 0px!important;
    } 
    
  </style>';
}

/*
//hook to add a meta box
add_action( 'add_meta_boxes', 'c3m_video_meta' );

function c3m_video_meta() {
    //create a custom meta box
    add_meta_box( 'c3m-meta', 'Featured Article Selector', 'c3m_mbe_function', 'epkb_post_type_1', 'normal', 'high' );
}

function c3m_mbe_function( $post ) {

    //retrieve the meta data values if they exist
    $c3m_mbe_featured = get_post_meta( $post->ID, '_c3m_mbe_featured', true );

    echo 'Select below to make article featured';
    ?>
    <p>Featured: 
    <select name="c3m_mbe_featured">
        <option value="No" <?php selected( $c3m_mbe_featured, 'no' ); ?>>No Way</option>
        <option value="Yes" <?php selected( $c3m_mbe_featured, 'yes' ); ?>>Make Feature This Article</option>
    </select>
    </p>
    <?php
}

//hook to save the meta box data
add_action( 'save_post', 'c3m_mbe_save_meta' );
function c3m_mbe_save_meta( $post_ID ) {
    global $post;
    if( $post->post_type == "epkb_post_type_1" ) {
        if ( isset( $_POST ) ) {
            update_post_meta( $post_ID, '_c3m_mbe_featured', strip_tags( $_POST['c3m_mbe_featured'] ) );
        }
    }
}*/

/**
 * Search SQL filter for matching against post title only.
 *
 * @link    http://wordpress.stackexchange.com/a/11826/1685
 *
 * @param   string      $search
 * @param   WP_Query    $wp_query
 */
function wpse_11826_search_by_title($search, $wp_query)
{
  if (!empty($search) && !empty($wp_query->query_vars['search_terms'])) {
    global $wpdb;

    $q = $wp_query->query_vars;
    $n = !empty($q['exact']) ? '' : '%';

    $search = array();

    foreach ((array) $q['search_terms'] as $term)
      $search[] = $wpdb->prepare("$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like($term) . $n);

    if (!is_user_logged_in())
      $search[] = "$wpdb->posts.post_password = ''";

    $search = ' AND ' . implode(' AND ', $search);
  }

  return $search;
}
//add_filter( 'posts_search', 'wpse_11826_search_by_title', 10, 2 );

add_filter( 'get_site_icon_url', '__return_false' );

add_action( 'wp_head', 'prefix_favicon', 100 );
add_action( 'admin_head', 'prefix_favicon', 100 );
function prefix_favicon() {
$uploads = wp_upload_dir();
$upload_path = $uploads['baseurl'];
    //code of the favicon logic
     if( THEME_NAME == 'black'){ 
     	$site_icon_url = $upload_path.THEME_FEBICON;
    }else if(THEME_NAME == 'green'){
    	$site_icon_url = $upload_path.THEME_FEBICON;
    }else{ 
    	if ( has_site_icon() ) {
            $site_icon_url = get_site_icon_url();
        } else {
            $site_icon_url = get_template_directory_uri().'/assets/img/favicon.png';
        }
    } 
  
    

    ?>
        <link rel="icon" href="<?php echo $site_icon_url;?>">
    <?php
}
add_action( 'wp_head', 'wp_site_icon', 99);

function the_breadcrumb() {
  echo '<div id="linkpad">';
if (!is_front_page()) {
  echo '<a href="';
  echo home_url();
  echo '">';
  echo 'Home';
  echo "</a> &raquo; ";
  if (is_category() || is_single()) {
    echo '';
    the_category(' &raquo; ');
    if (is_single()) {
      echo " &raquo; ";
      the_title();
      echo '';
    }
  } elseif (is_page()) {
    echo '';
    echo the_title();
    echo '';
  } elseif (is_home()) {
    echo wp_title('');
  }
}
elseif (is_tag()) {single_tag_title();}
elseif (is_day()) {echo"Archive for "; the_time('F jS, Y'); echo'';}
elseif (is_month()) {echo"Archive for "; the_time('F, Y'); echo'';}
elseif (is_year()) {echo"Archive for "; the_time('Y'); echo'';}
elseif (is_author()) {echo"Author Archive"; echo'';}
elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "Blog Archives"; echo'';}
elseif (is_search()) {echo"Search Results"; echo'';}
echo '</div>';
}




function get_category_based_permalink($post_id) {
    $categories = get_the_category($post_id);
    
    if (!empty($categories)) {
        // Get the category through which the user navigated
        $current_category = get_queried_object();
        
        // Check if the current category is a parent category
        if ($current_category->parent == 0) {
            // If it's a parent category, find the first category assigned to the post
            foreach ($categories as $category) {
                // Check if the category is the same as the current category
                if ($category->term_id == $current_category->term_id) {
                    // Generate permalink using the current category
                    return get_category_link($category->term_id) . '/' . get_post_field('post_name', $post_id);
                }
            }
        } else {
            // If it's a child category, find its parent category
            $parent_category_id = $current_category->parent;
            $parent_category = get_term($parent_category_id);
            
            // Check if the post is assigned to the parent category
            foreach ($categories as $category) {
                // Check if the post is assigned to the parent category
                if ($category->term_id == $parent_category_id) {
                    // Generate permalink using the parent category
                    return get_category_link($parent_category_id) . '/' . get_post_field('post_name', $post_id);
                }
            }
        }
    }
    
    // If no categories are assigned or the post doesn't match the current category, return the default permalink
    return get_permalink($post_id);
}
function get_custom_permalink($post_id) {
    $categories = get_the_category($post_id);
    
    // Check if the post has categories assigned
    if (!empty($categories)) {
        // Get the category through which the user navigated
        $current_category = get_queried_object();
        
        // Check if the current category is a parent category
        if ($current_category->parent == 0) {
            // If it's a parent category, find the first category assigned to the post
            foreach ($categories as $category) {
                // Check if the category is the same as the current category
                if ($category->term_id == $current_category->term_id) {
                    // Generate permalink using the current category
                    return get_permalink($post_id);
                }
            }
        } else {
            // If it's a child category, find its parent category
            $parent_category_id = $current_category->parent;
            $parent_category = get_term($parent_category_id);
            
            // Check if the post is assigned to the parent category
            foreach ($categories as $category) {
                // Check if the post is assigned to the parent category
                if ($category->term_id == $parent_category_id) {
                    // Generate permalink using the parent category
                    return get_category_link($parent_category_id) . '/' . get_post_field('post_name', $post_id);
                }
            }
        }
    }
    
    // If no categories are assigned or the post doesn't match the current category, generate the permalink using the default method
   
    return get_permalink($post_id);
}

/* function remove_category( $string, $type )  {           if ( $type != 'single' && $type == 'category' && ( strpos( $string, 'category' ) !== false ) )          {              $url_without_category = str_replace( "/category/", "/", $string );              return trailingslashit( $url_without_category );          }      return $string;  }     add_filter( 'user_trailingslashit', 'remove_category', 100, 2);*/





// Step 1: Register the custom field for the custom taxonomy.
function custom_taxonomy_add_meta_field() {
  // Add field for manage_theme
  ?>
  <div class="form-field">
      <label for="manage_theme">Manage Theme </label>
      <select name="manage_theme" id="manage_theme">
          <option value="haply">Haply</option>
          <option value="geonote">Geonote</option>
      </select>
  </div>
  <?php
}
add_action( 'epkb_post_type_1_category_add_form_fields', 'custom_taxonomy_add_meta_field', 10, 2 );

// Step 2: Save the custom field value when the term is saved.
function custom_taxonomy_save_meta_field( $term_id, $tt_id ) {
  if ( isset( $_POST['manage_theme'] ) ) {
      $manage_theme = sanitize_text_field( $_POST['manage_theme'] );
      update_term_meta( $term_id, 'manage_theme', $manage_theme );
  }
}
add_action( 'created_epkb_post_type_1_category', 'custom_taxonomy_save_meta_field', 10, 2 );

// Step 3: Add the custom field to the edit screen for the taxonomy.
function custom_taxonomy_edit_meta_field( $term ) {
  $manage_theme = get_term_meta( $term->term_id, 'manage_theme', true );
  ?>
  <tr class="form-field">
      <th scope="row" valign="top"><label for="manage_theme">Manage Theme </label></th>
      <td>
          <select name="manage_theme" id="manage_theme">
              <option value="haply" <?php selected( $manage_theme, 'haply' ); ?>>Haply</option>
              <option value="geonote" <?php selected( $manage_theme, 'geonote' ); ?>>Geonote</option>
          </select>
      </td>
  </tr>
  <?php
}
add_action( 'epkb_post_type_1_category_edit_form_fields', 'custom_taxonomy_edit_meta_field', 10, 2 );

// Step 4: Update the custom field value when the term is edited and saved.
function custom_taxonomy_update_meta_field( $term_id ) {
  if ( isset( $_POST['manage_theme'] ) ) {
      $manage_theme = sanitize_text_field( $_POST['manage_theme'] );
      update_term_meta( $term_id, 'manage_theme', $manage_theme );
  }
}
add_action( 'edited_epkb_post_type_1_category', 'custom_taxonomy_update_meta_field', 10, 2 );

// Step 5: Display the custom field in the taxonomy list table columns.
function custom_taxonomy_manage_columns( $columns ) {
  $columns['manage_theme'] = 'Manage Theme';
  return $columns;
}
add_filter( 'manage_edit-epkb_post_type_1_category_columns', 'custom_taxonomy_manage_columns' );

function custom_taxonomy_custom_column( $out, $column_name, $term_id ) {
  if ( $column_name === 'manage_theme' ) {
      $manage_theme = get_term_meta( $term_id, 'manage_theme', true );
      $out .= $manage_theme;
  }
  return $out;
}
add_filter( 'manage_epkb_post_type_1_category_custom_column', 'custom_taxonomy_custom_column', 10, 3 );

add_action( 'init', 'bt_flush_rewrite_rules' );

/* Flush your rewrite rules */
function bt_flush_rewrite_rules() {
     flush_rewrite_rules();
}


// Add custom function to modify homepage metadata
function custom_homepage_metadata() {
    if (is_front_page()) { // Check if it's the homepage

      if (THEME_NAME == 'black') {       
        $page_id = get_option('custom_front_page_id'); // Replace 123 with the ID of the page you want to pull metadata from
        // Get the metadata of the specified page
        $title = get_post_meta($page_id, '_yoast_wpseo_title', true);
        $description = get_post_meta($page_id, '_yoast_wpseo_metadesc', true);

        // Output the metadata for the homepage
        echo '<title>' . esc_html($title) . '</title>';
        echo '<meta name="description" content="' . esc_attr($description) . '">';
      }else{
        $page_id = get_the_id(); // Replace 123 with the ID of the page you want to pull metadata from
        // Get the metadata of the specified page
        $title = get_post_meta($page_id, '_yoast_wpseo_title', true);
        $description = get_post_meta($page_id, '_yoast_wpseo_metadesc', true);

        // Output the metadata for the homepage
        echo '<title>' . esc_html($title) . '</title>';
        echo '<meta name="description" content="' . esc_attr($description) . '">';
      }

    }else{?>
      <title><?php wp_title(' - ', true, 'right'); ?></title>
      <?php
    }
}
add_action('wp_head', 'custom_homepage_metadata');



// Add custom settings field to Reading settings page
function custom_front_page_settings_field() {
    add_settings_field(
        'custom_front_page_id',
        'Geonote Front Page',
        'display_custom_front_page_dropdown',
        'reading',
        'default'
    );
    register_setting('reading', 'custom_front_page_id',2);
}
add_action('admin_init', 'custom_front_page_settings_field');

// Display custom dropdown field in Reading settings page
function display_custom_front_page_dropdown() {
    $pages = get_pages();
    ?>
    <select name="custom_front_page_id" id="custom_front_page_id">
        <option value="">Select a page</option>
        <?php foreach ($pages as $page) : ?>
            <option value="<?php echo $page->ID; ?>" <?php selected(get_option('custom_front_page_id'), $page->ID); ?>><?php echo $page->post_title; ?></option>
        <?php endforeach; ?>
    </select>
    <?php
}