<?php declare(strict_types=1);
class FileUploader
{
    private const MAX_FILES = 10;
    private const UPLOAD_DIR = "uploads/";

    public static function processFiles(array $files): void
    {
        if (!isset($_POST["submit"])) {
            throw new Exception("El formulario no ha sido enviado.");
        }

        if (isset($files["files"]) && is_array($files["files"]["name"])) {
            foreach ($files["files"]["name"] as $key => $fileName) {
                $fileTmp = $files["files"]["tmp_name"][$key];
                $fileSize = $files["files"]["size"][$key];

                if ($fileSize > 0) {
                    self::checkAndCreateUploadDir();

                    $destination = self::UPLOAD_DIR . $fileName;

                    if (!move_uploaded_file($fileTmp, $destination)) {
                        throw new Exception(
                            "Error al mover el archivo $fileName."
                        );
                    }

                    echo "<div>Archivo $fileName subido correctamente.<div>";
                }
            }
        } else {
            echo "No se envió ningún archivo.";
        }
    }

    private static function checkAndCreateUploadDir(): void
    {
        if (
            !file_exists(self::UPLOAD_DIR) &&
            !mkdir(self::UPLOAD_DIR, 0777, true)
        ) {
            throw new Exception("Error al crear el directorio de subida.");
        }
    }
}

try {
    FileUploader::processFiles($_FILES);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
