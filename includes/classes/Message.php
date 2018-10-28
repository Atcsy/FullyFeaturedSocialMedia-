<?php

class Message
{
    private $user_obj;
    private $con;

    public function _construct($con, $user)
    {
        $this->con = $con;
        $this->user_obj = new user($con, $user);
    }

}


?>