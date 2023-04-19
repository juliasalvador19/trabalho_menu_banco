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

        $menu = '<table>';
        $menu .= '<tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Data Cadastro</th><th>Ações</th></tr>';
        foreach($querypessoa->fetchAll() as $item) {
            $menu .= '<tr><td>' . $item[0] . '</td><td>' . $item[1] . '</td><td>' . $item[2] . '</td><td>' . $item[3] . '</td><td><a href="?excluir=' . $item[0] . '">Excluir</a> | <a href="?alterar=' . $item[0] . '">Alterar</a></td></tr>';
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
            echo '<input type="text" name="nome" value="' . $pessoa[0] . '">';
            echo '<input type="text" name="email" value="' . $pessoa[1] . '">';
            echo '<input type="submit" name="alterar" value="Alterar">';
            echo '</form>';

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
        echo '<input type="text" name="nome" placeholder="Nome da pessoa" required><br>';
        echo '<input type="text" name="email" placeholder="Email da pessoa" required><br>';
        echo '<input type="date" name="datacadastro" placeholder="Data de cadastro da pessoa" required><br>';
        echo '<input type="submit" name="cadastrar" value="Cadastrar"><br>';
        echo '</form>';
    }

    public function ListarProduto() {
        $sqlproduto = 'SELECT id, nome, valor, total_estoque FROM produto';
        $queryproduto = $this->conexao->conexaoBanco()->prepare($sqlproduto);
        $queryproduto->execute();

        $menu = '<table>';
        $menu .= '<tr><th>ID</th><th>Nome</th><th>Valor</th><th>Estoque</th><th>Ações</th></tr>';
        foreach($queryproduto->fetchAll() as $item) {
            $menu .= '<tr><td>' . $item[0] . '</td><td>' . $item[1] . '</td><td>' . $item[2] . '</td><td>' . $item[3] . '</td><td><a href="?excluir=' . $item[0] . '">Excluir</a> | <a href="?alterar=' . $item[0] . '">Alterar</a></td></tr>';
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
            echo '<input type="text" name="nome" value="' . $produto[0] . '">';
            echo '<input type="number" name="valor" value="' . $produto[1] . '">';
            echo '<input type="number" name="total_estoque" value="' . $produto[2] . '">';
            echo '<input type="submit" name="alterar" value="Alterar">';
            echo '</form>';

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
        echo '<input type="number" name="id" placeholder="Codigo do produto" required><br>';
        echo '<input type="text" name="nome" placeholder="Nome do produto" required><br>';
        echo '<input type="number" name="valor" placeholder="Valor" required><br>';
        echo '<input type="number" name="total_estoque" placeholder="Estoque" required><br>';
        echo '<input type="submit" name="cadastrar" value="Cadastrar"><br>';
        echo '</form>';
    }

    
}
