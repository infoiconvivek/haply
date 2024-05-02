<?php
/**
 * Plugin Name: Gutenberg Custom Block
 * Author: WordPressIntegration
 * Author URI: https://www.wordpressintegration.com
 * Description: A simple block showing Information, Advice, Warning, and Danger notice boxes.
 */

// Load assets for wp-admin when editor is active
function gutenberg_image_content_block() {
   wp_enqueue_script(
      'gutenberg-block1-image-content-editor',
      plugins_url( 'block1-image-content.js', __FILE__ ),
      array( 'wp-blocks', 'wp-element' )
   );
   wp_enqueue_script(
      'gutenberg-user-designation-block-editor',
      plugins_url( 'user-designation-block.js', __FILE__ ),
      array( 'wp-blocks', 'wp-element' )
   );
   wp_enqueue_script(
      'gutenberg-block2-heading-editor',
      plugins_url( 'block2-heading.js', __FILE__ ),
      array( 'wp-blocks', 'wp-element' )
   );
   

   wp_enqueue_style(
      'gutenberg-block1-image-content-editor',
      plugins_url( 'block1.css', __FILE__ ),
      array()
   );
}
add_action( 'enqueue_block_editor_assets', 'gutenberg_image_content_block' );

// Load assets for the frontend
// function gutenberg_block1_block_frontend() {

//    wp_enqueue_style(
//       'gutenberg-block1-block-editor',
//       plugins_url( 'block1.css', __FILE__ ),
//       array()
//    );
// }
// add_action( 'wp_enqueue_scripts', 'gutenberg_block1_block_frontend' );
