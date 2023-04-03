<?php

    class Menu {
        private $class;
        private $listaElementos = [];

        function __construct($class) {
            if ($class) {$this->class = $class;};
        }

        function addElemento($elemento) {
            $this->listaElementos[] = $elemento;
        }

        function __toString() {
            $menu = "<menu class=\"{$this->class}\">"; 
            foreach($this->listaElementos as $iListaElementos){
                $menu .= $iListaElementos;
            }
            $menu .= "</menu>";
            return $menu;       
        }
    }
?>