<?php
// Estrutura da classe de conexão.
class Database {
    private static $instance = null;    //
    private $connection;                // Variaveis para instancia e conexão.

    // O construtor privado da classe estabelece a conexão com o banco de dados utilizando a extensão PDO do PHP.
    private function __construct() {
        $host = "localhost";
        $username = "root";                 // Variaveis que recebem os dados do BD
        $password = "";
        $database = "padraodeprojetos";

        // Logica que testa a conexão.
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {                                                             
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
            exit;
        }
    }
    // Este é um método estático que retorna a única instância da classe `Database`. Se ainda não houver uma instância, uma nova é criada.
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    // Retorna a conexão PDO estabelecida com o banco de dados.
    public function getConnection() {
        return $this->connection;
    }
}

$database = Database::getInstance();
$connection = $database->getConnection();
?>
