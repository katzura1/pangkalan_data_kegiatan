<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function register()
    {
        $data = [
            'title' => 'Register User'
        ];

        return view('pages.user.register')->with($data);
    }

    public function data(Request $request)
    {
        $status = $request->status;
        $data = User::all()->where('status', $status)->toArray();
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
            // 'username' => 'required|unique:users,username' . ($id == null ? '' : ',' . $id . ',id') . ',deleted_at,NULL',
            'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL',
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
                'level' => $request->level,
                'status' => '1',
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

    public function register_user(Request $request)
    {
        $data_validator = [
            'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL',
            'name' => 'required',
            'password' => 'required',
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
                'level' => 'media',
                'status' => '0',
            ];
            $data['password'] = bcrypt($data['password']);

            try {
                DB::beginTransaction();
                $user = User::create($data);
                $response = [
                    'code' => 200,
                    'message' => 'Data berhasil disimpan',
                    'data' => $user
                ];
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $response = [
                    'code' => 400,
                    'message' => $e->getMessage(),
                ];
            }
        }
        return response()->json($response, 200);
    }

    public function change_status(Request $request)
    {
        $data_validator = [
            'id' => 'required',
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(), $data_validator);

        if ($validator->fails()) {
            $response = [
                'code' => 400,
                'message' => $validator->errors()->first(),
            ];
        } else {
            try {
                DB::beginTransaction();
                $user = User::find($request->id);
                $user->status = $request->status == '1' ? '0' : '1';
                $user->save();
                $response = [
                    'code' => 200,
                    'message' => 'Data berhasil disimpan',
                    'data' => $user
                ];
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $response = [
                    'code' => 400,
                    'message' => $e->getMessage(),
                ];
            }
        }
        return response()->json($response, 200);
    }

    public function logout_user(Request $request)
    {
        session()->flush();
        return redirect()->route('login');
    }
}
