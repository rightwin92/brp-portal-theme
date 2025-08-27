<?php
if (!defined('ABSPATH')) exit;

add_action('after_setup_theme', function(){
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5',['search-form','comment-form','comment-list','gallery','caption']);
  register_nav_menus(['primary'=>'Primary Menu']);
});

add_action('wp_enqueue_scripts', function(){
  wp_enqueue_style('brpt-style', get_stylesheet_directory_uri().'/assets/app.css', [], '1.2');
  wp_enqueue_script('brpt-js', get_stylesheet_directory_uri().'/assets/app.js', ['jquery'], '1.2', true);
});

/** Helper to render cards */
function brpt_render_cards($q){
  if (!$q->have_posts()){ echo '<p>No items found.</p>'; return; }
  echo '<div class="brpt-grid">';
  while($q->have_posts()){ $q->the_post();
    echo '<article class="brpt-card">';
    echo '<h3 class="brpt-title"><a class="brpt-card-link" href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title()).'</a></h3>';
    echo '<div class="brpt-meta">'.esc_html(get_post_type()).' • '.esc_html(get_the_date()).'</div>';
    echo '<div class="brpt-ex">'.wp_kses_post(wp_trim_words(get_the_excerpt() ?: wp_strip_all_tags(get_the_content()), 24)).'</div>';
    echo '<div class="brpt-card-footer"></div>';
    echo '</article>';
  }
  echo '</div>';
  wp_reset_postdata();
}
