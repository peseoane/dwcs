<?php
declare(strict_types=1);

class View
{

    const TITLE = 'Examen MVC';
    const formValues = ['email', 'password', 'name', 'surname', 'dob', 'file'];

    public function __construct()
    {
    }

    public function renderLoginForm(): string
    {
        $form = '<h2>SIGN-IN</h2><form method="post">';
        foreach (self::formValues as $value) {
            if ($value === 'email' || $value === 'password') {
                $form .= '<label for="' . $value . '">' . ucfirst($value) . '</label>';
                $form .= '<input type="' . ($value === 'password' ? 'password' : 'text') . '" name="' . $value . '" id="' . $value . '">';
            }
        }
        $form .= '<input type="submit" value="Submit">';
        $form .= '</form>';
        return $form;
    }



    public function renderDeletionForm(): string
    {
        $form = '<form method="post">';
        $form .= '<input type="submit" name="delete" value="Delete All Information">';
        $form .= '</form>';
        return $form;
    }

    public function renderRegistrationForm(): string
    {
        $form = '<h3>SIGN-UP</h3></h3><form method="post" enctype="multipart/form-data">';
        foreach (self::formValues as $value) {
            if ($value === 'name' || $value === 'surname' || $value === 'email' || $value === 'password') {
                $form .= '<label for="' . $value . '">' . ucfirst($value) . '</label>';
                $form .= '<input type="' . ($value === 'password' ? 'password' : ($value === 'email' ? 'email' : 'text')) . '" name="' . $value . '" id="' . $value . '" required>';
            } elseif ($value === 'dob') {
                $form .= '<label for="' . $value . '">' . ucfirst($value) . '</label>';
                $form .= '<input type="date" name="' . $value . '" id="' . $value . '" required>';
            } elseif ($value === 'file') {
                $form .= '<label for="' . $value . '">Upload File</label>';
                $form .= '<input type="file" name="' . $value . '" id="' . $value . '">';
            }
        }
        $form .= '<input type="submit" value="Register">';
        $form .= '</form>';
        return $form;
    }


}