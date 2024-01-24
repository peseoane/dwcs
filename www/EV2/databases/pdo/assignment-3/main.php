<?php
declare(strict_types=1);

require_once "ConcretePaginationBuilder.php";
require_once "Form.php";

$myBooks = new ConcretePaginationBuilder("libro");

$filterTitle = "";
$sortByColumn = "titulo";
$sortDirection = "ASC";
$actualPage = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filterTitle = $_POST["filterTitle"] ?? "";
    $sortByColumn = $_POST["sortByColumn"] ?? "titulo";
    $sortDirection = $_POST["sortDirection"] ?? "ASC";
    $actualPage = $_POST["actualPage"] ?? 1;
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $actualPage = $_GET["page"] ?? 1;
}

$myBooks->setCurrentPage((int) $actualPage);
$myBooks->setFilter($filterTitle);
$myBooks->sortByColumn($sortByColumn);
$myBooks->defineSort($sortDirection);
$myBooks->build();

$bookKeys = $myBooks->getTable()->getHeaders();
$options = [
    "filterTitle" => [
        "type" => "text",
        "value" => "",
    ],
    "sortByColumn" => [
        "type" => "select",
        "value" => "",
        "options" => array_combine($bookKeys, $bookKeys),
    ],
    "sortDirection" => [
        "type" => "select",
        "value" => "",
        "options" => [
            "ASC" => "Ascendente",
            "DESC" => "Descendente",
        ],
    ],
    "submit" => [
        "type" => "submit",
        "value" => "Filtrar",
    ],
];
$myForm = new Form($options);
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Books</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
<?php
echo $myForm->render();
echo $myBooks->renderHtml();

?>
