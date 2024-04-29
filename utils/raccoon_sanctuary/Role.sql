create table Role
(
    role_id           int unsigned auto_increment
        primary key,
    role_name         varchar(120) not null,
    responsibility_id int unsigned not null,
    treatment_id      int unsigned null
)
    collate = utf8mb4_unicode_ci;

alter table Role
    add constraint role_responsibility_id_unique
        unique (responsibility_id);

alter table Role
    add constraint role_role_name_unique
        unique (role_name);

alter table Role
    add constraint role_responsibility_id_foreign
        foreign key (responsibility_id) references Responsibility (responsibility_id);

alter table Role
    add constraint role_treatment_id_foreign
        foreign key (treatment_id) references Treatment (treatment_id);

