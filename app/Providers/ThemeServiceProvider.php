<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;
use App\Blocks\ExampleBlock;

class ThemeServiceProvider extends SageServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		parent::register();
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		parent::boot();

		// CUSTOM POST TYPE BRANŻE
		add_action('init', function () {
			register_post_type('sectors', [
				'label' => 'Branże',
				'public' => true,
				'has_archive' => false,
				'rewrite' => ['slug' => 'sectors'],
				'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
				'show_in_rest' => true,
				'taxonomies' => ['category'],
				'menu_icon' => 'dashicons-list-view',
			]);
		});

		if (function_exists('acf_add_options_page')) {
			acf_add_options_sub_page([
				'page_title'  => 'Kafelki',
				'menu_title'  => 'Kafelki',
				'parent_slug' => 'edit.php?post_type=sectors',
				'menu_slug'   => 'sectors-cards',
				'capability'  => 'edit_posts',
			]);
		};

		// CUSTOM POST TYPE CASES
		add_action('init', function () {
			register_post_type('cases', [
				'label' => 'Realizacje',
				'public' => true,
				'has_archive' => false,
				'rewrite' => ['slug' => 'realizacje'],
				'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
				'show_in_rest' => true,
				'menu_icon' => 'dashicons-format-image',
			]);
		});

		// USATAWIENIA MOTYWU
		add_action('acf/init', function () {
			if (function_exists('acf_add_options_page')) {
				acf_add_options_page([
					'page_title' => 'Ustawienia motywu',
					'menu_title' => 'Ustawienia motywu',
					'menu_slug'  => 'theme-settings',
					'capability' => 'edit_posts',
					'redirect'   => false,
				]);

				acf_add_options_page([
					'page_title' => 'Wezwanie do działania',
					'menu_title' => 'Wezwanie do działania',
					'menu_slug'  => 'bottom',
					'capability' => 'edit_posts',
					'redirect'   => false,
				]);

				acf_add_options_page([
					'page_title' => 'Obszar działania',
					'menu_title' => 'Obszar działania',
					'menu_slug'  => 'o-area',
					'capability' => 'edit_posts',
					'redirect'   => false,
				]);

				/* 	acf_add_options_page([
					'page_title' => 'Oferta',
					'menu_title' => 'Oferta',
					'menu_slug'  => 'sectors',
					'capability' => 'edit_posts',
					'parent_slug' => '',
					'redirect'   => false,
				]); */
			}
		});
	}
}
