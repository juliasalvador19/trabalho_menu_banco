<?php

  include 'classes/conexao.class.php';

  class Menu {
    public function listaMenu(){

      $conexao = new Conexao();
      $banco = $conexao->conexaoBanco();
      $sql = 'SELECT acao, texto FROM menu';
      $query = $banco->prepare($sql);
      $query->execute(); 
      
      echo '<ol>';
      foreach($query->fetchAll() as $item){
        echo '<li><a href="'.$item['acao'].'">'.$item['texto'].'</a></li>';
      }
      echo '</ol>';
    }

  

  }

?>