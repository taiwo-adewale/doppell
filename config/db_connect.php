<?php

  require_once __DIR__."/../vendor/autoload.php";

  $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../');
  $dotenv->load();

  class Database {

    private $server;
    private $username;
    private $password;
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    protected $conn;

    function __construct() {
      $this->server = "mysql:host={$_ENV['DB_SERVER_MYSQL_HOST']};dbname={$_ENV['DB_SERVER_MYSQL_DBNAME']}";
      $this->username = $_ENV["DB_USERNAME"];
      $this->password = $_ENV["DB_PASSWORD"];
    }

    public function open() {
      try {
        $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
        return $this->conn;
      }
      catch (PDOException $e) {
        echo 'Connection error: ' . $e->getMessage();
      }
    }

    public function close() {
      $this->conn = null;
    }

  }

  $pdo = new Database();

?>