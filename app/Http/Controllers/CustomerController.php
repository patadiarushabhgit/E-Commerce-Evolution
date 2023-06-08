<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Customer::query();

        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }

        $customers = $query->latest()->paginate(5);
        Paginator::useBootstrap();

        return view('customer.index', compact('customers', 'search'))
            ->with('i', ($customers->currentPage() - 1) * 5);
    }


    public function create()
    {
        return view('customer.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'postalCode' => 'required',

        ]);

        $input = $request->all();



        Customer::create($input);

        return redirect()->route('customer.index')
            ->with('success', 'customer created successfully.');
    }


    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }


    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }


    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customer.index')
            ->with('success', 'customer deleted successfully');
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'postalCode' => 'required',

        ]);


        // Update the user's other fields
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->city = $request->city;
        $customer->state = $request->state;
        $customer->country = $request->country;
        $customer->postalCode = $request->postalCode;


        // Check if a new image file is uploaded


        $customer->save();

        return redirect()->route('customer.index')
            ->with('success', 'customer updated successfully.');
    }
}
