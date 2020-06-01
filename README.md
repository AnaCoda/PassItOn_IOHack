# PassItOn_IOHack
Team 1 "CoolBytes" submission for the IOHack Hackathon<br/>
This web application uses PHP, JavaScript, HTML, and CSS.<br/>
For our demo, we've been hosting our PHP server locally with IIS.<br/> <br/>
PHP version: 7.3.13<br/>
MySQL version: 5.1<br/> <br/>
Our database has four tables:<br/>
    users<br/>
    profiles<br/>
    subjects<br/>
    requests<br/> <br/>

Here are the structures of the tables <br/>
Users:<br/>```
+----------+-------------+------+-----+---------+----------------+
| Field    | Type        | Null | Key | Default | Extra          |
+----------+-------------+------+-----+---------+----------------+
| id       | int(10)     | NO   | PRI | NULL    | auto_increment |
| username | varchar(32) | NO   |     | NULL    |                |
| password | varchar(32) | NO   |     | NULL    |                |
| email    | text        | NO   |     | NULL    |                |
+----------+-------------+------+-----+---------+----------------+ ```

Profiles:<br/>
+----------+-------------+------+-----+---------+-------+<br/>
| Field    | Type        | Null | Key | Default | Extra |<br/>
+----------+-------------+------+-----+---------+-------+<br/>
| id       | int(10)     | NO   | MUL | NULL    |       |<br/>
| grade    | int(3)      | NO   |     | NULL    |       |<br/>
| name     | varchar(32) | NO   |     | NULL    |       |<br/>
| subjects | varchar(40) | NO   |     | NULL    |       |<br/>
+----------+-------------+------+-----+---------+-------+<br/> <br/>

Subjects:<br/>
+----------+-------------+------+-----+---------+----------------+<br/>
| Field    | Type        | Null | Key | Default | Extra          |<br/>
+----------+-------------+------+-----+---------+----------------+<br/>
| sub_id   | int(10)     | NO   | PRI | NULL    | auto_increment |<br/>
| sub_name | varchar(32) | NO   |     | NULL    |                |<br/>
+----------+-------------+------+-----+---------+----------------+<br/> <br/>

Requests:<br/>
+------------+---------+------+-----+---------+----------------+<br/>
| Field      | Type    | Null | Key | Default | Extra          |<br/>
+------------+---------+------+-----+---------+----------------+<br/>
| user_id    | int(10) | NO   |     | NULL    |                |<br/>
| request_id | int(10) | NO   | PRI | NULL    | auto_increment |<br/>
| subject    | int(3)  | NO   |     | NULL    |                |<br/>
| estim_time | int(2)  | NO   |     | NULL    |                |<br/>
+------------+---------+------+-----+---------+----------------+<br/>



