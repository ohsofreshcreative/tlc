@php
$sectionClass = '';
$sectionClass .= !empty($flip) ? ' order-flip' : '';
$sectionClass .= !empty($wide) ? ' wide' : '';
$sectionClass .= !empty($nomt) ? ' !mt-0' : '';
$sectionClass .= !empty($gap) ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
    $sectionClass .= ' ' . $background;
}
@endphp

{{-- Główny kontener dla logiki Alpine.js --}}
<div x-data="{ modalVisible: false, image: '', title: '', description: '', link: '' }">
   <section 
    data-gsap-anim="section" 
    @if(!empty($block_section_id)) id="{{ $block_section_id }}" @endif 
    class="b-brands -smt relative {{ $sectionClass }} {{ $block_section_class ?? '' }}"
>
        <div class="__wrapper c-main">
            <div class="">

                {{-- Zmieniono $r_brands na $brands_data --}}
                @if(!empty($brands_data))
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mt-10">
                    {{-- Zmieniono $r_brands na $brands_data --}}
                    @foreach ($brands_data as $item)
                    <div class="__card relative border-p bg-white flex items-center justify-center aspect-square h-48 p-4">
                        @if (!empty($item['image']['url']))
                        <button 
                            type="button" 
                            class="cursor-pointer"
                            x-on:click="
                                modalVisible = true;
                                image = '{{ $item['image']['url'] }}';
                                title = {{ json_encode($item['title'] ?? '') }};
                                description = {{ json_encode($item['txt'] ?? '') }};
                                link = '{{ $item['link'] ?? '' }}';
                            "
                        >
                            <img class="" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
                        </button>
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                    @if (is_admin())
                        <div class="text-center p-8 bg-yellow-100 border border-yellow-400 text-yellow-800">
                            <p><strong>Blok "Marki" jest pusty.</strong><br>Dodaj przynajmniej jedną markę w zakładce "Marki" w menu panelu administratora.</p>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </section>

    {{-- Modal (bez zmian) --}}
    <div 
        class="fixed right-0 top-0 z-[4000] h-screen w-full max-w-md bg-white shadow-lg backdrop-blur-sm transition-transform duration-300"
        x-show="modalVisible"
        x-trap.inert.noscroll="modalVisible"
        x-transition:enter="transform ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform ease-in duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        style="display: none;"
        x-on:keydown.escape.window="modalVisible = false"
    >
        <div class="p-8 relative h-full">
            <button type="button" @click="modalVisible = false" class="absolute top-4 right-4 cursor-pointer text-gray-500 hover:text-gray-800">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
            
            <div class="flex flex-col h-full">

                <h5 class="mt-12" x-text="title"></h5>
                <div class="bg-white w-56 h-32 mt-6 mb-6 flex items-center justify-center">
                    <img x-bind:src="image" alt="" class="max-w-full max-h-full object-contain">
                </div>

                <div class="overflow-y-auto mb-4" x-html="description"></div>

                <div class="">
                    <a x-show="link" x-bind:href="link" target="_blank" rel="noopener noreferrer" class="main-btn m-btn">
                        Strona producenta
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 bg-black/10 backdrop-blur-sm z-[3999]" x-show="modalVisible" @click="modalVisible = false" x-transition.opacity></div>
</div>