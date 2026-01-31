-- ============================================
-- IITU University Website - Database Setup
-- ============================================
-- This file creates the necessary database structure
-- for the IITU University Website Project

-- Create database
CREATE DATABASE IF NOT EXISTS group_project_web 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;

USE group_project_web;

-- ============================================
-- Table: students
-- Description: Stores student information
-- ============================================
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_code VARCHAR(50) UNIQUE NOT NULL COMMENT 'Unique student identifier',
    full_name VARCHAR(255) NOT NULL COMMENT 'Full name of the student',
    email VARCHAR(255) UNIQUE NOT NULL COMMENT 'Email address',
    password VARCHAR(255) NOT NULL COMMENT 'Hashed password',
    birth_date DATE COMMENT 'Date of birth',
    phone VARCHAR(20) COMMENT 'Phone number',
    address TEXT COMMENT 'Home address',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Registration timestamp',
    INDEX idx_student_code (student_code),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- Table: admins
-- Description: Stores administrator accounts
-- ============================================
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL COMMENT 'Admin username',
    password VARCHAR(255) NOT NULL COMMENT 'Hashed password',
    full_name VARCHAR(255) COMMENT 'Full name of admin',
    email VARCHAR(255) COMMENT 'Admin email',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Account creation timestamp',
    last_login TIMESTAMP NULL COMMENT 'Last login timestamp',
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- Table: chat_messages
-- Description: Stores chat messages from students
-- ============================================
CREATE TABLE IF NOT EXISTS chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_code VARCHAR(50) NOT NULL COMMENT 'Student who sent the message',
    message TEXT NOT NULL COMMENT 'Message content',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Message timestamp',
    is_deleted TINYINT(1) DEFAULT 0 COMMENT 'Soft delete flag',
    INDEX idx_student_code (student_code),
    INDEX idx_created_at (created_at),
    FOREIGN KEY (student_code) REFERENCES students(student_code) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- Table: sessions (optional - for session management)
-- Description: Stores active user sessions
-- ============================================
CREATE TABLE IF NOT EXISTS sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_code VARCHAR(50) NOT NULL,
    session_token VARCHAR(255) NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NOT NULL,
    INDEX idx_student_code (student_code),
    INDEX idx_session_token (session_token),
    INDEX idx_expires_at (expires_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- Insert Sample Data (Optional)
-- ============================================

-- Insert a test admin account
-- Username: admin
-- Password: admin123 (you should change this!)
-- Note: This is a bcrypt hash of 'admin123'
INSERT INTO admins (username, password, full_name, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System Administrator', 'admin@iitu.edu.kz')
ON DUPLICATE KEY UPDATE username=username;

-- Insert sample students (for testing)
INSERT INTO students (student_code, full_name, email, password, birth_date, phone) VALUES 
('IITU001', 'Rauan Kuanysh', 'rauan@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2000-01-15', '+7 777 123 4567'),
('IITU002', 'Aruzhan Aliyeva', 'aruzhan@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2001-05-20', '+7 777 234 5678'),
('IITU003', 'Miras Bekzat', 'miras@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2000-09-10', '+7 777 345 6789')
ON DUPLICATE KEY UPDATE student_code=student_code;

-- Insert sample chat messages
INSERT INTO chat_messages (student_code, message) VALUES 
('IITU001', 'Hello everyone! Welcome to IITU chat!'),
('IITU002', 'Hi! Glad to be here!'),
('IITU003', 'Looking forward to working together!')
ON DUPLICATE KEY UPDATE id=id;

-- ============================================
-- Verification Queries
-- ============================================
-- Uncomment these to verify the setup

-- SELECT * FROM students;
-- SELECT * FROM admins;
-- SELECT * FROM chat_messages;

-- ============================================
-- Useful Maintenance Queries
-- ============================================

-- Count all students
-- SELECT COUNT(*) as total_students FROM students;

-- Count all messages
-- SELECT COUNT(*) as total_messages FROM chat_messages;

-- Get recent messages with student names
-- SELECT cm.message, cm.created_at, s.full_name 
-- FROM chat_messages cm
-- JOIN students s ON cm.student_code = s.student_code
-- ORDER BY cm.created_at DESC
-- LIMIT 10;

-- ============================================
-- Security Notes
-- ============================================
-- 1. Change the default admin password immediately!
-- 2. Use strong passwords for all accounts
-- 3. The password hashes shown here are for 'admin123'
-- 4. Never commit real passwords to version control
-- 5. Use environment variables for sensitive data in production

-- ============================================
-- End of Database Setup
-- ============================================
