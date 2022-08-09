CREATE TABLE IF NOT EXISTS user_lookup (
userID INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
        firstName NVARCHAR(50) NOT NULL,
        lastName NVARCHAR(50) NOT NULL,
        email NVARCHAR(50) NOT NULL,
        username NVARCHAR(50) NOT NULL,
        street NVARCHAR(255) NOT NULL,
        city NVARCHAR(50) NOT NULL,
        userState NVARCHAR(2) NOT NULL,
        zip NVARCHAR(5) NOT NULL,
        phone NVARCHAR(10) DEFAULT NULL
        
        
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;