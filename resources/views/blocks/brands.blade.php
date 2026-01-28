@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}
@endphp

<!--- brands --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-brands -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main">
		<div class="">

			<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mt-10">
				@foreach ($r_brands as $item)
				<div class="__card relative border-p bg-white flex items-center justify-center aspect-square p-4">
					@if (!empty($item['image']['url']))
					@if (!empty($item['link']))
					<a href="{{ $item['link'] }}">
						<img class="" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
					</a>
					@else
					<img class="" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
					@endif
					@endif
				</div>
				@endforeach
			</div>

		</div>
	</div>
</section>