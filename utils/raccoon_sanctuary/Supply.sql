create table Supply
(
    supply_id   int unsigned auto_increment
        primary key,
    supply_name varchar(255)  not null,
    price       decimal(6, 2) null,
    quantity    int unsigned  not null
)
    collate = utf8mb4_unicode_ci;

alter table Supply
    add constraint supply_supply_name_unique
        unique (supply_name);

