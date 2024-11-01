<?php
/*
  Plugin Name: WT4 Recent Posts
  Plugin URI: http://www.wpthemes4u.co.uk/plugins/wt4-recent-posts
  Description: Display Recent posts anywhere with a shortcode or widget
  Author: Gareth Gillman
  Author URI: 
  Text Domain: wt4-recent-posts
  Version: 1.0.0
 */ 
  
 // Register Shortocde
 function wt4_scode( $atts ) {
  $wt4_content = '';
  
  $wt4_atts = shortcode_atts(
   array(
    'posts' => '',
    'cat' => '',
    'tag' => '',
   ),
   $atts
  );
  if(!empty($wt4_atts['posts'])) {
   $post_num = $wt4_atts['posts'];
  } else {
   $post_num = get_option('posts_per_page');
  }

  $wt4_args = array(
   'posts_per_page' => $post_num,
   'category_name' => $wt4_atts['cat'],
   'tag' => $wt4_atts['tag'],
  );

  $wt4_query = new WP_Query( $wt4_args );
  if ( $wt4_query->have_posts() ) {
	 $wt4_content .= '<ul class="wt4_list">';
	  while ( $wt4_query->have_posts() ) {
	   $wt4_query->the_post();
	   $wt4_content .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
	  }
	 $wt4_content .= '</ul>';
  }
  wp_reset_postdata();
  return $wt4_content;
 }
 add_shortcode( 'wt4_recent_posts', 'wt4_scode' );