create table Storage_Room
(
    storage_id    int unsigned auto_increment
        primary key,
    location_name varchar(255) not null,
    supply_id     int unsigned not null
)
    collate = utf8mb4_unicode_ci;

alter table Storage_Room
    add constraint storage_room_supply_id_foreign
        foreign key (supply_id) references Supply (supply_id);

