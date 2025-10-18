@php
/** Dane ACF:
* group: product_slider
* group: swiper_section
* section_header (text)
* section_text (textarea)
* slides (repeater) -> image(arr), header(text), text(textarea)
*/
$sliderGroup = get_field('product_slider');
$swiper = $sliderGroup['swiper_section'] ?? null;

$sectionHeader = $swiper['section_header'] ?? '';
$sectionText = $swiper['section_text'] ?? '';
$slides = $swiper['slides'] ?? [];

@endphp

@if(!empty($slides))
<section class="product-slider bg-dark py-20">
	<div class="__wrapper c-main">
		<div class="__top border-top-p border-dashed pt-20">
			@if($sectionHeader)
			<h2 class="__title text-white">{{ esc_html($sectionHeader) }}</h2>
			@endif
			@if($sectionText)
			<div class="__txt text-white mt-2">{!! nl2br(e($sectionText)) !!}</div>
			@endif
		</div>
		<div class="__wrap mt-10">
			<div class="swiper personalization-swiper !overflow-visible relative">
				<div class="swiper-wrapper">
					@foreach($slides as $i => $item)
					@php
					$img = $item['image'] ?? null;
					$imgId = is_array($img) ? ($img['ID'] ?? null) : (is_numeric($img) ? (int)$img : null);
					$bgUrl = $imgId ? wp_get_attachment_image_url($imgId, 'large') : '';
					$altText = $img['alt'] ?? ($item['header'] ?? get_the_title());
					$title = $item['header'] ?? '';
					$text = $item['text'] ?? '';
					@endphp
					<div class="swiper-slide radius-img border-p-dark img-s">
						<article class="radius-img flex items-end img-s p-8" aria-label="{{ esc_attr($title ?: 'Slajd '.($i+1)) }}"
							style="background-image: url('{{ esc_url($bgUrl) }}'); background-size: cover; background-position: center;">
							<div class="__overlay"></div>
							<div class="__content">
								@if($title)
								<h6 class="__header text-white">{{ esc_html($title) }}</h6>
								@endif
								@if($text)
								<p class="__text text-white mt-2">{!! nl2br(e($text)) !!}</p>
								@endif
							</div>
							<noscript>
								@if($imgId)
								{!! wp_get_attachment_image($imgId, 'large', false, ['alt' => esc_attr($altText), 'class' => '__img-fallback']) !!}
								@endif
							</noscript>
						</article>
					</div>
					@endforeach
				</div>
				<div class="absolute w-full gap-2 top-1/2 transform -translate-y-1/2 z-10">
					<div class="swiper-button-prev rounded-full"></div>
					<div class="swiper-button-next rounded-full"></div>
				</div>
			</div>
		</div>
	</div>
</section>

@endif