{{-- resources/views/woocommerce/content-product_cat.blade.php --}}
@php
  if (empty($category)) {
    return;
  }

  // Pobranie klas kategorii i zamiana na string jeśli tablica
  $classes = wc_get_product_cat_class('product-category product', $category);
  if (is_array($classes)) {
    $classes = implode(' ', $classes);
  }
@endphp



<li class="{{ $classes }}">

  {{-- Hook przed kategorią (np. otwarcie <a>) --}}
  @php do_action('woocommerce_before_subcategory', $category); @endphp

  <a href="{{ esc_url(get_term_link($category, 'product_cat')) }}"
     class="woocommerce-LoopCategory-link woocommerce-loop-category__link"
     aria-label="{{ esc_attr($category->name) }}">

    {{-- Miniaturka kategorii --}}
    @php do_action('woocommerce_before_subcategory_title', $category); @endphp

    <h2 class="woocommerce-loop-category__title">
      {{ $category->name }}

      @if (!empty($category->count))
        {!! apply_filters(
          'woocommerce_subcategory_count_html',
          ' <mark class="count">' . intval($category->count) . '</mark>',
          $category
        ) !!}
      @endif
    </h2>

    {{-- Dodatkowe elementy po tytule (np. opis) --}}
    @php do_action('woocommerce_after_subcategory_title', $category); @endphp
  </a>

  {{-- Hook po kategorii (np. zamknięcia wrapperów) --}}
  @php do_action('woocommerce_after_subcategory', $category); @endphp
</li>
