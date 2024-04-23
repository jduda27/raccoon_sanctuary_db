CREATE TABLE Budget(
    Budget_ID int PRIMARY KEY,
    Description varchar(255),
    Payment_Date date,
    Cash_Transacted decimal(65,3),
    Transaction_Type varchar(255)
);