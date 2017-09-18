<?
namespace Feedback\DB;

use Feedback\DB\DataBaseExecute as DB;

class ConstructQuery extends DB
{
    public static function insert($fields, $table)
    {
        $in_to = '';
        $what =  '';
        foreach ($fields as $key=>$field){
            $in_to .= ', '.$key;
            $what .= ', "'.$field.'"';
        }
        $query = 'INSERT INTO '.$table.'(  ID '.$in_to.')VALUES(0'.$what.');';
        return $query;
    }

    public static function showColumns($table)
    {
        $query = 'show columns from '.$table.';';
        return $query;
    }

    public static function select($table)
    {
        $query = 'select * from '.$table.';';
        return $query;
    }

    public static function showTables()
    {
        $query = 'show tables;';
        return $query;
    }

    public static function where($query, $field, $value)
    {
        $query = str_replace(';', '', $query);
        $j = explode('_', $field);
        $field_spec = end($j);
        if ($field_spec == 'id'){
            $query = $query . ' where ' . $field . '=' . $value;
        }else {
            $query = $query . ' where ' . $field . '="' . $value . '"';
        }
        return $query.';';
    }

    public static function CreateTable($form_name, $form_fields)
    {
        $fields = '';
        foreach ($form_fields as $key =>$field){
            $fields .= $field.' varchar(255) DEFAULT NULL,';
        }
        $query = "CREATE TABLE feedback.form_" . $form_name . " (  ID int(11) NOT NULL AUTO_INCREMENT,  ". $fields ."  PRIMARY KEY (ID));";
        return $query;
    }
}