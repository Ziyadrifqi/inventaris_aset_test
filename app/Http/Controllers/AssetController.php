<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetRequest;
use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $assets = Asset::with('category') // eager loading -> hindari N+1
            ->filter($request->only(['q', 'category_id', 'status']))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('assets.index', [
            'assets'     => $assets,
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }

    public function show(Asset $asset)
    {
        $asset->load('category');
        return view('assets.show', compact('asset'));
    }

    public function create()
    {
        return view('assets.create', [
            'asset'      => new Asset([
                'status' => 'tersedia',
                'kode'   => Asset::nextKode(),
            ]),
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }

    public function store(AssetRequest $request)
    {
        Asset::create($request->validated());
        return redirect()->route('assets.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function edit(Asset $asset)
    {
        return view('assets.edit', [
            'asset'      => $asset,
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }

    public function update(AssetRequest $request, Asset $asset)
    {
        $asset->update($request->validated());
        return redirect()->route('assets.index')->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus.');
    }
}
