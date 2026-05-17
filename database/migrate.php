<?php
/**
 * Database Migration Script
 * Executa o schema do banco de dados
 * 
 * Usage: php database/migrate.php
 */

// Load environment variables
require_once __DIR__ . '/../src/config/env.php';

echo "🚀 Starting database migration...\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

try {
    // Connect to MySQL server (without database)
    $dsn = sprintf(
        'mysql:host=%s:%d;charset=utf8mb4',
        DB_HOST,
        DB_PORT
    );

    echo "📡 Connecting to MySQL at " . DB_HOST . ":" . DB_PORT . "...\n";
    
    $pdo = new PDO(
        $dsn,
        DB_USER,
        DB_PASSWORD,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );

    echo "✅ Connected successfully!\n\n";

    // Create database if not exists
    echo "📦 Creating database '" . DB_NAME . "' if not exists...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✅ Database ready!\n\n";

    // Select database
    $pdo->exec("USE `" . DB_NAME . "`");

    // Read migration file
    $migrationFile = __DIR__ . '/init.sql';
    
    if (!file_exists($migrationFile)) {
        throw new Exception("Migration file not found: $migrationFile");
    }

    echo "📖 Reading migration file: $migrationFile\n";
    $sql = file_get_contents($migrationFile);

    // Split by semicolon and execute each statement
    $statements = array_filter(
        array_map('trim', explode(';', $sql)),
        function($stmt) { return !empty($stmt); }
    );

    echo "🔨 Executing " . count($statements) . " SQL statement(s)...\n\n";

    foreach ($statements as $index => $statement) {
        try {
            $pdo->exec($statement);
            $preview = substr(trim($statement), 0, 60);
            echo "  [" . ($index + 1) . "/" . count($statements) . "] ✓ " . $preview . "...\n";
        } catch (PDOException $e) {
            echo "  [" . ($index + 1) . "/" . count($statements) . "] ❌ Error: " . $e->getMessage() . "\n";
            throw $e;
        }
    }

    echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "✅ Database migration completed successfully!\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

    exit(0);

} catch (PDOException $e) {
    echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "❌ Migration failed!\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getCode() . "\n\n";
    
    exit(1);

} catch (Exception $e) {
    echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    exit(1);
}
?>
