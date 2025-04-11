<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'payment_method' => 'required|in:cash,transfer,credit_card,debit_card',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $sale = Sale::create([
                'total' => 0,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'user_id' => auth()->id(),
                'shipping_name' => $request->shipping_name,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_phone' => $request->shipping_phone,
            ]);

            $total = 0;
            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['id']);

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stock insuficiente para el producto: {$product->name}");
                }

                $product->stock -= $item['quantity'];
                $product->save();

                $sale->products()->attach($product->id, [
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);

                $total += $product->price * $item['quantity'];
            }

            $sale->update(['total' => $total]);

            Payment::create([
                'sale_id' => $sale->id,
                'payment_method' => $request->payment_method,
                'amount' => $total,
                'status' => 'completed',
                'amount_tendered' => $request->amount_tendered ?? null,
                'change' => $request->change ?? null,
                'reference_number' => $request->reference_number ?? null,
                'bank_name' => $request->bank_name ?? null,
                'card_number' => $request->card_number ?? null,
                'cardholder_name' => $request->cardholder_name ?? null,
                'card_expiry' => $request->card_expiry ?? null,
                'installments' => $request->installments ?? null,
                'account_number' => $request->account_number ?? null,
            ]);

            $sale->update(['status' => 'completed']);

            DB::commit();

            return redirect()->route('sales.index')->with('success', 'Venta completada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al procesar la venta: ' . $e->getMessage());
        }
    }

    public function show(Sale $sale)
    {
        $sale->load(['products', 'payment', 'user']);
        return view('sales.show', compact('sale'));
    }

    public function edit($id)
    {
        $sale = Sale::with(['products', 'payment'])->findOrFail($id);
        return view('sales.edit', compact('sale'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:cash,transfer,credit_card,debit_card',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'payment_method' => $request->payment_method,
            'amount' => $total,
            'amount_tendered' => $request->amount_tendered,
            'change' => $request->change,
            'bank_name' => $request->bank_name,
            'reference_number' => $request->reference_number,
            'card_number' => $request->card_number,
            'cardholder_name' => $request->cardholder_name,
            'card_expiry' => $request->card_expiry,
            'installments' => $request->installments,
            'account_number' => $request->account_number,
            'shipping_name' => $request->shipping_name,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_phone' => $request->shipping_phone,
        ]);

        try {
            DB::beginTransaction();

            $sale = Sale::findOrFail($id);
            $sale->update(['payment_method' => $request->payment_method]);

            $sale->products()->detach();
            $total = 0;

            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['id']);

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stock insuficiente para el producto: {$product->name}");
                }

                $product->stock -= $item['quantity'];
                $product->save();

                $sale->products()->attach($product->id, [
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);

                $total += $product->price * $item['quantity'];
            }

            $sale->update(['total' => $total]);

            $sale->payment()->update([
                'payment_method' => $request->payment_method,
                'amount' => $total,
            ]);

            DB::commit();

            return redirect()->route('sales.index')->with('success', 'Venta actualizada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar la venta: ' . $e->getMessage());
        }
    }
}
