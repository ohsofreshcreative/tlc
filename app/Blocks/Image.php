<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Image extends Block
{
	public $name = 'Obraz';
	public $description = 'image';
	public $slug = 'image';
	public $category = 'formatting';
	public $icon = 'format-image';
	public $keywords = ['obraz', 'zdjecie'];
	public $mode = 'edit'; 
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	public function fields()
	{
		$image = new FieldsBuilder('image');

		$image
			->setLocation('block', '==', 'acf/image') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Obraz',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- GROUP ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_image', ['label' => ''])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->endGroup()
			->addSelect('img_height', [
				'label' => 'Wysokość obrazu',
				'choices' => [
					'auto' => 'Auto (naturalna)',
					'sm'   => 'Mała (400px)',
					'md'   => 'Średnia (600px)',
					'lg'   => 'Duża (800px)',
				],
				'default_value' => 'md',
				'ui' => 1,
			])

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $image;
	}

	public function with()
	{
		return [
			'g_image'    => get_field('g_image'),
			'flip'       => get_field('flip'),
			'img_height' => get_field('img_height') ?: 'md',
		];
	}
}
