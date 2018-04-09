<?php
if (!defined('server'))
{
    define("server", "localhost");
}
if (!defined('dbname'))
{
    define("dbname", "otoshop");
}
if (!defined('user'))
{
    define("user", "root");
}
if (!defined('pass'))
{
    define("pass", "");
}

if (!function_exists("read_db")) {
    function read_db($query) {
        $cn = new mysqli(server, user, pass, dbname);
        if ($cn->connect_errno) {
            die("Error connect to database");
        }

        $cn->query("set names 'utf8'");

        $rs = $cn->query($query);
        return $rs;
    }
}
if (!function_exists("write_db")) {

    function write_db($query, $type) { // type: 0 => insert, type: 1 => delete/update
        $cn = new mysqli(server, user, pass, dbname);
        if ($cn->connect_errno) {
            die("Error connect to database");
        }

        $cn->query("set names 'utf8'");
        $cn->query($query);

        if ($type == 1) {
            return $cn->affected_rows; // Gets the number of affected rows in a previous MySQL operation
        }

        return $cn->insert_id; // Get the ID generated in the last query
    }

}
