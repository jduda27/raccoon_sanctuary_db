CREATE TABLE Sanctuary(
    Sanctuary_ID Int Primary Key,
    Account_ID  Int,
    Address varchar(255),
    Name varchar(255),
    Foreign Key (Account_ID) References Account(Account_ID)
);
