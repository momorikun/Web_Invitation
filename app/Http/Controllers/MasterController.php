<?php

namespace App\Http\Controllers;

use App\Interfaces\Master\MasterRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Ceremony;
use App\Repository\MasterRepository;

class MasterController extends Controller
{
    private MasterRepositoryInterface $masterRepository;

    public function __construct(MasterRepositoryInterface $masterRepository)
    {
        $this->masterRepository = $masterRepository;
    }

    public function index(){
        $ceremonies = $this->masterRepository->getAllCeremonies();
        return view('master.index', ['ceremonies' => $ceremonies]);
    }
}
