create table Responsibility
(
    responsibility_id int unsigned auto_increment
        primary key,
    enclosure_id      int unsigned not null
)
    collate = utf8mb4_unicode_ci;

alter table Responsibility
    add constraint responsibility_enclosure_id_foreign
        foreign key (enclosure_id) references Enclosure (enclosure_id);

