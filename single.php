<?php get_header(); ?>
<main class="brpt-container">
  <article class="brpt-single">
    <h1><?php the_title(); ?></h1>
    <div class="brpt-single-meta"><?php echo esc_html(get_post_type()); ?> • <?php echo esc_html(get_the_date()); ?></div>
    <div class="brpt-content"><?php while(have_posts()){ the_post(); the_content(); } ?></div>
  </article>
</main>
<?php get_footer(); ?>
