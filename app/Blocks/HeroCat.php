<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeroCat extends Block
{
	public $name = 'Hero - Kategoria';
	public $description = 'hero-cat';
	public $slug = 'hero-cat';
	public $category = 'formatting';
	public $icon = 'align-full-width';
	public $keywords = ['tresc', 'zdjecie'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$hero_cat = new FieldsBuilder('hero-cat');

		$hero_cat
			->setLocation('block', '==', 'acf/hero-cat') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Hero - Kategoria',
				'open' => false,
				'multi_expand' => true,
			])
			->addTab('Treść', ['placement' => 'top'])
			->addGroup('g_herocat', ['label' => 'Hero - Pojedyncza oferta'])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'thumbnail',
			])
			->addText('title', ['label' => 'Tytuł'])
			->addWysiwyg('txt', [
				'label' => 'Treść',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->endGroup()

			->addTab('Ustawienia bloku', ['placement' => 'top'])

			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $hero_cat;
	}

	public function with()
	{
		return [
			'g_herocat' => get_field('g_herocat'),
			'flip' => get_field('flip'),
		];
	}
}
