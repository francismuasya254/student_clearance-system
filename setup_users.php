<?php
require_once 'config/database.php';

$people = [
    ['System Admin',       null,               'admin@scms.test',     'admin123',   'admin',   null],
    ['Library Officer',    null,               'library@scms.test',   'officer123', 'officer', 1],
    ['Finance Officer',    null,               'finance@scms.test',   'officer123', 'officer', 2],
    ['Hostel Officer',     null,               'hostel@scms.test',    'officer123', 'officer', 3],
    ['Academics Officer',  null,               'academics@scms.test', 'officer123', 'officer', 4],
    ['Sports Officer',     null,               'sports@scms.test',    'officer123', 'officer', 5],
    ['Test Student',       'CT100/G/00001/24', 'student@scms.test',   'student123', 'student', null],
];

$stmt = $conn->prepare('INSERT INTO users (full_name, registration_no, email, password_hash, role, department_id) VALUES (?, ?, ?, ?, ?, ?)');
foreach ($people as $p) {
    $hash = password_hash($p[3], PASSWORD_DEFAULT);
    $stmt->bind_param('sssssi', $p[0], $p[1], $p[2], $hash, $p[4], $p[5]);
    $stmt->execute();
}
echo 'Done! Now DELETE this file (setup_users.php).';
