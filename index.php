<?php
require_once 'db.php';
$messages = getAllMessages();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake SMS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <h1 class="mb-4">Fake SMS Dashboard</h1>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Message ID</th>
                        <th>Date Time</th>
                        <th>Recipient</th>
                        <th>Body</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($messages)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No messages yet</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($messages as $msg): ?>
                            <tr>
                                <td><?= htmlspecialchars($msg['id']) ?></td>
                                <td><?= htmlspecialchars($msg['message_id']) ?></td>
                                <td><?= htmlspecialchars($msg['datetime']) ?></td>
                                <td><?= htmlspecialchars($msg['recipient']) ?></td>
                                <td><?= htmlspecialchars($msg['body']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <small class="text-muted">Total messages: <?= count($messages) ?></small>
        </div>
    </div>
</body>
</html>
