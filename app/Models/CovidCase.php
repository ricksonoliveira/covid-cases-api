<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class CovidCase extends Model
{
    use HasFactory;

    public function filterCitiesByCovidCase(Collection $covidCases) : Collection
    {
        return $covidCases->reduce(function ($carry, $covidCase) {
            Http::withHeaders(
                [
                    'MeuNome' => 'Rick G. S. Oliveira',
                ]
            )->post(
                'https://us-central1-lms-nuvem-mestra.cloudfunctions.net/testApi',
                [
                    'id' => $carry+1,
                    'nomeCidade' => $covidCase['city'],
                    'percentualDeCasos' => $covidCase['confirmed_per_100k_inhabitants']
                ]
            );
        }, 0);
    }
}
