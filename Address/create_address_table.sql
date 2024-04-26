CREATE TABLE Address(
    address_id INT PRIMARY KEY AUTO_INCREMENT,
    street_address VARCHAR(100) NOT NULL,
    city VARCHAR(60) NOT NULL,
    state VARCHAR(30) NOT NULL,
    zipcode CHAR(5) NOT NULL
);