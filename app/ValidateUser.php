<?php 
namespace app;

class ValidateUser{

    private $data;
    private $errors=[];
    private $fields = ['username','email','phone','password','repeat-password'];

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

/*********Validating the user input ***********/
    public function validateUserInfo(){

        foreach($this->fields as $field){

            if(!array_key_exists($field,$this->data)){
                trigger_error("$field should be present!");
            }else{
                self::checkValidateFunc($field);
            }
            // echo $field;
             
        }    
        return $this->errors;
    }

######### Adding error to array ########
    private function addError($key,$value){
        $this->errors[$key] = $value;
    }

################ set the value to private property #########
    public function setFields($arr){
        $this->fields = $arr;
    }

######### Email Validation function ##############    
    private function validateEmail(){
        $value = trim($this->data['email']);
        if(empty($value)){
            self::addError("email","Email is empty!");
        }else{
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                $this->addError("email","Invalid email address!");
            }
        }
    }

########## Other form field validation function ################
    private function validateData($name,$errorMessage,$pattern){
        $value = trim($this->data[$name]);
        if(empty($value)){
            self::addError($name,"$name is empty!");
        }else{
            if(!preg_match($pattern,$value)){
                $this->addError($name,$errorMessage);
            }
        }
    }

########## Checking the correspond validate function #############
    private function  checkValidateFunc($value){
        switch($value){
            case 'username': 
                return self::validateData($value,"Username should be characters and alphanumeric!","/^\w[\w]+/");
                break;
            case 'email': 
                return self::validateEmail();
                break;
            case 'phone': 
                return self::validateData($value,"Phone number should be like this +959887998665!","/^\\+959?\\d{9}/");
                break;
            case 'password': 
                return self::validateData($value,"Password should be 6 to 12 characters and alphanumeric!","/^\S{6,12}/");
                break;
            case 'repeat-password': 
                return self::validateData($value,"Password should be 6 to 12 characters and alphanumeric!","/^\S{6,12}/");
                break;
        }
    }

}

?>