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

@if (!empty($service_tabs))
<section @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-services -spt -smt {{ $sectionClass }}">
    <div class="c-main">
        @if ($title)
            <h2 class="text-center m-header">{{ $title }}</h2>
        @endif

        <div x-data="{ activeTab: {{ $service_tabs[0]['term']->term_id }} }" class="mt-12">
            {{-- Przyciski zakładek --}}
            <div class="__tabs flex justify-center gap-4 bg-dark rounded-full p-4">
                @foreach ($service_tabs as $tab)
                    <button
                        @click="activeTab = {{ $tab['term']->term_id }}"
                        :class="{ 'border-primary text-primary': activeTab === {{ $tab['term']->term_id }}, 'cursor-pointer border-transparent !bg-transparent text-white hover:text-gray-700 hover:border-gray-300': activeTab !== {{ $tab['term']->term_id }} }"
                        class="bg-white text-white text-sm whitespace-nowrap py-4 px-6 rounded-full border-solid-p"
                    >
                        {{ $tab['term']->name }}
                    </button>
                @endforeach
            </div>

            {{-- Treść zakładek --}}
            <div class="mt-10">
                @foreach ($service_tabs as $tab)
                    <div x-show="activeTab === {{ $tab['term']->term_id }}" x-cloak>
                        <div class="">
                            @foreach ($tab['posts'] as $service_post)
                                <div class="__card grid grid-cols-1 lg:grid-cols-[1.5fr_1.4fr] items-center gap-10 bg-white radius border-p p-6">
                                    @if (has_post_thumbnail($service_post->ID))
                                        <a href="{{ get_permalink($service_post->ID) }}">
                                            <img src="{{ get_the_post_thumbnail_url($service_post->ID, 'medium_large') }}" alt="{{ $service_post->post_title }}" class="img-l rounded-xl">
                                        </a>
                                    @endif
                                    <div class="p-6">
                                        <h4 class="text-xl font-bold mb-2">
                                            <a href="{{ get_permalink($service_post->ID) }}">{{ $service_post->post_title }}</a>
                                        </h4>
                                        <div class="text-gray-600 text-sm mb-4 prose max-w-none">
                                            {!! get_field('short_description', $service_post->ID) !!}
                                        </div>
                                        <a href="{{ get_permalink($service_post->ID) }}" class="underline-btn">
                                            Dowiedz się więcej
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@elseif (is_admin())
    <p>Blok Usługi: Dodaj wpisy do CPT "Usługi" i przypisz je do "Kategorii Usług", aby wyświetlić je w zakładkach.</p>
@endif