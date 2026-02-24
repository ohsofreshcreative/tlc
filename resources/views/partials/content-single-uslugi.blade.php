@php
$backgroundImage = !empty(get_the_post_thumbnail_url(null, 'full')) ? "
linear-gradient(to bottom, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 50%),
linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 100%),
url(" . get_the_post_thumbnail_url(null, 'full') . ") " : '';
@endphp


<div id="tresc" class="__entry mt-10">
	<div class="">
		{!! the_content() !!}
	</div>
</div>
