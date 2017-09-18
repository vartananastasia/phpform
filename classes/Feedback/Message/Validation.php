<?
namespace Feedback\Message;

use Feedback\DB\ConstructQuery as CQ;

class Validation
{
    public static function date($field)
    {
        return true;
    }

    public static function email($field)
    {
        return (strpos($field, '@')) ? true : false;
    }

    public static function not_null($field)
    {
        return ($field) ? true : false;
    }

    public static function valid_types()
    {
        $db_execution = new CQ();
        $fields = $db_execution->execute(CQ::select(DB_VALID_TYPE));
        while ($row = $fields->fetch()) {
            $data[$row['ID']] = $row['validation_type'];
        }
        return $data;
    }

    public static function column_valid($table)
    {
        $types = self::valid_types($table);
        $db_execution = new CQ();
        $fields = $db_execution->execute(CQ::where(CQ::select(DB_VALIDATION), 'table_id', $table));
        while ($row = $fields->fetch()) {
            $data[$row['column']][] = $types[$row['valid_type']];
        }
        return $data;
    }
}