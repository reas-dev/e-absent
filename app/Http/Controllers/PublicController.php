<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Participant;

class PublicController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $categories = $products->unique('category'); // ISI DROPDOWN KNAVBAR ATEGORI (DINAMIS)

        $participants = Participant::get();
        $places = $participants->unique('place'); // ISI DROPDOWN NAVBAR LOKASI (DINAMIS)

        return view('public.index', compact('products', 'categories', 'places'));
    }
    public function index2()
    {
        /** @var App\User $Auth */
        if (Auth::user() != null) {
            if (Auth::user()->isAdmin()) {
                return redirect('/admin');
            }
            elseif (Auth::user()->isAuth()) {
                return redirect('/participant');
            }
        }
        else{
            $products = Product::get();
            $categories = $products->unique('category'); // ISI DROPDOWN KNAVBAR ATEGORI (DINAMIS)

            $participants = Participant::get();
            $places = $participants->unique('place'); // ISI DROPDOWN NAVBAR LOKASI (DINAMIS)

            return view('public.index', compact('products', 'categories', 'places'));
        }
    }

    public function show($id)
    {
        $products = Product::get();
        $categories = $products->unique('category'); // ISI DROPDOWN NAVBAR KATEGORI (DINAMIS)

        $locations = Participant::get();
        $places = $locations->unique('place'); // ISI DROPDOWN NAVBAR LOKASI (DINAMIS)

        $product = Product::find($id); // PRODUK YANG DIKLIK (BERDASARKAN PARTICIPANT ID)
        //dd($product);
        $location = Participant::where('user_id', '=', $product->participant_id)->first(); // LOKASI DARI PARTICIPANT

        return view('public.show', compact('product', 'location', 'categories', 'places'));
    }

    public function index_category($category)
    {
        $products = Product::get();
        $categories = $products->unique('category'); // ISI DROPDOWN KATEGORI (DINAMIS)

        $products = Product::where('category', '=', $category)->get(); // SORTIR PRODUCT BERDASARKAN KATEGORI

        $locations = Participant::get();
        $places = $locations->unique('place'); // ISI DROPDOWN NAVBAR LOKASI (DINAMIS)

        return view('public.index', compact('products', 'categories', 'places'));
    }

    public function index_location($location)
    {
        $products = Product::get();
        $categories = $products->unique('category'); // ISI DROPDOWN NAVBAR KATEGORI (DINAMIS)

        $products = DB::table('participants')
            ->join('products', 'participants.user_id', '=', 'products.participant_id')
            ->where('participants.place', '=', $location)
            ->get(); // AMBIL PRODUK BERDASARKAN LOKASI PARTICIPANT

        $locations = Participant::get();
        $places = $locations->unique('place'); // ISI DROPDOWN NAVBAR LOKASI (DINAMIS)

        return view('public.index', compact('products', 'categories', 'places'));
    }

    public function external_url($url)
    {
        return redirect()->away('https://' . $url);
    }
}
