<?php

namespace App\Repository;

use App\Models\Fee;
use App\Models\Grade;

class FeesRepository implements FeesRepositoryInterface
{
    public function index()
    {
        $fees = Fee::all();
        $grades = Grade::all();
        return view('page.Fees.index', compact('fees', 'grades'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('page.Fees.add', compact('grades'));
    }

    public function edit($id)
    {
        $fee = Fee::findorfail($id);
        $grades = Grade::all();
        return view('page.Fees.edit', compact('fee', 'grades'));
    }


    public function store($request)
    {
        try {
            $fees = new Fee();
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount  = $request->amount;
            $fees->grade_id  = $request->grade_id;
            $fees->classroom_id  = $request->classroom_id;
            $fees->description  = $request->description;
            $fees->year  = $request->year;
            $fees->Fee_type  = $request->Fee_type;
            $fees->save();
            flash()->addSuccess(trans('message.success'));
            return redirect()->route('Fees.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {
            $fees = Fee::findorfail($request->id);
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount  = $request->amount;
            $fees->grade_id  = $request->grade_id;
            $fees->classroom_id  = $request->classroom_id;
            $fees->description  = $request->description;
            $fees->year  = $request->year;
            $fees->Fee_type  = $request->Fee_type;
            $fees->save();
            flash()->addSuccess(trans('message.Update'));
            return redirect()->route('Fees.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Fee::destroy($request->id);
            flash()->addError(trans('message.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
