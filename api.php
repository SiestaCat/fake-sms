<?php

require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['recipients']) || !isset($data['body'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing recipients or body']);
    exit;
}

if (!is_array($data['recipients']) || empty($data['recipients'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Recipients must be a non-empty array']);
    exit;
}

$messageId = uniqid('msg_', true);

foreach ($data['recipients'] as $recipient) {
    insertMessage($messageId, $recipient, $data['body']);
}

http_response_code(201);
echo json_encode([
    'success' => true,
    'message_id' => $messageId,
    'recipients_count' => count($data['recipients'])
]);
