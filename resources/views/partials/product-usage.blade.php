@php
// Jeśli nie przekażesz $usage przez @include, pobierz z ACF
$usage = $usage ?? get_field('product_usage') ?? [];

$image = $usage['image'] ?? null;
$header = $usage['header'] ?? '';
$content = $usage['content'] ?? '';
$link = $usage['link'] ?? null;

// ACF link: ['url' => ..., 'title' => ..., 'target' => '_blank'|'' ]
$link_url = $link['url'] ?? '';
$link_title = $link['title'] ?? '';
$link_target = $link['target'] ?? '';
@endphp

@if($image || $header || $content || $link)
<section class="product-usage relative -smt">
	<div class="__wrapper c-main grid grid-cols-1 lg:grid-cols-2 items-center gap-10">

		@if($image)
		<figure class="__img object-cover">
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

		<div class="__content">
			@if($header)
			<h2 class="__title m-header">{{ esc_html($header) }}</h2>
			@endif

			@if($content)
			<div class="__text">
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
</section>
@endif