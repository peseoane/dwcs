## Cosas a tener en cuenta de cara al examen:

- **NO usar atributos públicos.**

- Cuando utilices funciones callback, poner siempre como segundo argumento el índice.

- Asegurarse siempre de cerrar ficheros y recursos.

- Cuando trabajes con punteros en arrays, devolver siempre el puntero al inicio al terminar:
	- Método `reset()` en arrays.
	  ```php
      $array = [1, 2, 3];
      reset($array);
      ```

	- Método `rewind()` en objetos iterables.
	  ```php
      $iterator = new ArrayIterator([1, 2, 3]);
      $iterator->rewind();
      ```

- Asegurarse de que las funciones recursivas:
	- Tengan una condición de parada.
	  ```php
      function factorial($n) {
          if ($n <= 1) {
              return 1;
          }
          return $n * factorial($n - 1);
      }
      ```
	- Tengan la condición de parada ANTES de la ejecución del resto del código.

- Usar el método POST en formularios cuando se maneje información de usuarios.
	- Sólo usar GET con cosas como consultas de búsqueda.

- El envío de ficheros SÓLO puede ser con el método POST.
	- Recordar el atributo `enctype="multipart/form-data"`

- Recordar que `die()` termina la ejecución del programa abruptamente.

- Si trabajas con clases y objetos, siempre que puedas usa los métodos de estos en lugar de funciones procedimentales.

- Validar todos los datos introducidos por los usuarios en un formulario, usando las funciones:
	- `htmlspecialchars()`
	  ```php
      $input = '<script>alert("Hello");</script>';
      $safe_input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
      ```

	- `trim()`
	  ```php
      $input = '  Hello  ';
      $trimmed_input = trim($input);
      ```

	- `stripslashes()`
	  ```php
      $input = "It\'s a beautiful day";
      $clean_input = stripslashes($input);
      ```

- En lugar de usar `action="PÁGINA"` para la propia página, usar `action=<?php htmlspecialchars($_SERVER["PHP_SELF"])?>`

- Poner el header, cookies y sesiones antes de cualquier contenido en HTML.

- No utilizar variables de sesión antes de haber iniciado la sesión con `session_start()`

- Para eliminar totalmente una sesión:
	- Borrar la variable de sesión con `unset($_SESSION)` o `session_unset()`
	- Comprobar si existe la cookie de sesión, y de ser así, borrarla, de ésta manera:
	  ```php
      if (isset($_COOKIE[session_name()])) {
          setcookie(session_name(), "", 1);
      }
      ```
	- Cerrar la sesión usando `session_destroy()`

- Los resultados de hacer cambios sobre las cookies sólo se verán al recargar la página.

- No incluyas el path a la hora de crear una cookie, por defecto se creará donde se encuentre el fichero.

- SÓLO USAR `file_get_contents()` cuando puedas estimar el tamaño del archivo con el que se esté trabajando, para evitar la saturación de la memoria volátil.

- Encriptar SIEMPRE las contraseñas, usando `password_hash()`. Para comprobar contraseñas encriptadas, usar `password_verify()`.

- Al crear funciones, todos los datos que requiera la función para su funcionamiento DEBEN pasársele por cabecera.

- Falsos amigos en PHP:
	- `file_exists()` no sólo comprueba ficheros, también directorios.
	  ```php
      $path = '/ruta/a/fichero_o_directorio';
      if (file_exists($path)) {
          // Existe
      }
      ```
	- `unlink()` no "desvincula", elimina el fichero indicado.
	  ```php
      $file_path = '/ruta/a/archivo.txt';
      unlink($file_path);
      ```
	- `session_destroy()` no "destruye" la sesión, sólo la interrumpe.
	  ```php
      session_destroy();
      ```
	- `session_start()` no sólo "comienza" una sesión, también la reanuda.
	  ```php
      session_start();
      ```
	- `readdir()` no sólo lee los archivos "regulares" de un directorio, también:
		- Los archivos "." (alusión al mismo directorio)
		- Los archivos ".." (alusión al directorio padre)
		- Todos los archivos ocultos.
	  ```php
      $dir = '/ruta/a/directorio';
      $dh  = opendir($dir);
      while (false !== ($filename = readdir($dh))) {
          // Procesar $filename
      }
      closedir($dh);
      ```