<?
namespace Feedback\Form;

use Feedback\DB\ConstructQuery as CQ;

class ChooseForm
{
   public static function allForms(){

       $form = '';
       $db_execution = new CQ();
       $fields = $db_execution->execute(CQ::showTables());
       while ($row = $fields->fetch())
       {
           if(substr_count($row[0], 'form_')){
               $data[] = $row[0];
           }
       }
       foreach ($data as $item){
           $form .= '<a href="index.php?route=form/form&form='.$item.'">'.$item.'</a><br>';
       }

       return $form;
   }
}