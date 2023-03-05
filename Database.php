<?php

class Database
{
    public $host_name, $dbname, $username, $password, $conn;

    function __construct()
    {
        $this->host_name = "localhost";
        $this->dbname = "kanal-rss";
        $this->username = "root";
        $this->password = "";
        try {

            $this->conn = new PDO("mysql:host=$this->host_name;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function insert($link, $title, $desc, $date)
    {
        $sql = "INSERT INTO rss_added (rss_link, rss_title, rss_desc, rss_date) VALUES (?,?,?,?)";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$link, $title, $desc, $date]);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getSimilar($similar)
    {
        $sql = "SELECT * FROM rss_added WHERE rss_title = ?";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$similar]);
            $addTitle = ($stmt->rowCount() == 0) ? true : false;
            return $addTitle;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
