<?php
/**
 * Neuroaskeza — header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/znak.png">
<meta name="theme-color" content="#14110d">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="nav" id="nav">
  <a class="nav-mark" href="<?php echo esc_url( home_url( '/' ) ); ?>">
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/znak.png" alt="<?php bloginfo( 'name' ); ?> — знак">
    <span>Неуро<b>аскеза</b></span>
  </a>
  <button class="nav-toggle" id="navToggle" aria-label="Мени">
    <span></span><span></span><span></span>
  </button>
  <ul class="nav-links" id="navLinks">
    <li><a href="<?php echo esc_url( home_url( '/#o-sajtu' ) ); ?>">О сајту</a></li>
    <li><a href="<?php echo esc_url( home_url( '/#teme' ) ); ?>">Теме</a></li>
    <li><a href="<?php echo esc_url( home_url( '/#podkast' ) ); ?>">Подкаст</a></li>
    <li><a href="<?php echo esc_url( home_url( '/#pretplata' ) ); ?>">Претплата</a></li>
  </ul>
</nav>
