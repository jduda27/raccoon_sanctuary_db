CREATE TABLE Employee (
    Employee_ID INT PRIMARY KEY,
    NAME VARCHAR(50) NOT NULL,
    PhoneNumber VARCHAR(12) NOT NULL,
    Wage DOUBLE NOT NULL,
    RoleName VARCHAR(50) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    Sanctuary_ID int NOT NULL,
    Foreign Key (Sanctuary_ID) References Sanctuary(Sanctuary_ID)
);
