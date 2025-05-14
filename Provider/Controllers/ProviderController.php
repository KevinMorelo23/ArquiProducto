<?php

namespace Provider\Controllers;

use App\Http\Controllers\Controller;
use Provider\Model\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::all();
        $providers = Provider::withCount('products')->get();
        return view('Provider::index', compact('providers'));
    }

    public function create()
    {
        return view('Provider::create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:providers,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        Provider::create($validated);

        return redirect()->route('providers.index')
            ->with('success', 'Proveedor creado correctamente.');
    }

    public function show(Provider $provider)
    {
        return view('Provider::show', compact('provider'));
    }

    public function edit(Provider $provider)
    {
        return view('Provider::edit', compact('provider'));
    }

    public function update(Request $request, Provider $provider)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:providers,email,'.$provider->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        $provider->update($validated);

        return redirect()->route('providers.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();

        return redirect()->route('providers.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }
}