<?php

    class Alumno {
        private $nombre;
        private $apellidos;
        private $notas = array();

        public function __construct($nombre, $apellidos, $notas) {
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->notas = $notas;
        }

        public function __get($nombre){
            if (property_exists($this, $nombre));
            return $this->$nombre;
        }

        public function __set($nombre, $valor){
            if (property_exists($this, $nombre));
            $this->$nombre = $valor;
        }
    }

    function sumArray($obj){

        if($obj->__get('nombre') == 'Pepe'){

            $myArray = $obj->__get('notas');

            $count = count($myArray);

            for ($i = 0; $i < $count; $i++){
                $myArray[$i] = $myArray[$i] + 1;
            }
            
            $obj->__set('notas',$myArray);
        }
    };
    
    $Manolo = new Alumno('Manolo', 'Perez', array(5,3,4));
    $Pepe = new Alumno('Pepe','Martinez',array(1,3,2));
    $Maria = new Alumno('Maria','Alvarez',array(9,7,5));
    $Francisco = new Alumno('Francisco','Alvarez',array(4,6,3));

    $alumnos = array($Manolo,$Pepe,$Maria,$Francisco);

    array_walk($alumnos,'sumArray');

    echo implode(',',$Manolo->__get('notas')).'<br>';
    echo implode(',',$Pepe->__get('notas')).'<br>';
    echo implode(',',$Maria->__get('notas')).'<br>';
    echo implode(',',$Francisco->__get('notas')).'<br>';

?>