<?php

namespace App\Http\Controllers\admin;

use App\Models\Bank;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
class BankController extends Controller
{
    public function index()
    {
        $bank = Bank::latest()->get();
        return view('admin.bank.index',compact('bank'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'branch' => 'required',
            ]);
            $bank = new Bank();
            $bank->name = $request->name;
            $bank->branch = $request->branch;
            $bank->save();
            Toastr::success('Bank Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            // Handle the exception here
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'branch' => 'required',
            ]);
            $bank = Bank::find($id);
            $bank->name = $request->name;
            $bank->branch = $request->branch;
            $bank->status = $request->status;
            $bank->save();
            Toastr::success('Bank Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $bank = Bank::find($id);
            $bank->delete();
            Toastr::success('Bank Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
