<?php
/**
 * Tattoo LP - Lucro Oculto Calculator
 * Main entry point
 */

// Load environment variables
require_once __DIR__ . '/../src/config/env.php';

// Load database connection
require_once __DIR__ . '/../src/config/database.php';

// Load router
require_once __DIR__ . '/../src/router.php';

// Get request path
$path = $_GET['path'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];

// Route the request
routeRequest($path, $method);
?>
