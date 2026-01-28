@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
    $sectionClass .= ' ' . $background;
}

// Przygotuj dane katalogów
$catalogues_data = [];
if (!empty($r_catalogues)) {
    foreach ($r_catalogues as $item) {
        $thumbnail_url = !empty($item['file']['ID']) ? \App\get_pdf_thumbnail_url($item['file']['ID']) : '';
        $catalogues_data[] = [
            'title' => $item['title'] ?? '',
            'file_url' => $item['file']['url'] ?? '',
            'thumbnail' => $thumbnail_url,
            'producer' => trim($item['producer'] ?? ''),
            'product_group' => trim($item['product_group'] ?? ''),
            'industry' => trim($item['industry'] ?? ''),
        ];
    }
}

// Zbierz unikalne wartości dla filtrów
function get_unique_values($catalogues, $key) {
    $values = array_map(function($cat) use ($key) {
        return $cat[$key];
    }, $catalogues);
    $values = array_filter($values, function($v) {
        return !empty($v) && trim($v) !== '';
    });
    $values = array_unique($values);
    sort($values);
    return array_values($values);
}

$unique_producers = get_unique_values($catalogues_data, 'producer');
$unique_groups = get_unique_values($catalogues_data, 'product_group');
$unique_industries = get_unique_values($catalogues_data, 'industry');
@endphp

<!--- CATALOGUES --->

