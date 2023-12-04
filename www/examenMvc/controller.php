<?php
declare(strict_types=1);
require_once 'view.php';
require_once 'model.php';

class Controller
{
    private View $generarForm;
    private Database $database;

    public function __get(string $name)
    {
        return $this->$name;
    }

    private array $formData;

    public function __construct()
    {
        $this->generarForm = new View();
        $this->database = new Database();
        $this->formData = $_POST;
    }

    public function getLoginForm(): string
    {
        return $this->generarForm->render();
    }

    public function handleFormSubmission(): void
    {
        if (isset($this->formData['email'], $this->formData['password'])) {
            $username = $this->formData['email'];
            $password = $this->formData['password'];

            if (!$this->database->checkIfDbExists()) {
                $this->database->createDb();
            }

            if (!$this->database->checkIfTableExists()) {
                $this->database->createTable();
            }

            if (!$this->database->checkPassword($username, $password)) {
                $this->database->addUser($username, $password);
                echo 'User added';
            } else {
                echo 'User already exists';
            }
        }
    }
}

$controller = new Controller();
echo $controller->getLoginForm();
$controller->handleFormSubmission();
echo '<br>';
var_dump($controller->__get('database')->getUsersAndHashes());