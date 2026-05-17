<?php
/**
 * Router - Handle API endpoints and page requests
 */

function routeRequest($path, $method) {
    // Set JSON response header for API routes
    if (strpos($path, '/api/') === 0) {
        header('Content-Type: application/json');
    }

    // Route API endpoints
    if ($path === '/api/leads/submit' && $method === 'POST') {
        require_once __DIR__ . '/api/leads.php';
        handleLeadSubmission();
        return;
    }

    if ($path === '/api/leads/list' && $method === 'GET') {
        require_once __DIR__ . '/api/leads.php';
        getLeadsList();
        return;
    }

    // Route to home page for all other requests
    require_once __DIR__ . '/../public/home.php';
}

function sendJsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

function sendErrorResponse($message, $statusCode = 400) {
    sendJsonResponse(['success' => false, 'error' => $message], $statusCode);
}

function sendSuccessResponse($data = [], $message = 'Success') {
    sendJsonResponse(['success' => true, 'message' => $message, 'data' => $data], 200);
}
?>
