<?php


Class Template implements ArrayAccess
{

    private $registry;
    private $vars = array();

    function __construct($registry)
    {
        $this->registry = $registry;
    }

    function set($varname, $value, $overwrite = false)
    {
        if (isset($this->vars[$varname]) == true AND $overwrite == false) {
            trigger_error('Unable to set var `' . $varname . '`. Already set, and overwrite not allowed.', E_USER_NOTICE);

            return false;
        }
        $this->vars[$varname] = $value;

        return true;
    }

    function remove($varname)
    {
        unset($this->vars[$varname]);

        return true;
    }

    function show($template)
    {
        if (file_exists($template) == false) {
            echo 'нет запрашиваемого шаблона';
            return false;
        }
        $temp = file_get_contents($template);

        foreach ($this->vars as $key=>$field){
            $temp = str_replace('{{ '.$key.' }}', $field, $temp);
        }

        $pattern = "/{{ include (\w+).(\w+) }}/i";
        preg_match_all($pattern, $temp, $files);

        foreach ($files[1] as $key=>$file){
            $temp = str_replace('{{ include '.$file.'.'.$files[2][$key].' }}', file_get_contents('templates/'.$file.'.'.$files[2][$key]), $temp);
        }

          echo $temp;
    }

    function offsetExists($offset)
    {
        return isset($this->vars[$offset]);
    }

    function offsetGet($offset)
    {
        return $this->get($offset);
    }

    function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    function offsetUnset($offset)
    {
        unset($this->vars[$offset]);
    }

    function get($key)
    {
        if (isset($this->vars[$key]) == false) {
            return null;
        }

        return $this->vars[$key];

    }
}