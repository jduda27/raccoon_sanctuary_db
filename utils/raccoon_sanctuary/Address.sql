create table Address
(
    address_id     int unsigned auto_increment
        primary key,
    street_address varchar(100) not null,
    city           varchar(60)  not null,
    state          varchar(30)  not null,
    zipcode        char(5)      not null
)
    collate = utf8mb4_unicode_ci;

alter table Address
    add constraint address_city_unique
        unique (city);

alter table Address
    add constraint address_state_unique
        unique (state);

alter table Address
    add constraint address_street_address_unique
        unique (street_address);

alter table Address
    add constraint address_zipcode_unique
        unique (zipcode);

