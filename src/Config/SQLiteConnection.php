<?php
namespace App\Config;

use App\Config\Database;

/**
 * SQLite connnection
 */
class SQLiteConnection {
    /**
     * PDO instance
     * @var type 
     */
    private $pdo;

    /**
     * return in instance of the PDO object that connects to the SQLite database
     * @return \PDO
     */
    public function connect() {
        if ($this->pdo == null) {
            try {
                $this->pdo = new \PDO("sqlite:/var/www/" . Database::PATH_TO_SQLITE_FILE, '', '', [\PDO::ATTR_PERSISTENT => true]);
             } catch (\PDOException $e) {
                print_R($e); die;
             }
        }
        return $this->pdo;
    }
}