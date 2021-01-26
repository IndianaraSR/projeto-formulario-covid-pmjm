<?php
    Class Formulario {
        private $pdo;

        //conexão com o banco de dados
        public function __construct($dbname, $host, $user, $senha){
            try {
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $senha);
            } catch (Exception $e){
                echo "ERRO COM BANCO DE DADOS".$e->getMessage();
                exit();
            } catch (Exception $e){
                echo "ERRO".$e->getMessage();
                exit();
            }
        }

        //cadastrar usuario
        public function cadastrarRelatorio($user_id, $febre, $dor_no_corpo, $tosse_seca, $cansaco, $dificuldade_para_respirar, $mensagem) {
            $cmd = $this->pdo->prepare("INSERT INTO formulario_covid (usuario_id, febre, dor_no_corpo, tosse_seca, cansaco, dificuldade_para_respirar, mensagem) VALUES (:u, :f, :d, :t, :c, :i, :m)");
            $cmd->bindValue(":u", $user_id);
            $cmd->bindValue(":f", $febre);
            $cmd->bindValue(":d", $dor_no_corpo);
            $cmd->bindValue(":t", $tosse_seca);
            $cmd->bindValue(":c", $cansaco);
            $cmd->bindValue(":i", $dificuldade_para_respirar);
            $cmd->bindValue(":m", $mensagem);
            $cmd->execute();

            return true;
        }
    
        public function getLast($user_id) {
            $stmt = $this->pdo->prepare("SELECT * FROM formulario_covid");
            $stmt->bindValue(":c", $user_id);
            $relatorios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $relatorios;
        }
    }
?>