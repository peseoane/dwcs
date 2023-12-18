# Examen de DWCS (1ª evaluación)

Escribe en lenguaje PHP los siguientes ejercicios:

## Introducción

Se quiere modelar un sistema de gestión de reparaciones de un taller donde por cada reparación debemos recoger las piezas
empleadas y mantener un inventario de nuestro almacén.

En el inventario, por cada pieza recogemos:

- Código
- Nombre de la pieza
- Su cantidad disponible.

De las reparaciones tenemos los siguientes datos:

- Identificador.
- Descripción.
- Fecha.
- Nombre del operario.
- Conjunto de piezas empleado _(Su código y cantidad)_.

## Ejercicio 1

Crear una función anónima que reciba un array `Inventario`, un código y una cantidad.

Esta deberá buscar en el código si existe en el array, y si la cantidad solicitada es igual o inferior a la disponible
actualizará el inventario.
De no ser así, retornará un `False`.

## Ejercicio 2

Crearemos una web formada por los siguientes ficheros:

### `index.php`

Se nos muestran dos formularios, siendo uno para hacer **login** _(user + pwd)_ y otro para **registro** _(user + pwd +
repetición de pwd)_.

Supondremos que `pwd = "1234"`, y que el nombre de usuario será el propio email.

Si nos autenticamos correctamente _(Cualquier email con la `pwd` predefinida)_ y seremos redirigidos a `reparaciones.php`,
así mismo, guardaremos él `user` y `pwd` en una cookie.

Se permitirá un máximo de 3 intentos de login fallidos antes de ejecutar un bloqueo, ese bloqueo redirigirá a una página
de error con un mensaje personalizado.

> **NOTA:** hay que realizar la validación adecuada a cada campo. El `pwd` no se puede guardar tal y como se recibe.

**Realizar una clase que lleve una cuenta de intentos**.

### `reparaciones.php`

Habrá un formulario donde será representado únicamente mediante tres campos lo siguiente:

- Fecha pre-cubierta con la fecha actual. _(Usando una clase PHP para tales efectos)_.
- Un campo descripciones y el nombre del operario. _(el cual lo leerá de una cookie)_.

**En caso de cubrir correctamente** todos estos campos, se guardará la reparación y nos redirigirá a `piezas.php`.

> **NOTA:** el código de la reparación es incremental y se debe arrastrar al siguiente formulario.

### `piezas.php`

Formulario donde se mostrarán los siguientes campos:

- **Finalizar**: nos lleva a `mensaje.php`.
- **Añadir más piezas**: seguimos introduciendo más piezas a esa reparación, es decir, permaneciendo en la página actual
  actualizaremos el inventario _(descontando las piezas)_.
- **Cancelar operación**: borra todos los datos introducidos hasta el momento de forma que no va a existir la reparación
  en el sistema y las piezas que fuimos descontanto tenemos que volver a añadirlas al inventario, después seremos redirigidos
  a `mensaje.php`.
- Introducir una nueva reparación: nos lleva a `reparaciones.php`.

## `mensaje.php`

Muestra un mensaje personalizado dependiendo de cómo haya llegado _(por tanto, puede recibir diferentes parámetros)_:

- Si se introdujeran 3 veces mal el login, se mostrará un mensaje de error diciendo que `foo@bar` ha sido bloqueado.
- Mensaje dándonos las gracias y finalizando adecuadamente el programa. **No hay que borrar datos**.

## Ejercicio 3

Unir todas las piezas de los diferentes apartados de modos que empleemos una función que genera las variables de servidor,
_(reparaciones e inventario)_ tras hacer login, de forma que al menos tengamos tres reparaciones que empleen 1,2 y 3 piezas
respectivamente y un array inventario de al menos con 10 piezas.

> **NOTA:** utilizar comprobación estricta de tipos y que los datos introducidos en algún formulario no los tengamos que reescribir.