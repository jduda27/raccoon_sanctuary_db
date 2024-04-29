create table Schedule
(
    schedule_id  int unsigned auto_increment
        primary key,
    shift_id     int unsigned null,
    sanctuary_id int unsigned not null
)
    collate = utf8mb4_unicode_ci;

alter table Schedule
    add constraint schedule_sanctuary_id_unique
        unique (sanctuary_id);

alter table Schedule
    add constraint schedule_shift_id_unique
        unique (shift_id);

alter table Schedule
    add constraint schedule_sanctuary_id_foreign
        foreign key (sanctuary_id) references Sanctuary (sanctuary_id);

alter table Schedule
    add constraint schedule_shift_id_foreign
        foreign key (shift_id) references Shift (shift_id);

