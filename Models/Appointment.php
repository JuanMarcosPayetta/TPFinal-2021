<?php

namespace Models;

class Appointment
{
  private $appointmentId;
  private $jobOffer;
  private $student;
  private $date;


    public function getAppointmentId()
    {
        return $this->appointmentId;
    }


    public function setAppointmentId($appointmentId)
    {
        $this->appointmentId = $appointmentId;
    }

    public function getJobOffer()
    {
        return $this->jobOffer;
    }


    public function setJobOffer($jobOffer)
    {
        $this->jobOffer = $jobOffer;
    }


    public function getStudent()
    {
        return $this->student;
    }


    public function setStudent($student)
    {
        $this->student = $student;
    }


    public function getDate()
    {
        return $this->date;
    }


    public function setDate($date)
    {
        $this->date = $date;
    }





}