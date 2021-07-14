CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    subname varchar(100),
    email varchar(150) NOT NULL UNIQUE,
    pass varchar(255) NOT NULL,
    user_image varchar(100) DEFAULT 'default_userimage.png',
    signup_date date
) ENGINE = InnoDB;
CREATE TABLE categories (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(100) NOT NULL UNIQUE
) ENGINE = InnoDB;
UPDATE users
SET user_image = '1626172397.jpg'
WHERE id = 2;
INSERT INTO categories (name)
VALUES ('Animales'),
    ('Deportes'),
    ('Películas');
CREATE TABLE entries(
    id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
    user_id int NOT NULL,
    category_id int NOT NULL,
    title varchar(50) NOT NULL,
    description mediumtext,
    entry_date date NOT NULL,
    CONSTRAINT fk_entry_user FOREIGN KEY (user_id) REFERENCES users (id),
    CONSTRAINT fk_entry_category FOREIGN KEY (category_id) REFERENCES categories (id)
) ENGINE = InnoDB;
INSERT INTO entries (
        id,
        user_id,
        category_id,
        title,
        description,
        entry_date
    )
VALUES (
        NULL,
        '1',
        '1',
        'El Águila',
        'La reina de las rapaces. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo quidem blanditiis aspernatur, obcaecati quasi asperiores magni. Nobis excepturi quas atque minima cum! Nisi, mollitia molestias pariatur consequuntur aperiam voluptatum repellat.',
        '2020-10-01'
    ),
    (
        NULL,
        '1',
        '1',
        'El Lagarto',
        'Una vida arrastrada. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo quidem blanditiis aspernatur, obcaecati quasi asperiores magni. Nobis excepturi quas atque minima cum! Nisi, mollitia molestias pariatur consequuntur aperiam voluptatum repellat.',
        '2021-03-25'
    ),
    (
        NULL,
        '1',
        '2',
        'Fútbol',
        'El deporte rey. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo quidem blanditiis aspernatur, obcaecati quasi asperiores magni. Nobis excepturi quas atque minima cum! Nisi, mollitia molestias pariatur consequuntur aperiam voluptatum repellat.',
        '2021-01-05'
    ),
    (
        NULL,
        '2',
        '1',
        'El Elefante',
        'También conocido como paquidermo. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo quidem blanditiis aspernatur, obcaecati quasi asperiores magni. Nobis excepturi quas atque minima cum! Nisi, mollitia molestias pariatur consequuntur aperiam voluptatum repellat.',
        '2020-12-30'
    ),
    (
        NULL,
        '2',
        '2',
        'Baloncesto',
        'La liga más famosa es la NBA. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo quidem blanditiis aspernatur, obcaecati quasi asperiores magni. Nobis excepturi quas atque minima cum! Nisi, mollitia molestias pariatur consequuntur aperiam voluptatum repellat.',
        '2021-05-23'
    ),
    (
        NULL,
        '5',
        '1',
        'El Lobo',
        'El terror de los ganaderos. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo quidem blanditiis aspernatur, obcaecati quasi asperiores magni. Nobis excepturi quas atque minima cum! Nisi, mollitia molestias pariatur consequuntur aperiam voluptatum repellat.',
        '2021-02-02'
    ),
    (
        NULL,
        '5',
        '2',
        'Fórmula 1',
        'El rey del deporte de motor. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo quidem blanditiis aspernatur, obcaecati quasi asperiores magni. Nobis excepturi quas atque minima cum! Nisi, mollitia molestias pariatur consequuntur aperiam voluptatum repellat.',
        CURDATE()
    );