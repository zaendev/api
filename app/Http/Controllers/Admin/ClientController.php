<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Rclient;
use App\User;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $user = DB::table('users');
        if ($request->search) {
            $user->where('name', 'like', '%' . $request->search . '%');
        }
        $user = $user->get();

        $data = [];
        foreach ($user as $u){
            $dataExpires = DB::table('oauth_access_tokens')
                ->select('id', 'expires_at')
                ->where('user_id', $u->id)
                ->orderBy('id', 'desc')
                ->first();

            if(empty($dataExpires)){
                $expires = null;
            } else {
                $expires = $dataExpires->expires_at;
            }

            $data[] = [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'expires_at' => $expires,
                'created_at' => $u->created_at,
            ];
        }


        $meta = [
            'title' => 'Client',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.client.index',
            [
                'data' => $this->paginate($data, 10),
                'meta' => $meta
            ]
        );
    }

    public function create()
    {
        $meta = [
            'title' => 'Create Client',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.client.create',
            [
                'meta' => $meta
            ]
        );
    }

    public function store(Rclient $request)
    {
        $data = new User;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->level = 'client';
        $data->save();

        return redirect(route('client.index'))->with('message', 'Successfully created client');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        $meta = [
            'title' => 'Edit Client',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.client.edit',
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

        return redirect(route('client.index'))->with('message', 'Success Update');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);

        DB::table('oauth_access_tokens')
            ->where('user_id', $id)
            ->delete();

        $data->delete();

        return back()->with('message', 'Success Delete');
    }

    public function token($id)
    {
        $user = User::find($id);

        $tokenResult = $user->createToken('Personal Access Token');

        $meta = [
            'title' => 'Edit Client',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.client.token',[
            'name' => $user->name,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'meta' => $meta
        ]);
    }

    public function newex($id)
    {
        $dateExpires = DB::table('oauth_access_tokens')
            ->select('id', 'expires_at')
            ->where('user_id', $id)
            ->orderBy('id', 'desc')
            ->first();

        DB::table('oauth_access_tokens')
            ->where('id', $dateExpires->id)
            ->update(['expires_at' => Carbon::parse($dateExpires->expires_at)->addYear()]);

        return back()->with('message', 'Success add expires');
    }

    public function paginate($items, $perPage, $page = null)
    {
        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof \Illuminate\Support\Collection ? $items : \Illuminate\Support\Collection::make($items);
        return new \Illuminate\Pagination\LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]);
    }
}
