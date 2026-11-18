<?php
/**
 * Neuroaskeza — страница појединачног текста
 */
get_header();
?>

<main>
<?php while ( have_posts() ) : the_post(); ?>
  <article class="single-art">
    <div class="art-meta">
      <?php
      $cats = get_the_category();
      if ( $cats ) {
          echo '<span style="color:var(--zlato)">' . esc_html( $cats[0]->name ) . '</span>';
      }
      ?>
      <span><?php echo esc_html( get_the_date() ); ?></span>
    </div>

    <h1><?php the_title(); ?></h1>

    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="single-thumb"><?php the_post_thumbnail( 'large' ); ?></figure>
    <?php endif; ?>

    <div class="art-body">
      <?php the_content(); ?>
    </div>

    <a class="art-back" href="<?php echo esc_url( home_url( '/#teme' ) ); ?>">Назад на све текстове</a>
  </article>
<?php endwhile; ?>
</main>

<?php get_footer(); ?>
