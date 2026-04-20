@php
    $show_sidebar = get_field('show_help_sidebar');
@endphp

@if ($show_sidebar)
    @php
        $sidebar_title = get_field('help_sidebar_title') ?: 'Potrzebujesz pomocy?';
        $sidebar_image = get_field('help_sidebar_image');
        $name = get_field('name');
        $sidebar_text = get_field('help_sidebar_text') ?: 'Nasz doradca pomoże Ci znaleźć odpowiedni produkt';
        $sidebar_button = get_field('help_sidebar_button');
    @endphp
    <section data-gsap-anim="section">
        <div data-gsap-element="bubble" 
            x-data="{ isOpen: true }"
            x-show="isOpen"
            x-transition
            class="fixed bottom-8 right-8 z-50 w-full max-w-[320px]"
            style="display: none;">
            <div class="__sidebar relative bg-dark dashed-p-3 radius h-max p-8">

                <button @click="isOpen = false" class="absolute top-4 right-4 text-white/50 hover:text-white" aria-label="Zamknij">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <h6 class="text-white pr-6">{{ $sidebar_title }}</h6>
                
                @if ($sidebar_image)
                    {!! wp_get_attachment_image($sidebar_image, 'full', false, ['class' => 'my-8']) !!}
                @endif
				
				@if ($name)
                <h5 class="text-white">{{ $name }}</h5>
				@endif

                <p class="text-white">{{ $sidebar_text }}</p>

                @if ($sidebar_button)
                    <a class="main-btn m-btn mt-6" href="{{ $sidebar_button['url'] }}" target="{{ $sidebar_button['target'] }}">{{ $sidebar_button['title'] }}</a>
                @endif
            </div>
        </div>
    </section>
@endif