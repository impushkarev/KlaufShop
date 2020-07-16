<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\AccountImages;


class AccountController extends Controller
{
    public function create(request $data) {
        $account = new Account;

        if($data->hasFile('files')) {
            $this->construct_item($account, $data);        
            $this->upload_images($data, $account->id);
        }

        return redirect()->route('admin');
    }

    public function update(request $data, Account $account) {
        $this->construct_item($account, $data);
        if($data->hasFile('files')) {
            $this->upload_images($data, $account->id);
        }

        return redirect()->route('admin');
    }

    public function delete(Account $account) {
        $account->delete();

        return redirect()->route('admin');
    }

    private function construct_item($account, $data) {
        $account->fill([
            'name' => $data->name,
            'game' => $data->game,
            'description' => $data->description,
            'mres' => str_replace(' ', '', $data->mres),
            'ares' => str_replace(' ', '', $data->ares),
            'dres' => str_replace(' ', '', $data->dres),
            'rang' => str_replace(' ', '', $data->rang),
            'desc_rang' => $data->desc_rang,
            'lvl' => $data->lvl,
            'login' => $data->login,
            'password' => $data->password,
            'isLinked' => $data->isLinked ? $data->isLinked : false,
            'price' => str_replace(' ', '', $data->price),
        ])->push();
    }

    private function upload_images($data, $id) {
        foreach ($data->file('files') as $photo) {
            $photo->move(implode('/', [public_path(), 'img', 'accounts', $id]), $photo->getClientOriginalName());

            $img = new AccountImages;
            $img->fill([
                'account_id' => $id,
                'image' => $photo->getClientOriginalName(),
            ])->push();
        }
    }
}
