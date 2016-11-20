<?php

class database {

    var $con;

    function __construct() {
        $dbsql = array(
            'host' => 'localhost',
            'user' => 'root',
            'pass' => '',
            'dbname' => 'ecproduct'
        );
        $this->con = mysqli_connect($dbsql['host'], $dbsql['user'], $dbsql['pass'], $dbsql['dbname']) or die('Error connecting to MySQL');
        //mysql_select_db($dbsql['dbname'], $this->con) or die('Database ' . $dbsql['dbname'] . ' does not exist!');
        mysqli_set_charset($this->con, "utf8");
    }

    function __destruct() {
        mysqli_close($this->con);
    }

    function select($options) {
        $default = array(
            'table' => '',
            'fields' => '*',
            'condition' => '1=1',
            'order' => '1',
            'limit' => 1000
        );
        $options = array_merge($default, $options);
        $sql = "SELECT {$options['fields']} FROM {$options['table']} WHERE {$options['condition']} ORDER BY {$options['order']} LIMIT {$options['limit']}";
        return mysqli_query($this->con, $sql);
    }

    function query($sql) {
        return mysqli_query($this->con, $sql);
    }

    function get($query) {
        return mysqli_fetch_assoc($query);
    }

    function rows($query) {
        return mysqli_num_rows($query);
    }

    function update($table = null, $array_of_values = array(), $conditions = 'FALSE') {
        if ($table === null || empty($array_of_values))
            return false;
        $what_to_set = array();
        foreach ($array_of_values as $field => $value) {
            if (is_array($value) && !empty($value[0]))
                $what_to_set[] = "`$field`='{$value[0]}'";
            else
                $what_to_set [] = "`$field`='" . mysqli_real_escape_string($this->con, $value) . "'";
        }
        $what_to_set_string = implode(',', $what_to_set);
        return mysqli_query($this->con, "UPDATE $table SET $what_to_set_string WHERE $conditions");
    }

    function insert($table = null, $array_of_values = array()) {
        if ($table === null || empty($array_of_values) || !is_array($array_of_values))
            return false;
        $fields = array();
        $values = array();
        foreach ($array_of_values as $id => $value) {
            $fields[] = $id;
            if (is_array($value) && !empty($value[0]))
                $values[] = $value[0];
            else
                $values[] = "'" . mysqli_real_escape_string($this->con, $value) . "'";
        }
        $sql = "INSERT INTO $table (" . implode(',', $fields) . ') VALUES (' . implode(',', $values) . ')';
        if (mysqli_query($this->con, $sql))
            return mysqli_insert_id($this->con);
        return false;
    }

    function realsql($unescaped_string) {
        return mysqli_real_escape_string($this->con, $unescaped_string);
    }

    function delete($table = null, $conditions = 'FALSE') {
        if ($table === null)
            return false;
        return mysqli_query($this->con, "DELETE FROM $table WHERE $conditions");
    }

    function insert_id() {
        return mysqli_insert_id($this->con);
    }

    function free($query) {
        mysqli_free_result($query);
    }

    function close() {
        mysqli_close($this->con);
    }

}
