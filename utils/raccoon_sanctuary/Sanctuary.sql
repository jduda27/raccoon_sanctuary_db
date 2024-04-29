create table Sanctuary
(
    sanctuary_id   int unsigned auto_increment
        primary key,
    sanctuary_name varchar(100) not null,
    address_id     int unsigned not null
)
    collate = utf8mb4_unicode_ci;

alter table Sanctuary
    add constraint sanctuary_address_id_unique
        unique (address_id);

alter table Sanctuary
    add constraint sanctuary_sanctuary_name_unique
        unique (sanctuary_name);

alter table Sanctuary
    add constraint sanctuary_address_id_foreign
        foreign key (address_id) references Address (address_id)
            on delete cascade;

