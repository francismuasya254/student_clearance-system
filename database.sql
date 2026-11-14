CREATE DATABASE IF NOT EXISTS scms_db;
USE scms_db;

CREATE TABLE departments (
  department_id INT AUTO_INCREMENT PRIMARY KEY,
  department_name VARCHAR(100) NOT NULL UNIQUE,
  description VARCHAR(255) NULL
);

CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  registration_no VARCHAR(40) UNIQUE,
  email VARCHAR(120) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('student','officer','admin') NOT NULL,
  department_id INT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (department_id) REFERENCES departments(department_id)
);

CREATE TABLE clearance_requests (
  request_id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  overall_status ENUM('Pending','In Progress','Cleared') DEFAULT 'Pending',
  FOREIGN KEY (student_id) REFERENCES users(user_id)
);

CREATE TABLE clearance_items (
  item_id INT AUTO_INCREMENT PRIMARY KEY,
  request_id INT NOT NULL,
  department_id INT NOT NULL,
  status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
  officer_comment TEXT NULL,
  reviewed_by INT NULL,
  reviewed_at DATETIME NULL,
  UNIQUE (request_id, department_id),
  FOREIGN KEY (request_id) REFERENCES clearance_requests(request_id),
  FOREIGN KEY (department_id) REFERENCES departments(department_id),
  FOREIGN KEY (reviewed_by) REFERENCES users(user_id)
);

INSERT INTO departments (department_name, description) VALUES
('Library', 'Returned all library books'),
('Finance', 'Fee balance cleared'),
('Hostel', 'Room handed over'),
('Academics', 'No missing marks'),
('Sports', 'Returned sports equipment');

-- ===== Admin sign-off + notifications (also in upgrade.sql) =====

ALTER TABLE clearance_requests
  MODIFY overall_status ENUM('Pending','In Progress','Awaiting Admin','Cleared') DEFAULT 'Pending',
  ADD COLUMN signed_by INT NULL,
  ADD COLUMN signed_at DATETIME NULL,
  ADD COLUMN admin_remarks VARCHAR(255) NULL,
  ADD FOREIGN KEY (signed_by) REFERENCES users(user_id);

CREATE TABLE IF NOT EXISTS notifications (
  notification_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  message VARCHAR(500) NOT NULL,
  is_read TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
