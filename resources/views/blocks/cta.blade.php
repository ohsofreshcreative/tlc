@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

<!--- cta --->

<section data-gsap-anim="section" class="cta pt-10 {{ $sectionClass }}">
	<div data-gsap-element="wrapper" class="__wrapper">

		<div class="grid grid-cols-1 md:grid-cols-2 items-center gap-10 rounded-xl bg-p-bright border-p-light p-4">
			<div class="__img">
				<img src="{{ $cta['image']['url'] }}" alt="{{ $cta['image']['alt'] ?? ($cta['title'] ?? '') }}" class="w-full h-full object-cover radius-img" loading="lazy">
			</div>

			<div class="__content">
				@if ($cta['title'])
				<h6 data-gsap-element="header" class="">{{ $cta['title'] }}</h6>
				@endif

				@if (!empty($cta['button']))
				<a data-gsap-element="btn" class="main-btn m-btn mt-6 inline-flex" href="{{ $cta['button']['url'] }}">
					{{ $cta['button']['title'] }}
				</a>
				@endif
			</div>
		</div>

	</div>
</section>