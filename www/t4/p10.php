<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Subida de Archivos</title>
</head>
<body>
<form method="post" action="p10form.php" enctype="multipart/form-data">
    <p>Subir archivos:</p>
    <div id="file-container">
        <input type="file" name="files[]">
    </div>
    <button type="button" id="add-file">Agregar archivo</button>
    <br/>
    <br/>
    <input type="submit" name="submit" value="Enviar" />
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const maxFiles = 10;
        const fileContainer = document.getElementById("file-container");

        document.getElementById("add-file").addEventListener("click", function() {
            if (fileContainer.childElementCount < maxFiles) {
                let newInput = document.createElement("input");
                newInput.type = "file";
                newInput.name = "files[]";
                fileContainer.appendChild(newInput);
            } else {
                alert("Se alcanzó el número máximo de archivos permitidos (10).");
            }
        });
    });
</script>
</body>
</html>