@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';

$heightStyle = match($img_height) {
	'sm'  => 'height:400px',
	'md'  => 'height:600px',
	'lg'  => 'height:800px',
	default => '',
};
@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="b-image mt-16 {{ $customClass }} {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper">

		@if (!empty($g_image['image']))
		<img class="radius-img object-cover w-full __img order1" @if($heightStyle) style="{{ $heightStyle }}" @endif src="{{ $g_image['image']['url'] }}" alt="{{ $g_image['image']['alt'] ?? '' }}">
		@endif

	</div>

</section>