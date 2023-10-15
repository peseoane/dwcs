<?php declare(strict_types=1);

class Document
{
    public static function generateBoilerplate(string $title, string $description): string {
        $boilerplate = "<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'>
  <title>$title</title>
  <meta name='description' content='$description'>
</head>
<body>";

        return $boilerplate;
    }
    public static function generateMeta(): string
    {
        return '<meta name="description" content="Your description here">';
    }

    public static function generateContainerStart(): string
    {
        return '<div class="container">';
    }

    public static function generateContainerEnd(): string
    {
        return '</div>';
    }

    public static function closeDocument(): string
    {
        return '</body></html>';
    }
}

class Form
{
    private array $config;
    private string $target;

    public function __construct(array $config, string $target)
    {
        $this->config = $config;
        $this->target = $target;
    }

    public function generateForm(): string
    {
        $form = '<form class="form-group" action="' . $this->target . '" method="post">';

        foreach ($this->config as $key => $value) {
            $form .= '<label for="' . $key . '">' . $key . '</label>';
            $form .= '<input type="text" id="' . $key . '" name="' . $key . '" value="' . $value . '"><br>';
        }

        $form .= '<input type="submit" value="Submit">';
        $form .= '</form>';

        return $form;
    }
}