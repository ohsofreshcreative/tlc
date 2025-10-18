@php
  // Dane z ACF (fallback – można też przekazać przez @include)
  $productContact = $productContact ?? get_field('product_contact') ?? [];
  $g_contact_1    = $g_contact_1    ?? ($productContact['g_contact_1'] ?? []);
  $g_contact_2    = $g_contact_2    ?? ($productContact['g_contact_2'] ?? []);

  // Klasy zewnętrzne (opcjonalnie)
  $sectionClass   = $sectionClass   ?? '';

  // Dane treści
  $header   = $g_contact_1['header'] ?? '';
  $txt      = $g_contact_1['txt'] ?? '';
  $image    = $g_contact_1['image'] ?? null; // array / id / null
  $imgUrl   = is_array($image) ? ($image['url'] ?? '') : (is_numeric($image) ? wp_get_attachment_image_url((int)$image, 'large') : '');
  $imgAlt   = is_array($image) ? ($image['alt'] ?? '') : '';

  $shortcode = $g_contact_2['shortcode'] ?? '';
@endphp

@if($header || $txt || $shortcode || $imgUrl)
<section data-gsap-anim="section" class="contact bg-s-lighter relative -smt pt-30 pb-30 {{ $sectionClass }}">
  <div class="__wrapper c-main relative z-2">

    <div class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-10 z-10">
      {{-- Kolumna treści --}}
      <div class="__content w-full lg:w-11/12 flex flex-col justify-between">
        <div class="__data">
          @if($header)
            <h3 data-gsap-element="header">{!! $header !!}</h3>
          @endif

          @if($txt)
            <div data-gsap-element="txt" class="mt-6">
              {!! $txt !!}
            </div>
          @endif

          @if($shortcode)
            <div data-gsap-element="form" class="mt-10">
              {!! do_shortcode($shortcode) !!}
            </div>
          @endif
        </div>
      </div>

      {{-- Kolumna obrazu --}}
      <div data-gsap-element="img" class="!h-full">
        @if($imgUrl)
          <img class="!h-full radius-img object-cover w-full"
               src="{{ esc_url($imgUrl) }}"
               alt="{{ esc_attr($imgAlt) }}">
        @endif
      </div>
    </div>

    <div class="__glow"></div>
  </div>
</section>
@endif
