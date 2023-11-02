<?php
include(__DIR__ . '/../config.php');

/**
 * Obtém uma instância de conexão com o banco de dados.
 *
 * @return PDO|null Retorna uma instância de conexão PDO em caso de sucesso ou null em caso de falha.
 */
function getDBConnection() {
    try {
        $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return null;
    }
}
