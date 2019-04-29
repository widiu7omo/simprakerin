<?php 
namespace Tools;
class FormGenerator{
    
    private $generatedElement;
    public $name;
    public $class;
    private $input = '<input>';
    private $radio = 'radio';
    private $checkbox = 'checkbox';
    private $button = 'button';
    private $type = 'type';
    private $select = '<select>';
    private $option = '<option>';
    private $value = 'value';
    public function generate($name,$type,$class = null,$element){
        
    }
    public function set_name($name){
        $this->name = '"'.$name.'"';
    }
    public function get_name(){
        return $this->name;
    }
    public function input($mode,$name,$value = null,$withClass = false){
        $startInput = substr_replace($this->input,' name="'.$name.'"',-1,0);
        $closeInput = substr_replace($startInput,'/',-1,0);
        $generatedElement = $closeInput;
        var_dump($closeInput);
        return $generatedElement;
    }
    
    public function select(){
        return '<select></select>';
    }

    public static function hey(){
        echo 'hey';
    }
    public function result(){
        return $generatedElement;
    }

}
?>