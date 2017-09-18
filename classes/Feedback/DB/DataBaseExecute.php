<?
namespace Feedback\DB;

class DataBaseExecute
{
    private $connect;

    public function __construct()
    {
        $this->connect = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    }

    public function execute($query)
    {
        $execution = $this->connect->query($query);
        self::shat($this->connect);
        return $execution;
    }

    private static function shat(\PDO $db_conn)
    {
        $db_conn = null;
    }
}