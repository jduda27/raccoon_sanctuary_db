ALTER TABLE Sanctuary
    ADD Account_ID INT,
    ADD Foreign Key (Account_ID) References Account(Account_ID);