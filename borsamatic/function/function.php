<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'borsamatic';
    private $username = 'root';
    private $password = '';
    public $conn;

    // Bağlantı fonksiyonu
    public function connect() {
        $this->conn = null;

        try {
            // PDO üzerinden MySQL bağlantısı
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec('set names utf8');
        } catch(PDOException $e) {
            echo 'Bağlantı hatası: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
