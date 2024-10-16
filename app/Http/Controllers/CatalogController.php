<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $catalog = Catalog::all();
        return view('backend.catalog.index', compact('catalog'));
    }

    public function list()
    {
        $catalog = Catalog::all();
        return view('list', compact('catalog'));
    }

    public function create()
    {
        return view('backend.catalog.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $data['name'].'.'.$data['image']->getClientOriginalExtension();
        $data['image']->storeAs('public/images', $path);

        $catalog = new Catalog();
        $catalog->name = $request->name;
        $catalog->description = $request->description;
        $catalog->image = $path;
        $catalog->refreshrate = $request->refreshrate;

        $catalog->save();
        return redirect()->route('catalog.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $catalog = Catalog::find($id);
        return view('backend.catalog.edit', compact('catalog'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $data['name'].'.'.$data['image']->getClientOriginalExtension();
        $data['image']->storeAs('public/images', $path);

        $catalog = Catalog::find($id);
        $catalog->name = $request->name;
        $catalog->description = $request->description;
        $catalog->image = $path;
        $catalog->refreshrate = $request->refreshrate;
        $catalog->save();

        return redirect()->route('catalog.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $catalog = Catalog::find($id);
        $catalog->delete();

        return redirect()->route('catalog.index')->with('success', 'Produk berhasil dihapus');
    }
}
