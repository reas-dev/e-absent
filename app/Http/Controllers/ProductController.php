<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Participant;

class ProductController extends Controller
{
    public function show()
    {
        $id = Auth::user()->id;
        $participant = Participant::select(['code', 'id'])->where('user_id', $id)->first();

        $product = Product::where('participant_id', $participant->id)->first();
        if ($product != null) {
            return redirect('/participant/product/edit');
        }
        return view('participant.upload-product');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'category' => 'required',
            'sub_category' => 'required|min:3|max:50',
            'promotion' => 'required|min:3',
            'image' => 'required|file|mimes:jpeg,png,jpg|max:308',
            'description' => 'required|min:3|max:250'
        ]);

        $id = Auth::user()->id;
        $participant = Participant::select(['code', 'id'])->where('user_id', $id)->first();

        $produk = Product::where('participant_id', $participant->id)->first();
        if ($produk != null) {
            return redirect('/home')->with('status', 'has-submit');
        }

        $file = $request->file('image');

        $code = str_replace("/", "_", $participant->code);

        $nama_file = time() . "_" . $code . "." . $file->getClientOriginalExtension();

        $tujuan_upload = 'data_file/product';
        $file->move($tujuan_upload, $nama_file);

        Product::create([
            'participant_id' => $participant->id,
            'image' => $nama_file,
            'name' => $request->name,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'url' => $request->promotion,
            'description' => $request->description
        ]);

        return redirect('/home')->with('status', 'product-done');
    }

    public function showEdit()
    {
        $id = Auth::user()->id;
        $participant = Participant::select(['code', 'id'])->where('user_id', $id)->first();

        $product = Product::where('participant_id', $participant->id)->first();
        if ($product != null) {
            return view('participant.upload-product-edit')->with(compact(['product']));
        }
        return redirect('/participant/product');
    }

    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'category' => 'required',
            'sub_category' => 'required|min:3|max:50',
            'promotion' => 'required|min:3',
            'description' => 'required|min:3|max:250'
        ]);
        $id = Auth::user()->id;
        $participant = Participant::select(['code', 'id'])->where('user_id', $id)->first();

        $product = Product::where('participant_id', $participant->id)->first();
        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'url' => $request->promotion,
            'description' => $request->description
        ]);

        return redirect('/participant/product/edit')->with('status', 'product-edit-done');
    }
}
