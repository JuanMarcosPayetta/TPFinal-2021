<?php

namespace DAO;

use Models\Country;


class CountryRepository implements lCountryRepository
{
    private $countryList = array();
    private $fileName;


    public function __construct()
    {
        $this->fileName = ROOT . "/Data/countrys.json";
    }

    /**
     * Add a country to a Json file
     * @param Country $country
     */
    function add(Country $country)
    {
        $this->RetrieveData();
        array_push($this->countryList, $country);
        $this->SaveData();
    }

    /**
     * Get all the countrys from Json file
     * @return array
     */
    function getAll()
    {
        $this->RetrieveData();
        return $this->countryList;
    }

    /**
     * Remove a country by ID from Json file
     * @param $id
     */
    public function searchById($id)
    {
        $this->retrieveData();
        $country=null;

        foreach ($this->countryList as $value)
        {
            if($value->getId()==$id)
            {
                $country=$value;
            }
        }

        return $country;
    }

    public function searchByName($name)
    {
        $this->retrieveData();
        $country=null;

        foreach ($this->countryList as $value)
        {
            if(strcasecmp($value->getName(), $name)==0)
            {
                $country=$value;
            }
        }

        return $country;
    }

    public function searchMaxId()
    {
        $this->retrieveData();
        $country=null;

        $maxid=1;
        if(count($this->countryList)>1)
        {
            $maxid=$this->countryList[0]->getId();

            foreach ($this->countryList as $value)
            {
                if($value->getId()>$maxid)
                {
                    $maxid=$value->getId();
                }
            }
            $maxid++;
        }
        else
        {
            $maxid++;
        }

        return $maxid;
    }



    function remove($id)
    {
        $this->retrieveData();


        $this->countryList=array_filter($this->countryList, function ($country) use($id){
            return $country->getId()!=$id; //si se cumple guarda el dato en this->countrylist

        });

        $this->saveData();
    }

    /**
     *Saves all countrys in a Json file
     */
    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->countryList as $country) {
            $valuesArray["name"] = $country->getName();
            $valuesArray["id"] = $country->getId();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);

    }

    /**
     *Retrieves all countrys from Json file to an array
     */
    private function RetrieveData()
    {
        $this->countryList = array();

        if (file_exists($this->fileName))
        {
            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {
                $country = new Country();
                $country->setName($valuesArray["name"]);
                $country->setId($valuesArray["id"]);

                array_push($this->countryList, $country);
            }
        }
    }
}