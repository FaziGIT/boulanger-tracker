<?php

namespace App\Http\Controllers;

use App\DTOs\ProductDataDto;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateFrequencyProductRequest;
use App\Models\Product;
use App\Services\ProductScrapingService;
use Illuminate\Http\RedirectResponse;

class ProductController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Need to change to display only product of the user
        return view('trackers.index', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $result = app(ProductScrapingService::class)->fetchAndParseProductData($data['url']);

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['error']);
        }

        /** @var ProductDataDto $dto */
        $dto = $result['dto'];

        $product = Product::create([
            ...$dto->toArray(),
            'old_price' => $dto->price,
            'discount' => 0,
            'user_id' => auth()->id(),
            'frequency' => $data['frequency'],
        ]);

        $product->save();

        return redirect()->back()->with('success', 'Le produit a été ajouté avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if (!auth()->user()->can('delete', $product)) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer ce produit.');
        }

        try {
            $product->delete();
            return redirect()->back()->with('success', 'Le produit a été supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression du produit.');
        }
    }

    public function updateFrequency(Product $product, UpdateFrequencyProductRequest $request): RedirectResponse
    {
        if (!auth()->user()->can('update', $product)) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier ce produit.');
        }

        try {
            $data = $request->validated();

            $product->frequency = $data['frequency'];
            $product->save();

            return redirect()->back()->with('success', 'La fréquence du produit a été mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour de la fréquence.');
        }
    }

    public function handleActive(Product $product): RedirectResponse
    {
        // An error gonna happen because I use patch/put method in the form
        // But if I use post method, it will not work (for the success message)
        if (!auth()->user()->can('update', $product)) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier ce produit.');
        }

        try {
            $product->is_active = !$product->is_active;
            $product->is_ended = false;
            $product->save();

            return redirect()->back()->with('success', 'Le statut du produit a été mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du statut.');
        }
    }

    public function end(Product $product): RedirectResponse
    {
        if (!auth()->user()->can('update', $product)) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier ce produit.');
        }

        try {
            $product->is_active = false;
            $product->is_ended = true;
            $product->save();

            return redirect()->back()->with('success', 'Le produit a été marqué comme terminé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du statut du produit.');
        }
    }
}
