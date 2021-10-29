<?php

namespace Controllers;

use DAO\AppointmentDAO;
use Models\Appointment;
use Models\JobOffer;
use Models\Student;

require_once(VIEWS_PATH . "checkLoggedUser.php");


class AppointmentController
{

    private $AppointmentDAO;
    private $loggedUser;

    public function __construct()
    {
        $this->AppointmentDAO= new AppointmentDAO();
        $this->loggedUser = $this->loggedUserValidation();
    }


    public function addAppointment($appointmentId,JobOffer $jobOffer, Student $student, $date)
    {
        require_once(VIEWS_PATH . "checkLoggedUser.php");

        $appointment = new Appointment();

        $appointment->setAppointmentId($appointmentId);
        $appointment->setJobOffer($jobOffer);
        $appointment->setStudent($student);
        $appointment->setDate($date);


        try {
            $this->AppointmentDAO->add($appointment);
          ///  $this-> /// mostrar vista*************************************************
        }
        catch (\PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }


    public function showAppointmentList($valueToSearch = null, $back = null, $message = "")
    {
        require_once(VIEWS_PATH . "checkLoggedAdmin.php");

        try {
            $allAppointment = $this->AppointmentDAO->getAll();
        }
        catch (\PDOException $ex)
        {
            echo $ex->getMessage();
        }
        $searchedAppointment=$this->searchAppointmentFiltreASD($allAppointment, $valueToSearch, $back);
        /// require_once(VIEWS_PATH . *******AGREGAR VISTA ****);
    }

    public function searchAppointmentFiltreASD($allAppointment, $valueToSearch)
    {
        $searchedAppointment = array();

        if($valueToSearch!=null)
        {
            foreach ($allAppointment as $value)
            {
                if ($value-> getAppointmentId== $valueToSearch)  // ID == ID
                {
                    array_push($searchedAppointment, $value);
                }
            }
        }
        else
        {
            $searchedAppointment = $allAppointment;
        }

        if($valueToSearch=='Show all apointments' || $valueToSearch=='Back')
        {
            $searchedAppointment = $allAppointment;
        }

        return $searchedAppointment;
    }



    public function Remove($studentId)
    {
        require_once(VIEWS_PATH . "checkLoggedUser.php");

        try {
            $this->AppointmentDAO->remove($studentId);
            /// $this-> ///*****LLAMAR A LA VISTA ***///();
        }
        catch (\PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }


    public function loggedUserValidation()
    {
        $loggedUser = null;

        if (isset($_SESSION['loggedadmin'])) {
            $loggedUser = $_SESSION['loggedadmin'];
        }
        else if(isset($_SESSION['loggedstudent'])) {
            $loggedUser = $_SESSION['loggedstudent'];
        }

        return  $loggedUser;
    }


}