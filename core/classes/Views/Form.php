<?php

namespace Core\Views;

use Core\View;

class Form extends View
{
    public function render($template_path = ROOT . '/core/templates/form.tpl.php')
    {
        return parent::render($template_path); // TODO: Change the autogenerated stub
    }

    /**
     * Filters inputs, accepts <>! in order not to hack
     *
     * @return array|null
     */
    public function values(): ?array
    {
        $filter_params = [];

        foreach ($this->data['fields'] as $index => $value) {
            $filter_params[$index] = FILTER_SANITIZE_SPECIAL_CHARS;
        }

        return filter_input_array(INPUT_POST, $filter_params);
    }

    /**
     * If form is submitted, filtered inputs are returned;
     *
     * @return bool
     */
    public function isSubmitted(): bool
    {
        return (bool)$this->values();
    }


    /**
     * Tikrinama pateikta forma pritaikant kiekvieno laukelio validatorius.
     *
     * @return bool
     */
    public function validateForm(): bool
    {
        if (!$this->isSubmitted()) {
            return false;
        }

        $is_valid = true;
        $form_values = $this->values();

        foreach ($this->data['fields'] as $field_id => &$field) {
            foreach ($field['validators'] ?? [] as $function_name => $function) {
                if (is_array($function)) {
                    $field_is_valid = $function_name($form_values[$field_id], $field, $function);
                } else {
                    $field_is_valid = $function($form_values[$field_id], $field);
                }

                if (!$field_is_valid) {
                    $is_valid = false;
                    break;
                }
            }
        }

        foreach ($this->data['validators'] ?? [] as $validator_index => $validator) {
            if (is_array($validator)) {
                $field_is_valid = $validator_index($form_values, $this->data, $params = $validator);
            } else {
                $field_is_valid = $validator($form_values, $this->data);
            }

            if (!$field_is_valid) {
                $is_valid = false;
                break;

            }
        }

        return $is_valid;
    }

    /**
     * Function is used for editing the values saved in the db file.
     * It fills input space with value saved before.
     *
     * @param $values
     */
    public function fill($values)
    {
        foreach ($values as $value_id => $value) {
            if (isset($this->data['fields'][$value_id])) {
                $this->data['fields'][$value_id]['value'] = $value;
            }
        }
    }

    public static function action()
    {
        return filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
    }
}