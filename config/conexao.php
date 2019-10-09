<?php 
    if(file_exists('../config.php')){
        require_once('../config.php');
    }else{
        ini_set('display_errors',1);
        ini_set('display_startup_erros',1);
        error_reporting(E_ALL);
        throw new exception('Arquivo config não existe!');
    } 
?>
<?php 
    class conexao extends PDO{
        public $host;
        public $dbname;
        public $user;
        public $password;

        public $con;

        public function __construct()
        {
            if (trim(MYSQL_HOST) == '') throw new exception('Não Existe Host Configurado');
            if (trim(MYSQL_DB_NAME) == '') throw new exception('Não Existe Nome do Banco Configurado');
            if (trim(MYSQL_USER) == '') throw new exception('Não Existe Usuario Configurado');
            if (trim(MYSQL_PASSWORD) == '') throw new exception('Não Existe Senha Configurado');
        
            $this->host = MYSQL_HOST;
            $this->dbname = MYSQL_DB_NAME;
            $this->user = MYSQL_USER;
            $this->password = MYSQL_PASSWORD;

            $this->getConexao();
            
        }

        private function getConexao(){
            try {
                $conexao = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname."", $this->user, $this->password);
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$conexao->disableCache();
            } catch (PDOException $e) {
                if($e->getCode() == 1049){
                    echo "Não existe banco de dados, por favor execute o arquivo .sql do projeto.";
                    exit();   
                }
                echo "Erro: " . $e->getMessage();
            }
            
            $this->con = $conexao;
        }
    };
?>