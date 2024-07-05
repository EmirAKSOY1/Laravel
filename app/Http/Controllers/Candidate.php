<?php

namespace App\Http\Controllers;

use App\Models\CandidateModel;
use App\Models\Level;
use App\Models\User;
use App\Models\UserRol;
use App\Models\OrganisationLevel;
use App\Models\OrganisationModel;
use Illuminate\Http\Request;

class Candidate extends Controller
{
    public function index(Request $request)
    {
        /*
        $candidates = CandidateModel::with('user')->get(); // Adayları kullanıcı bilgileriyle birlikte çek
        return view('admin.candidate', compact('candidates'));*/
        $query = CandidateModel::query()->with('user'); // Adayları kullanıcı bilgileriyle birlikte çekmek için

        // Filtreleme işlemleri
        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('name') . '%');
            });
        }

        if ($request->filled('surname')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('surname', 'like', '%' . $request->input('surname') . '%');
            });
        }

        if ($request->filled('tc')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('tc', 'like', '%' . $request->input('tc') . '%');
            });
        }
        if ($request->filled('candidate_id')) {
            $query->where('id', 'like', '%' . $request->input('candidate_id') . '%');
        }

        $candidates = $query->paginate(10); // Sayfalama ekleyebilirsiniz
        // Aday bulunamadı durumu kontrolü
        if ($candidates->isEmpty()) {
            return view('admin.candidate')->with('message', 'Aday bulunamadı.');
        }
        return view('admin.candidate', compact('candidates'));
    }
    public function destroy($id)
    {
        // Adayı ve ilişkili kullanıcıyı bulun
        $candidate = CandidateModel::findOrFail($id);
        $user = $candidate->user;

        // Adayı ve kullanıcıyı silin
        $candidate->delete();
        if ($user) {
            $user->roles()->detach(); // user_role tablosundaki kayıtları siler
            $user->delete();
        }

        return redirect()->route('candidate.index')
            ->with('delete', 'Aday başarıyla silindi.');
    }
    public function edit($id)
    {
        $candidates = CandidateModel::with('organisationLevel.organisation')->find($id);
        $organisationLevels = OrganisationLevel::with('organisation', 'level')->get();
        return view('admin.edit_candidate', compact('candidates','organisationLevels'));
    }
    public function update(Request $request, $id)
    {
        $candidate = CandidateModel::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'tc' => 'required|string',
            'email' => 'required|email',
            'birthdate' => 'required|date',
            'organisation_level_id' => 'required|exists:level_organisation,id',
            'gender' => 'required|in:0,1',
            'active' => 'required|in:0,1',
            // Diğer gerekli validasyon kuralları
        ]);

        $candidate->user->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'tc' => $request->input('tc'),
            'email' => $request->input('email'),
        ]);

        $candidate->update([
            'birthdate' => $request->input('birthdate'),
            'organisation_level_id' => $request->input('organisation_level_id'),
            'gender' => $request->input('gender'),
            // Diğer form alanları
        ]);

        $candidate->user->update([
                'is_active' => $request->input('active'),
        ]);


        return redirect()->route('candidate.index')->with('update', 'Aday başarıyla Güncellendi.');
    }
    public function create(){
        $organisationLevels = OrganisationLevel::with('organisation', 'level')->get();
        return view('admin.add_candidate',compact('organisationLevels'));
    }
    public function store(Request $request){
        $request->validate([
            'candidate_name' => 'required|string|max:255',
            'candidate_surname' => 'required|string|max:255',
            'candidate_username' => 'required|string|max:255|unique:users,username', // Kullanıcı adı benzersiz olmalı
            'candidate_tc' => 'required|string|max:11|unique:users,tc', // TC numarası benzersiz olmalı
            'candidate_email' => 'required|email|max:255|unique:users,email', // Email benzersiz olmalı
            'password' => 'required|string|min:8',
            'candidate_birthdate' => 'required|date',
            'organisation_level_id' => 'required|exists:level_organisation,id',
            'gender' => 'required|in:0,1',
            'active' => 'required|in:0,1'
        ]);
        // Yeni kullanıcıyı oluştur ve veritabanına kaydet
        $user = new User();
        $user->name = $request->candidate_name;
        $user->surname = $request->candidate_surname;
        $user->username = $request->candidate_username;
        $user->tc = $request->candidate_tc;
        $user->email = $request->candidate_email;
        $user->password = bcrypt($request->password);
        $user->is_active = $request->active;
        $user->save();

        // Yeni adayı oluştur ve veritabanına kaydet
        $candidate = new CandidateModel();
        $candidate->user_id = $user->id;
        $candidate->birthdate = $request->candidate_birthdate;
        $candidate->organisation_level_id = $request->organisation_level_id;
        $candidate->gender = $request->gender;
        $candidate->save();

        $role = new UserRol();
        $role->user_id = $user->id;
        $role->role_id = 3;
        $role->save();



        return redirect()->route('candidate.index')->with('add', 'Aday Başarıyla Eklendi.');
    }
}
