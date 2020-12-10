<?php

namespace App\Views\Forms;

use Core\Views\Form;

class RegisterForm extends Form
{
    public function __construct()
    {
        parent::__construct(
            [
                'attr' => [
                    'method' => 'POST'
                ],
                'fields' => [
                    'email' => [
                        'label' => 'Email',
                        'type' => 'email',
                        'validators' => [
                            'validate_field_not_empty',
                            'validate_user_unique',
                            'validate_email'
                        ]
                    ],
                    'password' => [
                        'label' => 'Password',
                        'type' => 'password',
                        'validators' => [
                            'validate_field_not_empty'
                        ]
                    ],
                    'password_repeat' => [
                        'label' => 'Repeat password',
                        'type' => 'password',
                        'validators' => [
                            'validate_field_not_empty'
                        ]
                    ],
                ],
                'buttons' => [
                    'submit' => [
                        'title' => 'Register',
                        'type' => 'submit',
                    ]
                ],
                'validators' => [
                    'validate_fields_match' => [
                        'password',
                        'password_repeat'
                    ]
                ]
            ]
        );
    }
}