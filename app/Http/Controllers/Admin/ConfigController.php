<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\Rclient;
use Auth;

class ConfigController extends Controller
{
    public function index()
    {
        $data = User::findOrFail(Auth::user()->id);

        $meta = [
            'title' => 'Edit Client',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.config.index',
            [
                'data' => $data,
                'meta' => $meta
            ]
        );
    }

    public function update(Rclient $request, $id)
    {
        $data = User::findOrFail($id);

        $data->name = $request->name;
        $data->email = $request->email;
        if (!empty($request->password)) {
            $data->password = bcrypt($request->password);
        }
        $data->save();

        return back()->with('message', 'Success Update');
    }

}
