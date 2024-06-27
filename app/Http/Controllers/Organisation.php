<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganisationModel;

class Organisation extends Controller
{
    public function showOrganisation()
    {
        return view('admin.add_organisation');
    }
    public function add(Request $request){
        // Veritabanına veri ekleme
        $organisation = new OrganisationModel;
        $organisation->organisation_name = $request->organisation_name;
        $organisation->save();

        return redirect()->back()->with('success', 'Data has been saved successfully!');
    }
}
