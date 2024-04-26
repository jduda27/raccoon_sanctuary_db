CREATE TABLE Schedule (
    schedule_id INT AUTO_INCREMENT,
    sanctuary_id INT NOT NULL,
    FOREIGN KEY (sanctuary_id) REFERENCES Sanctuary(sanctuary_id),
    PRIMARY KEY (schedule_id, sanctuary_id)
);