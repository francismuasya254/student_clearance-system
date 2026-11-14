<?php
require_once 'includes/auth.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $pass  = $_POST['password'];

    $stmt = $conn->prepare('SELECT user_id, full_name, password_hash, role, department_id FROM users WHERE email = ? OR registration_no = ?');
    $stmt->bind_param('ss', $login, $login);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($pass, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id']       = $user['user_id'];
        $_SESSION['name']          = $user['full_name'];
        $_SESSION['role']          = $user['role'];
        $_SESSION['department_id'] = $user['department_id'];
        header('Location: ' . BASE . '/' . $user['role'] . '/dashboard.php');
        exit;
    }
    $error = 'Wrong email/registration number or password.';
}
include 'includes/header.php';
?>
<h1>Login</h1>
<?php if ($error): ?><p class='error'><?= e($error) ?></p><?php endif; ?>
<form method='post'>
  <label>Email or registration number</label>
  <input type='text' name='login' required>
  <label>Password</label>
  <input type='password' name='password' required>
  <button type='submit'>Login</button>
</form>
<?php include 'includes/footer.php'; ?>
