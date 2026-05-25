-- put in ./dump directory for PostgreSQL

CREATE TABLE IF NOT EXISTS Person (
    id SERIAL PRIMARY KEY,
    name VARCHAR(20) NOT NULL
);

INSERT INTO Person (name) VALUES 
    ('William'),
    ('Marc'),
    ('John');