create table users
(
    id         int auto_increment
        primary key,
    name       varchar(100)                                     not null,
    email      varchar(150)                                     not null,
    password   varchar(255)                                     not null,
    avatar     varchar(255)                                     null,
    role       enum ('admin', 'user') default 'user'            null,
    is_active  tinyint(1)             default 1                 null,
    created_at timestamp              default CURRENT_TIMESTAMP null,
    constraint email
        unique (email)
);

create index idx_users_email
    on users (email);
