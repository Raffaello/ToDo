CREATE TABLE Users
(
    id INTEGER PRIMARY KEY, 
    email    varchar(25), 
    password varchar(25),
    isAdmin BOOLEAN
);


CREATE TABLE IF NOT EXISTS ToDoItem
(
    id INTEGER PRIMARY KEY,
    user_id INTEGER, 
    status  BOOLEAN,
    description varchar(255),
    dueDate datetime,
    
    FOREIGN KEY(user_id) REFERENCES Users(id)
);
