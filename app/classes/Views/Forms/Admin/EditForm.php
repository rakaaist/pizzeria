<?php


namespace App\Views\Forms\Admin;


use Core\Views\Form;

class EditForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST'
            ],
            'fields' => [
                'coordinate_x' => [
                    'label' => '',
                    'value' => '',
                    'type' => 'number',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_coordinate'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Coordinate X'
                        ]
                    ]
                ],
                'coordinate_y' => [
                    'label' => '',
                    'value' => '',
                    'type' => 'number',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_coordinate'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Coordinate Y'
                        ]
                    ]
                ],
                'colour' => [
                    'label' => '',
                    'type' => 'select',
                    'options' => [
                        'black' => 'Black',
                        'red' => 'Red',
                        'green' => 'Green',
                        'blue' => 'Blue',
                    ],
                    'value' => 'red',
                    'validators' => [
                        'validate_select'
                    ]
                ]
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Edit pixel!',
                    'type' => 'submit',
                ]
            ],
            'validators' => [
                'validate_unique_pixel'
            ]
        ]);
    }
}