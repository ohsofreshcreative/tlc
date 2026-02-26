<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PageHelpSidebarFields extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $helpSidebar = new FieldsBuilder('page_help_sidebar', [
            'title' => 'Pasek boczny "Potrzebujesz pomocy?"',
            'position' => 'normal',
            'style' => 'default',
        ]);

      $helpSidebar
            ->setLocation('post_type', '==', 'page') // Dla zwykłych stron i "podstron sklepu"
                ->or('taxonomy', '==', 'product_cat'); // Dla kategorii produktów


        $helpSidebar
            ->addTab('Ustawienia paska bocznego')
            ->addTrueFalse('show_help_sidebar', [
                'label' => 'Pokaż pasek boczny "Potrzebujesz pomocy?"',
                'instructions' => 'Zaznacz, aby wyświetlić dymek pomocy na tej stronie.',
                'ui' => 1,
            ])
            ->addText('help_sidebar_title', [
                'label' => 'Tytuł',
                'default_value' => 'Potrzebujesz pomocy?',
            ])
            ->conditional('show_help_sidebar', '==', '1')
            ->addImage('help_sidebar_image', [
                'label' => 'Zdjęcie',
                'return_format' => 'id',
            ])
            ->conditional('show_help_sidebar', '==', '1')
            ->addTextarea('help_sidebar_text', [
                'label' => 'Tekst',
                'default_value' => 'Nasz doradca pomoże Ci znaleźć odpowiedni produkt',
                'rows' => 3,
            ])
            ->conditional('show_help_sidebar', '==', '1')
            ->addLink('help_sidebar_button', [
                'label' => 'Przycisk',
            ])
            ->conditional('show_help_sidebar', '==', '1');

        return $helpSidebar->build();
    }
}