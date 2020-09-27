<?php
    Class Usuario{
        private $pdo;

        //conexão com o banco de dados
        public function __construct($dbname, $host, $user, $senha){

            try{
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
            
            }catch (Exception $e){
                echo "ERRO COM BANCO DE DADOS".$e->getMessage();
                exit();

            }catch (Exception $e){
                echo "ERRO".$e->getMessage();
                exit();

            }            

        }

        public function buscarDados(){
            $res = array();
            $cmd = $this->pdo->prepare("SELECT * FROM usuarios ORDER BY nome");
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;

        }

        //cadastrar usuario
        public function cadastrarUsuario($nome, $cpf, $telefone, $email, $senha){
            //verifica se já possui cadastro
            $cmd = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE  cpf = :c");
            $cmd->bindValue(":c",$cpf);
            $cmd->execute();

            if($cmd->rowCount() > 0){
                return false;

            }else{
                $cmd = $this->pdo->prepare("INSERT INTO usuarios (nome, cpf, telefone, email, senha) VALUES (:n, :c, :t, :e, :s)");
                $cmd->bindValue(":n",$nome);
                $cmd->bindValue(":c",$cpf);
                $cmd->bindValue(":t",$telefone);
                $cmd->bindValue(":e",$email);
                $cmd->bindValue(":s",md5($senha));
                $cmd->execute();
                return true;
            }

        }

        //login
        public function login($cpf, $senha){
            $res = array();
            $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE cpf = :c AND senha = :s");
            $cmd->bindValue(":c",$cpf);
            $cmd->bindValue(":s",md5($senha));
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;

/*$cmd = $pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
$cmd->bindValue(":id",1);
$cmd->execute();
$resultado = $cmd->fetch(PDO::FETCH_ASSOC);*/
        }


    }

?>