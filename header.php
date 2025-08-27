<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="brpt-site-hd">
  <div class="brpt-site-inner">
    <a class="brpt-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav class="brpt-nav"><?php wp_nav_menu(['theme_location'=>'primary','container'=>false]); ?></nav>
  </div>
</header>
