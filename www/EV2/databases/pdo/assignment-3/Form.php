<?php
declare(strict_types=1);

class Form
{
    protected array $fields = [];

    public function __construct(array $options)
    {
        foreach ($options as $name => $option) {
            $type = $option["type"] ?? "text";
            $value = $option["value"] ?? "";
            $selectOptions = $option["options"] ?? [];

            $this->fields[$name] = [
                "type" => $type,
                "value" => $value,
                "options" => $selectOptions,
            ];
        }
    }

    public function render(): string
    {
        $html =
            '<form method="POST" action="' .
            htmlspecialchars($_SERVER["PHP_SELF"]) .
            '">';

        foreach ($this->fields as $name => $field) {
            $type = $field["type"];
            $value = $field["value"];
            $selectOptions = $field["options"];

            $html .= "<label for='{$name}'>{$name}</label>";

            if ($type === "select") {
                $html .= "<select name='{$name}'>";
                foreach ($selectOptions as $optionValue => $optionLabel) {
                    $html .= "<option value='{$optionValue}'>{$optionLabel}</option>";
                }
                $html .= "</select>";
            } else {
                $html .= "<input type='{$type}' name='{$name}' value='{$value}' />";
            }
        }

        $html .= "</form>";

        return $html;
    }
}
