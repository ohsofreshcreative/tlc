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

@php
$backgroundImage = !empty($bottom['image']['url']) ? "linear-gradient(0deg, rgba(43, 23, 106, 1) 0%, rgba(43, 23, 106, 0.10) 100%), url({$bottom['image']['url']})" : '';
@endphp

<!-- bottom-block -->

<section data-gsap-anim="section" class="cta-bottom relative overflow-hidden -smt bg-dark {{ $sectionClass }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: 50%;">
	<div class="c-main py-40">
		<div class="w-full md:w-1/2">
			<p class="subtitle-s">{{ strip_tags($bottom['subtitle']) }}</p>
			<h2 data-gsap-element="header" class="text-white mt-4">{{ $bottom['title'] }}</h2>
			<div data-gsap-element="txt" class="mt-2 text-white">
				{!! $bottom['txt'] !!}
			</div>
			@if (!empty($bottom['button']))
			<a data-gsap-element="btn" class="second-btn m-btn" href="{{ $bottom['button']['url'] }}">{{ $bottom['button']['title'] }}</a>
			@endif
		</div>

		<!-- 	<div class="flex flex-col mt-10 gap-4">
			<a data-gsap-element="phone" class="__phone flex items-center text-2xl text-white" href="tel:{{ $bottom['phone'] }}">{{ $bottom['phone'] }}</a>
			<a data-gsap-element="mail" class="__mail flex items-center text-2xl text-white" href="mailto:{{ $bottom['mail'] }}">{{ $bottom['mail'] }}</a>
		</div> -->

	</div>
</section>