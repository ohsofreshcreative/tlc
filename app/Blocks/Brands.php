<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Brands extends Block
{
	public $name = 'Marki';
	public $description = 'brand';
	public $slug = 'brands';
	public $category = 'formatting';
	public $icon = 'ellipsis';
	public $keywords = ['brand', 'kafelki'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$brands = new FieldsBuilder('brands');

		$brands
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Marki',
				'open' => false,
				'multi_expand' => true,
			])
			->addTab('Elementy', ['placement' => 'top'])
			->addMessage('Edycja', 'Pole edytujemy klikajac w menu panelu administratora "Marki".')

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
			])
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $brands->build();
	}

	public function with()
	{
		// Pobierz dane z pola repeater
		$brands_data = get_field('r_brand', 'option') ?: [];


		return [
			'brands_data'   => $brands_data, // Przekaż już posortowane dane
			'section_id'    => get_field('section_id', 'option') ?: '',
			'section_class' => get_field('section_class', 'option') ?: '',
			'nomt'          => get_field('nomt', 'option') ?: false,
			'flip'          => get_field('flip', 'option') ?: false,
			'wide'          => get_field('wide', 'option') ?: false,
			'gap'           => get_field('gap', 'option') ?: false,
			'background'    => get_field('background', 'option') ?: 'none',
			// Pola z samego bloku (nie z opcji)
			'block_title'   => get_field('block-title') ?: '',
			'block_nomt'    => get_field('nomt') ?: false,
			'block_section_id'    => get_field('section_id') ?: '',
			'block_section_class' => get_field('section_class') ?: '',
		];
	}
}
