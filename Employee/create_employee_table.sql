CREATE TABLE Employee (
    Employee_ID INT PRIMARY KEY,
    Employee_Name VARCHAR(50) NOT NULL,
    Phone_Number VARCHAR(12) NOT NULL,
    Wage DECIMAL(8,2) NOT NULL,
    Role_Name VARCHAR(32),
    Address VARCHAR(100) NOT NULL
);
