<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployerCollection;
use App\Models\Employer;

class EmployerController extends Controller
{
    protected $modelFields = [
        "name",
        "address",
        "card_code"
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginated = Employer::select()->paginate($request->per_page);
        return response()->json(new EmployerCollection($paginated));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employers.create');
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
            'name' => 'required',
            'address' => 'required',
            'card_code' => 'required'
        ]);

        $createdEmployer = new Employer;
        $createdEmployer->name = $request->input('name');
        $createdEmployer->address=$request->input('address');
        $createdEmployer->card_code = $request->input('card_code');
        $createdEmployer->save();
        return redirect('/employers/' . $createdEmployer->id)->with('success', 'Employer Created Successfully!!!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }
}
