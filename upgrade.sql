-- Run this ONCE in phpMyAdmin (SQL tab) with your existing scms_db database.
USE scms_db;

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
