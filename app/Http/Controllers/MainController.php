<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pkb;

class MainController extends Controller
{

    public function main(Request $req)
    {

        $year = (int) $req->input("year", 0);
        $code = $req->input("country", "");
        $data = [];

        if ($year != 0 || $code != "") {
            if ($year != 0 && $code != "") {
                $data = Pkb::where("year", $year)->where("country", $code)->orderBy("value", "DESC")->get()->toArray();
            } elseif ($year != 0) {

                $data = Pkb::where("year", $year)->orderBy("value", "DESC")->get()->toArray();
            } elseif ($code != "") {
                $data = Pkb::where("country", $code)->orderBy("year", "DESC")->get()->toArray();
            }
        } else {
            $maxy = Pkb::max("year");
            $data = Pkb::where("year", $maxy)->where("code", "!=", "")->orderBy("value", "DESC")->get()->toArray();
        }



        $years = Pkb::select("year")->groupBy("year")->get()->pluck("year")->toArray();
        $country = Pkb::select("country")->groupBy("country")->get()->pluck("country")->toArray();

        return view("main", ["data" => $data, "years" => $years, "country" => $country, "year" => $year, "code" => $code]);
    }

    public function import()
    {

        $data = Storage::get('gdp-maddison.csv');
        $data = explode("\n", $data);
        foreach ($data as $key => $record) {
            if ($key == 0) {
                continue;
            }
            $res = explode(",", $record);
            Pkb::updateOrCreate(
                ["country" => $res[0], "year" => $res[2]],
                ["country" => $res[0], "code" => $res[1], "year" => $res[2], "value" => $res[3], "info" => $res[4] ? $res[4] : null]
            );
        }
        return redirect("/")->with('success', 'Dokonano importu z CSV');
    }
}
