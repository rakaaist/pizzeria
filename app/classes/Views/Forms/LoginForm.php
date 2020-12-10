<?php

namespace App\Views\Forms;

use Core\Views\Form;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST'
            ],
            'fields' => [
                'email' => [
                    'label' => 'Email',
                    'type' => 'email',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_email'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'type' => 'password',
                    'validators' => [
                        'validate_field_not_empty'
                    ]
                ]
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Login',
                    'type' => 'submit',
                ]
            ],
            'validators' => [
                'validate_login'
            ]
        ]);
    }
}