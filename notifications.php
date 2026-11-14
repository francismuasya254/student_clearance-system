<?php
require_once 'includes/auth.php';
if (!isset($_SESSION['user_id'])) { header('Location: ' . BASE . '/login.php'); exit; }

$rows = [];
try {
    $s = $conn->prepare('SELECT message, created_at, is_read FROM notifications WHERE user_id = ? ORDER BY notification_id DESC LIMIT 100');
    $s->bind_param('i', $_SESSION['user_id']);
    $s->execute();
    $rows = $s->get_result()->fetch_all(MYSQLI_ASSOC);
    $m = $conn->prepare('UPDATE notifications SET is_read = 1 WHERE user_id = ?');
    $m->bind_param('i', $_SESSION['user_id']);
    $m->execute();
} catch (Throwable $ex) { }
include 'includes/header.php';
?>
<h1>Notifications</h1>
<?php if (!$rows): ?><p>No notifications yet.</p><?php endif; ?>
<?php foreach ($rows as $n): ?>
  <div class='note <?= $n['is_read'] ? '' : 'unread' ?>'><?= e($n['message']) ?><small><?= e($n['created_at']) ?></small></div>
<?php endforeach; ?>
<?php include 'includes/footer.php'; ?>
