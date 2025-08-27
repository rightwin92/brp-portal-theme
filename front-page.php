<?php /* Front Page (executes page shortcodes; falls back to portal UI) */ 
get_header(); 

// Get current front-page content
$page_id   = get_queried_object_id();
$page_html = $page_id ? get_post_field('post_content', $page_id) : '';

// Helper: render page content as WP would (runs shortcodes)
function brpt_render_page_content($content){
  if (!function_exists('has_shortcode')) return apply_filters('the_content', $content);
  // If user placed our shortcodes, render their content as-is
  if (has_shortcode($content, 'brp_portal') || has_shortcode($content, 'brp_submit') || has_shortcode($content, 'brp_dashboard')){
    return apply_filters('the_content', $content);
  }
  // If no BRP shortcodes found, return empty to trigger fallback UI below
  return '';
}

$rendered = $page_html ? brpt_render_page_content($page_html) : '';
?>
<main class="brpt-container brpt-full">
  <section class="brpt-hero">
    <h1><?php bloginfo('name'); ?></h1>
    <p class="brpt-sub">Biz Referrals Portal — Ask • Requirement • Give • Lead • Response</p>
  </section>

  <?php if (!empty($rendered)) : ?>
    <!-- Render the page content (shortcodes executed) -->
    <section class="brpt-content">
      <?php echo $rendered; ?>
    </section>
  <?php else: ?>
    <!-- Fallback UI: show the portal even if page has no shortcodes -->
    <section class="brpt-tabs-wrap"><?php echo do_shortcode('[brp_portal]'); ?></section>
    <section class="brpt-submit-wrap"><?php echo do_shortcode('[brp_submit]'); ?></section>
  <?php endif; ?>

  <section class="brpt-latest">
    <header class="brpt-sec-h"><h2>Latest Opportunities</h2></header>
    <div class="brpt-filterbar">
      <select id="brpt-type"><option value="">All Types</option><option value="ask">Ask</option><option value="requirement">Requirement</option><option value="give">Give</option><option value="lead">Lead</option></select>
      <input id="brpt-city" type="text" placeholder="Filter by city">
      <input id="brpt-q" type="text" placeholder="Search text">
      <button id="brpt-apply">Apply</button>
    </div>
    <?php
      // Show a list even if page content was used
      $q = new WP_Query(['post_type'=>['ask','requirement','give','lead'],'posts_per_page'=>20,'post_status'=>'publish']);
      if (function_exists('brpt_render_cards')) { brpt_render_cards($q); }
      else {
        // Minimal fallback if helper missing
        if ($q->have_posts()){ echo '<ul>'; while($q->have_posts()){ $q->the_post();
          echo '<li><a href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title()).'</a></li>';
        } echo '</ul>'; } wp_reset_postdata();
      }
    ?>
  </section>
</main>
<?php get_footer(); ?>
