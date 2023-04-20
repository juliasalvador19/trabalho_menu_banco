<?php
  class Conexao {
    private $host = 'mysql:host=localhost;dbname=menu';
    private $usuario = 'root';
    private $senha = '';
    public $conexao;

    public function conexaoBanco() {
      return new PDO($this->host, $this->usuario, $this->senha);
    }
  }

?>
