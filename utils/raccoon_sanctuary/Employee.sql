create table Employee
(
    employee_id  int unsigned auto_increment
        primary key,
    first_name   varchar(255) not null,
    last_name    varchar(255) not null,
    phone_number varchar(12)  not null,
    email        varchar(255) not null,
    address_id   int unsigned not null,
    role_id      int unsigned not null
)
    collate = utf8mb4_unicode_ci;

alter table Employee
    add constraint employee_email_unique
        unique (email);

alter table Employee
    add constraint employee_phone_number_unique
        unique (phone_number);

alter table Employee
    add constraint employee_address_id_foreign
        foreign key (address_id) references Address (address_id)
            on delete cascade;

alter table Employee
    add constraint employee_role_id_foreign
        foreign key (role_id) references Role (role_id);

