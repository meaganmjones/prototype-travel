CREATE TABLE  IF NOT EXISTS login_lookup (
  loginID INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
  userName NVARCHAR(16) NOT NULL,
  userPassword NVARCHAR(255) NULL,
  loginSalt NVARCHAR(32) NOT NULL),
  userPermissions NVARCHAR(15) NOT NULL;

  INSERT into users SET userName = "", userPassword = sha1(CONCAT("school-salt","")), userSalt = "school-salt";