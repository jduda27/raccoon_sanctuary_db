ALTER TABLE Shift
    ADD Employee_ID INT,
    ADD Foreign Key (Employee_ID) References Employee(Employee_ID);