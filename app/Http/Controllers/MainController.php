<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pkb;

class MainController extends Controller
{

    public function main()
    {
        return view("main", []);
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
