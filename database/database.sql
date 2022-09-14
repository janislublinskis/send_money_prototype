CREATE
    DATABASE prototype;

CREATE TABLE applications
(
    id           INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT UNIQUE,
    email        VARCHAR(255)             NOT NULL,
    money_amount INT UNSIGNED             NOT NULL,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at   DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE deals
(
    id             INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT UNIQUE,
    application_id INT UNSIGNED             NOT NULL,
    partner        ENUM ('A', 'B')          NOT NULL,
    status         TEXT                     NOT NULL DEFAULT 'ask',
    created_at     TIMESTAMP                         DEFAULT CURRENT_TIMESTAMP,
    updated_at     DATETIME                          DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (application_id) REFERENCES applications (id)
);
