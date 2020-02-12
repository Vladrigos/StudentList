<?php

Class Validator
{
    const GENDER_MALE = "m";
    const GENDER_FEMALE = "f";
    const LOCAL = "l";
    const NOT_LOCAL = "n";
    
    const NAME_PATTERN = "!^[a-zA-Z]{2,}$|^[а-яёА-ЯЁ]{2,}$!u";
    const SURNAME_PATTERN = "!^[a-zA-Z]{2,}$|^[а-яёА-ЯЁ]{2,}$!u";
    const GROUP_PATTERN = "!^[a-zA-Z0-9]{2,5}|$|^[а-яёА-ЯЁ0-9]{2,5}|$!u";
    const POINTS_PATTERN = "!^[1-9][0-9]{0,3}!";
    const MAIL_PATTERN = "!^[a-zA-Z0-9]{1,30}@[a-zA-Z0-9]{1,10}\.[a-zA-Z0-9]{1,10}$!";
    /*
     * removing spaces and the first letter mode
     */
    public static function formatStudent(Student $student)
    {
        $student->setName(Validator::ucFirst(trim($student->getName())));
        $student->setSurname(Validator::ucFirst(trim($student->getSurname())));
    }
    
    public static function checkStudent(Student $student)
    {
        $errors['name'] = Validator::checkName($student->getName());
        $errors['surname'] = Validator::checkSurname($student->getSurname());
        $errors['group'] = Validator::checkGroup($student->getGroup());
        $errors['points'] = Validator::checkPoints($student->getPoints());
        $errors['email'] = Validator::checkEmail($student->getEmail());
        
        //очень похоже на костыль, не придумал как лучше
        //Если в массиве есть хоть 1 ошибка
        foreach($errors as $error)  
        {
            if($error != NULL)
            {
                //возвращаем массив с ошибками
                //var_dump($errors);
                return $errors;
            }
        }
        //иначе ошибок не найдено
        return 0;
    }
    
    public static function ucFirst($string) {
        $string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
        return $string;
    }
    
    private static function checkName($name)
    {
        if($name == '' || !preg_match(Validator::NAME_PATTERN, $name))
        {
            return "Ошибка, поле содержит недопустимые символы!";
        }
        if(strlen($name) > 25 || strlen($name) < 2)
        {
            return "Ошибка, Имя не может содержать больше 25 символов или меньше 2!";
        }
        
    }
    
    private static function checkSurname($surname)
    {

        if($surname == '' || !preg_match(Validator::SURNAME_PATTERN, $surname))
        {
            return "Ошибка, поле содержит недопустимые символы!";
        }

        if(strlen($surname) > 25 || strlen($surname) < 2)
        {
            return "Ошибка, фамилия не может содержать больше 25 символов или меньше 2!";
        }
    }
    
    private static function checkGroup($group)
    {
        if(strlen($group) > 5 || strlen($group) < 2)
        {
            return "Ошибка, группа не может содержать больше 5 символов или меньше 2!";
        }
        if(!preg_match(Validator::GROUP_PATTERN, $group))
        {
            return "Ошибка, поле содержит недопустимые символы!";
        }
    }
    
    private static function checkPoints($points)
    {
        if($points > 200 || $points < 1)
        {
            return "Количество баллов может быть от 1 до 200!";
        }
        if(!preg_match(Validator::POINTS_PATTERN, $points))
        {
            return "Недопустимые символы";
        }
    }
    
    private static function checkEmail($email)
    {
        if(strlen($email) > 40 || strlen($email) < 5)
        {
            return "Ошибка, почта не может содержать больше 40 символов или меньше 5!";
        }
        if(!preg_match(Validator::MAIL_PATTERN, $email))
        {
            return "Ошибка, поле содержит недопустимые символы!";
        }
    }
}
