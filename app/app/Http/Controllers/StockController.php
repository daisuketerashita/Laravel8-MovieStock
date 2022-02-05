<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    //トップページ（観た映画一覧）
    public function index()
    {
        return view('index');
    }

    //観た映画登録ページの表示
    public function create()
    {
        return view('stock');
    }

    //観た映画の登録処理
    public function store(Request $request)
    {
        $post = $request->all();

        //バリデーション
        $validatedData = $request->validate([
            'title' => 'required',
            'due_date' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('image')){
            $request->file('image')->store('/public/images');
            $data = [
                'user_id' => \Auth::id(),
                'title' => $post['title'],
                'due_date' => $post['due_date'],
                'image' => $request->file('image')->hashName()
            ];
        }else{
            $data = [
                'user_id' => \Auth::id(),
                'title' => $post['title'],
                'due_date' => $post['due_date'],
            ]; 
        }

        //データベースにINSERT
        Stock::insert($data);

        //トップへのリダイレクト
        return redirect()->route('index');
    }
}
