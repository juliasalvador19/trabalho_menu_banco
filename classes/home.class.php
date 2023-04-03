<?php

    include "autoload.php";

    class Home {

        public function montarPagina(){

            $html = new Html('pt-br');

            $head = new Head();
            $html->addElemento($head);
            
            $meta1 = new Meta('UTF-8', null, null, null);
            $meta2 = new Meta(null, 'X-UA-Compatible', 'IE=edge', null);
            $meta3 = new Meta(null, null, 'width=device-width, initial-scale=1.0', 'viewport');
            $head->addElemento($meta1);
            $head->addElemento($meta2);
            $head->addElemento($meta3);

            $title = new Title('Trabalho - Menu');
            $head->addElemento($title);
            
            $body = new Body();
            $html->addElemento($body);

            $menu = new Menu("menu-principal");
            $body->addElemento($menu);

            $ul = new Ul();
            $menu->addElemento($ul);
            
            $ul->addElemento(new Li("<a href='#'>Home</a>"));
            $ul->addElemento(new Li("<a href='#'>Pessoa</a>"));
            $ul->addElemento(new Li("<a href='#'>Produto</a>"));

            echo $html;
   
        }
    }

?>