<?php
namespace Models;

abstract class User
{
    private $email;
    private $active;
    //no se agrego firstName y lastName por si algun dia empresa tambiem sea user y no poseen estas caracteristicas


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getActive()
    {
        return $this->active;
    }


    public function setActive($active)
    {
        $this->active = $active;
    }






}