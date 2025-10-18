@php
// Ustawienie klas CSS dla sekcji na podstawie ustawień bloku
$sectionClass = collect([
$nomt ? '!mt-0' : '',
$lightbg ? 'section-light' : '',
$graybg ? 'section-gray' : '',
$whitebg ? 'section-white' : '',
$brandbg ? 'section-brand' : '',
$darkbg ? 'section-dark' : '',
])->filter()->implode(' ');
@endphp

<!--- categories --->

<section
	data-gsap-anim="section"
	@if (!empty($section_id)) id="{{ $section_id }}" @endif
	class="categories relative -smt  {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main relative">
		@if (!empty($g_categories['title']))
		<h2 data-gsap-element="header" class="text-center mb-8">{{ $g_categories['title'] }}</h2>
		@endif

		{{-- Swiper Container --}}
		<div class="swiper offer-swiper !overflow-visible">
			<div class="swiper-wrapper">
				{{-- ZMIANA 4: Pętla iteruje po $categories --}}
				@foreach ($categories as $category)
				<div class="swiper-slide">
					<a href="{{ $category['url'] }}" class="">
						<div class="">
							<img
								src="{{ $category['image_url'] }}"
								alt="{{ $category['name'] }}"
								class="category-card__image __img img-xl w-full object-cover transition-transform duration-300 group-hover:scale-105"
								loading="lazy">
						</div>
						<div class="mt-4">
							<p class="text-center text-lg">{{ $category['name'] }}</p>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>

		<div class="relative flex justify-center gap-2 mt-10">
			<div class="swiper-button-prev rounded-full"></div>
			<div class="swiper-button-next rounded-full"></div>
		</div>

	</div>
</section>