<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Child;

class FormController extends Controller
{
    public function index()
    {
        $children = Child::all(); // Fetch all children from the database
        $countries = ['Country 1', 'Country 2', 'Country 3']; // Replace with your country list

        return view('form', compact('children', 'countries'));
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name.*' => 'required|string',
            'middle_name.*' => 'required|string',
            'last_name.*' => 'required|string',
            'age.*' => 'required|numeric',
            'address.*' => 'required|string',
            'city.*' => 'required|string',
            'state.*' => 'required|string',
            'zip_code.*' => 'required|numeric',
        ], [
            'first_name.*.required' => 'First Name is required.',
            'middle_name.*.required' => 'Middle Name is required.',
            'last_name.*.required' => 'Last Name is required.',
            'age.*.required' => 'Age is required.',
            'age.*.numeric' => 'Age must be a number.',
            'address.*.required' => 'Child Address is required.',
            'city.*.required' => 'Child City is required.',
            'state.*.required' => 'Child State is required.',
            'zip_code.*.required' => 'Child Zip Code is required.',
            'zip_code.*.numeric' => 'Child Zip Code must be a number.',
        ]);

        if ($validator->fails()) {
            return redirect('/form')
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        foreach ($validatedData['first_name'] as $index => $firstName) {
            Child::updateOrCreate(
                ['id' => $request->input('child_id.' . $index)],
                [
                    'first_name' => $firstName,
                    'middle_name' => $validatedData['middle_name'][$index],
                    'last_name' => $validatedData['last_name'][$index],
                    'age' => $validatedData['age'][$index],
                    'gender' => $request->input('gender.' . $index),
                    'different_address' => $request->input('different_address.' . $index, false),
                    'address' => $request->input('address.' . $index),
                    'city' => $request->input('city.' . $index),
                    'state' => $request->input('state.' . $index),
                    'country' => $request->input('country.' . $index),
                    'zip_code' => $request->input('zip_code.' . $index),
                ]
            );
        }

        return redirect('/form')->with('success', 'Data saved successfully!');
    }
}
