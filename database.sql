CREATE TABLE IF NOT EXISTS roles (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     title ENUM('ADMIN', 'USER') NOT NULL
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS users (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100),
    surname VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    role_id INT NOT NULL,
    isBanned TINYINT(1) DEFAULT 0,
    CONSTRAINT fk_users_role
    FOREIGN KEY (role_id) REFERENCES roles(id)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS sessions (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        token VARCHAR(255) NOT NULL,
    expiredIn DATETIME NOT NULL,
    user_id INT NOT NULL UNIQUE,
    CONSTRAINT fk_sessions_user
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS spotted (
                                       id INT AUTO_INCREMENT PRIMARY KEY,
                                       title VARCHAR(150),
    `text` TEXT NOT NULL,
    numLike INT DEFAULT 0,
    numDislike INT DEFAULT 0,
    user_id INT NOT NULL,
    status ENUM('PENDING', 'APPROVED', 'REJECTED') DEFAULT 'PENDING',
    CONSTRAINT fk_spotted_user
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS comments (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        `text` TEXT NOT NULL,
                                        user_id INT NOT NULL,
                                        spotted_id INT NOT NULL,
                                        CONSTRAINT fk_comments_user
                                        FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_spotted
    FOREIGN KEY (spotted_id) REFERENCES spotted(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS categories (
                                          id INT AUTO_INCREMENT PRIMARY KEY,
                                          name VARCHAR(50) NOT NULL
    ) ENGINE=InnoDB;
