<?php /* Front Page App */ get_header(); ?>
<main class="brpt-container brpt-full">
  <section class="brpt-hero"><h1>Biz Referrals Portal</h1><p class="brpt-sub">Ask • Requirement • Give • Lead • Response</p></section>

  <section class="brpt-tabs-wrap"><?php echo do_shortcode('[brp_portal]'); ?></section>
  <section class="brpt-submit-wrap"><?php echo do_shortcode('[brp_submit]'); ?></section>

  <section class="brpt-latest">
    <header class="brpt-sec-h"><h2>Latest Opportunities</h2></header>
    <div class="brpt-filterbar">
      <select id="brpt-type"><option value="">All Types</option><option value="ask">Ask</option><option value="requirement">Requirement</option><option value="give">Give</option><option value="lead">Lead</option></select>
      <input id="brpt-city" type="text" placeholder="Filter by city">
      <input id="brpt-q" type="text" placeholder="Search text">
      <button id="brpt-apply">Apply</button>
    </div>
    <?php
      $q=new WP_Query(['post_type'=>['ask','requirement','give','lead'],'posts_per_page'=>20,'post_status'=>'publish']);
      brpt_render_cards($q);
    ?>
  </section>
</main>
<?php get_footer(); ?>
