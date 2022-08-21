<?php

namespace App\Interfaces\Master;

interface MasterRepositoryInterface
{
    public function getAllCeremonies();
    public function getDeletedCeremonies();
}