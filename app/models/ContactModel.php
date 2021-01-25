<?php


class ContactModel
{
    private $name;
    private $email;
    private $age;
    private $message;

    public function setData($name, $email, $age, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->message = $message;
    }

    public function validForm()
    {
        if(strlen($this->name) < 3)
            return "Name so short!";
        else if(strlen($this->email) < 3)
            return "Email so short!";
        else if(!is_numeric($this->age) || $this->age <= 0 || $this->age > 90)
            return "You entered not age";
        else if(strlen($this->message) < 10)
            return "Message so short";
        else
            return "Ok";
    }

    public function mail()
    {
        $to = "mail@mail.com";
        $message = "Name: $this->name. Age: $this->age. Message: $this->message.";

        $subject = "=?utf-8?B?".base64_encode('Message from site')."?=";

        $header = "From: $this->email\r\nReply-to: $this->email\r\nContent-type: text/html; charset=utf8\r\n";

        $success = mail($to, $subject, $message, $header);

        if(!$success)
            return "Cant send message";
        else
            return true;
    }
}