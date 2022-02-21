<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function index()
    {
        $data = [
            'title' => 'Kelola Data User'
        ];

        return view('pages.user.index')->with($data);
    }

    public function data(Request $request)
    {
        $data = User::all()->toArray();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        return response()->json($final, 200);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $data_validator = [
            'username' => 'required|unique:users,username' . ($id == null ? '' : ',' . $id . ',id,deleted_at,NULL'),
            'name' => 'required',
            'password' => ($id == null ? 'required' : 'nullable'),
            'level' => 'required'
        ];

        $validator = Validator::make($request->all(), $data_validator);

        if ($validator->fails()) {
            $response = [
                'code' => 400,
                'message' => $validator->errors()->first(),
            ];
        } else {
            $data = [
                'username' => $request->username,
                'name' => $request->name,
                'password' => $request->password,
                'level' => $request->level
            ];
            $data['password'] = bcrypt($data['password']);

            if ($id == null || $id == '' || $id == '0') {
                $user = User::create($data);
                $response = [
                    'code' => 200,
                    'message' => 'Data berhasil disimpan',
                    'data' => $user
                ];
            } else {
                $user = User::find($id);
                $user->update($data);
                $response = [
                    'code' => 200,
                    'message' => 'Data berhasil disimpan',
                    'data' => $user
                ];
            }
        }
        return response()->json($response, 200);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->delete();
        $response = [
            'code' => 200,
            'message' => 'Data berhasil dihapus',
            'data' => $user
        ];
        return response()->json($response, 200);
    }

    public function login()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('pages.user.login')->with($data);
    }

    public function login_user(Request $request)
    {
        $data_validator = [
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $data_validator);

        if ($validator->fails()) {
            $response = [
                'code' => 400,
                'message' => $validator->errors()->first(),
            ];
        } else {
            $user = User::where('username', $request->username)->first();
            if (password_verify($request->password, $user->password)) {
                $data_session = [
                    'pangkalan_id' => $user->id,
                    'pangkalan_username' => $user->username,
                    'pangkalan_name' => $user->name,
                    'pangkalan_level' => $user->level
                ];
                session()->put($data_session);

                $response = [
                    'code' => 200,
                    'message' => 'Login berhasil',
                    'data' => $user
                ];
            } else {
                $response = [
                    'code' => 400,
                    'message' => 'Username atau password salah',
                ];
            }
        }
        return response()->json($response, 200);
    }
}
