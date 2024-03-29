<?php

namespace App\Services;
use App\Models\CatalogueModel;
class CatalogueService extends BaseService
{
    private $catalogue;
    function __construct()
    {
        parent::__construct();
        $this->catalogue=new CatalogueModel();
    }


    function getAllCatalogue()
    {
        return $this->catalogue->findAll();
    }
    function getCatalogue($id)
    {
        return $this->catalogue->find($id)->first();
    }
    
}