<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  
  public function index()
  {

    return view("users.index");
  }

  public function admins()
  {
    $users = User::with('roles')->get();
    
    return view('admins.index', ['users' => $users]);

  }


  public function edit($id)
  {
    return view('users.edit')->with('id', $id);
  }

  public function view($id)
  {
    return view('users.view')->with('id', $id);
  }

  public function profile()
  {
    $user = Auth::user();
    return view('users.profile', compact(['user']));
  }

  public function update(Request $request, $id)
  {
    $name = $request->input('name');
    $password = $request->input('password');
    $old_password = $request->input('old_password');
    $email = $request->input('email');

    if ($password == '') {
      $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'email' => 'required|email'
      ]);
    } else {
      $user = Auth::user();
      if (password_verify($old_password, $user->password)) {
        $validator = Validator::make($request->all(), [
          'name' => 'required|max:255',
          'password' => 'required|min:8',
          'confirm_password' => 'required|same:password',
          'email' => 'required|email'
        ]);

      } else {
        return Redirect()->back()->with(['message' => "Please enter correct old password"]);
      }

    }

    if ($validator->fails()) {
      $error = $validator->errors()->first();
      return Redirect()->back()->with(['message' => $error]);
    }

    $user = User::find($id);
    if ($user) {
      $user->name = $name;
      $user->email = $email;
      if ($password != '') {
        $user->password = Hash::make($password);
      }
      $user->save();
    }

    return redirect()->back();
  }

  public function create()
  {
    return view('users.create');
  }

  public function createAdmin()
  {
     $roles = Role::pluck('name','name')->all();
      return view('admins.create',compact('roles'));
  }

  // public function createAdmin(Request $request)
  // {
  //    if ($request->ajax()) {
  //       $haspermision = auth()->user()->can('user-create');
  //       // if ($haspermision) {
  //          $roles = Role::all();
  //          $view = View::make('admins.create', compact('roles'))->render();
  //          return response()->json(['html' => $view]);
  //       // } else {
  //         //  abort(403, 'Sorry, you are not authorized to access the page');
  //       // }
  //    } else {
  //       return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
  //    }
  // }

  public function storeAdmin(Request $request)
  {
    
    $input = $request->all();
    
    $input['password'] = Hash::make($input['password']);
    $user = User::create($input);
    $user->assignRole($request->input('roles'));

  return redirect('/admins');

  }

  public function showAdmin($id)
  {
      $admins = User::findOrFail($id);

      return view('admins.show', compact('admins'));
  }

  public function editAdmin($id)
  {
      $admins = User::with('roles')->findOrFail($id);
      $roles = Role::all();
      return view('admins.edit', compact('admins','roles'));
  }

  public function assignRoles()
  {
    $user = User::find(1);
    $role = Role::findByName('Admin');

    if (!$role) {
        return back()->withErrors(['role' => 'Role does not exist.']);
    }

    $user->assignRole($role);
    $user->save();

    //return back()->with('success', 'Role assigned successfully.');

    // $user = User::find(1);
    // $user->assignRole('admin');
    return redirect('/admins');
  }

  public function updateAdmin(Request $request, $id)
  {
      $request->validate([
          'name' => 'required|max:255',
          'email' => 'required|email',
      ]);
      $user =  User::findOrFail($id);
      
      User::whereId($id)->update([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),]);
        $roles = $request->input('roles');
        if (isset($roles)) {
           $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
           $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

      return redirect('/admins');
  }

  public function destroyAdmin($id)
  {
      User::findOrFail($id)->delete();
      
      return redirect('/admins');
  }

  public function createRole()
  {
    
    $role = Role::create(['guard_name' => 'users', 'name' => 'usersAdmin']);
   $permissions = explode(",", "1");
   $role->syncPermissions($permissions);
   return redirect('/admins');

   

  }



}