ALTER TABLE Shift
    ADD schedule_id INT NOT NULL,
    ADD FOREIGN KEY (schedule_id) REFERENCES Schedule(schedule_id);