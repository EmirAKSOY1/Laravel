<?php

namespace App\Http\Controllers;
use App\Models\NoticeModel;
use Illuminate\Http\Request;
use App\Models\OrganisationModel;
use App\Models\Level;
use App\Models\OrganisationLevel;

class Organisation extends Controller
{
    public function index(Request $request)
    {
       // $organisations = OrganisationModel::with('levels')->get();
        $query = OrganisationModel::with('levels');

        if ($request->has('search')) {
            $query->where('organisation_name', 'like', '%' . $request->search . '%');
        }

        $organisations = $query->get();
        return view('admin.organisation',compact('organisations'));
    }
    public function create(){
        $levels = Level::all();
        return view('admin.add_organisation', compact('levels'));
    }
    public function add(Request $request){
        // Veritabanına veri ekleme
        $organisation = new OrganisationModel;
        $organisation->organisation_name = $request->organisation_name;
        $organisation->save();

        return redirect()->back()->with('success', 'Data has been saved successfully!');
    }
    public function destroy($id)
    {
        $organisation = OrganisationModel::findOrFail($id);
        $organisation->levels()->detach();
        $organisation->delete();

        return redirect()->route('organisation.index')
            ->with('delete', 'Kurum başarıyla silindi.');
    }
    public function store(Request $request)
    {
        // Yeni okulu organisation tablosuna ekleyelim
        $organisation = new OrganisationModel();
        $organisation->organisation_name = $request->input('organisation_name');
        $organisation->save();

        $organisation->levels()->attach($request->input('level_id'));

        return redirect()->back()->with('success', 'Okul başarıyla eklendi.');
    }
    public function edit($id)
    {
        $organisation = OrganisationModel::findOrFail($id);
        $levelModel = Level::all();

        $currentLevel = $organisation->levels; // veya $organisation->level->name
        foreach ($currentLevel as $level) {
            $levelll=$level->id;

        }

        return view('admin.edit_organisation', compact('organisation','levelModel','levelll'));
    }
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'organisation_name' => 'required|string|max:255',
            'level_id' => 'required|exists:levels,id',
        ]);

        // Update school in organisation table
        $organisation = OrganisationModel::findOrFail($id);
        $organisation->organisation_name = $request->organisation_name;
        $organisation->save();

        // Update link in organisation_level table
        $organisationLevel = OrganisationLevel::where('organisation_id', $organisation->id)->first();
        $organisationLevel->level_id = $request->level_id;
        $organisationLevel->save();

        return redirect()->back()->with('success', 'Data has been saved successfully!');
    }

}
