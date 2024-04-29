create table Raccoon_Treatment_History
(
    treatment_time datetime     not null,
    treatment_id   int unsigned not null,
    raccoon_id     int unsigned not null
)
    collate = utf8mb4_unicode_ci;

alter table Raccoon_Treatment_History
    add primary key (treatment_time);

alter table Raccoon_Treatment_History
    add constraint raccoon_treatment_history_raccoon_id_foreign
        foreign key (raccoon_id) references Raccoon (raccoon_id);

alter table Raccoon_Treatment_History
    add constraint raccoon_treatment_history_treatment_id_foreign
        foreign key (treatment_id) references Treatment (treatment_id);

