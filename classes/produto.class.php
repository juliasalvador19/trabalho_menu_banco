<?php

    include "autoload.php";

    class Produto {

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

            $title = new Title('Trabalho - Menu|Produto');
            $head->addElemento($title);
            
            $body = new Body();
            $html->addElemento($body);

            echo $html;

            $link = new Link ('https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css', 'stylesheet');
            $head->addElemento($link);
            
            $body = new Body();
            $html->addElemento($body);

            $table = new Table();
            echo $table->ListarProduto();
            $table->excluirProduto();
            $table->alterarProduto();
            $table->cadastrarProduto();

            echo $html;
   
        }
    }

?>