<?php
/**
 * Neuroaskeza — насловна (једнострана)
 */
get_header();
$tpl     = get_template_directory_uri();
$pod_cat = neuro_podcast_cat_id();
?>

<header class="hero" id="vrh">
  <div class="hero-row">
    <div class="hero-left">
      <div class="hero-nimbus">
        <img class="hero-logo" src="<?php echo esc_url( $tpl ); ?>/images/logo.png" alt="Неуроаскеза — логотип: мозак исцртан златом и назив исписан уставним писмом">
      </div>
      <p class="hero-tag">Гдје се <em>тиховање отаца</em> сусреће са <strong>савременом психологијом</strong> — простор за ум који тражи и срце које се моли.</p>
      <p class="hero-verse">Срце чисто сазижди во мнѣ, Боже · Пс 50,12</p>
    </div>

    <div class="monk-scene" aria-label="Цртеж монаха који се моли са бројаницом">
      <div>
        <div class="monk-frame">
          <div class="pray-bubbles" aria-hidden="true">
            <span class="bdot d1"></span>
            <span class="bdot d2"></span>
            <span class="bdot d3"></span>
            <span class="bubble main">Господе Исусе Христе,<br>помилуј ме</span>
          </div>
          <img class="monk-base" src="<?php echo esc_url( $tpl ); ?>/images/monah.png" alt="Монах погнуте главе моли се на столици држећи бројаницу">
          <img class="monk-rope" src="<?php echo esc_url( $tpl ); ?>/images/brojanica.png" alt="" aria-hidden="true">
        </div>
        <p class="monk-caption">Молитва срца · непрестано</p>
      </div>
    </div>
  </div>
  <div class="hero-scroll" aria-hidden="true"></div>
</header>

<main>

<!-- ============ О САЈТУ ============ -->
<section id="o-sajtu">
  <div class="wrap">
    <p class="eyebrow reveal">О сајту</p>
    <h2 class="reveal d1">Двије хиљаде година искуства о души.<br>Један <span class="gold">ум</span>, једно <span class="crims">срце</span>.</h2>
    <p class="lede reveal d2">Православна аскетска традиција вијековима је пажљиво описивала унутрашњи живот човјека — помисли, страсти, пажњу, тиховање. Савремена психологија истим питањима прилази другим језиком. <strong style="color:var(--pergament);font-weight:500">Неуроаскеза</strong> постоји да та два језика преводи један у други — не да их изједначи, него да их доведе у разговор.</p>

    <div class="meet">
      <div class="meet-col theo reveal d1">
        <h3>Предање Цркве</h3>
        <p>Искуство подвижника од пустиње до данас — психологија прије психологије.</p>
        <?php
        $theo_q = new WP_Query( array(
            'posts_per_page' => -1,
            'category_name'  => 'predanje',
            'orderby'        => 'date',
            'order'          => 'ASC',
            'no_found_rows'  => true,
        ) );
        if ( $theo_q->have_posts() ) : ?>
        <ul>
          <?php while ( $theo_q->have_posts() ) : $theo_q->the_post(); ?>
          <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
          <?php endwhile; wp_reset_postdata(); ?>
        </ul>
        <?php else : ?>
        <ul>
          <li>Учење о помислима — Евагрије Понтијски и Добротољубље</li>
          <li>Тиховање и Исусова молитва — исихастичка пракса пажње</li>
          <li>Страсти и врлине као динамика душе</li>
          <li>Личност и заједница — од Свете Тројице до породице</li>
        </ul>
        <?php endif; ?>
      </div>
      <div class="meet-axis" aria-hidden="true">
        <div class="line"></div>
        <div class="cross">✛</div>
        <div class="line"></div>
      </div>
      <div class="meet-col psy reveal d2">
        <h3>Савремена психологија</h3>
        <p>Шта наука о уму данас зна — и гдје ћути пред тајном личности.</p>
        <?php
        $psy_q = new WP_Query( array(
            'posts_per_page' => -1,
            'category_name'  => 'psihologija',
            'orderby'        => 'date',
            'order'          => 'ASC',
            'no_found_rows'  => true,
        ) );
        if ( $psy_q->have_posts() ) : ?>
        <ul>
          <?php while ( $psy_q->have_posts() ) : $psy_q->the_post(); ?>
          <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
          <?php endwhile; wp_reset_postdata(); ?>
        </ul>
        <?php else : ?>
        <ul>
          <li>Пажња, навика и неуропластичност</li>
          <li>Когнитивне дисторзије и борба са помислима</li>
          <li>Психологија привржености и однос са Богом као Оцем</li>
          <li>Туга, анксиозност и смисао — клиничко и духовно</li>
        </ul>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ ТЕМЕ / ТЕКСТОВИ ============ -->
