
CREATE TABLE User (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    userName VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(200) NOT NULL, /*Usar password_hash() en PHP por seguridad*/
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );