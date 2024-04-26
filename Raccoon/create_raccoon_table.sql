CREATE TABLE Raccoon (
    raccoon_id INT PRIMARY KEY AUTO_INCREMENT,
    raccoon_name VARCHAR(255) NOT NULL,
    age INT,
    sex CHAR(1) NOT NULL,
    length DECIMAL(5, 2) NOT NULL,
    weight DECIMAL(6, 2) NOT NULL
);