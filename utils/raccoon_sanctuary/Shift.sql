create table Shift
(
    shift_id    int unsigned auto_increment
        primary key,
    start_time  datetime     not null,
    end_time    datetime     not null,
    employee_id int unsigned null,
    schedule_id int unsigned not null
)
    collate = utf8mb4_unicode_ci;

alter table Shift
    add constraint shift_end_time_unique
        unique (end_time);

alter table Shift
    add constraint shift_start_time_unique
        unique (start_time);

alter table Shift
    add constraint shift_employee_id_foreign
        foreign key (employee_id) references Employee (employee_id)
            on update cascade on delete cascade;

alter table Shift
    add constraint shift_schedule_id_foreign
        foreign key (schedule_id) references Schedule (schedule_id)
            on update cascade on delete cascade;

