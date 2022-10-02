<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $Classrooms = Classroom::all();
        $Grades = Grade::all();

        return view('page.Classrooms.Classrooms', compact('Classrooms', 'Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ClassroomRequest $request)
    {
        $List_Classes = $request->List_Classes;
        try {
            foreach ($List_Classes as $List_Classe) {
                $classes = new Classroom();

                $classes->Name_class = ['en' => $List_Classe['Name_class_en'], 'ar' => $List_Classe['Name']];

                $classes->Grade_id = $List_Classe['Grade_id'];

                $classes->save();
            }
            flash()->addSuccess(trans('message.success'));

            return redirect()->route('Classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        try {
            $Classrooms = Classroom::findOrFail($request->id);

            $Classrooms->update([

                $Classrooms->Name_class = ['ar' => $request->Name, 'en' => $request->Name_en],
                $Classrooms->Grade_id = $request->Grade_id,
            ]);
            flash()->addSuccess(trans('message.Update'));

            return redirect()->route('Classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $classes = Classroom::findOrFail($request->id)->delete();
        flash()->addError(trans('message.Delete'));

        return redirect()->route('Classes.index');
    }

    public function delete_all(Request $request)
    {
        $delete_all_id = explode(',', $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->Delete();
        // flash()->addError();

        flash()->addError(trans('message.Delete'));

        return redirect()->route('Classes.index');
    }

    public function Filter_Classes(Request $request)
    {
        $Grades = Grade::all();
        $details = Classroom::select('*')->where('Grade_id', '=', $request->Grade_id)->get();

        return view('page.Classrooms.Classrooms', compact('Grades', $details));
    }
}
