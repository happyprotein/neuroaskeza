<?php
/**
 * Neuroaskeza — статичка страница
 */
get_header();
?>
<main>
<?php while ( have_posts() ) : the_post(); ?>
  <article class="single-art">
    <h1><?php the_title(); ?></h1>
    <div class="art-body"><?php the_content(); ?></div>
  </article>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
