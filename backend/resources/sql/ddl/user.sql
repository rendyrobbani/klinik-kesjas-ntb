create or replace table user (
    id         varchar(8),
    nama       varchar(255),
    password   varchar(255),
    created_at datetime,
    created_by varchar(8),
    updated_at datetime,
    updated_by varchar(8),
    is_deleted bit,
    deleted_at datetime,
    deleted_by varchar(8),
    constraint fk_user_to_user_01 foreign key (created_by) references user (id),
    constraint fk_user_to_user_02 foreign key (updated_by) references user (id),
    constraint fk_user_to_user_03 foreign key (deleted_by) references user (id),
    primary key (id)
) engine = innodb;