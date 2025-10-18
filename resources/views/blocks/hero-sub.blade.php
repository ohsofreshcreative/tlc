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
$backgroundImage = !empty($g_hero_sub['image']['url']) ? "
linear-gradient(to bottom, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 50%),
linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 100%),
url({$g_hero_sub['image']['url']})" : '';
@endphp

<!-- hero-offer -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="hero-sub relative {{ $sectionClass }} {{ $section_class }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">

	<div class="__wrapper c-main {{ !empty($g_hero_sub['image']) ? 'pt-60 pb-26' : '' }}">

		<div class="__content w-full sm:w-3/4 relative z-10">
		@if (function_exists('breadcrumbs'))
  {!! breadcrumbs() !!}
@endif

			<h1 data-gsap-element="header" class="text-white m-header">{{ $g_hero_sub['header'] }}</h1>

			@if (!empty($g_hero_sub['txt']))
			<p data-gsap-element="txt" class="text-white">{{ strip_tags($g_hero_sub['txt']) }}</p>
			@endif

			<a data-gsap-element="btn" href="#" class="js-scroll-to-next block m-btn">
				<div class="__arrow bg-primary">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 20 24" fill="none">
						<path d="M10.7383 22.7454L19.4181 14.0655C19.8264 13.6572 19.8265 12.9932 19.4183 12.585C19.0101 12.1768 18.3461 12.1768 17.9378 12.5851L11.0484 19.4744L11.0476 1.99787C11.0474 1.41913 10.5788 0.95049 10 0.950244C9.42127 0.950596 8.95255 1.41932 8.9522 1.99806L8.953 19.4752L2.06463 12.5869C1.65641 12.1786 0.99242 12.1787 0.584122 12.587C0.175823 12.9953 0.175763 13.6593 0.583987 14.0675L9.25988 22.7434C9.666 23.1537 10.33 23.1537 10.7383 22.7454Z" fill="white" />
					</svg>
				</div>
			</a>

			@if (!empty($g_hero_sub['cta']))
			<div class="inline-buttons m-btn">
				<a data-gsap-element="button" class="main-btn left-btn" href="{{ $g_hero_sub['cta']['url'] }}" target="{{ $g_hero_sub['cta']['target'] }}">{{ $g_hero_sub['cta']['title'] }}</a>

				@if (!empty($g_hero_sub['cta2']))
				<a data-gsap-element="button" class="stroke-btn" href="{{ $g_hero_sub['cta2']['url'] }}" target="{{ $g_hero_sub['cta2']['target'] }}">{{ $g_hero_sub['cta2']['title'] }}</a>
				@endif
			</div>
			@endif
		</div>
	</div>

</section>