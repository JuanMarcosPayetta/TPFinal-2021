<?php
namespace Controllers;
require_once(VIEWS_PATH . "checkLoggedUser.php");
use DAO\JobOfferDAO;
use DAO\JobOfferPositionDAO;
use DAO\JobPositionDAO;
use DAO\OriginCareerDAO;
use DAO\CompanyDAO;
use DAO\CountryDAO;
use DAO\OriginJobPositionDAO;
use Models\Administrator;
use Models\Career;
use Models\Company;
use Models\JobOffer;
use Models\JobOfferPosition;
use Models\JobPosition;


class JobController
{
    private $companyDAO;
    private $countryDAO;
    private $careersOrigin;
    private $jobPositionsOrigin;
    private $loggedUser;
    private $jobOfferDAO;
    private $jobOfferPositionDAO;
    private $jobPositionDAO;


    public function __construct()
    {
        $this->companyDAO = new CompanyDAO();
        $this->countryDAO = new CountryDAO();
        $this->careersOrigin= new OriginCareerDAO();
        $this->jobPositionsOrigin= new OriginJobPositionDAO();
        $this->loggedUser = $this->loggedUserValidation();
        $this->jobOfferDAO= new JobOfferDAO();
        $this->jobOfferPositionDAO= new JobOfferPositionDAO();
        $this->jobPositionDAO = new JobPositionDAO();

    }


    /**
     * Call the "createJobOffer" view
     * @param string $message
     */
    public function showCreateJobOfferView($message = "", $careerId= null, $values=null)
    {
        require_once(VIEWS_PATH . "checkLoggedAdmin.php");

        $allCompanies = $this->companyDAO->getAll();
        $allCountrys = $this->countryDAO->getAll();
        $allCareers= $this->careersOrigin->start($this->careersOrigin);

        if($careerId!=null)
        {
            $allPositions= $this->jobPositionsOrigin->start($this->jobPositionsOrigin);
            $this->jobPositionDAO->updateJobPositionFile(null, $allPositions);

        }

        require_once(VIEWS_PATH . "createJobOffer.php");
    }


    public function addJobOfferFirstPart($company, $career, $publishDate, $endDate)
    {
        $endDateValidation = $this->validateEndDate($endDate);
        if ($endDateValidation == null) {
            $message = "Error, enter a valid Job Offer End Date";
            $flag = 1;
            $this->showCreateJobOfferView($message);
        }
         else
        {
            $values= array("company"=>$company, "career"=>$career, "publishDate"=>$publishDate, "endDate"=>$endDate );
           $this->showCreateJobOfferView("", $career, $values);
        }
    }


    public function addJobOfferSecondPart($title, $position, $remote, $dedication, $description, $salary, $active, $values)
    {


        $postvalue = unserialize(base64_decode($values));

        $newJobOffer = new JobOffer();
        $newJobOffer->setDescription($description);
        $newJobOffer->setActive($active);
        $newJobOffer->setDedication($dedication);
        $newJobOffer->setEndDate($postvalue['endDate']);
        $newJobOffer->setPublishDate($postvalue['publishDate']);
        $newJobOffer->setRemote($remote);
        $newJobOffer->setSalary($salary);
        $newJobOffer->setTitle($title);

        $career = new Career();
        $career->setCareerId($postvalue['career']);
        $newJobOffer->setCareer($career);

        $company = new Company();
        $company->setCompanyId($postvalue['company']);
        $newJobOffer->setCompany($company);

        $admin = new Administrator();
        $admin->setAdministratorId($this->loggedUser->getAdministratorId());
        $newJobOffer->setCreationAdmin($admin);

        $positionsArray = array();
        foreach ($position as $value) {
            $newJobPosition = new JobPosition();
            $newJobPosition->setJobPositionId($value);
            array_push($positionsArray, $newJobPosition);
        }

        $newJobOffer->setJobPosition($positionsArray);

        $idOffer = $this->jobOfferDAO->add($newJobOffer);


        foreach ($newJobOffer->getJobPosition() as $value) {
            $op = new JobOfferPosition();
            $op->setJobPositionId($value->getJobPositionId());
            $op->setJoOfferId($idOffer);
            $this->jobOfferPositionDAO->add($op);
        }

        $allOffers = $this->jobOfferDAO->getJobOffer($idOffer);
        $offer=$this->unifyOffer($allOffers);
        var_dump($offer);


        //$this->showCreateJobOfferView("", $career);

    }

    /**
     * Validate if the entered job offer end date is valid
     */
    public function validateEndDate($date)
    {
        $validate =null;
        if (strtotime($date) >= time()) {
            $validate = 1;
        }
        return $validate;
    }


    public function unifyOffer($offer)
    {
        $positionArray=array();
        $finalOffer=null;
        if(is_array($offer))
        {
            $finalOffer=$offer[0];

            foreach ($offer as $values)
            {
                $pos= new JobPosition();
                $pos->setJobPositionId($values->getJobPosition()->getJobPositionId());
                $pos->setDescription($values->getJobPosition()->getDescription());
                $pos->setCareer($values->getJobPosition()->getCareer());
                array_push($positionArray, $pos);
            }
            $finalOffer->setJobPosition($positionArray);
        }
        else if(is_object($offer))
        {
            $finalOffer=$offer;
        }

        return $finalOffer;

    }



    /**
     * Validate if the admin/student has logged in the system correctly
     * @return mixed|null
     */
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