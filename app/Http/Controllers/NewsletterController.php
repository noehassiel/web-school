<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use Session;


use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{

    public function index()
    {
        $newsletter = Newsletter::paginate(30);


        return view('back.newsletter.index')
        ->with('newsletter', $newsletter);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $newsletter = new Newsletter;
        $newsletter->name = $request->name;
        $newsletter->email = $request->email;
        $newsletter->save();


    }

    public function show(Newsletter $newsletter)
    {
        //
    }

    public function edit(Newsletter $newsletter)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $newsletter = Newsletter::find($id);
        $newsletter->name = $request->name;
        $newsletter->email = $request->email;
        $newsletter->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::find($id);

        $newsletter->delete();

        return redirect()->back();
    }
}
