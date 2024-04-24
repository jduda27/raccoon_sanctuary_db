ALTER TABLE Sanctuary
    ADD Employee_ID INT,
    ADD Foreign Key (Employee_ID) References Employee(Employee_ID);