<?php

function getDb() {
    $dbPath = __DIR__ . '/data/messages.db';
    $dbDir = dirname($dbPath);

    if (!is_dir($dbDir)) {
        mkdir($dbDir, 0777, true);
    }

    $db = new SQLite3($dbPath);

    // Create table if not exists
    $db->exec('
        CREATE TABLE IF NOT EXISTS messages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            message_id TEXT NOT NULL,
            datetime TEXT NOT NULL,
            recipient TEXT NOT NULL,
            body TEXT NOT NULL
        )
    ');

    return $db;
}

function insertMessage($messageId, $recipient, $body) {
    $db = getDb();
    $datetime = date('Y-m-d H:i:s');

    $stmt = $db->prepare('
        INSERT INTO messages (message_id, datetime, recipient, body)
        VALUES (:message_id, :datetime, :recipient, :body)
    ');

    $stmt->bindValue(':message_id', $messageId, SQLITE3_TEXT);
    $stmt->bindValue(':datetime', $datetime, SQLITE3_TEXT);
    $stmt->bindValue(':recipient', $recipient, SQLITE3_TEXT);
    $stmt->bindValue(':body', $body, SQLITE3_TEXT);

    $stmt->execute();
    $db->close();
}

function getAllMessages() {
    $db = getDb();
    $results = $db->query('SELECT * FROM messages ORDER BY datetime DESC');

    $messages = [];
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $messages[] = $row;
    }

    $db->close();
    return $messages;
}
