<?php

namespace App\Repository\Master;

use App\Interfaces\Master\MasterRepositoryInterface;
use App\Models\Ceremony;

class MasterRepository implements MasterRepositoryInterface
{
    public function getAllCeremonies()
    {
        return Ceremony::paginate(15);
    }

    public function getDeletedCeremonies()
    {
        return Ceremony::select('*')->whereNotNull('deleted_at')->get();
    }
}