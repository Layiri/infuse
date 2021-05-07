<?php

include_once '../config/config.php';
include_once '../helpers/Database.php';


$conn = Database::connectDatabase($config);


$table_name = 'user_visitors';
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
                        `ip_address` VARCHAR(255) NOT NULL,
                        `user_agent` TEXT NOT NULL,
                        `view_date` DATETIME NOT NULL,
                        `page_url` TEXT NOT NULL,
                        `views_count` INT NOT NULL DEFAULT 1
            )";

// use exec() because no results are returned
$conn->exec($sql);

echo "Table " . $table_name . " created successfully";

