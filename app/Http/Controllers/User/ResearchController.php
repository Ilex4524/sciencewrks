<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\DepartmentEmployee;
use App\Research;
use App\ResearchAuthor;

use Auth;
use Session;
use Storage;

class ResearchController extends Controller
{

    public function __construct() {       
        $this->middleware('auth');
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$researches = Research::whereIn('id', ResearchAuthor::select('id')::whereIn('author', DepartmentEmployee::select('id'))::where('department', '=', Auth::user()->departmentEmployee->department));
        $researches = DB::select('select id, name, published_at, size from researches order by created_at desc');
        return view('crud.researches.index')->withResearches($researches);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get all possible authors.
        $rawAuthors = DB::select('select de.id, e.firstname, e.lastname from department_employees de join employees e on de.employee = e.id where de.department = :dept', ['dept' => Auth::user()->departmentEmployee->department]);
        $authors = array();
        foreach($rawAuthors as $author) {           
            $authors[$author->id] = $author->firstname.' '.$author->lastname;
        }    
        return view('crud.researches.create')->withAuthors($authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [            
            'name' => 'unique_with:researches, published_at',
            'authors' => 'required'            
        ]);
        
        // Store the research.
        $research = new Research;
        $research->name = $request->name;
        $research->published_at = date('Y-m-d' , strtotime($request->published_at));
        $research->size = $request->size;
        $research->is_scopus = $request->is_scopus ?? false;
        $research->is_vak = $request->is_vak ?? false;
        $research->is_abroad = $request->is_abroad ?? false;
        $file = $request->file('file')->store('researches');
        $research->file = $file;
        $research->save();

        // Store the new research authors.
        foreach($request->authors as $author) {
            $rAuthor = new ResearchAuthor;
            $rAuthor->author = $author;
            $rAuthor->research = $research->id;
            $rAuthor->bulk = 0;
            $rAuthor->save();
        }  
        
        Session::flash('success', 'The research was successfully saved!');

        // Redirect to another page.
        return redirect()->route('researches.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $research = Research::find($id);
        $authors = DB::select('select e.firstname firstname, e.lastname lastname, d.name department FROM 
        research_authors ra join department_employees de on ra.author = de.id join employees e on de.employee = e.id
        join departments d on de.department = d.id where ra.research = :research', ['research' => $id]);
        return view('crud.researches.show')->withAuthors($authors)->withResearch($research);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download($id) 
    {
        $path = Research::find($id)->file;
        return Storage::download($path);
    }
}
