<?php
/**
 * Database Migration Script
 * Executa o schema do banco de dados
 */

require_once __DIR__ . '/../src/config/env.php';

try {
    $dsn = sprintf(
        'mysql:host=%s:%d;charset=utf8mb4',
        DB_HOST,
        DB_PORT
    );

    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    
    // Leia e execute o arquivo SQL
    $sql = file_get_contents(__DIR__ . '/init.sql');
    
    // Divida por ; e execute cada comando
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            $pdo->exec($statement);
            echo "✓ Executed: " . substr($statement, 0, 50) . "...\n";
        }
    }
    
    echo "\n✅ Database migration completed successfully!\n";
    
} catch (PDOException $e) {
    echo "❌ Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
?>
