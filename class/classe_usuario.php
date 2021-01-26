<?php
    Class Usuario{
        private $pdo;

        //conexão com o banco de dados
        public function __construct($dbname, $host, $user, $senha){

            try{
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $senha);
            
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

        public function findByCpf($cpf) {
            $res = array();
            $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE cpf=? ORDER BY nome");
            $stmt->execute([$cpf]);
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        }

        public function findBy($query) {
            $str = "SELECT * FROM usuarios";
    
            $i = 0;
            foreach($query as $key => $value) {
                if($i == 0)
                    $str .= " WHERE " . $key . "=\"" . $value . "\"";
                else
                    $str .= " AND " . $key . "=\"" . $value . "\"";

                $i++;
            }

            $stmt = $this->pdo->prepare($str);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $user;
        }

        //cadastrar usuario
        public function cadastrarUsuario($nome, $cpf, $telefone, $email, $senha) {
            //verifica se já possui cadastro
            $cmd = $this->pdo->prepare("SELECT id FROM usuarios WHERE  cpf = :c");
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
            return $this->findBy(array("cpf"=>$cpf, "senha"=>md5($senha)));

            /*$cmd = $pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
            $cmd->bindValue(":id",1);
            $cmd->execute();
            $resultado = $cmd->fetch(PDO::FETCH_ASSOC);*/
        }

        public function getDados($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM dados WHERE usuario_id=?");
            $stmt->execute([$id]);
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        }

        public function cadastrarDados($id, $idade, $sexo, $gestante, $trabalho, $grupo_de_risco) {
            $cmd = $this->pdo->prepare("SELECT * FROM dados WHERE usuario_id = :i");
            $cmd->bindValue(":i", $id);
            $cmd->execute();

            if($cmd->rowCount() > 0)
                return false;

            $cmd = $this->pdo->prepare("INSERT INTO dados (usuario_id, idade, sexo, gestante, autodeclarado, trabalho) VALUES (:u, :i, :s, :g, :a, :t)");
            $cmd->bindValue(":u", $id);
            $cmd->bindValue(":i", $idade);
            $cmd->bindValue(":s", $sexo);
            $cmd->bindValue(":g", $gestante);
            $cmd->bindValue(":a", $grupo_de_risco);
            $cmd->bindValue(":t", $trabalho);
            $cmd->execute();

            return true;
        }
    }

?>