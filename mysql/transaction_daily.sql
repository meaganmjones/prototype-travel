CREATE TABLE IF NOT EXISTS transaction_daily (
transactionID INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
        userID INT NOT NULL,
        productID INT NOT NULL,
        loginID INT NOT NULL,
        cartTotal MONEY NOT NULL,
        transactionDate DATETIME
        
        
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;