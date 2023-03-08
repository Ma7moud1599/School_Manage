<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;

class LibraryRepository implements LibraryRepositoryInterface
{
    use AttachFilesTrait;

    public function index()
    {
        $books = Library::all();
        return view('page.library.index', compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('page.library.create', compact('grades'));
    }

    public function store($request)
    {
        try {
            $books = new Library();
            $books->title = $request->title;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->grade_id = $request->grade_id;
            $books->classroom_id = $request->classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();
            $this->uploadFile($request, 'file_name', 'Library');

            flash()->addSuccess(trans('message.success'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::findorFail($id);
        return view('page.library.edit', compact('book', 'grades'));
    }

    public function update($request)
    {
        try {
            $book = library::findorFail($request->id);
            $book->title = $request->title;

            if ($request->hasfile('file_name')) {
                $this->deleteFile($book->file_name);

                $this->uploadFile($request, 'file_name', 'Library');

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            $book->grade_id = $request->grade_id;
            $book->classroom_id = $request->classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();
            flash()->addSuccess(trans('message.Update'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $this->deleteFile($request->file_name);
        library::destroy($request->id);
        flash()->addError(trans('message.Delete'));
        return redirect()->route('library.index');
    }

    public function download($filename)
    {
        return response()->download(public_path('attachments/library/' . $filename));
    }
}