<section data-gsap-anim="section" class="b-catalogues -spt {{ $sectionClass }} {{ $section_class }}" id="{{ $section_id }}">
    <div class="__wrapper c-main relative">

        {!! \App\Helpers\Breadcrumbs::render() !!}
        
        <div class="relative grid grid-cols-1 lg:grid-cols-[1fr_2fr] items-center pt-30">
            <div class="__content">
                <h2 data-gsap-element="header" class="m-header">{{ strip_tags($g_catalogues['header'] ?? '') }}</h2>
                <p data-gsap-element="txt">{!! $g_catalogues['text'] ?? '' !!}</p>

               <!--  <div class="inline-buttons m-btn">
                    @if (!empty($g_catalogues['button']))
                    <a data-gsap-element="btn" class="main-btn" href="{{ $g_catalogues['button']['url'] }}">{{ $g_catalogues['button']['title'] }}</a>
                    @endif
                    @if (!empty($g_catalogues['button2']))
                    <a data-gsap-element="btn" class="second-btn" href="{{ $g_catalogues['button2']['url'] }}">{{ $g_catalogues['button2']['title'] }}</a>
                    @endif
                </div> -->
            </div>
        </div>

        <div class="pt-20">
            @if (!empty($catalogues_header))
            <h3 class="mb-10">{{ $catalogues_header }}</h3>
            @endif

            {{-- Filtry z dropdownami z checkboxami i searchem --}}
            @if ($enable_filters && (count($unique_producers) > 0 || count($unique_groups) > 0 || count($unique_industries) > 0))
            <div class="catalogue-filters mb-10 p-6 bg-gray-100 rounded-lg">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    
                    {{-- Wyszukiwanie globalne --}}
                    <div>
                        <label class="block text-sm font-medium mb-3">
                            <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Szukaj
                        </label>
                        <input
                            type="text"
                            data-catalogue-search
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Wpisz nazwę katalogu..."
                        />
                    </div>

                    {{-- Producent Dropdown --}}
                    @if (count($unique_producers) > 0)
                    <div class="relative">
                        <label class="block text-sm font-medium mb-3">
                            Producent (<span data-count="producer">0</span>)
                        </label>
                        <div class="custom-multiselect" data-multiselect="producer">
                            <button type="button" class="multiselect-trigger w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-left flex items-center justify-between focus:ring-2 focus:ring-blue-500">
                                <span>Wybierz producenta</span>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="multiselect-dropdown hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
                                {{-- Search wewnątrz dropdowna --}}
                                <div class="p-3 border-b border-gray-200 sticky top-0 bg-white">
                                    <input
                                        type="text"
                                        data-dropdown-search="producer"
                                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Szukaj producenta..."
                                    />
                                </div>
                                {{-- Lista checkboxów --}}
                                <div class="max-h-60 overflow-y-auto" data-options-container="producer">
                                    @foreach ($unique_producers as $producer)
                                    <label class="filter-option flex items-center px-4 py-2 hover:bg-gray-50 cursor-pointer transition-colors" data-value="{{ strtolower($producer) }}">
                                        <input
                                            type="checkbox"
                                            value="{{ strtolower($producer) }}"
                                            data-catalogue-filter="producer"
                                            class="mr-3 w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                        />
                                        <span class="text-sm">{{ $producer }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Grupa produktowa Dropdown --}}
                    @if (count($unique_groups) > 0)
                    <div class="relative">
                        <label class="block text-sm font-medium mb-3">
                            Grupa produktowa (<span data-count="group">0</span>)
                        </label>
                        <div class="custom-multiselect" data-multiselect="group">
                            <button type="button" class="multiselect-trigger w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-left flex items-center justify-between focus:ring-2 focus:ring-blue-500">
                                <span>Wybierz grupę</span>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="multiselect-dropdown hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
                                {{-- Search wewnątrz dropdowna --}}
                                <div class="p-3 border-b border-gray-200 sticky top-0 bg-white">
                                    <input
                                        type="text"
                                        data-dropdown-search="group"
                                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Szukaj grupy..."
                                    />
                                </div>
                                {{-- Lista checkboxów --}}
                                <div class="max-h-60 overflow-y-auto" data-options-container="group">
                                    @foreach ($unique_groups as $group)
                                    <label class="filter-option flex items-center px-4 py-2 hover:bg-gray-50 cursor-pointer transition-colors" data-value="{{ strtolower($group) }}">
                                        <input
                                            type="checkbox"
                                            value="{{ strtolower($group) }}"
                                            data-catalogue-filter="group"
                                            class="mr-3 w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                        />
                                        <span class="text-sm">{{ $group }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Branża Dropdown --}}
                    @if (count($unique_industries) > 0)
                    <div class="relative">
                        <label class="block text-sm font-medium mb-3">
                            Branża (<span data-count="industry">0</span>)
                        </label>
                        <div class="custom-multiselect" data-multiselect="industry">
                            <button type="button" class="multiselect-trigger w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-left flex items-center justify-between focus:ring-2 focus:ring-blue-500">
                                <span>Wybierz branżę</span>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="multiselect-dropdown hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
                                {{-- Search wewnątrz dropdowna --}}
                                <div class="p-3 border-b border-gray-200 sticky top-0 bg-white">
                                    <input
                                        type="text"
                                        data-dropdown-search="industry"
                                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Szukaj branży..."
                                    />
                                </div>
                                {{-- Lista checkboxów --}}
                                <div class="max-h-60 overflow-y-auto" data-options-container="industry">
                                    @foreach ($unique_industries as $industry)
                                    <label class="filter-option flex items-center px-4 py-2 hover:bg-gray-50 cursor-pointer transition-colors" data-value="{{ strtolower($industry) }}">
                                        <input
                                            type="checkbox"
                                            value="{{ strtolower($industry) }}"
                                            data-catalogue-filter="industry"
                                            class="mr-3 w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                        />
                                        <span class="text-sm">{{ $industry }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>

                <div class="mt-4 flex items-center justify-between">
                    <span class="text-sm text-gray-600">
                        Wyświetlono: <strong data-catalogue-count>{{ count($catalogues_data) }}</strong> z {{ count($catalogues_data) }}
                    </span>
                    <button data-catalogue-reset class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md text-sm font-medium transition-colors">
                        Wyczyść filtry
                    </button>
                </div>
            </div>
            @endif

            {{-- Siatka katalogów --}}
            <div data-catalogue-grid class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($catalogues_data as $item)
                <a href="{{ $item['file_url'] }}" 
                   download 
                   class="catalogue-item" 
                   data-title="{{ strtolower($item['title']) }}"
                   data-producer="{{ strtolower($item['producer']) }}"
                   data-group="{{ strtolower($item['product_group']) }}"
                   data-industry="{{ strtolower($item['industry']) }}">
                    <div class="__card relative bg-white border-bottom-p p-10 h-full flex flex-col transform transition-transform hover:scale-105">
                        @if($item['thumbnail'])
                        <img class="__thumb img-l m-auto mb-4" src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}" loading="lazy">
                        @endif
                        
                        <h6 class="text-center mt-auto mb-4">{{ $item['title'] }}</h6>
                        
                        @if ($enable_filters && ($item['producer'] || $item['product_group'] || $item['industry']))
                        <div class="flex flex-wrap gap-2 justify-center text-xs mb-4">
                            @if ($item['producer'])
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $item['producer'] }}</span>
                            @endif
                            @if ($item['product_group'])
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">{{ $item['product_group'] }}</span>
                            @endif
                            @if ($item['industry'])
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded">{{ $item['industry'] }}</span>
                            @endif
                        </div>
                        @endif
                        
                        <img class="__btn m-auto" src="/wp-content/uploads/2025/11/download.svg" alt="Download" />
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Komunikat brak wyników --}}
            <div data-catalogue-no-results class="hidden mt-10 text-center p-10 bg-gray-100 rounded-lg">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-lg text-gray-600 font-medium">Nie znaleziono katalogów</p>
                <p class="text-sm text-gray-500 mt-2">Spróbuj zmienić kryteria wyszukiwania</p>
            </div>

        </div>

    </div>
</section>