ALTER TABLE Shift
    ADD employee_id INT,
    ADD schedule_id INT NOT NULL,
    ADD FOREIGN KEY (employee_id) REFERENCES Employee(employee_id) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (schedule_id) REFERENCES Schedule(schedule_id) ON UPDATE CASCADE ON DELETE CASCADE;