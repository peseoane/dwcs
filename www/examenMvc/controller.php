<?php
declare(strict_types=1);
require_once 'view.php';
require_once 'model.php';

class Controller
{
    private View $viewModel;
    private Database $entityModel;
    private array $formData;

    public function __get(string $name)
    {
        return $this->$name;
    }

    public function __construct()
    {
        $this->viewModel = new View();
        $this->entityModel = new Database();
        $this->entityModel->createDb();
        $this->entityModel->createTable();
        $this->formData = $_POST;
    }

    public function getLoginForm(): string
    {
        return $this->viewModel->renderLoginForm();
    }

    public function getDeletionForm(): string
    {
        return $this->viewModel->renderDeletionForm();
    }

    public function getRegistrationForm(): string
    {
        return $this->viewModel->renderRegistrationForm();
    }

    public function handleFormSubmission(): void
    {
        if (isset($this->formData['email'], $this->formData['password'])) {
            $email = $this->formData['email'];
            $password = $this->formData['password'];

            if (!$this->entityModel->checkIfDbExists()) {
                $this->entityModel->createDb();
            }

            if (!$this->entityModel->checkIfTableExists()) {
                $this->entityModel->createTable();
            }

            if ($this->entityModel->checkPassword($email, $password)) {
                echo 'Credentials are correct.';
            } else {
                echo 'Credentials are incorrect or user does not exist.';
            }
        }
        // PHP, the language that makes you appreciate every other language.
        // Keep those error messages coming, PHP.
        // It's not like I wanted to understand
        // what went wrong or anything.

        if (isset($this->formData['name'], $this->formData['surname'], $this->formData['dob'], $this->formData['email'], $this->formData['password'], $_FILES['file'])) {
            $username = $this->formData['name'];
            $surname = $this->formData['surname'];
            $dob = $this->formData['dob'];
            $email = $this->formData['email'];
            $password = $this->formData['password'];
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
                        $fileData = fopen($tmpFilePath, 'r');
                        $fileContents = fread($fileData, filesize($tmpFilePath));
                        fclose($fileData);
                    } else {
                        echo 'Failed to upload file.';
                        $tmpFilePath = null;
                    }
                }

                $this->entityModel->addUser($username, $surname, $dob, $email, $password, $tmpFilePath);                echo 'User registered successfully.';
            } else {
                echo 'Invalid date of birth.';
            }
        }

        if (isset($this->formData['delete'])) {
            $this->entityModel->deleteAllUserInformation();
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
// Ah, the majestic symphony of PHP code... Brace yourself for the cacophony as we dance on the tightrope between order
// and chaos. Will the forms gracefully submit or implode spectacularly? Only PHP knows, and it's not telling because
// xdenug dosent resolve the host. So fu. I'm not bitter, you're bitter.
echo '<div class="card">';
echo '<br>Controller state:<br>';
var_dump($controller);
echo '<br>Database state:<br>';
var_dump($controller->entityModel->getUsersAndHashes());
echo '</div>';
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">';