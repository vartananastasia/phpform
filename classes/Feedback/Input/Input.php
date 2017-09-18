<?
namespace Feedback\Input;

use Feedback\DB\ConstructQuery as CQ;

class Input
{
    private $name;
    private $title;
    private $form;
    private $type;
    private $validation = [];
    private $html;

    public function __construct($name, $form, $type, $validation)
    {
        $this->name = $name;
        $this->form = $form;
        $this->type = $type;
        $this->validation = $validation;

        switch ($this->type){
            case 'textarea':
                $this->html = self::htmlTextarea($this->name);
                break;
            case 'text':
                $this->html = self::htmlText($this->name);
                break;
            case 'checkbox':
                $this->html = self::htmlCheckbox($this->name);
                break;
            case 'radio':
                $this->html = self::htmlRadio($this->name);
                break;
        }
    }

    public function __get($field){
        switch ($field){
            case 'name':
                return $this->name;
                break;
            case 'form':
                return $this->form;
                break;
            case 'type':
                return $this->type;
                break;
            case 'validation':
                return $this->validation;
                break;
            case 'html':
                return $this->html;
                break;
        }
    }

    public static function input_types(){

        $db_execution = new CQ();
        $fields = $db_execution->execute(CQ::select(DB_INPUT_TYPES));
        while ($row = $fields->fetch())
        {
            $data[$row['ID']] = $row['type'];
        }
        return $data;
    }

    private static function htmlTextarea($name){
        return "<textarea name='{$name}'></textarea>";
    }

    private static function htmlText($name){
        return "<input type='text' name='{$name}'>";
    }

    private static function htmlCheckbox(){
    }

    private static function htmlRadio(){
    }
}