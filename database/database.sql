CREATE
    DATABASE property_system;

CREATE TABLE properties
(
    uuid             CHAR(36)     NOT NULL DEFAULT (uuid()) UNIQUE,
    property_type_id INT UNSIGNED NOT NULL,
    county           VARCHAR(255) NOT NULL,
    country          VARCHAR(255) NOT NULL,
    town             VARCHAR(255) NOT NULL,
    description      VARCHAR(255) NOT NULL,
    address          VARCHAR(255) NOT NULL,
    image_full       VARCHAR(255) NOT NULL,
    image_thumbnail  VARCHAR(255) NOT NULL,
    latitude         VARCHAR(255) NOT NULL,
    longitude        VARCHAR(255) NOT NULL,
    num_bedrooms     INT UNSIGNED NOT NULL,
    num_bathrooms    INT UNSIGNED NOT NULL,
    price            INT UNSIGNED NOT NULL,
    type             VARCHAR(255) NOT NULL,
    created_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at       DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (uuid)
);

CREATE TABLE property_types
(
    id             INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    title           VARCHAR(255) NOT NULL,
    description      TEXT NOT NULL,
    created_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at       DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

ALTER TABLE properties
    ADD CONSTRAINT properties_property_type_fk
        FOREIGN KEY (property_type_id) REFERENCES property_types(id);