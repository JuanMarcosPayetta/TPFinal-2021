<?php

namespace DAO;

use Models\Administrator;
use Models\Career;
use Models\Company;
use Models\JobOffer;
use Models\JobOfferPosition;
use Models\JobPosition;

class JobOfferDAO implements IJobOfferDAO
{
    private $connection;
    private $tableName= "jobOffers";
    private $tableName2= "jobOffers_jobPositions";
    private $tableName3 ="companies";
    private $tableName4 ="administrators";
    private $tableName5 ="careers";
    private $tableName6= "jobPositions";


    function add(JobOffer $jobOffer)
    {
        try
        {
            $query= "INSERT INTO ".$this->tableName."(activeJobOffer , remote, publishDate, endDate, title, dedication, descriptionOffer, salary, creationAdminId, companyId, careerIdOffer) VALUES (:activeJobOffer , :remote, :publishDate, :endDate, :title, :dedication, :descriptionOffer, :salary, :creationAdminId, :companyId, :careerIdOffer)";

            $parameters['activeJobOffer']=$jobOffer->getActive();
            $parameters['remote']=$jobOffer->getRemote();
            $parameters['publishDate']=$jobOffer->getPublishDate();
            $parameters['endDate']=$jobOffer->getEndDate();
            $parameters['title']=$jobOffer->getTitle();
            $parameters['dedication']=$jobOffer->getDedication();
            $parameters['descriptionOffer']=$jobOffer->getDescription();
            $parameters['salary']=$jobOffer->getSalary();
            $parameters['creationAdminId']=$jobOffer->getCreationAdmin()->getAdministratorId();
            $parameters['companyId']=$jobOffer->getCompany()->getCompanyId();
            $parameters['careerIdOffer']=$jobOffer->getCareer()->getCareerId();


            $this->connection =Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            return $this->connection->lastId();
        }
        catch(\PDOException $ex)
        {
            throw $ex;
        }
    }

    function getAll()
    {
        try {

            $query= "SELECT * FROM ".$this->tableName." o INNER JOIN ".$this->tableName2." op ON o.jobOfferId= op.jobOfferIdOp
            INNER JOIN ".$this->tableName3." co ON o.companyId= co.companyId 
            INNER JOIN ".$this->tableName4." ad ON o.creationAdminId= ad.administratorId
            INNER JOIN ".$this->tableName5." ca ON o.careerIdOffer= ca.careerId";


            //INNER JOIN ".$this->tableName6." jp ON op.jobPositionIdOp = jp.jobPositionId WHERE (op.jobOfferIdOp= :jobOfferId)

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array());

            $mapedArray=null;
            if(!empty($result))
            {
                $mapedArray= $this->mapear($result); //lo mando a MAPEAR y lo retorno (ver video minuto 13:13 en adelante)
            }

            return $mapedArray; //si todo esta ok devuelve el array mapeado, y sino NULL
        }
        catch (\PDOException $ex)
        {
            throw $ex;
        }
    }

    function getJobOffer($jobOfferId)
    {
        try {

            $query= "SELECT * FROM ".$this->tableName." o INNER JOIN ".$this->tableName2." op ON o.jobOfferId= op.jobOfferIdOp
            INNER JOIN ".$this->tableName6." jp ON op.jobPositionIdOp = jp.jobPositionId 
            INNER JOIN ".$this->tableName3." co ON o.companyId= co.companyId 
            INNER JOIN ".$this->tableName4." ad ON o.creationAdminId= ad.administratorId
            INNER JOIN ".$this->tableName5." ca ON o.careerIdOffer= ca.careerId WHERE (op.jobOfferIdOp= :jobOfferId)";

            $parameters['jobOfferId']=$jobOfferId;

            //INNER JOIN ".$this->tableName6." jp ON op.jobPositionIdOp = jp.jobPositionId WHERE (op.jobOfferIdOp= :jobOfferId)

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters);

            $mapedArray=null;
            if(!empty($result))
            {
                $mapedArray= $this->mapear($result); //lo mando a MAPEAR y lo retorno (ver video minuto 13:13 en adelante)
            }

            return $mapedArray; //si todo esta ok devuelve el array mapeado, y sino NULL
        }
        catch (\PDOException $ex)
        {
            throw $ex;
        }
    }



    function remove($id)
    {

    }

    function update(JobOffer $jobOffer)
    {

    }


    public function mapear ($array)
    {
        $array = is_array($array) ? $array : [];
        var_dump($array);

        $resultado = array_map(function ($value){


            $jobOffer = new JobOffer();

            $jobOffer->setJobOfferId($value["jobOfferId"]);
            $jobOffer->setActive($value["activeJobOffer"]);
            $jobOffer->setRemote($value["remote"]);
            $jobOffer->setPublishDate($value["publishDate"]);
            $jobOffer->setEndDate($value["endDate"]);
            $jobOffer->setTitle($value["title"]);
            $jobOffer->setDedication($value['dedication']);
            $jobOffer->setDescription($value["descriptionOffer"]);
            $jobOffer->setSalary($value["salary"]);

            $careerId=$value['careerId'];
            $careerDescription=$value['description'];
            $career= new Career();
            $career->setDescription($careerDescription);
            $career->setCareerId($careerId);
            $jobOffer->setCareer($career);

            $company = new Company();
            $company->setCompanyId($value["companyId"]);
            $company->setName($value["name"]);
            $company->setFoundationDate($value["foundationDate"]);
            $company->setCuit($value["cuit"]);
            $company->setAboutUs($value["aboutUs"]);
            $company->setEmail($value["email"]);
            $company->setActive($value["activeCompany"]);
            $company->setCompanyLink($value['companyLink']);
            $jobOffer->setCompany($company);


            $admin= new Administrator();
            $admin->setAdministratorId($value['administratorId']);
            $admin->setActive($value['activeAdmin']);
            $admin->setEmail($value['emailAdmin']);
            $admin->setPassword($value['passwordAdmin']);
            $admin->setEmployeeNumber($value['employeeNumber']);
            $admin->setFirstName($value['firstNameAdmin']);
            $admin->setLastName($value['lastNameAdmin']);
            $jobOffer->setCreationAdmin($admin);

            $jobPosition= new JobPosition();
            $jobPosition->setJobPositionId($value["jobPositionIdOp"]);


            if(isset($value['descriptionJob']))
            {
                $jobPosition->setDescription($value['descriptionJob']);
            }

            if(isset($value['careerIdJob']))
            {
                $career= new Career();
                $career->setCareerId($value['careerIdJob']);
                $jobPosition->setCareer($career);
            }
            $jobOffer->setJobPosition($jobPosition);


            return $jobOffer;

        }, $array);

        return count($resultado) > 1 ? $resultado : $resultado['0']; //devuelve un array si es mas de 1 dato, O un objeto si es 1 solo dato y sino NULL

    }





}