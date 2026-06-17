<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Catalogues extends Block
{
	public $name = 'Katalogi';
	public $description = 'catalogues';
	public $slug = 'catalogues';
	public $category = 'formatting';
	public $icon = 'open-folder';
	public $keywords = ['catalogues', 'kafelki'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$catalogues = new FieldsBuilder('catalogues');

		$catalogues
			->setLocation('block', '==', 'acf/catalogues')
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Katalogi',
				'open' => false,
				'multi_expand' => true,
			])
			
			/*--- TAB #1 ---*/
			->addTab('Treści', ['placement' => 'top'])
			->addGroup('g_catalogues', ['label' => ''])
			->addText('header', ['label' => 'Nagłówek'])
			->addTextarea('text', [
				'label' => 'Opis',
				'rows' => 4,
				'new_lines' => 'br',
			])
			->addLink('button', [
				'label' => 'Przycisk #1',
				'return_format' => 'array',
			])
			->addLink('button2', [
				'label' => 'Przycisk #2',
				'return_format' => 'array',
			])
			->endGroup()

			/*--- TAB #2 ---*/
			->addTab('Katalogi', ['placement' => 'top'])
			->addText('catalogues_header', ['label' => 'Nagłówek sekcji katalogów'])
			->addTrueFalse('enable_filters', [
				'label' => 'Włącz filtrowanie',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
				'default_value' => 1,
			])
			->addRepeater('r_catalogues', [
				'label' => 'Katalogi',
				'layout' => 'row',
				'min' => 1,
				'button_label' => 'Dodaj katalog'
			])
			->addFile('file', [
				'label' => 'Plik PDF',
				'return_format' => 'array',
				'mime_types' => 'pdf',
			])
			->addText('title', [
				'label' => 'Nazwa katalogu',
				'required' => 1,
			])
			->addText('producer', [
				'label' => 'Producent',
				'instructions' => 'Wpisz nazwę producenta (np. Bosch, Siemens)',
			])
			->addText('product_group', [
				'label' => 'Grupa produktowa',
				'instructions' => 'Wpisz grupę produktową (np. Narzędzia, Elektronika)',
			])
			->addText('industry', [
				'label' => 'Branża',
				'instructions' => 'Wpisz branżę (np. Budowlana, Motoryzacyjna)',
			])
			->endRepeater()

			/*--- USTAWIENIA BLOKU ---*/
			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
			])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('wide', [
				'label' => 'Szeroka kolumna',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('gap', [
				'label' => 'Większy odstęp',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addSelect('background', [
				'label' => 'Kolor tła',
				'choices' => [
					'none' => 'Brak (domyślne)',
					'section-white' => 'Białe',
					'section-light' => 'Jasne',
					'section-gray' => 'Szare',
					'section-brand' => 'Marki',
					'section-gradient' => 'Gradient',
					'section-dark' => 'Ciemne',
				],
				'default_value' => 'none',
				'ui' => 0,
				'allow_null' => 0,
			]);

		return $catalogues;
	}

	public function with()
	{
		return [
			'g_catalogues' => get_field('g_catalogues'),
			'catalogues_header' => get_field('catalogues_header'),
			'r_catalogues' => get_field('r_catalogues'),
			'enable_filters' => get_field('enable_filters'),
			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),
			'flip' => get_field('flip'),
			'wide' => get_field('wide'),
			'nomt' => get_field('nomt'),
			'gap' => get_field('gap'),
			'background' => get_field('background'),
		];
	}
}