<footer class="footer">
	<div class="__wrap bg-dark relative">
		<div class="__wrapper c-main relative z-10">
			<div class="__widgets grid gap-1 md:gap-6 py-36">
				@for ($i = 1; $i <= 4; $i++)
					@if (is_active_sidebar('sidebar-footer-' . $i))
					<div>@php(dynamic_sidebar('sidebar-footer-' . $i))</div>
			@endif
			@endfor
		</div>
	</div>
		<img class="absolute left-0 bottom-0" src="/wp-content/uploads/2025/09/footer-img.svg" />
	</div>

	<div class="c-main flex flex-col md:flex-row justify-between gap-6 py-10 footer-bottom">
		<p class="">Copyright ©2025 <?php echo get_bloginfo('name'); ?>. All Rights Reserved</p>
		<p class="flex gap-2">Designed &amp; Developed by
			<a target="_blank" href="https://www.ohsofresh.pl" title="OhSoFresh"><img class="oh" src="/wp-content/themes/windes/resources/images/ohsofresh.svg"></a>
		</p>
	</div>
	</div>

</footer>