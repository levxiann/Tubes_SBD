<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Medium;
use App\Models\Category_item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index($id)
    {
        $items = Medium::findOrFail($id)->category_items()->get();

        return view('artsandculture.item', compact('items'));
    }

    public function detail($id, $idmed)
    {
        Category_item::where('item_id', $id)->where('medium_id', $idmed)->firstOrFail(); //cek apakah item dan medium sudah sesuai
        $item = Item::findOrFail($id); //cari detail item
        $mediums = Category_item::where('item_id', $id)->get(); //medium yang ada pada item tersebut
        $count = Medium::find($idmed)->category_items()->count(); //jumlah item pada medium yang sama
        $items = Medium::find($idmed)->category_items()->where('item_id', '<>', $id)->offset(rand(0, $count-6))->limit(6)->get(); //item lain pada medium yang sama
        $allmed = Medium::all(); //daftar semua medium
        
        if(Auth::check())
        {
            $liked = User::find(Auth::user()->id)->favourites()->where('fav_id',2)->where('item_id', $id)->count();
        }
        else
        {
            $liked = -1;
        }

        return view('artsandculture.detailitem', compact('item', 'items', 'mediums', 'idmed', 'allmed', 'liked'));
    }

    public function store(Request $request, $id)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }
        elseif(Auth::user()->level == 2)
        {
            return redirect('/medium');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'date' => 'required|string|min:4',
            'type' => 'required|string|max:255',
            'dimension' => 'required|string|max:255',
            'repository' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:10240'
        ]);

        $newname = Str::random(20);
        $newname .=".";
        $newname .= $request->file('image')->extension();
        $request->file('image')->move(public_path('images/items'), $newname);

        Item::create([
            'title' => $request->title,
            'author' => $request->author,
            'date' => $request->date,
            'type' => $request->type,
            'dimension' => $request->dimension,
            'repository' => $request->repository,
            'image' => $newname
        ]);

        $idItem = Item::orderBy('id', 'DESC')->first();

        Category_item::create([
            'item_id' => $idItem->id,
            'medium_id' => $id
        ]);

        return redirect('/medium/'. $id)->with('status','Item berhasil ditambah');
    }

    public function update(Request $request, $id, $idmed)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }
        elseif(Auth::user()->level == 2)
        {
            return redirect('/medium');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'date' => 'required|string|min:4',
            'type' => 'required|string|max:255',
            'dimension' => 'required|string|max:255',
            'repository' => 'required|string|max:255',
            'image' => 'image|mimes:jpg,png,jpeg|max:10240'
        ]);

        Item::where('id', $id)
        ->update([
            'title' => $request->title,
            'author' => $request->author,
            'date' => $request->date,
            'type' => $request->type,
            'dimension' => $request->dimension,
            'repository' => $request->repository
        ]);

        if($request->has('image'))
        {
            $newname = Str::random(20);
            $newname .=".";
            $newname .= $request->file('image')->extension();

            $request->file('image')->move(public_path('images/items'), $newname);

            Item::where('id', $id)
            ->update([
                'image' => $newname
                ]);
        }

        return redirect('/item/'. $id . '/'. $idmed)->with('status','Item berhasil diubah');
    }

    public function updatemedium(Request $request, $id)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }
        elseif(Auth::user()->level == 2)
        {
            return redirect('/medium');
        }

        $request->validate([
            'itemmed' => 'required'
        ]);

        Category_item::where('item_id', $id)->delete();

        foreach($request->itemmed as $itemmed)
        {
            Category_item::create([
                'item_id' => $id,
                'medium_id' => $itemmed
            ]);
        }

        return redirect('/item/'. $id . '/'. $request->itemmed[0])->with('status','Item Medium berhasil diubah');
    }

    public function destroy($id, $idmed)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }
        elseif(Auth::user()->level == 2)
        {
            return redirect('/medium');
        }
        
        Item::destroy($id);

        return redirect('/medium/'.$idmed)->with('status','Item berhasil dihapus');
    }
}
