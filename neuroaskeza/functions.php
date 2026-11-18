<?php
/**
 * Neuroaskeza — funkcije teme
 */

function neuro_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_image_size( 'neuro-card', 800, 480, true );
}
add_action( 'after_setup_theme', 'neuro_setup' );

function neuro_scripts() {
	wp_enqueue_style(
		'neuro-fonts',
		'https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&family=PT+Serif:ital,wght@0,400;0,700;1,400&family=PT+Mono&display=swap',
		array(), null
	);
	wp_enqueue_style( 'neuro-style', get_stylesheet_uri(), array( 'neuro-fonts' ), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'neuro_scripts' );

function neuro_excerpt_length( $length ) { return 26; }
add_filter( 'excerpt_length', 'neuro_excerpt_length' );

function neuro_excerpt_more( $more ) { return '…'; }
add_filter( 'excerpt_more', 'neuro_excerpt_more' );

/* ---------- Прилагођавач: линкови подкаста и форма претплате ---------- */
function neuro_customize( $wp_customize ) {
	$wp_customize->add_section( 'neuro_links', array(
		'title'    => 'Неуроаскеза — линкови',
		'priority' => 30,
	) );

	$fields = array(
		'neuro_youtube' => 'YouTube канал (URL)',
		'neuro_spotify' => 'Spotify подкаст (URL)',
		'neuro_apple'   => 'Apple Podcasts (URL)',
		'neuro_rss'     => 'RSS подкаста (URL)',
		'neuro_form'    => 'Претплата — action URL форме (нпр. Formspree)',
	);
	foreach ( $fields as $id => $label ) {
		$wp_customize->add_setting( $id, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( $id, array(
			'label'   => $label,
			'section' => 'neuro_links',
			'type'    => 'url',
		) );
	}
}
add_action( 'customize_register', 'neuro_customize' );

/* ---------- Резервне илустрације (кад текст нема истакнуту слику) ---------- */
function neuro_card_svg( $seed ) {
	$svgs = array(
		// кандило
		'<svg viewBox="0 0 400 240" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="400" height="240" fill="#1d1712"/><circle cx="200" cy="128" r="64" fill="none" stroke="#E8A317" stroke-opacity=".14"/><path d="M196 8 h8 M200 4 v12" stroke="#E8A317" stroke-width="2.5" stroke-linecap="round"/><g stroke="#E8A317" stroke-width="1.6" stroke-dasharray="2 5" stroke-linecap="round"><path d="M200 16 L156 118 M200 16 L244 118 M200 16 L200 112"/></g><ellipse cx="200" cy="120" rx="48" ry="9" fill="none" stroke="#E8A317" stroke-width="2.5"/><path d="M152 120 C 152 152 170 168 200 168 C 230 168 248 152 248 120" fill="none" stroke="#E8A317" stroke-width="2.5"/><path d="M200 168 v14 M188 188 h24" stroke="#E8A317" stroke-width="2.5" stroke-linecap="round"/><path d="M200 86 C 209 100 212 108 208 117 C 205 123 201 126 200 127 C 199 126 195 123 192 117 C 188 108 191 100 200 86 Z" fill="#B01818"/><path d="M200 99 C 205 107 206 112 204 117 C 202 121 200 122 200 123 C 200 122 198 121 196 117 C 194 112 195 107 200 99 Z" fill="#F2C14E"/><circle cx="200" cy="108" r="26" fill="none" stroke="#F2C14E" stroke-opacity=".3"/></svg>',
		// оранс са птицама
		'<svg viewBox="0 0 400 240" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="400" height="240" fill="#1d1712"/><circle cx="200" cy="78" r="26" fill="none" stroke="#E8A317" stroke-opacity=".8" stroke-width="2"/><circle cx="200" cy="78" r="12" fill="none" stroke="#E8A317" stroke-width="2.5"/><path d="M200 90 C 186 96 180 108 176 128 L 166 196 L 234 196 L 224 128 C 220 108 214 96 200 90 Z" fill="none" stroke="#E8A317" stroke-width="2.5" stroke-linejoin="round"/><path d="M180 112 C 168 106 156 96 150 84 M150 84 l-2 -9 M150 84 l9 -2" stroke="#E8A317" stroke-width="2.5" fill="none" stroke-linecap="round"/><path d="M220 112 C 232 106 244 96 250 84 M250 84 l2 -9 M250 84 l-9 -2" stroke="#E8A317" stroke-width="2.5" fill="none" stroke-linecap="round"/><path d="M190 196 v-26 M210 196 v-26" stroke="#E8A317" stroke-opacity=".4" stroke-width="1.6"/><g stroke="#B01818" stroke-width="2.4" fill="none" stroke-linecap="round"><path d="M108 56 q8 -9 16 0 M124 56 q8 -9 16 0"/><path d="M268 42 q7 -8 14 0 M282 42 q7 -8 14 0"/><path d="M300 96 q6 -7 12 0 M312 96 q6 -7 12 0"/><path d="M76 118 q6 -7 12 0 M88 118 q6 -7 12 0"/></g></svg>',
		// Јеванђеље
		'<svg viewBox="0 0 400 240" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="400" height="240" fill="#1d1712"/><path d="M118 150 C 150 136 185 136 200 146 C 215 136 250 136 282 150 L 282 96 C 250 82 215 82 200 92 C 185 82 150 82 118 96 Z" fill="none" stroke="#E8A317" stroke-width="2.5" stroke-linejoin="round"/><path d="M200 92 V 146" stroke="#E8A317" stroke-width="2"/><g stroke="#E8A317" stroke-opacity=".45" stroke-width="1.6" stroke-linecap="round"><path d="M134 104 c 18 -7 36 -8 52 -3 M134 116 c 18 -7 36 -8 52 -3 M134 128 c 18 -7 36 -8 52 -3"/></g><path d="M241 96 v34 M227 109 h28" stroke="#B01818" stroke-width="4" stroke-linecap="round"/><path d="M118 150 L 200 162 L 282 150 L 282 158 L 200 171 L 118 158 Z" fill="none" stroke="#E8A317" stroke-width="2" stroke-linejoin="round"/><path d="M318 132 v44" stroke="#EDE3CF" stroke-width="5" stroke-linecap="round"/><path d="M318 110 C 323 118 324 122 322 127 C 320 130 319 131 318 132 C 317 131 316 130 314 127 C 312 122 313 118 318 110 Z" fill="#F2C14E"/><circle cx="318" cy="121" r="14" fill="none" stroke="#F2C14E" stroke-opacity=".3"/></svg>',
		// просфора
		'<svg viewBox="0 0 400 240" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="400" height="240" fill="#1d1712"/><circle cx="200" cy="122" r="66" fill="none" stroke="#E8A317" stroke-width="2.5"/><circle cx="200" cy="122" r="56" fill="none" stroke="#E8A317" stroke-opacity=".35" stroke-width="1.5"/><rect x="170" y="92" width="60" height="60" fill="none" stroke="#B01818" stroke-width="2.5"/><path d="M200 92 v60 M170 122 h60" stroke="#B01818" stroke-width="2.5"/><g font-family="Spectral,serif" font-size="13" font-weight="600" fill="#E8A317" text-anchor="middle"><text x="185" y="112">ІС</text><text x="215" y="112">ХС</text><text x="185" y="142">НИ</text><text x="215" y="142">КА</text></g><g stroke="#E8A317" stroke-opacity=".7" stroke-width="2" fill="none" stroke-linecap="round"><path d="M92 176 C 96 150 100 126 110 104"/><path d="M110 104 l-9 -3 M112 116 l-10 -4 M108 128 l-10 -4 M106 140 l-10 -4 M110 104 l5 -9 M112 116 l6 -9 M108 128 l6 -9"/><path d="M308 176 C 304 150 300 126 290 104"/><path d="M290 104 l9 -3 M288 116 l10 -4 M292 128 l10 -4 M294 140 l10 -4 M290 104 l-5 -9 M288 116 l-6 -9 M292 128 l-6 -9"/></g></svg>',
		// два нимба
		'<svg viewBox="0 0 400 240" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="400" height="240" fill="#1d1712"/><circle cx="178" cy="110" r="58" fill="none" stroke="#E8A317" stroke-width="2.5"/><circle cx="178" cy="110" r="50" fill="none" stroke="#E8A317" stroke-opacity=".3" stroke-width="1.5"/><circle cx="240" cy="142" r="34" fill="none" stroke="#B01818" stroke-width="2.5"/><path d="M240 128 v28 M226 142 h28" stroke="#B01818" stroke-width="2.2" stroke-linecap="round"/><path d="M178 66 l4 9 9 1 -7 7 2 9 -8 -5 -8 5 2 -9 -7 -7 9 -1 Z" fill="#F2C14E"/><g fill="#E8A317" font-family="Spectral,serif" font-size="13" font-weight="600"><text x="106" y="62">МР</text><text x="232" y="86">ѲУ</text></g></svg>',
		// свијећа
		'<svg viewBox="0 0 400 240" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect width="400" height="240" fill="#16110c"/><g fill="#E8A317"><circle cx="84" cy="58" r="1.6" opacity=".6"/><circle cx="138" cy="38" r="1.2" opacity=".4"/><circle cx="318" cy="66" r="1.6" opacity=".6"/><circle cx="282" cy="42" r="1.2" opacity=".4"/><circle cx="62" cy="172" r="1.2" opacity=".35"/><circle cx="346" cy="184" r="1.4" opacity=".45"/></g><circle cx="200" cy="92" r="44" fill="none" stroke="#F2C14E" stroke-opacity=".18"/><circle cx="200" cy="92" r="26" fill="none" stroke="#F2C14E" stroke-opacity=".3"/><path d="M200 64 C 211 82 214 92 209 103 C 205 110 201 113 200 114 C 199 113 195 110 191 103 C 186 92 189 82 200 64 Z" fill="#B01818"/><path d="M200 80 C 206 90 207 96 204 103 C 202 107 201 108 200 109 C 199 108 198 107 196 103 C 193 96 194 90 200 80 Z" fill="#F2C14E"/><path d="M193 118 h14 L 206 196 h-12 Z" fill="none" stroke="#EDE3CF" stroke-width="2.5" stroke-linejoin="round"/><path d="M193 128 c 0 8 -4 10 -4 18" stroke="#EDE3CF" stroke-width="2" fill="none" stroke-linecap="round"/><path d="M172 196 h56 M180 204 h40" stroke="#E8A317" stroke-width="2.5" stroke-linecap="round"/></svg>',
	);
	return $svgs[ $seed % count( $svgs ) ];
}

/* Слаг категорије подкаста — текстови из ње се не приказују у мрежи текстова */
function neuro_podcast_cat_id() {
	$cat = get_category_by_slug( 'podkast' );
	if ( ! $cat ) { $cat = get_category_by_slug( 'подкаст' ); }
	return $cat ? (int) $cat->term_id : 0;
}
