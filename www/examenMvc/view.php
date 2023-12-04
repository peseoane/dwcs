<?php
declare(strict_types=1);
class View {

    const TITLE = 'Examen MVC';
    const formValues = ['email', 'password'];

    public function __construct() {
    }
    public function render(): string {
        $form = '<form method="post">';
        foreach (self::formValues as $value) {
            $form .= '<label for="' . $value . '">' . ucfirst($value) . '</label>';
            $form .= '<input type="' . ($value === 'password' ? 'password' : 'text') . '" name="' . $value . '" id="' . $value . '">';
        }
        $form .= '<input type="submit" value="Submit">';
        $form .= '</form>';
        return $form;
    }
}