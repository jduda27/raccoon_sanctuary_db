ALTER TABLE Budget
    ADD Account_ID int,
    ADD FOREIGN KEY (Account_ID) REFERENCES Account(Account_ID);