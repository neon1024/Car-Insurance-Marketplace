<?php

namespace App\Http\Controllers;

use App\Services\OfferService;
use Exception;
use Inertia\Inertia;

class OfferController extends Controller
{
    private OfferService $offerService;
    public function __construct(OfferService $offerService) {
        $this->offerService = $offerService;
    }

    public function index()
    {
        try {
            // TODO validate
            $validated = request()->validate([
                'product' => 'required|array',
                'product.motor' => 'required|array',
                'product.motor.startDate' => 'required|date|date_format:Y-m-d|after_or_equal:today',
                'product.motor.termTime' => 'required|integer|min:1|max:12',

                'product.policyholder' => 'required|array',
                'product.policyholder.lastName' => 'sometimes|string',
                'product.policyholder.firstName' => 'sometimes|string',
                'product.policyholder.isForeignPerson' => 'required|boolean',
                'product.policyholder.taxId' => 'required|string',
                'product.policyholder.nationality' => 'required|string|size:2',
                'product.policyholder.citizenship' => 'required|string|size:2',
                'product.policyholder.gender' => 'required|string|in:m,f',
                'product.policyholder.birthdate' => 'required|date_format:Y-m-d',
                'product.policyholder.email' => 'sometimes|email',
                'product.policyholder.mobileNumber' => 'sometimes|string',

                'product.policyholder.identification' => 'sometimes|array',
                'product.policyholder.identification.idType' => 'sometimes|string',
                'product.policyholder.identification.idNumber' => 'sometimes|string',
                'product.policyholder.identification.issueAuthority' => 'sometimes|string',
                'product.policyholder.identification.issueDate' => 'sometimes|date_format:Y-m-d',

                'product.policyholder.address' => 'required|array',
                'product.policyholder.address.country' => 'required|string',
                'product.policyholder.address.county' => 'required|string',
                'product.policyholder.address.city' => 'required|string',
                'product.policyholder.address.cityCode' => 'required|integer',
                'product.policyholder.address.street' => 'required|string',
                'product.policyholder.address.houseNumber' => 'required|string',
                'product.policyholder.address.postcode' => 'required|string',

                'product.policyholder.hasDisability' => 'sometimes|boolean',
                'product.policyholder.isRetired' => 'sometimes|boolean',

                'product.vehicle' => 'required|array',
                'product.vehicle.registrationType' => 'required|string',
                'product.vehicle.licensePlate' => 'sometimes|string',
                'product.vehicle.vin' => 'required|string',
                'product.vehicle.vehicleType' => 'required|string',
                'product.vehicle.brand' => 'required|string',
                'product.vehicle.model' => 'required|string',
                'product.vehicle.yearOfConstruction' => 'required|integer|min:1900|max:2100',
                'product.vehicle.engineDisplacement' => 'required|integer|min:1',
                'product.vehicle.seats' => 'required|integer|min:1',
                'product.vehicle.enginePower' => 'required|integer|min:1',
                'product.vehicle.totalWeight' => 'required|integer|min:1',
                'product.vehicle.fuelType' => 'required|string',
                'product.vehicle.firstRegistration' => 'required|date_format:Y-m-d|before_or_equal:today',
                'product.vehicle.usageType' => 'required|string',
                'product.vehicle.currentMileage' => 'required|integer|min:0',
                'product.vehicle.hasMobilityModifications' => 'required|boolean',
                'product.vehicle.isLeased' => 'required|boolean',

                'product.vehicle.identification' => 'required|array',
                'product.vehicle.identification.idNumber' => 'required|string',
            ]);

            $offersData = $this->offerService->getOffers($validated);

            // TODO redirect and store $offers in session permanently
//            return redirect()->route("offerResults.page")->with("offers", $offersData);
            return Inertia::render('OfferResults', [
                'offers' => $offersData,
            ]);
            // TODO handle
        } catch (Exception $error) {
            return Inertia::render('OfferResults', [
                "offers" => [],
                'errors' => $error->getMessage()
            ]);
        }
    }
}
