<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Country;
use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/company/index')->with('companies', Company::orderBy('name')->paginate(50));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/company/create')
            ->with('products', Product::all())
            ->with('countries', Country::orderBy('name')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = new Company;
        $company->fill($request->validated());
        $company->generator_type = "admin";
        $company->generator_id = Auth::guard('admin')->id();
        $company->save();

        $product = $company->product;
        if ($product) {
            $company->u_l_number = $product->prefix . "-" . date("Y") . "-" . $company->id;
        }

        $company->save();

        return redirect()
            ->route('admin.company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('admin/company/show')->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin/company/edit')
            ->with('company', $company)
            ->with('products', Product::all())
            ->with('countries', Country::orderBy('name')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->fill($request->validated());
        $company->generator_type = "admin";
        $company->generator_id = Auth::guard('admin')->id();
        $company->save();

        return redirect()
            ->route('admin.company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        return redirect()->route('admin.company.index');
    }
}
