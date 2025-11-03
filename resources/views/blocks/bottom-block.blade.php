@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';
@endphp

<!-- bottom-block -->

<section data-gsap-anim="section" class="cta-bottom relative overflow-hidden -smt bg-dark {{ $sectionClass }}">
	<div class="c-main grid grid-cols-1 md:grid-cols-2 items-center">

		<div class="__content py-20">
			<h3 data-gsap-element="header" class="text-white mt-4">{{ $bottom['title'] }}</h3>
			<div data-gsap-element="txt" class="mt-2 text-white">
				{!! $bottom['txt'] !!}
			</div>

			<div data-gsap-element="form" class="mt-10">
				{!! do_shortcode($bottom['shortcode']) !!}
			</div>
		</div>

		<picture class="block absolute h-full right-0">
			<img
				src="{{ $bottom['image']['url'] }}"
				alt="{{ $bottom['image']['alt'] }}"
				class="object-cover h-full"
				loading="lazy">
		</picture>

	</div>
</section>