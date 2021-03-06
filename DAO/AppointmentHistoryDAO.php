<?php

namespace DAO;

use Models\AppointmentHistory;
use Models\Career;
use Models\Company;
use Models\JobOffer;
use Models\User;

class AppointmentHistoryDAO implements IAppointmentHistoryDAO
{
    private $connection;
    private $tablename = "appointmentHistory";



    public function add(AppointmentHistory $appointmentHistory)
    {
        try
        {
            $hola="hola";

            $query = "INSERT INTO " . $this->tablename . " (jobOfferTitle, jobOfferCompanyName, jobOfferCompanyCuit, historyCareerName, historyStudentId, appointmentDate) VALUES (:jobOfferTitle, :jobOfferCompanyName, :jobOfferCompanyCuit, :historyCareerName, :historyStudentId, :appointmentDate)";

            $parameters['jobOfferTitle'] = $appointmentHistory->getJobOffer()->getTitle();
            $parameters['jobOfferCompanyName'] = $appointmentHistory->getCompany()->getName();
            $parameters['jobOfferCompanyCuit'] = $appointmentHistory->getCompany()->getCuit();
            $parameters['historyCareerName'] = $appointmentHistory->getCareer()->getDescription();
            $parameters['historyStudentId'] = $appointmentHistory->getStudent()->getUserId();
            $parameters['appointmentDate']= $appointmentHistory->getAppointmentDate();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);

        }catch (\Exception $ex)
        {
            throw $ex;
        }
    }

    /**
     * Returns all values from Data base
     * @return array
     */
    function getAll()
    {

        try {
            $query= "SELECT * FROM ".$this->tablename;


            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array());

            $mapedArray=null;
            if(!empty($result))
            {
                $mapedArray= $this->mapear($result); //lo mando a MAPEAR y lo retorno (ver video minuto 13:13 en adelante)
            }

            return $mapedArray; //si todo esta ok devuelve el array mapeado, y sino NULL
        }
        catch (\Exception $ex)
        {
            throw $ex;
        }
    }



    function getHistoryAppointments($studentId)
    {
        try {

            $query = "SELECT * FROM " . $this->tablename . " WHERE (historyStudentId= :historyStudentId)";

            $parameters['historyStudentId'] = $studentId;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters);

            $mapedArray = null;
            if (!empty($result)) {
                $mapedArray = $this->mapear($result); //lo mando a MAPEAR y lo retorno (ver video minuto 13:13 en adelante)
            }

            return $mapedArray; //si todo esta ok devuelve el array mapeado, y sino NULL
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


    public function mapear ($array)
    {
        $array = is_array($array) ? $array : []; //si lo que viene como parametro es un array lo deja como viene, sino lo guarda como array vacio

        $resultado = array_map(function ($value){

            $appointment = new AppointmentHistory();

           $appointment->setHistoryId($value["historyId"]);
           $appointment->setAppointmentDate($value['appointmentDate']);
           $offer= new JobOffer();
           $offer->setTitle($value["jobOfferTitle"]);
           $appointment->setJobOffer($offer);
           $career= new Career();
           $career->setDescription($value["historyCareerName"]);
           $appointment->setCareer($career);
           $student= new User();
           $student->setUserId($value['historyStudentId']);
           $appointment->setStudent($student);
           $company= new Company();
           $company->setName($value['jobOfferCompanyName']);
           $company->setCuit($value['jobOfferCompanyCuit']);
           $appointment->setCompany($company);

            return $appointment;

        }, $array);

        return count($resultado) > 1 ? $resultado : $resultado['0'];

    }


}