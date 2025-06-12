<?php

namespace App\Controllers;

use App\Models\RaceModel;
use App\Models\RaceYearModel;
use App\Models\ResultModel;
use App\Models\RiderModel;
use App\Libraries\GroupHelper;

class Main extends BaseController
{
    protected $raceModel;
    protected $raceYearModel;
    protected $resultModel;
    protected $riderModel;
    protected $groupHelper;

    // konstruktor tridy, ktery inicializuje modely
    public function __construct()
    {
        $this->raceModel = new RaceModel();
        $this->raceYearModel = new RaceYearModel();
        $this->resultModel = new ResultModel();
        $this->riderModel = new RiderModel();
        $this->groupHelper = new GroupHelper();
    }

    // metoda index, ktera vrati seznam rocniku
    public function index()
    {
        // ziskani vsech rocniku zavodu elite muzu, vcetne jmena zavodu a typu uci tour
        $raceYears = $this->raceYearModel
            ->select('cyklo_race_year.*, cyklo_race.default_name, cyklo_race.country AS race_country, cyklo_uci_tour_type.name AS uci_tour_name')
            ->join('cyklo_race', 'cyklo_race.id = cyklo_race_year.id_race')
            ->join('cyklo_uci_tour_type', 'cyklo_uci_tour_type.id = cyklo_race_year.uci_tour', 'left')
            ->where('cyklo_race_year.category', 'E')
            ->where('cyklo_race_year.sex', 'M')
            ->orderBy('cyklo_race.default_name', 'ASC')
            ->findAll();

        // seskupeni rocniku podle zavodu
        $races = [];
        foreach ($raceYears as $year) {
            $raceId = $year->id_race;

            // pokud zavod jeste neni v poli, vytvorime ho
            if (!isset($races[$raceId])) {
                $races[$raceId] = (object)[
                    'info' => (object)[
                        'default_name' => $year->default_name,
                        'country' => $year->race_country
                    ],
                    'years' => []
                ];
            }

            // pokud neni uci tour typ, nastavime pomlcku
            $year->uci_tour_name = $year->uci_tour_name ?? '-';

            // pridame rocnik k danemu zavodu
            $races[$raceId]->years[] = $year;
        }

        // predani dat do view
        return view('index', [
            'races' => $races
        ]);
    }

    // metoda rocnik, ktera vrati detail rocniku
    public function rocnik($id)
    {
        // ziskame detail rocniku podle id
        $year = $this->raceYearModel
            ->select('cyklo_race_year.*, cyklo_race.default_name, cyklo_race.country AS race_country')
            ->join('cyklo_race', 'cyklo_race.id = cyklo_race_year.id_race')
            ->where('cyklo_race_year.id', $id)
            ->first();

        // ziskame vysledky typu 4 = celkove poradi po etape
        $results = $this->resultModel
            ->select('cyklo_result.*, cyklo_rider.first_name, cyklo_rider.last_name, cyklo_rider.country')
            ->join('cyklo_rider', 'cyklo_rider.id = cyklo_result.id_rider', 'left')
            ->where('cyklo_result.id_stage', $id)
            ->where('cyklo_result.type_result', 4)
            ->where('cyklo_result.rank !=', 0) // aby tam nebyla nula jako poradi, nevim jak jinak 
            ->orderBy('cyklo_result.rank', 'ASC')
            ->limit(20)
            ->findAll();

        // predani dat do view
        return view('rocnik', [
            'year' => $year,
            'results' => $results
        ]);
    }

    // metoda editrocnik, ktera vrati formulář pro editaci rocniku
    public function editRocnik($id)
    {
        // ziskani data rocniku
        $year = $this->raceYearModel
            ->select('cyklo_race_year.*, cyklo_race.default_name')
            ->join('cyklo_race', 'cyklo_race.id = cyklo_race_year.id_race')
            ->where('cyklo_race_year.id', $id)
            ->first();

        // ziskani vsech typu uci tour 
        $uciTourTypes = $this->raceYearModel
            ->db
            ->table('cyklo_uci_tour_type')
            ->select('id, name')
            ->get()
            ->getResult();

        // predani dat do view pro editaci rocniku
        return view('edit_rocnik', [
            'year' => $year,
            'uciTourTypes' => $uciTourTypes
        ]);
    }

    // metoda update rocniku, ktera provede aktualizaci dat
    public function updateRocnik($id)
    {
        // ziskani dat z formulare
        $data = $this->request->getPost();

        // aktualizace dat rocniku
        $this->raceYearModel->update($id, [
            'real_name' => $data['real_name'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'uci_tour' => $data['uci_tour']
        ]);

        // presmerovani na hlavni stranku
        return redirect()->to(base_url());
    }
}
