<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    //トップページ（観た映画一覧）
    public function index()
    {
        //ユーザーに紐付いた一覧を取得
        $stocks = Auth::user()->stocks()->orderBy('created_at', 'DESC')->simplePaginate(6);

        return view('stock.index',compact('stocks'));
    }

    //観た映画の詳細ページ
    public function detail($id)
    {
        //ユーザーに紐付いた詳細ページを取得
        $stock = Auth::user()->stocks()->where('id',$id)->first();
        return view('stock.detail',compact('stock'));
    }

    //観た映画登録ページの表示
    public function create()
    {
        return view('stock.add');
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
        return redirect('/')->with('flash_message', '登録が完了しました');
    }

    //観た映画の削除機能
    public function delete(Request $request)
    {
        $stock = Stock::find($request->id);
        $stock->delete();

        //トップへのリダイレクト
        return redirect('/')->with('flash_message', '削除しました');
    }

    //使い方ページの表示
    public function howto()
    {
        return view('howto');
    }
}
