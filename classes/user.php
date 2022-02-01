<?php

class User
{

    private $id;
    private $username;
    private $password;
    private $jsonContent;

    public function __construct()
    {
        $this->jsonContent = file_get_contents('data/users.json');
    }

    public function getUser($id)
    {
        $jsonData = json_decode($this->jsonContent, true);
        foreach ($jsonData as $key => $value) {
            if ($value['id'] == $id) {
                //don't want to send clear text password
                $value['password'] = "XXX";
                echo json_encode($value, JSON_PRETTY_PRINT);
            }
        }
    }

}
