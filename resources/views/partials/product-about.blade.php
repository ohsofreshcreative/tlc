@php
// Jeśli nie przekażesz $about przez @include, pobierz z ACF
$about = $about ?? get_field('product_about') ?? [];

$image = $about['image'] ?? null;
$header = $about['header'] ?? '';
$content = $about['content'] ?? '';
$link = $about['link'] ?? null;

// ACF link: ['url' => ..., 'title' => ..., 'target' => '_blank'|'' ]
$link_url = $link['url'] ?? '';
$link_title = $link['title'] ?? '';
$link_target = $link['target'] ?? '';
@endphp

@if($image || $header || $content || $link)
<section class="product-about bg-dark relative -spt">
	<div class="__wrapper c-main grid grid-cols-1 lg:grid-cols-2 items-center gap-10">

		@if($image)
		<figure class="__img img-xl order-1 lg:order-2">
			{!! wp_get_attachment_image(
			$image['ID'] ?? $image,
			'large',
			false,
			[
			'class' => '__img radius-img object-cover',
			'loading' => 'lazy',
			'alt' => esc_attr($image['alt'] ?? ($header ?: get_the_title())),
			'sizes' => '(min-width: 1024px) 800px, 100vw',
			]
			) !!}
		</figure>
		@endif

		<div class="__content order-2 lg:order-1">
			@if($header)
			<h4 class="__title m-header text-white">{{ esc_html($header) }}</h4>
			@endif

			@if($content)
			<div class="__text text-white">
				{!! wp_kses_post($content) !!}
			</div>
			@endif

			@if($link_url && $link_title)
			<a data-gsap-element="btn" class="main-btn m-btn" href="{{ esc_url($link_url) }}" target="{{ esc_attr($link_target ?: '_self') }}">
				{{ esc_html($link_title) }}
			</a>
			@endif
		</div>

	</div>
	<img class="absolute top-1/2 -left-1/3" src="/wp-content/uploads/2025/10/sign-reversed.svg" />
	<div class="__glow"></div>
</section>
@endif