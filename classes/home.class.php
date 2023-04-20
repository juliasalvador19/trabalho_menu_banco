<?php

    include "autoload.php";

    class Home {

        public function montarPagina(){

            $html = new Html('pt-br');

            $head = new Head();
            $html->addElemento($head);
            
            $head->addElemento(new Meta('UTF-8', null, null, null));
            $head->addElemento(new Meta(null, 'X-UA-Compatible', 'IE=edge', null));
            $head->addElemento(new Meta(null, null, 'width=device-width, initial-scale=1.0', 'viewport'));

            $title = new Title('Trabalho - Menu');
            $head->addElemento($title);
            
            $body = new Body();
            $html->addElemento($body);

            $link = new Link ('https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css', 'stylesheet');
            $head->addElemento($link);
            
            $body = new Body();
            $html->addElemento($body);

            $menu = new Menu();
            $menu->listaMenu();

            echo $html;
   
        }
    }

?>