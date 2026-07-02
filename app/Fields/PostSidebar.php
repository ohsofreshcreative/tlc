<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PostSidebar extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $postSidebar = new FieldsBuilder('post_sidebar', [
            'title' => 'Ustawienia paska bocznego',
            'position' => 'normal',
            'style' => 'default',
        ]);

        $postSidebar
            ->setLocation('post_type', '==', 'post');

        $postSidebar
            ->addText('post_sidebar_title', [
                'label' => 'Nagłówek paska bocznego',
                'instructions' => 'Wpisz niestandardowy nagłówek (pozostaw puste dla domyślnego).',
            ])
            ->addImage('post_sidebar_image', [
                'label' => 'Zdjęcie',
                'instructions' => 'Wybierz niestandardowe zdjęcie (pozostaw puste dla domyślnego).',
                'return_format' => 'id',
            ])
            ->addTextarea('post_sidebar_name', [
                'label' => 'Imię eksperta',
                'instructions' => 'Wpisz niestandardowe imię eksperta (pozostaw puste dla domyślnego).',
                'rows' => 3,
            ])
            ->addTextarea('post_sidebar_desc', [
                'label' => 'Opis',
                'instructions' => 'Wpisz niestandardowy opis (pozostaw puste dla domyślnego).',
                'rows' => 3,
            ]);

        return $postSidebar->build();
    }
}