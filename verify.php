<?php
require_once 'includes/auth.php';
$id = (int)($_GET['id'] ?? 0);
$code = strtoupper(trim($_GET['code'] ?? ''));
$row = null;
if ($id > 0) {
    $s = $conn->prepare("SELECT r.request_id, r.signed_at, u.full_name, u.registration_no, a.full_name AS signer FROM clearance_requests r JOIN users u ON r.student_id = u.user_id LEFT JOIN users a ON r.signed_by = a.user_id WHERE r.request_id = ? AND r.overall_status = 'Cleared'");
    $s->bind_param('i', $id);
    $s->execute();
    $row = $s->get_result()->fetch_assoc();
}
$valid = $row && $row['signed_at'] && hash_equals(cert_code($row['request_id'], $row['signed_at']), $code);
include 'includes/header.php';
?>
<h1>Verify a Clearance Certificate</h1>
<?php if ($valid): ?>
  <div class='clear-banner cb-ok'><div class='cb-title'>&#10004; VALID</div>
  <p><b><?= e($row['full_name']) ?></b> (<?= e($row['registration_no']) ?>) is fully cleared. Signed by <?= e($row['signer']) ?> on <?= e($row['signed_at']) ?>.</p></div>
<?php elseif ($id || $code): ?>
  <div class='clear-banner cb-bad'><div class='cb-title'>&#10008; NOT VALID</div><p>No signed clearance matches this reference and code.</p></div>
<?php endif; ?>
<form method='get'>
  <label>Request number</label><input type='number' name='id' value='<?= $id ?: '' ?>' required>
  <label>Verification code</label><input type='text' name='code' value='<?= e($code) ?>' required>
  <button type='submit'>Verify</button>
</form>
<?php include 'includes/footer.php'; ?>
