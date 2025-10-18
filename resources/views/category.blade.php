@extends('layouts.app')

@section('content')

<div class="hero category-header" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 50%), linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 100%), url('{{ $category_image['url'] }}');">
	<div class="__wrapper c-main pt-60 pb-26">
		<div class="__content w-full md:w-2/3">
			<h1 class=" text-white">
				{!! get_the_archive_title() !!}
			</h1>
			<a data-gsap-element="btn" href="#" class="js-scroll-to-next block m-btn">
				<div class="__arrow bg-primary">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 20 24" fill="none">
						<path d="M10.7383 22.7454L19.4181 14.0655C19.8264 13.6572 19.8265 12.9932 19.4183 12.585C19.0101 12.1768 18.3461 12.1768 17.9378 12.5851L11.0484 19.4744L11.0476 1.99787C11.0474 1.41913 10.5788 0.95049 10 0.950244C9.42127 0.950596 8.95255 1.41932 8.9522 1.99806L8.953 19.4752L2.06463 12.5869C1.65641 12.1786 0.99242 12.1787 0.584122 12.587C0.175823 12.9953 0.175763 13.6593 0.583987 14.0675L9.25988 22.7434C9.666 23.1537 10.33 23.1537 10.7383 22.7454Z" fill="white" />
					</svg>
				</div>
			</a>
		</div>
	</div>
</div>

{{-- 
  <div class="-smt">
    <div class="__wrapper c-main flex gap-4 overflow-x-scroll">
      <a class="stroke-small-btn" href="/kategorie/wszystkie-wpisy/">Wszystkie wpisy</a>
      @foreach($categories as $category)
      @if($category->name !== 'Wszystkie wpisy')
      <a class="stroke-small-btn" href="{{ get_category_link($category->term_id) }}" class="button {{ $term && $term->term_id === $category->term_id ? 'active' : '' }}">{{ $category->name }}</a>
      @endif
      @endforeach
    </div>
  </div> 
  --}}

@if (have_posts())
<div class="c-main pb-25 !mt-10 posts grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
	@while (have_posts()) @php(the_post())

	@includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
	@endwhile
</div>

{!! get_the_posts_navigation() !!}
@else
<div class="mt-20 mb-20">
	<div class="c-main">
		<h3 class="">Brak wpisów w tej kategorii.</h3>
		<a class="main-btn m-btn" href="/kategorie/wszystkie-wpisy/">Sprawdź wszystkie wpisy</a>
	</div>
</div>
@endif
@endsection

<style>
	.category-header {
		background-image:
			linear-gradient(to bottom, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0) 50%),
			linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0) 100%),
			var(--bg-image);
		background-size: cover;
		background-position: center;
	}
</style>