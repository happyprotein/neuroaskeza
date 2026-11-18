<?php
/**
 * Neuroaskeza — footer
 */
$tpl = get_template_directory_uri();
?>

<footer>
  <img src="<?php echo esc_url( $tpl ); ?>/images/znak.png" alt="<?php bloginfo( 'name' ); ?>">
  <p>Неуроаскеза · Православна теологија и психологија у разговору</p>
  <p class="ps">Слава Богу за све · <?php echo esc_html( date_i18n( 'Y' ) ); ?></p>
</footer>

<script>
// навигација — сјенка при скролу
var nav = document.getElementById('nav');
addEventListener('scroll', function(){ nav.classList.toggle('scrolled', scrollY > 30); }, {passive:true});

// мобилни мени
var toggle = document.getElementById('navToggle');
var links = document.getElementById('navLinks');
toggle.addEventListener('click', function(){
  toggle.classList.toggle('open');
  links.classList.toggle('open');
});
links.querySelectorAll('a').forEach(function(a){ a.addEventListener('click', function(){
  toggle.classList.remove('open'); links.classList.remove('open');
});});

// откривање при скролу
var io = new IntersectionObserver(function(entries){
  entries.forEach(function(e){ if (e.isIntersecting) { e.target.classList.add('on'); io.unobserve(e.target); } });
}, {threshold:.15});
document.querySelectorAll('.reveal').forEach(function(el){ io.observe(el); });
</script>
<?php wp_footer(); ?>
</body>
</html>
