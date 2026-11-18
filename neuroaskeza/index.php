<?php
/**
 * Neuroaskeza — основни шаблон (архиве, претрага)
 */
get_header();
?>
<main>
  <section style="padding-top:8rem">
    <div class="wrap">
      <p class="eyebrow"><?php
        if ( is_search() ) { echo 'Претрага'; }
        elseif ( is_category() ) { echo 'Категорија'; }
        else { echo 'Текстови'; }
      ?></p>
      <h2><?php
        if ( is_search() ) { printf( 'Резултати за: %s', esc_html( get_search_query() ) ); }
        elseif ( is_archive() ) { the_archive_title(); }
        else { echo 'Сви текстови'; }
      ?></h2>
      <div class="cards" style="margin-top:2.5rem">
      <?php $i = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <a class="card" href="<?php the_permalink(); ?>">
          <div class="card-img">
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'neuro-card' ); } else { echo neuro_card_svg( get_the_ID() + $i ); } ?>
          </div>
          <div class="card-body">
            <h3><?php the_title(); ?></h3>
            <p><?php echo esc_html( get_the_excerpt() ); ?></p>
            <span class="card-more">Прочитај текст</span>
          </div>
        </a>
      <?php $i++; endwhile; else : ?>
        <p class="lede">Нема текстова за приказ.</p>
      <?php endif; ?>
      </div>
      <div style="margin-top:2.5rem"><?php the_posts_pagination(); ?></div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
