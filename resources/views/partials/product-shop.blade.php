@php
// Jeśli nie przekażesz $shop przez @include, pobierz z ACF
$shop = $shop ?? get_field('product_shop') ?? [];

$image = $shop['image'] ?? null;
$icon = $shop['icon'] ?? null;
$header = $shop['header'] ?? '';
$content = $shop['content'] ?? '';
$link = $shop['link'] ?? null;

// ACF link: ['url' => ..., 'title' => ..., 'target' => '_blank'|'' ]
$link_url = $link['url'] ?? '';
$link_title = $link['title'] ?? '';
$link_target = $link['target'] ?? '';
@endphp

@if($image || $header || $content || $link)
<section class="product-shop bg-dark relative -smt">
	<div class="__wrapper grid grid-cols-1 lg:grid-cols-2 items-center gap-10">

		@if($image)
		<figure class="__img img-2xl !mb-0">
			{!! wp_get_attachment_image(
			$image['ID'] ?? $image,
			'large',
			false,
			[
			'class' => '__img object-cover',
			'loading' => 'lazy',
			'alt' => esc_attr($image['alt'] ?? ($header ?: get_the_title())),
			'sizes' => '(min-width: 1024px) 800px, 100vw',
			]
			) !!}
		</figure>
		@endif

		<div class="__content w-11/12 md:w-3/4 mx-auto">
		
			@if($icon)
			<img src="{{ esc_url($icon['url']) }}" alt="{{ esc_attr($icon['alt'] ?? '') }}" class="__icon mb-4" />
			@endif

			@if($header)
			<h3 class="__title primary m-header">{{ esc_html($header) }}</h3>
			@endif

			@if($content)
			<div class="__text text-white">
				{!! wp_kses_post($content) !!}
			</div>
			@endif

			@if($link_url && $link_title)
			<a data-gsap-element="btn" class="shop-btn m-btn" href="{{ esc_url($link_url) }}" target="{{ esc_attr($link_target ?: '_self') }}">
				{{ esc_html($link_title) }}
			</a>
			@endif
		</div>

	</div>
</section>
@endif