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

<!--- logos -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-logos relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative">
		<h4 data-gsap-element="header" class="w-full md:w-1/2">{{ $g_logos['title'] }}</h4>
	</div>

	@if (!empty($g_logos['gallery']))
	<div
		class="__logos mt-20 select-none"
		x-data="logosSlider()"
		:class="{ 'cursor-grabbing': isDragging, 'cursor-grab': !isDragging }"
		@pointerdown="startDrag"
		@pointermove="onDrag"
		@pointerup="endDrag"
		@pointercancel="endDrag"
	>
		<div class="__wrapper" x-ref="wrapper">
			@foreach ($g_logos['gallery'] as $image)
			<div class="__slide">
				<img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" class="h-12 w-auto pointer-events-none">
			</div>
			@endforeach
			@foreach ($g_logos['gallery'] as $image)
			<div class="__slide">
				<img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" class="h-12 w-auto pointer-events-none">
			</div>
			@endforeach
		</div>
	</div>
	@endif

</section>

<script>
function logosSlider() {
	return {
		isDragging: false,
		startX: 0,
		originX: 0,

		startDrag(e) {
			const w = this.$refs.wrapper;
			const matrix = new DOMMatrix(getComputedStyle(w).transform);
			this.originX = matrix.m41;
			w.style.animation = 'none';
			w.style.transform = `translateX(${this.originX}px)`;
			this.isDragging = true;
			this.startX = e.clientX;
			this.$el.setPointerCapture(e.pointerId);
		},

		onDrag(e) {
			if (!this.isDragging) return;
			const delta = e.clientX - this.startX;
			this.$refs.wrapper.style.transform = `translateX(${this.originX + delta}px)`;
		},

		endDrag() {
			if (!this.isDragging) return;
			this.isDragging = false;
			const w = this.$refs.wrapper;
			const currentX = new DOMMatrix(getComputedStyle(w).transform).m41;
			const halfWidth = w.scrollWidth / 2;
			// Normalize into the [−halfWidth, 0] range for seamless loop resume
			let normalized = currentX % halfWidth;
			if (normalized > 0) normalized -= halfWidth;
			const delay = -(Math.abs(normalized) / halfWidth * 120);
			w.style.transform = '';
			w.style.animation = `logos-slider 120s ${delay}s linear infinite`;
		},
	}
}
</script>