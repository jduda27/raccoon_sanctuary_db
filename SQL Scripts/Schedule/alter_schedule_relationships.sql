ALTER TABLE Schedule
    ADD shift_id INT,
    ADD sanctuary_id INT NOT NULL,
    ADD FOREIGN KEY (shift_id) REFERENCES Shift(shift_id),
    ADD FOREIGN KEY (sanctuary_id) REFERENCES Sanctuary(sanctuary_id),
    DROP PRIMARY KEY,
    ADD PRIMARY KEY (schedule_id, sanctuary_id);