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

            if ($this->database->checkPassword($username, $password)) {
                echo 'Credentials are correct.';
            } else {
                echo 'Credentials are incorrect or user does not exist.';
            }
        }

        if (isset($this->formData['name'], $this->formData['surname'], $this->formData['dob'], $_FILES['file'])) {
            $username = $this->formData['name'];
            $surname = $this->formData['surname'];
            $dob = $this->formData['dob'];
            $file = $_FILES['file'];

            $dobDateTime = DateTime::createFromFormat('Y-m-d', $dob);
            if ($dobDateTime && $dobDateTime->format('Y-m-d') === $dob) {
                $tmpFilePath = null;
                if ($file['error'] === UPLOAD_ERR_OK) {
                    $tmpFile = tmpfile();
                    $metaData = stream_get_meta_data($tmpFile);
                    $tmpFilePath = $metaData['uri'];

                    if (move_uploaded_file($file['tmp_name'], $tmpFilePath)) {
                        echo 'File uploaded successfully.';
                    } else {
                        echo 'Failed to upload file.';
                        $tmpFilePath = null;
                    }
                }

                $this->database->addUser($username, $surname, $dob, $tmpFilePath);
                echo 'User registered successfully.';
            } else {
                echo 'Invalid date of birth.';
            }
        }

        if (isset($this->formData['delete'])) {
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