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
$sectionClass .= $darkbg ? ' section-dark' : '';
@endphp

<section data-gsap-anim="section" class="cards -smt {{ $sectionClass }}">
	<div class="__wrapper c-main">
		<div class="">

			<div class="relative grid grid-cols-1 lg:grid-cols-[1fr_2fr] items-center">
				<div class="__content">
					<h2 class="m-header">{{ strip_tags($g_cards['header']) }}</h2>
					<p>{{ $g_cards['text'] }}</p>
				</div>

				@if (!empty($g_photos))
				<div class="__photos relative z-9">
					@if (!empty($g_photos['image1']))
					<div data-gsap-element="image" class="__img1">
						<img class="object-cover w-full __img img-xl radius-img"
							src="{{ $g_photos['image1']['url'] }}"
							alt="{{ $g_photos['image1']['alt'] ?? '' }}">
					</div>
					@endif
					@if (!empty($g_photos['image2']))
					<div data-gsap-element="image" class="__img2">
						<img class="radius-img"
							src="{{ $g_photos['image2']['url'] }}"
							alt="{{ $g_photos['image2']['alt'] ?? '' }}">
					</div>
					@endif
					@if (!empty($g_photos['image3']))
					<div data-gsap-element="image" class="__img3">
						<img class="radius-img"
							src="{{ $g_photos['image3']['url'] }}"
							alt="{{ $g_photos['image3']['alt'] ?? '' }}">
					</div>
					@endif
				</div>
				@endif

				<div class="__glow">
				</div>
			</div>

			@if (!empty($r_cards))
			@php
			$itemCount = count($r_cards);
			$gridCols = 1;
			if ($itemCount == 2) $gridCols = 2;
			if ($itemCount == 3) $gridCols = 3;
			if ($itemCount >= 4) $gridCols = 4; // Twój dotychczasowy warunek
			$gridClass = $gridCols > 1 ? 'grid-cols-1 lg:grid-cols-' . $gridCols : 'grid-cols-1';
			@endphp

			<div class="grid {{ $gridClass }} gap-8 mt-10">
				@foreach ($r_cards as $item)
				<div class="__card relative bg-dark radius border-p p-8">
					@if (!empty($item['image']['url']))
					<img class="mb-6" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
					@endif
					@if (!empty($item['title']))
					<h6 class="mb-4">{{ $item['title'] }}</h6>
					@endif
					@if (!empty($item['text']))
					<p class="">{{ $item['text'] }}</p>
					@endif
				</div>
				@endforeach
			</div>
			@endif

		</div>
	</div>
</section>