<section id="teme" style="background:var(--noc2);border-top:1px solid var(--linija)">
  <div class="wrap">
    <p class="eyebrow reveal">Из писаонице</p>
    <h2 class="reveal d1">Текстови који спајају <span class="gold">олтар</span> и <span class="crims">ординацију</span></h2>
    <p class="lede reveal d2">Сваки текст полази од стварног питања — туге, расијаности, навике, односа — и тражи одговор и у светоотачком предању и у савременим истраживањима.</p>

    <div class="cards">
    <?php
    $args = array(
        'posts_per_page'      => 6,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    );
    if ( $pod_cat ) { $args['category__not_in'] = array( $pod_cat ); }
    $q = new WP_Query( $args );
    $i = 0;
    if ( $q->have_posts() ) :
        while ( $q->have_posts() ) : $q->the_post();
            $delay = array( '', ' d1', ' d2' )[ $i % 3 ];
            $cats  = get_the_category();
            $cat_name = $cats ? esc_html( $cats[0]->name ) : 'Текст';
            $cat_class = ( $i % 2 === 1 ) ? 'card-cat red' : 'card-cat';
    ?>
      <a class="card reveal<?php echo esc_attr( $delay ); ?>" href="<?php the_permalink(); ?>">
        <div class="card-img">
          <?php
          if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'neuro-card' );
          } else {
              echo neuro_card_svg( get_the_ID() + $i ); // резервна иконографска илустрација
          }
          ?>
        </div>
        <div class="card-body">
          <span class="<?php echo esc_attr( $cat_class ); ?>"><?php echo $cat_name; ?><?php if ( is_sticky() ) : ?><span class="badge">Истакнуто</span><?php endif; ?></span>
          <h3><?php the_title(); ?></h3>
          <p><?php echo esc_html( get_the_excerpt() ); ?></p>
          <span class="card-more">Прочитај текст</span>
        </div>
      </a>
    <?php
            $i++;
        endwhile;
        wp_reset_postdata();
    else :
    ?>
      <p class="lede">Текстови стижу ускоро — први се већ пишу.</p>
    <?php endif; ?>
    </div>
  </div>
</section>

