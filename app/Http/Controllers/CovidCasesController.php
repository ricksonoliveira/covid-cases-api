<?php

namespace App\Http\Controllers;

use App\Models\CovidCase;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

class CovidCasesController extends Controller
{
    protected $apiBrasilUrl = "https://api.brasil.io/v1/";

    protected $token = "Token cd06accc7cba9e0b48b4d3106f3ea4359f593725";

    public function covidCases(Request $request)
    {
        try {
            $dateStart = $request->get('dateStart', '2020-05-10');
            $dateEnd = $request->get('dateEnd', '2020-05-11');
            $state = $request->get('state', 'MG');
            $perPage = $request->get('perPage', 10);


            $covidCases = Http::withHeaders(
                [
                    'Authorization' => $this->token
                ]
            )
               ->get($this->apiBrasilUrl
                . 'dataset/covid19/caso/data/?state='
                . $state
                . '&dateStart'
                . $dateStart
                .'&dateEnd='
                . $dateEnd
                . '&order_for_place='
                . $perPage
            )->json();

            $collection = collect($covidCases);

            $covidCaseModel = new CovidCase();
            $covidCaseModel->filterCitiesByCovidCase($collection);

            return $collection
                ->sortBy('confirmed_per_100k_inhabitants')
                ->values()
                ->all();

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

    }
}
