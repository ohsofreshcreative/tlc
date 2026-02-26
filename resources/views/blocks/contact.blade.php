@php
$sectionClass = '';
@endphp

<!--- contact --->



<section data-gsap-anim="section" class="contact bg-gradient relative pt-60 pb-30">

	<div class="__wrapper c-main relative z-2">

		<div class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-10 z-10">
			<div class="__content flex flex-col justify-between">
				<div class="__data">
					<h2 data-gsap-element="header" class="text-white">{!! $g_contact_1['header'] !!}</h2>
	  				
					@if ($g_contact_1['txt'])
					<div data-gsap-element="txt" class="text-white mt-6">
						{!! $g_contact_1['txt'] !!}
					</div>
					
					@endif
					<div data-gsap-element="form" class="mt-10">
						{!! do_shortcode($g_contact_2['shortcode']) !!}
					</div>

				</div>
			</div>
			<!-- <div data-gsap-element="img" class="h-full">
				<img class="h-full rounded-full object-cover" src="{{ $g_contact_1['image']['url'] }}" alt="{{ $g_contact_1['image']['alt'] ?? '' }}">
			</div> -->
		</div>

	</div>

</section>