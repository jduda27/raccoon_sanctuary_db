ALTER TABLE Account
    ADD Budget_ID int,
    ADD FOREIGN KEY (Budget_ID) REFERENCES Budget(Budget_ID);