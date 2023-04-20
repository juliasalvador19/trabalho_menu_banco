<?php

include 'classes/conexao.class.php';

class Table {
    private $conexao;

    public function __construct() {
        $this->conexao = new Conexao();
    }

    public function ListarPessoa() {
        $sqlpessoa = 'SELECT id, nome, email, datacadastro FROM pessoa';
        $querypessoa = $this->conexao->conexaoBanco()->prepare($sqlpessoa);
        $querypessoa->execute();

        $menu = '<table class="table">';
        $menu .= '<thead class="thead-dark"><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Data Cadastro</th><th>Ações</th></tr></thead>';
        foreach($querypessoa->fetchAll() as $item) {
            $menu .= '<tr><td>' . $item[0] . '</td><td>' . $item[1] . '</td><td>' . $item[2] . '</td><td>' . $item[3] . '</td><td><a class="btn btn-danger" href="?excluir=' . $item[0] . '">Excluir</a> <a class="btn btn-primary" href="?alterar=' . $item[0] . '">Alterar</a></td></tr>';
        }
        $menu .= '</table><hr>';

        return $menu;
    }

    public function excluirPessoa() {
        if(isset($_GET['excluir'])) {
            $id = $_GET['excluir'];
            $sql = "DELETE FROM pessoa WHERE id = ?";
            $query = $this->conexao->conexaoBanco()->prepare($sql);
            $excluido = $query->execute([$id]);

            header("Location: lista_pessoa.php");
            exit;
        }
    }

    public function alterarPessoa() {
        if(isset($_GET['alterar'])) {
            $id = $_GET['alterar'];
            $sql = "SELECT nome, email FROM pessoa WHERE id = ?";
            $query = $this->conexao->conexaoBanco()->prepare($sql);
            $query->execute([$id]);
            $pessoa = $query->fetch();


            echo '<form method="post">';
            echo '<input class="caixa" type="text" name="nome" value="' . $pessoa[0] . '">'. '&nbsp';
            echo '<input class="caixa" type="text" name="email" value="' . $pessoa[1] . '">' . '<br>';
            echo '<input class="btn btn-warning" type="submit" name="alterar" value="Alterar">';
            echo '</form>';
            echo '<hr>';

            if(isset($_POST['alterar'])) {
                $nome = $_POST['nome'];
                $email =  $_POST['email'];
                $sql = "UPDATE pessoa SET nome = ?, email = ? WHERE id = ?";
                $query = $this->conexao->conexaoBanco()->prepare($sql);
                $atualizado = $query->execute([$nome, $email, $id]);

                header("Location: lista_pessoa.php");
                exit;
                
            }
        }
    }

