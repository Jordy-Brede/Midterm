CREATE DATABASE quotesdb;

\c quotesdb;

CREATE TABLE authors (
    id SERIAL PRIMARY KEY,
    author VARCHAR(255) NOT NULL
);

CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    category VARCHAR(255) NOT NULL
);

CREATE TABLE quotes (
    id SERIAL PRIMARY KEY,
    quote TEXT NOT NULL,
    author_id INT NOT NULL,
    category_id INT NOT NULL,
    CONSTRAINT fk_author FOREIGN KEY (author_id) REFERENCES authors(id) ON DELETE RESTRICT,
    CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT
);
