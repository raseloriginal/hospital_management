-- Settings table for Hospital Management System
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL DEFAULT 1,
  `hospital_name` varchar(255) NOT NULL DEFAULT 'HealthCare Pro',
  `hospital_tagline` varchar(255) DEFAULT 'Advanced Medical Services',
  `hospital_email` varchar(255) DEFAULT 'info@healthcare.com',
  `hospital_phone` varchar(255) DEFAULT '+1-234-567-890',
  `hospital_address` text DEFAULT '123 Medical Plaza, City, Country',
  `currency_symbol` varchar(10) DEFAULT '$',
  `logo_path` varchar(255) DEFAULT 'logo.png',
  `favicon_path` varchar(255) DEFAULT 'favicon.ico',
  `facebook_url` varchar(255) DEFAULT '#',
  `twitter_url` varchar(255) DEFAULT '#',
  `linkedin_url` varchar(255) DEFAULT '#',
  `footer_text` varchar(255) DEFAULT '© 2024 HealthCare Pro. All Rights Reserved.',
  `primary_color` varchar(7) DEFAULT '#217346',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default settings if not exists
INSERT IGNORE INTO `settings` (`id`, `hospital_name`, `hospital_tagline`, `hospital_email`, `hospital_phone`, `hospital_address`, `currency_symbol`, `logo_path`, `favicon_path`, `facebook_url`, `twitter_url`, `linkedin_url`, `footer_text`, `primary_color`) 
VALUES (1, 'HealthCare Pro', 'Advanced Medical Services', 'info@healthcare.com', '+1-234-567-890', '123 Medical Plaza, City, Country', '$', 'logo.png', 'favicon.ico', '#', '#', '#', '© 2024 HealthCare Pro. All Rights Reserved.', '#217346');
