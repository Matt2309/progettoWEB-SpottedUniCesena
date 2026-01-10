/* 06/01/2026 - Aggiunta email */
ALTER TABLE spotted_db.users
    ADD COLUMN email VARCHAR(100) UNIQUE;

/* 09/01/2026 - Collegamento categorie a spotted  */
ALTER TABLE spotted
    ADD COLUMN category_id INT NULL AFTER user_id;
UPDATE spotted SET category_id = 1; -- categoria di default
ALTER TABLE spotted
    MODIFY category_id INT NOT NULL;

/* 09/01/2026 - Aggiunta created_at a spotted e comments */
ALTER TABLE spotted
    ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE comments
    ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP;
