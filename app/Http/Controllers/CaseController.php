<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cases;
use App\CasePrize;
use App\CasePrizeList;

class CaseController extends Controller
{
    public function create(request $data) {
        
        if($data->hasFile('files')) {
            $case = new Cases;

            $case->fill([
                'image' => $data->file('files')->getClientOriginalName(),
            ]);
            $this->construct_item($case, $data);
            $data->file('files')->move(implode('/', [public_path(), 'img', 'cases', $case->id]), $data->file('files')->getClientOriginalName());
        }

        for ($i=1; $i < count($data->name_prize); $i++) {   
            $case_prizes = new CasePrize;      

            $this->construct_prizes($case_prizes, $data, $case->id, $i);

            for ($j=0; $j < count($data->data_prize[$i]); $j++) {            
                $case_prizes_list = new CasePrizeList;
                $this->construct_prizes_list($case_prizes_list, $data, $case_prizes->id, $i, $j);
            }
        }

        return redirect()->route('admin');
    }

    public function delete(Cases $case) {
        $case->delete();

        return redirect()->route('admin');
    }

    private function construct_item($case, $data) {
        $case->fill([
            'name' => $data->name,
            'type' => $data->type,
            'price' => $data->price,
        ])->push();
    }

    private function construct_prizes($case_prizes, $data, $id, $i) {
        $case_prizes->fill([
            'case_id' => $id,
            'name' => $data->name_prize[$i],
            'chance' => $data->chance[$i],
            'type' => $data->type_of_prize[$i],
        ])->push();
    }

    private function construct_prizes_list($case_prizes_list, $data, $id, $i, $j) {
        $case_prizes_list->fill([
            'case_prize_id' => $id,
            'data' => $data->data_prize[$i][$j],
        ])->push();
    }
}
