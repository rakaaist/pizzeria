<?php

namespace App\Views\Forms\Admin;

use Core\Views\Form;

class DeleteForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST',
                'class' => 'form-delete'
            ],
            'fields' => [
                'row_id' => [
//                    'value' => $row_id,
                    'type' => 'hidden',
                    'validators' => [
                        'validate_row_exists'
                    ]
                ]
            ],
            'buttons' => [
                'submit' => [
                    'name' => 'delete_button',
                    'title' => 'Delete!',
                    'type' => 'submit',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn-delete'
                        ]
                    ]
                ]
            ]
        ]);
    }
}