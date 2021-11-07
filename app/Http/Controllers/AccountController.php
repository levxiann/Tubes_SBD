<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Favourite;

class AccountController extends Controller
{
    public function index()
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }
        
        return view('artsandculture.account');
    }

    public function update(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'sex' => 'required',
            'birthOfDate' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id,
            'image' => 'image|mimes:jpg,png,jpeg|max:10240'
        ]);

        User::where('id', Auth::user()->id)
        ->update([
            'name' => $request->name,
            'sex' => $request->sex,
            'birthOfDate' => $request->birthOfDate,
            'email' => $request->email,
        ]);

        if($request->has('image'))
        {
            $newname = Str::random(20);
            $newname .=".";
            $newname .= $request->file('image')->extension();

            $request->file('image')->move(public_path('images'), $newname);

            User::where('id', Auth::user()->id)
            ->update([
                'image' => $newname
                ]);
        }

        return redirect('/account')->with('status','Akun berhasil diedit');
    }

    public function favmedium(Request $request, $id)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }

        if(User::find(Auth::user()->id)->favourites()->where('fav_id',1)->where('medium_id', $id)->count() > 0)
        {
            return redirect('/medium/'.$id);
        }

        Favourite::create([
            'user_id' => Auth::user()->id,
            'fav_id' => 1,
            'medium_id' => $id
        ]);

        return redirect('/medium/'.$id);
    }

    public function deletefavmedium($id)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }

        User::findOrFail(Auth::user()->id)->favourites()->where('fav_id',1)->where('medium_id', $id)->delete();

        return redirect('/medium/'.$id);
    }

    public function favitem(Request $request, $id, $idmed)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }

        if(User::find(Auth::user()->id)->favourites()->where('fav_id',2)->where('item_id', $id)->count() > 0)
        {
            return redirect('/medium/'.$id);
        }

        Favourite::create([
            'user_id' => Auth::user()->id,
            'fav_id' => 2,
            'item_id' => $id
        ]);

        return redirect('/item/'.$id.'/'.$idmed);
    }

    public function deletefavitem($id, $idmed)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }

        User::findOrFail(Auth::user()->id)->favourites()->where('fav_id',2)->where('item_id', $id)->delete();

        return redirect('/item/'.$id.'/'.$idmed);
    }

    public function favarticle(Request $request, $id, $idmed)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }

        if(User::find(Auth::user()->id)->favourites()->where('fav_id',3)->where('article_id', $id)->count() > 0)
        {
            return redirect('/medium/'.$id);
        }

        Favourite::create([
            'user_id' => Auth::user()->id,
            'fav_id' => 3,
            'article_id' => $id
        ]);

        return redirect('/article/'.$id.'/'.$idmed);
    }

    public function deletefavarticle($id, $idmed)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }

        User::findOrFail(Auth::user()->id)->favourites()->where('fav_id',3)->where('article_id', $id)->delete();

        return redirect('/article/'.$id.'/'.$idmed);
    }

    public function showfav()
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }

        $mediums = User::find(Auth::user()->id)->favourites()->where('fav_id', 1)->get();
        $items = User::find(Auth::user()->id)->favourites()->where('fav_id', 2)->get();
        $articles = User::find(Auth::user()->id)->favourites()->where('fav_id', 3)->get();

        return view('artsandculture.favourites', compact('mediums', 'items', 'articles'));
    }

    public function accounts()
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }
        elseif(Auth::user()->level == '2')
        {
            return redirect('/medium');
        }

        $users = User::paginate(9);

        return view('artsandculture.accounts', compact('users'));
    }

    public function search(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }
        elseif(Auth::user()->level == 2)
        {
            return redirect('/medium');
        }

        $users = User::where('name', 'like', "%".$request->keyword."%")->orWhere('email', 'like', "%".$request->keyword."%")->paginate(9);

        $users->appends(['keyword' => $request->keyword]);

        return view('artsandculture.accounts', compact('users'));
    }

    public function destroy($id)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }
        elseif(Auth::user()->level == 2)
        {
            return redirect('/medium');
        }
        
        User::destroy($id);

        return redirect('/accounts')->with('status', 'Akun berhasil dihapus');
    }
}
