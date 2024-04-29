create table Treatment
(
    treatment_id   int unsigned auto_increment
        primary key,
    treatment_type varchar(255) not null
)
    collate = utf8mb4_unicode_ci;

alter table Treatment
    add constraint treatment_treatment_type_unique
        unique (treatment_type);

