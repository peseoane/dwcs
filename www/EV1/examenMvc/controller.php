<?php
declare(strict_types=1);
require_once "view.php";
require_once "model.php";

class Controller
{
    private View $viewModel;
    private Database $entityModel;
    private array $formData;

    public function __construct()
    {
        $this->viewModel = new View();
        $this->entityModel = new Database();
        $this->entityModel->createDb();
        $this->entityModel->createTable();
        $this->formData = $_POST;
    }

    public function __get(string $name)
    {
        return $this->$name;
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
        if (isset($this->formData["email"], $this->formData["password"])) {
            $email = $this->formData["email"];
            $password = $this->formData["password"];

            if (!$this->entityModel->checkIfDbExists()) {
                $this->entityModel->createDb();
            }

            if (!$this->entityModel->checkIfTableExists()) {
                $this->entityModel->createTable();
            }

            if ($this->entityModel->checkPassword($email, $password)) {
                echo '<div class="alert alert-success" role="alert">Credentials are correct.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Credentials are incorrect or user does not exist.</div>';
            }
        }

        if (
            isset(
                $this->formData["name"],
                $this->formData["surname"],
                $this->formData["dob"],
                $this->formData["email"],
                $this->formData["password"],
                $_FILES["file"]
            )
        ) {
            $username = $this->formData["name"];
            $surname = $this->formData["surname"];
            $dob = $this->formData["dob"];
            $email = $this->formData["email"];
            $password = $this->formData["password"];
            $file = $_FILES["file"];

            $dobDateTime = DateTime::createFromFormat("Y-m-d", $dob);
            if ($dobDateTime && $dobDateTime->format("Y-m-d") === $dob) {
                $tmpFilePath = null;
                if ($file["error"] === UPLOAD_ERR_OK) {
                    $tmpFile = tmpfile();
                    $metaData = stream_get_meta_data($tmpFile);
                    $tmpFilePath = $metaData["uri"];

                    if (move_uploaded_file($file["tmp_name"], $tmpFilePath)) {
                        echo '<div class="alert alert-success" role="alert">File uploaded successfully.</div>';
                        $fileData = fopen($tmpFilePath, "r");
                        $fileContents = fread(
                            $fileData,
                            filesize($tmpFilePath)
                        );
                        fclose($fileData);
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Failed to upload file.</div>';
                        $tmpFilePath = null;
                    }
                }

                $this->entityModel->addUser(
                    $username,
                    $surname,
                    $dob,
                    $email,
                    $password,
                    $tmpFilePath
                );
                echo '<div class="alert alert-success" role="alert">User registered successfully.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Invalid date of birth.</div>';
            }
        }

        if (isset($this->formData["delete"])) {
            $this->entityModel->deleteAllUserInformation();
            echo '<div class="alert alert-info" role="alert">All user information has been deleted.</div>';
        }

        // deleting POST data to prevent resubmission...
        // ain't gonna do shit, but it's the thought that counts.
        foreach ($_POST as $key => $value) {
            unset($_POST[$key]);
        }
    }
}

$controller = new Controller();

// Ah, the majestic symphony of PHP code... Brace yourself for the cacophony as we dance on the tightrope between order
// and chaos. Will the forms gracefully submit or implode spectacularly? Only PHP knows, and it's not telling because
// xdenug dosent resolve the host. So fu. I'm not bitter, you're bitter.<!DOCTYPE html>
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title><?php echo $controller->viewModel::TITLE; ?></title> <!-- :: !! -->
</head>
<body class="container">
<div class="container form-group">
    <?php echo $controller->getLoginForm(); ?>
</div>
<div class="container form-group">
    <?php echo $controller->getDeletionForm(); ?>
</div>
<?php echo $controller->handleFormSubmission(); ?>
<div class="container form-group">
    <?php echo $controller->getRegistrationForm(); ?>
</div>
<div class="container">
    <br>Controller state:<br>
    <?php var_dump($controller); ?>
    <br>Database state:<br>
    <?php var_dump($controller->entityModel->getUsersAndHashes()); ?>
</div>
</body>
</html>