<?php

namespace App\Http\Controllers\admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    public function index()
    {
        $currency = Currency::latest()->get();
        return view('admin.currency.index', compact('currency'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rate' => 'required'
        ]);

        try {
            $currency = new Currency();
            $currency->name = $request->name;
            $currency->rate = $request->rate;
            $currency->compare_name = $request->compare_name;
            $currency->compare_rate = $request->compare_rate;
            $currency->save();

            Toastr::success('Currency Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'rate' => 'required',
        ]);

        try {
            $currency = Currency::find($id);
            $currency->name = $request->name;
            $currency->rate = $request->rate;
            $currency->compare_name = $request->compare_name;
            $currency->compare_rate = $request->compare_rate;
            $currency->status = $request->status;
            $currency->save();

            Toastr::success('Currency Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $currency = Currency::find($id);
            $currency->delete();

            Toastr::success('Currency Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
