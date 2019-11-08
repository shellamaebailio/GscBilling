<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BillingSignatories;

class BillingSignatoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BillingSignatories::latest()->paginate(5);
    }

    public function view()
    {
        return view('settings.billing');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'fname' => 'required',
            'lname' => 'required',
            'position' => 'required',
        ]);
        
        return BillingSignatories::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $data = request()->validate([
            'fname' => 'required',
            'lname' => 'required',
            'position' => 'required',
        ]);

        $q = BillingSignatories::findorFail($id);
        $q->update($request->all());
        return $q;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $signatory = BillingSignatories::findOrFail($id);
        $signatory->delete();
    }

    public function search()
    {
        if($search = \Request::get('q')){
            $signatories = BillingSignatories::where(function($query) use ($search){
                $query->where('fname','LIKE',"%$search%")
                        ->orwhere('mname','LIKE',"%$search%")
                        ->orwhere('ename','LIKE',"%$search%")
                        ->orwhere('lname','LIKE',"%$search%")
                        ->orwhere('position','LIKE',"%$search%");
            })->paginate(5);
        }else{
            $signatories = BillingSignatories::latest()->paginate(5);
        }

        return $signatories;
    }
}
