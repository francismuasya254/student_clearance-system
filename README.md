# Student Clearance Management System (SCMS)

A web-based system that lets students get cleared by their institution online, without visiting each office in person.

## Problem it solves
Manual clearance means students walk from office to office to get signatures, which is slow, easy to lose track of, and hard to verify. SCMS moves the whole process online.

## Features
- **Students:** register, submit a clearance request, track each department's decision, and see a clear CLEARED / NOT CLEARED status with their balance in every department
- **Department officers:** review only their own department's requests, then approve or reject with a comment
- **Administration:** review fully approved requests, sign off the clearance, or send a department back for a re-check
- **Notifications:** students are told when each department clears their balance and when the administration signs
- **Clearance certificate:** printable certificate with the admin's signature and a verification code
- **Certificate verification:** anyone can check a certificate's validity online
- Role-based access (student, officer, admin) and hashed passwords

## Tech stack
PHP, MySQL, HTML, CSS, XAMPP (Apache)

## How to run locally
1. Install XAMPP and start Apache and MySQL
2. Copy this folder to `C:\xampp\htdocs\student-clearance-system`
3. In phpMyAdmin, run `database.sql` (existing installs: run `upgrade.sql`)
4. Open `http://localhost/student-clearance-system/setup_users.php` once to create test accounts, then delete that file
5. Open `http://localhost/student-clearance-system/`

## Test accounts
| Role | Email | Password |
|---|---|---|
| Student | student@scms.test | student123 |
| Officer | library@scms.test | officer123 |
| Admin | admin@scms.test | admin123 |

*These are demo accounts for local testing only.*

## Author
Francis Muasya
