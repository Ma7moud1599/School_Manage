<?php

namespace App\Http\Controllers\Parents\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Attendance;
use App\Models\Fee_invoice;
use App\Models\ReceiptStudent;
use App\Models\My_Parent;
use Illuminate\Support\Facades\Hash;


class ChildrenController extends Controller
{
    public function index()
    {

        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('page.Parents.children.index', compact('students'));
    }

    public function results($id)
    {

        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            flash()->addError(trans('message.code'));
            return redirect()->route('sons.index');
        }
        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            flash()->addError(trans('message.results'));
            return redirect()->route('sons.index');
        }

        return view('page.Parents.degrees.index', compact('degrees'));
    }

    public function attendances()
    {
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('page.Parents.Attendance.index', compact('students'));
    }

    public function attendanceSearch(Request $request)
    {
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => trans('message.date_error'),
            'from.date_format' =>  trans('message.date_error_1'),
            'to.date_format' =>  trans('message.date_error_1'),
        ]);

        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();

        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('pages.parents.Attendance.index', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.parents.Attendance.index', compact('Students', 'students'));
        }
    }

    public function fees()
    {
        $students_ids = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $Fee_invoices = Fee_invoice::whereIn('student_id', $students_ids)->get();
        return view('page.Parents.fees.index', compact('Fee_invoices'));
    }

    public function receiptStudent($id)
    {

        $student = Student::findorFail($id);
        if ($student->parent_id !== auth()->user()->id) {
            flash()->addError(trans('message.Payments_error'));
            return redirect()->route('sons.fees');
        }

        $receipt_students = ReceiptStudent::where('student_id', $id)->get();

        if ($receipt_students->isEmpty()) {
            flash()->addError(trans('message.Payments'));
            return redirect()->route('sons.fees');
        }
        return view('page.Parents.Receipt.index', compact('receipt_students'));
    }

    public function profile()
    {
        $information = My_Parent::findorFail(auth()->user()->id);
        return view('page.Parents.profile', compact('information'));
    }

    public function update(Request $request, $id)
    {

        $information = My_Parent::findorFail($id);

        if (!empty($request->password)) {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        flash()->addSuccess(trans('message.Update'));
        return redirect()->back();
    }
}
