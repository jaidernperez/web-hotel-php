<?php

namespace Config;

use PDO;

class Conn
{
    private $engine;
    private $host;
    private $port;
    private $dbname;
    private $user;
    private $password;
    private $debug;
    /**
     * @var PDO
     */
    protected $conn;

    public function __construct() {
        $CONFIG = parse_ini_file("env.php");
        $this->engine = $CONFIG["DB_CONNECTION"];
        $this->host = $CONFIG["DB_HOST"];
        $this->port = $CONFIG["DB_PORT"];
        $this->dbname = $CONFIG["DB_DATABASE"];
        $this->user = $CONFIG["DB_USERNAME"];
        $this->password = $CONFIG["DB_PASSWORD"];
        $this->debug = $CONFIG["DB_DEBUG"];
        $this->connect();
    }

    public function connect() {
        switch ($this->engine) {
            case "mysql":
                $encoding = "SET NAMES \"UTF8\"";
                $textString = "mysql:host={$this->host};dbname={$this->dbname};port=3306</br>";
                $array = array(PDO::MYSQL_ATTR_INIT_COMMAND => $encoding);
                $this->conn = new PDO($textString, $this->user, $this->password, $array);
                $this->conn->query("SET SESSION sql_mode=\"STRICT_TRANS_TABLES \"");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                break;
            case "pgsql":
                $textString = "pgsql:host={$this->host};dbname={$this->dbname}";
                $this->conn = new PDO($textString, $this->user, $this->password);
                $this->conn->query("SET SESSION sql_mode=\"STRICT_TRANS_TABLES \"");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                break;
            default:
                echo "Motor not supported";
                exit();
        }
    }

}