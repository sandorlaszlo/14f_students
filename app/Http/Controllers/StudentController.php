<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$students = Student::all();
        $students = Student::with("group")->get();

        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    public function store(CreateStudentRequest $request)
    {
        //Validálás v1
        // $request->validate([
            //     "name"=> "required|min:5",
            //     "email"=> "required|email|unique:students,email",
            // ]);

        //Validálás v2
        // $validator = Validator::make($request->all(),
        //     [
        //         "name"=> "required|min:5",
        //         "email"=> "required|email|unique:students,email",
        //     ],
        //     [
        //         "required"=> "A(z) :attribute mező kitöltése kötelező.",
        //         "email.unique"=> "Az email cím már foglalt.",
        //     ]);

        // if ($validator->fails()) {
        //     // return response()->json(['message' => 'Hiányos adatok.'], 422);
        //     return response()->json($validator->errors(), 422);
        // }

        $student = Student::create($request->all());
        // $student = Student::create([
        //     "name"=> strtoupper($request->name),
        //     "email"=> $request->email,
        //     "rank"=> $request->rank
        // ]);
        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $student = Student::findOrFail($id);
        $student = Student::find($id);
        if ($student == null)
            return response()->json(["message" => "No student found."], 404);
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);
        if ($student == null)
            return response()->json(["message"=> "No student found."], 404);

        $student->update($request->all());
        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        if ($student == null)
            return response()->json(["message"=> "No student found."], 404);

        $student->delete();
        return response('', 204);
    }

    public function rankOverLimit($limit)
    {
        $students = Student::where('rank', '>', $limit)->get();
        if ($students->count() == 0)
            return response()->json(['message'=> 'No matching student found.'], 404);
        return response()->json($students);
    }
}
