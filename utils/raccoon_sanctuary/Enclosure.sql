create table Enclosure
(
    enclosure_id   int unsigned auto_increment
        primary key,
    enclosure_name varchar(255) not null,
    storage_id     int unsigned null
)
    collate = utf8mb4_unicode_ci;

alter table Enclosure
    add constraint enclosure_enclosure_name_unique
        unique (enclosure_name);

alter table Enclosure
    add constraint enclosure_storage_id_foreign
        foreign key (storage_id) references Storage_Room (storage_id);

