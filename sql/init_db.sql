-- CREATE TABLE IF NOT EXISTS Users
-- (
--     id INTEGER PRIMARY KEY, 
--     email    varchar(25), 
--     password varchar(25),
--     isAdmin BOOLEAN
-- );


-- CREATE TABLE IF NOT EXISTS ToDoItems
-- (
--     id INTEGER PRIMARY KEY,
--     user_id INTEGER, 
--     status  BOOLEAN,
--     description varchar(255),
--     dueDate datetime,
    
--     FOREIGN KEY(user_id) REFERENCES Users(id)
-- );

--DELETE FROM Users;
--VACUUM;
--insert into Users(id, email, password, isAdmin, username, salt, is_active) VALUES
--(1, '', 'admin', 1, 'admin', '', 1),
--(2, '', 'user1', 0, 'user1', '', 1),
--(3, '', 'user2', 0, 'user2', '', 1);
