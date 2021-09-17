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

    public function update(Request $request, sections $sections)
    {
        //
    }

    public function destroy(sections $sections)
    {
        //
    }
}
