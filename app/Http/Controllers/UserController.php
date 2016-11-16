<?php

namespace App\Http\Controllers;

use Hash;
use Validator;
use Redirect;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $users = User::all();
      return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
      $v = Validator::make($request->all(), [
        'name' => 'required',
        'password' => 'required',
        'email' => 'required',
        'rights' => 'required',
      ]);

      if ($v->fails())
      {
          return redirect()->back()->withErrors($v->errors());
      }
      if (User::where('email', $request->get('email'))->exists()) {
        return redirect('admin/users')
            ->withErrors(['same' => 'User already exsists.']);
      }

      User::create(array(
        'name' => $request->get('name'),
        'email' => $request->get('email'),
        'password' => Hash::make($request->get('name')),
        'rights' => $request->get('rights'),
      ));

      return Redirect::to('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

      if ($request->ajax())
        {
          $user = User::findOrFail($id);
          $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
          ]);

          $user->name = $request->get('name');
          $user->email = $request->get('email');
          $user->rights = $request->get('role');
          $user->save();

          return $request->json(200, ["text" => "Uporabnik je bil posodbljen"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
      if ($request->ajax()){
        $user = User::findOrFail($id);
        $user->delete();
        return $request->json(200, ["text" => "Uporabnik je bil izbrisan"]);
      }
    }

    public function filterUsers(Request $request)
    {
      if ($request->ajax())
      {
          return User::search($request->input('param'), null, true)->get();
      }
    }
}
