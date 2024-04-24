ALTER TABLE Task
    ADD Shift_ID Int,
    ADD FOREIGN KEY (Shift_ID) REFERENCES Shift(Shift_ID);