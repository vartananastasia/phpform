<?
namespace Feedback\Form;

use Feedback\Input\Input as Input;
use Feedback\DB\ConstructQuery as CQ;
use Feedback\Message\Validation as Valid;

class Form
{
    private $fields = [];
    private $html;
    private $name;

    public function __construct($table_name)
    {
        $this->name = str_replace('form_', '', $table_name);
        $this->fields = self::getInputs();
        $this->html = self::constructForm($this->fields);
    }

    private function getInputs()
    {

        $valid_types = Valid::valid_types();
        $input_types = Input::input_types();
        $forms = self::forms();

        $db_execution = new CQ();
        $fields = $db_execution->execute(CQ::where(CQ::select(DB_INPUTS), 'form_id', $forms[$this->name]));

        while ($row = $fields->fetch())
        {

            $db_execution = new CQ();
            $f = $db_execution->execute(CQ::where(CQ::select(DB_INPUT_VALIDATION), 'input_id', $row['ID']));
            while ($r = $f->fetch())
            {
               $validation[$row['ID']][] = $valid_types[$r['valid_type_id']];
            }

            $data[] = new Input($row['name'], $this->name, $input_types[$row['input_type_id']], $validation[$row['ID']]);
        }

        return $data;
    }

    private static function constructForm($data)
    {
        $form = '';
        foreach ($data as $field) {
            $form .= $field->html;
        }
        return $form;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function getName()
    {
        return $this->name;
    }

    private static function forms()
    {
        $db_execution = new CQ();
        $fields = $db_execution->execute(CQ::select(DB_FORMS));

        while ($row = $fields->fetch())
        {
            $data[$row['name']] = $row['ID'];
        }

        return $data;
    }

    public function getInputValidation(){
        foreach ($this->fields as $field){
            $data[$field->name] = $field->validation;
        }
        return $data;
    }
}