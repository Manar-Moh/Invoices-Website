<?php

namespace App\Http\Controllers;

use App\sections;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SectionsController extends Controller
{

    public function index()
    {
        $data = sections::all();
        return view('sections.sections',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'section_name' => ['required', 'unique:sections', 'max:255']
        ]);
        sections::create([
            'section_name' => $request->section_name,
            'description' => $request->section_desc,
            'created_by' => Auth::User()->name
        ]);
        session()->flash('success','Section Was Added Successfully');
        return redirect('/sections');
    }

    public function show(sections $sections)
    {
        //
    }

    public function edit(sections $sections)
    {
        //
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $validatedData = $request->validate([
            'section_name' => ['required', 'unique:sections,section_name,'.$id, 'max:255']
        ]);
        $sections_arr = sections::find($id);
        $sections_arr->update([
            'section_name' => $request->section_name,
            'description' => $request->section_desc
        ]);
        session()->flash('success_edit','Section Was Updated Successfully');
        return redirect('/sections');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        sections::find($id)->delete();
        session()->flash('success_delete','Section Was Deleted Successfully');
        return redirect('/sections');

    }
}
