ALTER TABLE Schedule
    ADD shift_id INT,
    ADD FOREIGN KEY (shift_id) REFERENCES Shift(shift_id);