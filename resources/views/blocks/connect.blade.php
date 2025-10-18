@php
$sectionClass = '';
@endphp

@php
$backgroundImage = !empty($g_connect_1['image']['url']) ? "
linear-gradient(to bottom, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 50%),
linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 100%),
url({$g_connect_1['image']['url']})" : '';
@endphp

<!--- connect --->

<section data-gsap-anim="section" class="connect bg-s-lighter relative -smt pt-10 pb-30 {{ $sectionClass }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">

	<div class="__wrapper c-main relative z-2">

		<div class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-10 z-10">
			<div class="__content w-full lg:w-11/12 flex flex-col justify-between">
				<div class="__data">
					<h2 data-gsap-element="header" class="text-white">{!! $g_connect_1['header'] !!}</h2>

					<div class="flex flex-col md:flex-row gap-4 border-top-p pt-8 mt-8">
						<a href="tel:{{ preg_replace('/\s+/', '', $g_connect_1['phone']) }}" class="__phone">{{ $g_connect_1['phone'] }}</a>
						<a href="mailto:{{ $g_connect_1['email'] }}" class="__mail">{{ $g_connect_1['email'] }}</a>
					</div>

					<div class="mt-4 text-white border-top-p pt-8 mt-8">
						<b class="text-lg">{!! $g_connect_1['name'] !!}</b>
						<div class="flex flex-col md:flex-row gap-4 mt-2">
							<p>{!! $g_connect_1['address'] !!}</p>
							<p>{!! $g_connect_1['data'] !!}</p>
						</div>
					</div>

				</div>
			</div>

			<div data-gsap-element="form" class="__form bg-dark  radius overflow-hidden p-10 mt-10">
				<h5 class="relative text-white mb-6 z-10">Formularz kontaktowy</h5>
				<div class="relative z-10">{!! do_shortcode($g_connect_2['shortcode']) !!}</div>
				<div class="__glow1"></div>
				<div class="__glow2"></div>
			</div>
		</div>
	</div>

</section>