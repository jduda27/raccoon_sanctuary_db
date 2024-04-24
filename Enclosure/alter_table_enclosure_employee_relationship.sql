ALTER TABLE Enclosure
    ADD Employee_ID INT,
    ADD FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID);