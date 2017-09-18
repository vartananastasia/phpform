<?php

use Feedback\Form\ChooseForm as FChoose;
use Feedback\Form\Form as Form;
use Registry as Reg;
use Template as Temp;
use Feedback\Message\Message as Mes;


Class Controller_Form Extends Controller_Base
{
    function index()
    {
        echo 'Default request';
    }

    function choose()
    {
        $template = new Temp(new Reg);
        $template->set('choose', FChoose::allForms());

        $template->show('templates/choose.html');
    }

    function form()
    {
        $form = new Form($_GET['form']);
        $template = new Temp(new Reg);
        $template->set('form', $form->getHtml());
        $template->set('form_name', $form->getName());

        $template->show('templates/form.html');
    }

    function send()
    {
        $message = new Mes($_POST, new Form($_GET['form']));
        $template = new Temp(new Reg);
        $template->set('send', $message->getStatus());

        $template->show('templates/send.html');
    }
}