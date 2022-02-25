<?php


/*
-------------TASK-------------
 id          | int(9)       | NO   | PRI | NULL    | auto_increment |
| name        | varchar(50)  | NO   |     | NULL    |                |
| description | varchar(255) | NO   |     | NULL    |                |

*/

function connectDB() {
    $db = mysqli_connect('localhost', 'root', '', 'ajax', 3306);


    if (!$db) {
        exit;
    }

    return $db;
}


