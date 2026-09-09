<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display all books
    public function index()
    {
        $data = DB::table('books')->get();
        return view('pages.page2', compact('data'));
    }

    // Show Add Form
    public function show_add_form()
    {
        return view('pages.add-book-form');
    }

    // Add book
    public function do_add(Request $request)
    {
        $filename = null;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $file->move('_uploads', $filename);
        }

        DB::table('books')->insert([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'country_id' => $request->input('country_id'),
            'stock' => $request->input('stock'),
            'amount' => $request->input('amount'),
            'photo' => $filename
        ]);

        return redirect(url('/page2'))->with('success', 'Book added successfully!');
    }

    // Delete book
    public function do_delete($id)
    {
        DB::table('books')->where('id', $id)->delete();
        return redirect(url('/page2'))->with('success', 'Book deleted!');
    }

    // Show Edit Form
    public function show_edit_form($id)
    {
        $data = DB::table('books')->where('id', $id)->first();
        return view('pages.edit-book-form', compact('data'));
    }

    // Update book
    public function do_update(Request $request)
    {
        $filename = $request->input('old_photo');
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $file->move('_uploads', $filename);
        }

        DB::table('books')->where('id', $request->input('id'))->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'country_id' => $request->input('country_id'),
            'stock' => $request->input('stock'),
            'amount' => $request->input('amount'),
            'photo' => $filename
        ]);

        return redirect(url('/page2'))->with('success', 'Book updated successfully!');
    }
}
