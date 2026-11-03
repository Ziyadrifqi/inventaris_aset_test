<?php

namespace App\Http\Controllers;

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
}
