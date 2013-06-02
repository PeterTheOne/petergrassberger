<?php

include_once('AbstractController.class.php');

abstract class AbstractPdoController extends AbstractController {

    protected $config;
    protected $pdo;

    public function __construct($config) {
        // load config
        $this->config = $config;

        // connect to database
        try {
            $this->pdo = new PDO("mysql:host=$config->dbHost;dbname=$config->dbName",
                $config->dbUsername, $config->dbPassword);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}


?>
