@php
// Pobieramy naszą grupę ACF z produktu
$extras = get_field('product_extras') ?: [];
$imgUrl = $extras['image']['url'] ?? '';
$link = $extras['link'] ?? null;

// Klasy sekcji (możesz podpiąć to pod toggles w ACF jeśli chcesz)
$flip = false; $wide = false; $nomt = false; $gap = false;
$lightbg = false; $graybg = false; $whitebg = false; $brandbg = false;

$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';

// Tło jak w Twoim przykładzie (z gradientami)
$backgroundImage = $imgUrl ? "
linear-gradient(to bottom, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 50%),
linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 100%),
url({$imgUrl})
" : '';
@endphp

@if($imgUrl)
<section data-gsap-anim="section"
	class="hero-sub relative h-[90vh] max-h-[940px] {{ $sectionClass }}"
	style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">

	<div class="__wrapper c-main h-full pt-6 pb-26">
		<div class="__content h-full flex flex-col justify-between w-full sm:w-1/2 relative z-10">
			@if (function_exists('woocommerce_breadcrumb'))
			@php
			woocommerce_breadcrumb([
			'delimiter' => '<span class="sep"> / </span>',
			'wrap_before' => '<nav class="woocommerce-breadcrumb" aria-label="Breadcrumb">',
				'wrap_after' => '</nav>',
			'before' => '',
			'after' => '',
			'home' => _x('Strona główna', 'breadcrumb', 'sage'),
			]);
			@endphp
			@endif

			<div>
				<h1 class="text-white text-h2 m-header">{{ get_the_title() }}</h1>
				@if(!empty($link['url']))
				<div class="inline-buttons m-btn">
					<a class="main-btn left-btn" href="">Zapytaj o produkt</a>
					<a class="shop-btn"
						href="{{ esc_url($link['url']) }}"
						target="{{ esc_attr($link['target'] ?? '_self') }}">
						{{ $link['title'] ?? 'Zobacz więcej' }}
					</a>
				</div>
				@endif
			</div>
		</div>
	</div>
</section>
@endif