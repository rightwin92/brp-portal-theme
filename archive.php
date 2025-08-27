<?php get_header(); ?>
<main class="brpt-container brpt-archive">
  <header class="brpt-hero"><h1><?php post_type_archive_title(); ?></h1></header>
  <?php
    $q = new WP_Query([
      'post_type'=>get_post_type() ?: ['ask','requirement','give','lead','response'],
      'paged'=>max(1,get_query_var('paged'))
    ]);
    brpt_render_cards($q);
    the_posts_pagination();
  ?>
</main>
<?php get_footer(); ?>
