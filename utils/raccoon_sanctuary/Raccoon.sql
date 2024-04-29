create table Raccoon
(
    raccoon_id   int unsigned auto_increment
        primary key,
    raccoon_name varchar(255)  not null,
    age          int unsigned  null,
    sex          char          not null,
    length       decimal(5, 2) not null,
    weight       decimal(6, 2) not null,
    enclosure_id int unsigned  not null
)
    collate = utf8mb4_unicode_ci;

alter table Raccoon
    add constraint raccoon_enclosure_id_unique
        unique (enclosure_id);

alter table Raccoon
    add constraint raccoon_enclosure_id_foreign
        foreign key (enclosure_id) references Enclosure (enclosure_id);

