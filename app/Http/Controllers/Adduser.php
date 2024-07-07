<?php

namespace App\Http\Controllers;

use App\Models\CandidateModel;
use App\Models\NoticeModel;
use App\Models\OrganisationLevel;
use App\Models\UserRol;
use App\Models\User;
use Illuminate\Http\Request;

class Adduser extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->with('roleUser.organisationLevel.organisation');
        //dd($users);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('surname')) {
            $query->where('surname', 'like', '%' . $request->input('surname') . '%');
        }
        if ($request->filled('tc')) {
            $query->where('tc', 'like', '%' . $request->input('tc') . '%');
        }
        if($request->filled('rol_id')!=0){
            if ($request->filled('rol_id')) {
                $query->whereHas('roles', function ($q) use ($request) {
                    $q->where('role_id', 'like', '%' . $request->input('rol_id') . '%');
                });
            }
        }
        $users = $query->paginate(10); // Sayfalama ekleyebilirsiniz

        // Aday bulunamadı durumu kontrolü
        if ($users->isEmpty()) {
            return view('admin.user')->with('message', 'Kullanıcı bulunamadı.');
        }
        return view('admin.user',compact('users'));
    }
    public function destroy($id)
    {
        // Adayı ve ilişkili kullanıcıyı bulun
        $user = User::findOrFail($id);
        if ($user) {
            $user->roles()->detach(); // user_role tablosundaki kayıtları siler
            $user->delete();
        }
        return redirect()->route('add_user.index')
            ->with('delete', 'Aday başarıyla silindi.');
    }
    public function create(){
        $organisationLevels = OrganisationLevel::with('organisation', 'level')->get();
        return view('admin.add_user',compact('organisationLevels'));
    }
    public function store(Request $request){
        // Veritabanına veri ekleme
        $user = new User();
        $user->name = $request->input('user_name');
        $user->surname = $request->input('user_surname');
        $user->username = $request->input('username');
        $user->email = $request->input('user_mail');
        $user->tc = $request->input('user_tc');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $user_id = $user->id;

        $user_role = new UserRol();
        $user_role->user_id = $user_id;
        $user_role->role_id =$request->input('flexRadioDefault');
        $user_role->organasation_level_id =$request->input('organisation_level_id');

        $user_role->save();
        return redirect()->back()->with('success', 'Data has been saved successfully!');
    }
    public function edit($id){
        $users=User::findOrFail($id);
        $organisationLevels = OrganisationLevel::with('organisation', 'level')->get();
        return view('admin.edit_user', compact('users','organisationLevels'));
    }
    public function update(Request $request , $id){

        $user=User::findOrFail($id);
        $user_rol=UserRol::where('user_id', $id)->first();

        $validatedData = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'username' => 'required|string',
            'tc' => 'required|string',
            'email' => 'required|email',
            'active' => 'required|in:0,1',

        ]);

        $user->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'username' => $request->input('username'),
            'tc' => $request->input('tc'),
            'email' => $request->input('email'),
            'is_active' => $request->input('active'),
        ]);
        $user_rol->update([
            'role_id' =>$request->input('role'),
            'organasation_level_id' =>$request->input('organisation_level_id'),
        ]);

        return redirect()->route('add_user.index')->with('success_update', 'Aday başarıyla Güncellendi.');
    }
}
