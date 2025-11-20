@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

<!--- hero-about -->

<section data-gsap-anim="section" class="b-hero-about bg-dark relative z-10 -spt {{ $sectionClass }}">
	<div class="__wrapper c-main relative">
		<div class="__content">
			@php
			if (function_exists('woocommerce_breadcrumb')) {
			woocommerce_breadcrumb([
			'wrap_before' => '<nav class="woocommerce-breadcrumb text-white">',
				]);
				}
				@endphp

				<h1 data-gsap-element="header" class="text-h2 text-white w-full md:w-1/2 mt-30">{{ $g_heroabout['title'] }}</h1>

		</div>

		<div class="grid grid-cols-1 md:grid-cols-[1.5fr_2fr] gap-10 mt-18">
			@if ($g_heroabout['image'])
			<img data-gsap-element="image" class="__img radius img-3xl object-cover" src="{{ $g_heroabout['image']['url'] }}" alt="{{ $g_heroabout['image']['alt'] ?? '' }}">
			@endif
			<div class="__img2">
				@if ($g_heroabout['image2'])
				<img data-gsap-element="image" class="__img radius img-2xl w-full object-cover" src="{{ $g_heroabout['image2']['url'] }}" alt="{{ $g_heroabout['image2']['alt'] ?? '' }}">
				@endif
			</div>
		</div>

	</div>

</section>