    public function cadastrarPessoa() {
        if(isset($_POST['cadastrar'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $datacadastro = $_POST['datacadastro'];
            $sql = "INSERT INTO pessoa (nome, email, datacadastro) VALUES (?, ?, ?)";
            $query = $this->conexao->conexaoBanco()->prepare($sql);
            $cadastrado = $query->execute([$nome, $email, $datacadastro]);
    
            header("Location: lista_pessoa.php");
            exit;
        }
    
        echo '<h4>Cadastrar pessoa</h4>';
        echo '<form method="post">';
        echo '<input class="caixa" type="text" name="nome" autocomplete="off" placeholder="Nome" required><br>';
        echo '<input class="caixa" type="text" name="email" autocomplete="off" placeholder="Email" required><br>';
        echo '<input class="caixa" type="datetime-local" name="datacadastro" required><br>';
        echo '<input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar"><br>';
        echo '</form>';
    }

    public function ListarProduto() {
        $sqlproduto = 'SELECT id, nome, valor, total_estoque FROM produto';
        $queryproduto = $this->conexao->conexaoBanco()->prepare($sqlproduto);
        $queryproduto->execute();

        $menu = '<table class="table">';
        $menu .= '<thead class="thead-dark"><tr><th>ID</th><th>Nome</th><th>Valor</th><th>Estoque</th><th>Ações</th></tr></thead>';
        foreach($queryproduto->fetchAll() as $item) {
            $menu .= '<tr><td>' . $item[0] . '</td><td>' . $item[1] . '</td><td>' . $item[2] . '</td><td>' . $item[3] . '</td><td><a class="btn btn-danger" href="?excluir=' . $item[0] . '">Excluir</a> <a class="btn btn-primary" href="?alterar=' . $item[0] . '">Alterar</a></td></tr>';
        }
        $menu .= '</table><hr>';

        return $menu;
    }

    public function excluirProduto() {
        if(isset($_GET['excluir'])) {
            $id = $_GET['excluir'];
            $sql = "DELETE FROM produto WHERE id = ?";
            $query = $this->conexao->conexaoBanco()->prepare($sql);
            $excluido = $query->execute([$id]);

            header("Location: lista_produto.php");
            exit;
        }
    }

    public function alterarProduto() {
        if(isset($_GET['alterar'])) {
            $id = $_GET['alterar'];
            $sql = "SELECT nome, valor, total_estoque FROM produto WHERE id = ?";
            $query = $this->conexao->conexaoBanco()->prepare($sql);
            $query->execute([$id]);
            $produto = $query->fetch();

            echo '<form method="post">';
            echo '<input class="caixa" type="text" name="nome" value="' . $produto[0] . '">&nbsp';
            echo '<input class="caixa" type="number" name="valor" value="' . $produto[1] . '">&nbsp';
            echo '<input class="caixa" type="number" name="total_estoque" value="' . $produto[2] . '"><br>';
            echo '<input class="btn btn-warning" type="submit" name="alterar" value="Alterar">';
            echo '</form>';
            echo '<hr>';

            if(isset($_POST['alterar'])) {
                $nome = $_POST['nome'];
                $valor = $_POST['valor'];
                $total_estoque =  $_POST['total_estoque'];
                $sql = "UPDATE produto SET nome = ?, valor = ?, total_estoque = ? WHERE id = ?";
                $query = $this->conexao->conexaoBanco()->prepare($sql);
                $atualizado = $query->execute([$nome, $valor, $total_estoque, $id]);

                header("Location: lista_produto.php");
                exit;
                
            }
        }
    }

    public function cadastrarProduto() {
        if(isset($_POST['cadastrar'])) {
            $id = $_POST['id'];
           	$nome = $_POST['nome'];
            $valor = $_POST['valor'];
            $total_estoque =  $_POST['total_estoque'];
            $sql = "INSERT INTO produto (id, nome, valor, total_estoque) VALUES (?, ?, ?, ?)";
            $query = $this->conexao->conexaoBanco()->prepare($sql);
            $cadastrado = $query->execute([$id, $nome, $valor, $total_estoque]);
    
            header("Location: lista_produto.php");
            exit;
        }
    
        echo '<h4>Cadastrar produto</h4>';
        echo '<form method="post">';
        echo '<input class="caixa" type="number" name="id" autocomplete="off" placeholder="Código" required><br>';
        echo '<input class="caixa" type="text" name="nome" autocomplete="off" placeholder="Nome" required><br>';
        echo '<input class="caixa" type="number" name="valor" autocomplete="off" placeholder="Valor" required><br>';
        echo '<input class="caixa" type="number" name="total_estoque" autocomplete="off" placeholder="Estoque" required><br>';
        echo '<input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar"><br>';
        echo '</form>';
    }

    public function ListarUsuario() {
        $sqlusuario = 'SELECT id, nome, email FROM usuario';
        $queryusuario = $this->conexao->conexaoBanco()->prepare($sqlusuario);
        $queryusuario->execute();

        $menu = '<table class="table">';
        $menu .= '<thead  class="thead-dark"><tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr></thead>';
        foreach($queryusuario->fetchAll() as $item) {
            $menu .= '<tr><td>' . $item[0] . '</td><td>' . $item[1] . '</td><td>' . $item[2] . '</td><td><a class="btn btn-danger" href="?excluir=' . $item[0] . '">Excluir</a> <a class="btn btn-primary" href="?alterar=' . $item[0] . '">Alterar</a></td></tr>';
        }
        $menu .= '</table><hr>';

        return $menu;
    }

    public function excluirUsuario() {
        if(isset($_GET['excluir'])) {
            $id = $_GET['excluir'];
            $sql = "DELETE FROM usuario WHERE id = ?";
            $query = $this->conexao->conexaoBanco()->prepare($sql);
            $excluido = $query->execute([$id]);

            header("Location: lista_usuario.php");
            exit;
        }
    }

    public function alterarUsuario() {
        if(isset($_GET['alterar'])) {
            $id = $_GET['alterar'];
            $sql = "SELECT nome, email FROM usuario WHERE id = ?";
            $query = $this->conexao->conexaoBanco()->prepare($sql);
            $query->execute([$id]);
            $usuario = $query->fetch();

            echo '<form method="post">';
            echo '<input class="caixa" type="text" name="nome" value="' . $usuario[0] . '">&nbsp';
            echo '<input class="caixa" type="text" name="email" value="' . $usuario[1] . '"><br>';
            echo '<input class="btn btn-warning" type="submit" name="alterar" value="Alterar">';
            echo '</form>';
            echo '<hr>';

            if(isset($_POST['alterar'])) {
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $sql = "UPDATE usuario SET nome = ?, email = ? WHERE id = ?";
                $query = $this->conexao->conexaoBanco()->prepare($sql);
                $atualizado = $query->execute([$nome, $email, $id]);

                header("Location: lista_usuario.php");
                exit;
                
            }
        }
    }

    public function cadastrarUsuario() {
        if(isset($_POST['cadastrar'])) {
            $id = $_POST['id'];
           	$nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha =  $_POST['senha'];
            $sql = "INSERT INTO usuario (id, nome, email, senha) VALUES (?, ?, ?, ?)";
            $query = $this->conexao->conexaoBanco()->prepare($sql);
            $cadastrado = $query->execute([$id, $nome, $email, $senha]);
    
            header("Location: lista_usuario.php");
            exit;
        }
		        
		echo '<h4>Cadastrar usuário</h4>';
        echo '<form method="post">';
        echo '<input class="caixa" type="number" name="id" autocomplete="off" placeholder="Código" required><br>';
        echo '<input class="caixa" type="text" name="nome" autocomplete="off" placeholder="Nome" required><br>';
        echo '<input class="caixa" type="text" name="email" autocomplete="off" placeholder="Email" required><br>';
        echo '<input class="caixa" type="text" name="senha" autocomplete="off"placeholder="Senha" required><br>';
        echo '<input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar"><br>';
        echo '</form>';
    }

    
}
