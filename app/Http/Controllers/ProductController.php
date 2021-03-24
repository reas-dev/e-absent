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

        $products = Product::where('participant_id', $participant->id)->orderBy('created_at', 'asc')->get();

        return view('participant.product-list')->with(compact(['products']));
    }

    public function showUpload()
    {
        return view('participant.upload-product');
    }

    public function showDetail($id)
    {
        $product = Product::find($id); // PRODUK YANG DIKLIK (BERDASARKAN PARTICIPANT ID)

        $location = Participant::where('user_id', '=', $product->participant_id)->first(); // LOKASI DARI PARTICIPANT

        return view('participant.product-show', compact('product', 'location'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'category' => 'required',
            'sub_category' => 'required|min:3|max:50',
            'promotion' => 'required|min:3',
            'image' => 'required|file|mimes:jpeg,png,jpg|max:308',
            'description' => 'required|min:3|max:1500'
        ]);

        $id = Auth::user()->id;
        $participant = Participant::select(['code', 'id'])->where('user_id', $id)->first();

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

    public function showEdit($id)
    {
        $participant = Participant::select(['code', 'id'])->where('user_id', Auth::user()->id)->first();
        $product = Product::where('id', $id)->where('participant_id', $participant->id)->first();
        if ($product != null) {
            return view('participant.upload-product-edit')->with(compact(['product']));
        }
        return redirect('/participant/product');
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'category' => 'required',
            'sub_category' => 'required|min:3|max:50',
            'promotion' => 'required|min:3',
            'description' => 'required|min:3|max:1500'
        ]);
        $user_id = Auth::user()->id;
        $participant = Participant::select(['code', 'id'])->where('user_id', $user_id)->first();

        $product = Product::where('id', $id)->where('participant_id', $participant->id)->first();
        if ($product == null) {
            return redirect('/participant/product');
        }
        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'url' => $request->promotion,
            'description' => $request->description
        ]);

        return redirect('/participant/product/'.$id.'/edit')->with('status', 'product-edit-done');
    }
}
