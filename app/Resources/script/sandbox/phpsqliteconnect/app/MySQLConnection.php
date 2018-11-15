<?php
namespace App;

/**
 * MySQL connnection
 */
class MySQLConnection {
    /**
     * PDO instance
     * @var type
     */
    private $pdo;

    /**
     * return in instance of the PDO object that connects to the MySQL database
     * @return \PDO
     */
    public function connect() {

        if ($this->pdo == null) {
            $this->pdo = new \PDO(Config::MYSQL_DSN, Config::MYSQL_USER, Config::MYSQL_PASSWORD);
        }
        return $this->pdo;
    }
}
