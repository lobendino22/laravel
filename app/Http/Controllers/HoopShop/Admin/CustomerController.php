<?php

namespace App\Http\Controllers\HoopShop\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // List all client accounts
    public function index()
    {
        $customers = User::where('role', 'client')->orderByDesc('created_at')->get();
        return view('hoop.admin.customers.index', compact('customers'));
    }

    // Show add form
    public function create()
    {
        return view('hoop.admin.customers.form');
    }

    // Store new customer
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'client',
        ]);

        return redirect()->route('hoop.admin.customers')->with('success', 'Customer added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $customer = User::where('role', 'client')->findOrFail($id);
        return view('hoop.admin.customers.form', compact('customer'));
    }

    // Update customer
    public function update(Request $request, $id)
    {
        $customer = User::where('role', 'client')->findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $customer->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $customer->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'] ?: $customer->password,
        ]);

        return redirect()->route('hoop.admin.customers')->with('success', 'Customer updated successfully!');
    }

    // Delete customer
    public function destroy($id)
    {
        $customer = User::where('role', 'client')->findOrFail($id);
        $customer->delete();

        return redirect()->route('hoop.admin.customers')->with('success', 'Customer deleted successfully!');
    }
}
