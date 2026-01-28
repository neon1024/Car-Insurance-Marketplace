<?php

namespace App\Http\Controllers;

use App\Services\NomenclatureService;
use Exception;

class NomenclatureController extends Controller
{
    private NomenclatureService $nomenclatureService;

    public function __construct(NomenclatureService $nomenclatureService) {
        $this->nomenclatureService = $nomenclatureService;
    }

    // TODO
    public function getCountries() {
        try {
            $countries = $this->nomenclatureService->getCountries();

            return $countries;
        } catch(Exception $error) {
            return redirect()->back()->with([
                "error" => true,
                "status" => 500,
                "message" => $error->getMessage()
            ]);
        }
    }

    // TODO
    public function getCounties() {
        try {
            $counties = $this->nomenclatureService->getCounties();

            return $counties;
        } catch(Exception $error) {
            return redirect()->back()->with([
                "error" => true,
                "status" => 500,
                "message" => $error->getMessage()
            ]);
        }
    }

    // TODO
    public function getCitiesByCountyCode() {
        $county_code = request()->route()->parameter("county_code");

        if(!$county_code) {
            return redirect()->back()->with("Get cities failed. No county code provided");
        }

        try {
            $cities = $this->nomenclatureService->getCitiesByCountyCode($county_code);

            return $cities;
        } catch(Exception $error) {
            return redirect()->back()->with([
                "error" => true,
                "status" => 500,
                "message" => $error->getMessage()
            ]);
        }
    }
}
