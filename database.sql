CREATE TABLE IF NOT EXISTS roles (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       title ENUM('ADMIN', 'USER') NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(50) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL, -- Store hash here (bcrypt)
                       name VARCHAR(100),
                       surname VARCHAR(100),
                       role_id INT NOT NULL,
                       FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE IF NOT EXISTS sessions (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          token VARCHAR(255) NOT NULL,
                          expiredIn DATETIME NOT NULL,
                          user_id INT NOT NULL UNIQUE,
                          FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS spotted (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         title VARCHAR(150),
                         text TEXT NOT NULL,
                         numLike INT DEFAULT 0,
                         numDislike INT DEFAULT 0,
                         user_id INT NOT NULL,
                         FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS comments (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          text TEXT NOT NULL,
                          numLike INT DEFAULT 0,
                          numDislike INT DEFAULT 0,
                          user_id INT NOT NULL,
                          spotted_id INT NOT NULL,
                          FOREIGN KEY (user_id) REFERENCES users(id),
                          FOREIGN KEY (spotted_id) REFERENCES spotted(id) ON DELETE CASCADE
);

INSERT INTO roles (title) VALUES ('USER'), ('ADMIN');