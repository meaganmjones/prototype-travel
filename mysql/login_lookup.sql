CREATE TABLE  IF NOT EXISTS login_lookup (
  loginID INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
  userName NVARCHAR(16) NOT NULL,
  userPassword NVARCHAR(255) NULL,
  loginSalt NVARCHAR(255) NOT NULL,
  userPermissions NVARCHAR(15) NOT NULL
  
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
  
  INSERT INTO login_lookup SET userName = "", userPassword = sha1(CONCAT("school-salt","")), loginSalt = "school-salt", userPermissions = "";