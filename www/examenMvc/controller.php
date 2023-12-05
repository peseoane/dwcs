<?php
declare(strict_types=1);
require_once 'view.php';
require_once 'model.php';

class Controller
{
    private View $generarForm;
    private Database $database;
    private array $formData;

    public function __get(string $name)
    {
        return $this->$name;
    }

    public function __construct()
    {
        $this->generarForm = new View();
        $this->database = new Database();
        $this->formData = $_POST;
    }

    public function getLoginForm(): string
    {
        return $this->generarForm->renderLoginForm();
    }

    public function getDeletionForm(): string
    {
        return $this->generarForm->renderDeletionForm();
    }

    public function getRegistrationForm(): string
    {
        return $this->generarForm->renderRegistrationForm();
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
                echo 'User already exists, please register down bellow.';
            }
        }


        if (isset($this->formData['name'], $this->formData['surname'], $this->formData['dob'], $_FILES['file'])) {
            $username = $this->formData['name'];
            $surname = $this->formData['surname'];
            $dob = $this->formData['dob'];
            $file = $_FILES['file'];

            // Validate date of birth
            $dobDateTime = DateTime::createFromFormat('Y-m-d', $dob);
            if ($dobDateTime && $dobDateTime->format('Y-m-d') === $dob) {
                // Handle file upload if a file was provided
                if ($file['error'] === UPLOAD_ERR_OK) {
                    $uploadDirectory = '/path/to/upload/directory/';
                    $uploadFilePath = $uploadDirectory . basename($file['name']);

                    if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
                        echo 'File uploaded successfully.';
                    } else {
                        echo 'Failed to upload file.';
                    }
                }

                // Add user to database
                $this->database->addUser($username, $surname, $dob);
                echo 'User registered successfully.';
            } else {
                echo 'Invalid date of birth.';
            }
        }

        if (isset($this->formData['delete'])) {
            // Logic for handling deletion form submission
            $this->database->deleteAllUserInformation();
            echo 'All user information has been deleted.';
        }
    }
}

$controller = new Controller();
echo $controller->getLoginForm();
echo $controller->getDeletionForm();
echo $controller->getRegistrationForm();
$controller->handleFormSubmission();
echo '<br>';
var_dump($controller->__get('database')->getUsersAndHashes());