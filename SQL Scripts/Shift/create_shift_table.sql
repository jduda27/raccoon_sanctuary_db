CREATE TABLE Shift (
    shift_id INT AUTO_INCREMENT,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    PRIMARY KEY (shift_id,start_time, end_time)
);