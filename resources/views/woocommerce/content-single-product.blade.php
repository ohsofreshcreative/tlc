@php
defined('ABSPATH') || exit;
global $product;
@endphp

@php do_action('woocommerce_before_single_product'); @endphp

@if (post_password_required())
{!! get_the_password_form() !!}
@php return; @endphp
@endif

<!--- hero --->
@include('partials.product-hero')

<!--- about --->
@include('partials.product-about')

<!--- slider --->
@include('partials.product-slider')

<!--- usage --->
@include('partials.product-usage')

<!--- shop --->
@include('partials.product-shop')

<!--- downloads --->
@include('partials.product-downloads')

<!--- contact --->
@include('partials.product-contact')

@php do_action('woocommerce_after_single_product'); @endphp