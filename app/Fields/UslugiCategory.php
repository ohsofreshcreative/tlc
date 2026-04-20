<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class UslugiCategory extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $uslugiCategory = new FieldsBuilder('uslugi_category_settings', [
            'title' => 'Ustawienia Kategorii Usług',
        ]);

        $uslugiCategory
            ->setLocation('taxonomy', '==', 'uslugi_category');

        $uslugiCategory
            ->addNumber('kolejnosc', [
                'label' => 'Kolejność',
                'instructions' => 'Wpisz liczbę, aby ustawić kolejność wyświetlania. Im niższa liczba, tym kategoria pojawi się wyżej na liście.',
                'default_value' => 10,
                'min' => 1,
            ]);

        return $uslugiCategory->build();
    }
}