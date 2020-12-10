<?php

use App\App;

/**
 * Function checks whether the user already exists
 *
 * @param $email
 * @param $file_name
 * @return bool
 */
function validate_user_unique($email, &$field)
{
    $user_exists = App::$db->getRowsWhere('users', ['email' => $email]);

    if ($user_exists) {
        $field['error'] = 'This user already exists';

        return false;
    }

    return true;
}


/**
 * Function checks whether the user has already registered;
 *
 * @param $filtered_input
 * @param $form
 * @return bool
 */
function validate_login($filtered_input, &$form)
{
    $login = App::$db->getRowsWhere('users', [
        'email' => $filtered_input['email'],
        'password' => $filtered_input['password']
    ]);

    if ($login) {
        return true;
    }

    $form['error'] = 'Password or email is incorrect!';
    return false;
}

/**
 * Function validates a coordinate to be between 0 and 490 pixels
 *
 * @param $filtered_input
 * @param $field
 * @return bool
 */
function validate_coordinate($filtered_input, &$field)
{
    if ($filtered_input >= 0 && $filtered_input < 491) {
        return true;
    }
    $field['error'] = 'Coordinate must be between 0 and 490!';

    return false;
}

/**
 * @param $filtered_input
 * @param $form
 * @return bool
 */
//function validate_unique_pixel($filtered_input, &$form)
//{
//    $coordinates = [
//        'coordinate_x' => ($filtered_input['coordinate_x']),
//        'coordinate_y' => ($filtered_input['coordinate_y'])
//    ];
//
////    for ($i = -10; $i <= 10; $i += 10) {
////        $coordinates = [
////            'coordinate_x' => ($filtered_input['coordinate_x'] + $i),
////            'coordinate_y' => ($filtered_input['coordinate_y'] + $i)
////        ];
//
//    var_dump($coordinates);
//
//    $pixel_unique = (bool)App::$db->getRowsWhere('pixels', $coordinates);
//    var_dump($pixel_unique);
//
//    if ($pixel_unique) {
//        $form['error'] = 'This pixel is already chosen!';
//
//        return false;
//    }
//    return true;
//}

function validate_unique_pixel($filtered_input, &$form)
{
    $pixel_unique = App::$db->getRowsWhere('pixels', [
        'coordinate_x' => $filtered_input['coordinate_x'],
        'coordinate_y' => $filtered_input['coordinate_y']
    ]);

    if (!$pixel_unique) {
        return true;
    }

    $form['error'] = 'This pixel is already chosen!';
    return false;
}

function validate_row_exists($field_input)
{
    return App::$db->rowExists('pixels', $field_input);
}
