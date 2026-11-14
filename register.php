<?php
require_once 'includes/auth.php';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['full_name']);
    $reg     = trim($_POST['registration_no']);
    $email   = trim($_POST['email']);
    $pass    = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($name === '' || $reg === '' || $email === '' || $pass === '') {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Enter a valid email address.';
    } elseif (strlen($pass) < 6) {
        $error = 'Password must be at least 6 characters.';
    } elseif ($pass !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        $check = $conn->prepare('SELECT user_id FROM users WHERE email = ? OR registration_no = ?');
        $check->bind_param('ss', $email, $reg);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $error = 'That email or registration number is already registered.';
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $role = 'student';
            $ins = $conn->prepare('INSERT INTO users (full_name, registration_no, email, password_hash, role) VALUES (?, ?, ?, ?, ?)');
            $ins->bind_param('sssss', $name, $reg, $email, $hash, $role);
            $ins->execute();
            $success = 'Account created! You can now log in.';
        }
    }
}
include 'includes/header.php';
?>
<h1>Create Account</h1>
<?php if ($error): ?><p class='error'><?= e($error) ?></p><?php endif; ?>
<?php if ($success): ?><p class='success'><?= e($success) ?></p><?php endif; ?>
<form method='post'>
  <label>Full name</label>
  <input type='text' name='full_name' required>
  <label>Registration number</label>
  <input type='text' name='registration_no' required>
  <label>Email</label>
  <input type='email' name='email' required>
  <label>Password</label>
  <input type='password' name='password' required>
  <label>Confirm password</label>
  <input type='password' name='confirm' required>
  <button type='submit'>Register</button>
</form>
<?php include 'includes/footer.php'; ?>