<!-- ============ ПОДКАСТ ============ -->
<section id="podkast" class="podcast">
  <div class="wrap">
    <p class="eyebrow reveal">Подкаст</p>
    <h2 class="reveal d1">Разговори у којима <span class="gold">богослов</span> и <span class="crims">психолог</span> сједе за истим столом</h2>
    <p class="lede reveal d2">Подкаст „Неуроаскеза" — мирни, дуги разговори са свештеницима, психолозима, психијатрима и научницима о души, уму и спасењу. Без журбе, без сензације.</p>

    <div class="pod-grid">
      <div class="pod-visual reveal d1">
        <div class="pod-disc" title="Подкаст Неуроаскеза">
          <div class="pod-wave"></div>
          <div class="pod-wave w2"></div>
          <div class="pod-wave w3"></div>
          <img src="<?php echo esc_url( $tpl ); ?>/images/znak.png" alt="Знак подкаста — мозак исцртан златом">
        </div>
      </div>
      <div class="reveal d2">
        <?php
        $eps = $pod_cat ? new WP_Query( array(
            'posts_per_page' => 4,
            'cat'            => $pod_cat,
        ) ) : false;
        if ( $eps && $eps->have_posts() ) :
            $total = (int) $eps->found_posts;
            $n = $total;
        ?>
        <ul class="episodes">
          <?php while ( $eps->have_posts() ) : $eps->the_post(); ?>
          <li class="ep" onclick="location.href='<?php echo esc_url( get_permalink() ); ?>'">
            <span class="ep-num">Еп. <?php echo esc_html( str_pad( $n, 2, '0', STR_PAD_LEFT ) ); ?></span>
            <span class="ep-title"><?php the_title(); ?>
              <small><?php echo esc_html( get_the_excerpt() ); ?></small>
            </span>
            <span class="ep-play">▶</span>
          </li>
          <?php $n--; endwhile; wp_reset_postdata(); ?>
        </ul>
        <?php else : ?>
        <p class="pod-empty">Прве епизоде су у припреми. <em>(Савјет уреднику: направи категорију са слагом <strong>podkast</strong> и објави епизоде у њој — појавиће се овдје саме.)</em></p>
        <?php endif; ?>

        <div class="pod-platforms">
          <?php
          $platforms = array(
              'YouTube'        => get_theme_mod( 'neuro_youtube' ),
              'Spotify'        => get_theme_mod( 'neuro_spotify' ),
              'Apple Podcasts' => get_theme_mod( 'neuro_apple' ),
              'RSS'            => get_theme_mod( 'neuro_rss' ),
          );
          foreach ( $platforms as $name => $url ) :
              if ( $url ) :
          ?>
          <a class="chip" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $name ); ?></a>
          <?php endif; endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ ЦИТАТ + ЦАРИНИК ============ -->
<section>
  <div class="quote reveal">
    <blockquote>Стекни мир у себи, и хиљаде око тебе ће се спасити.</blockquote>
    <cite>Преподобни Серафим Саровски</cite>
  </div>
  <div class="carinik-wrap reveal d1">
    <img class="carinik-img" src="<?php echo esc_url( $tpl ); ?>/images/carinik.png" alt="Икона цариника погнуте главе, са ореолом, обасјаног зраком свјетлости одозго — смирење и покајање">
    <p class="carinik-caption">„Боже, милостив буди мени грешноме“ · Лк 18,13</p>
  </div>
</section>

<!-- ============ ПРЕТПЛАТА ============ -->
<section id="pretplata" style="padding-top:0">
  <div class="wrap">
    <div class="subscribe-box reveal">
      <div>
        <p class="eyebrow" style="margin-bottom:.8rem">Писмо читаоцима</p>
        <h2 style="font-size:clamp(1.5rem,3vw,2.1rem);margin-bottom:.6rem">Једно писмо мјесечно.<br>Без буке.</h2>
        <p class="lede" style="font-size:1rem">Нови текстови, нове епизоде подкаста и по једна мисао отаца за тај мјесец — право у твоје сандуче.</p>
      </div>
      <?php $form_action = get_theme_mod( 'neuro_form' ); ?>
      <?php if ( $form_action ) : ?>
      <form class="sub-form" action="<?php echo esc_url( $form_action ); ?>" method="POST">
        <input type="email" name="email" required placeholder="твоја@адреса.рс" aria-label="Адреса е-поште">
        <button class="btn" type="submit">Пријави се</button>
      </form>
      <?php else : ?>
      <form class="sub-form" onsubmit="event.preventDefault(); this.querySelector('input').value=''; alert('Хвала! Пријава је забиљежена.');">
        <input type="email" required placeholder="твоја@адреса.рс" aria-label="Адреса е-поште">
        <button class="btn" type="submit">Пријави се</button>
      </form>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ============ БЛАГОСЛОВ ============ -->
<section class="blagoslov" aria-label="Благослов">
  <div class="hand-wrap reveal">
    <img class="hand-img" src="<?php echo esc_url( $tpl ); ?>/images/desnica.png" alt="Десница Господња која благосиља из облака — фрагмент старе иконе">
    <p class="hand-caption">Десница Господња твори силу · Пс 117,16</p>
  </div>
</section>

</main>

<?php get_footer(); ?>
