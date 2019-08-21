<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator, Illuminate\Support\Facades\Session, DB;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{

    public function checkAdmin() {
        if(Auth::user()->hasRole('user')) {
            abort(404);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            DB::statement(DB::raw('set @rownum=0'));
            $data = Transaction::select(DB::raw('@rownum  := @rownum  + 1 AS no, transactions.qty * transactions.price AS total'),'transactions.*', 'users.username')
                ->join('users','users.id','transactions.user_id');

            if($request->input('startDate')) {
                $data->whereBetween('transactions.date', [$request->input('startDate'), $request->input('endDate')]);
            }

            if($request->input('user_id')){
                $data->where('transactions.user_id', $request->input('user_id'));
            } 

            if(Auth::user()->hasRole('user')){
                $data->where('transactions.user_id', Auth::user()->id);
            } 

            return  Datatables::of($data)->make(true);
        }

        return view("transactions.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkAdmin();
        return view("transactions.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkAdmin();

        $requestData = $request->all();
        
        $validator = Validator::make($requestData, [
            'product_id' => 'nullable|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'qty' => 'required|min:1',
            'price' => 'nullable|min:1|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('transactions.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $product = Product::find($requestData['product_id']);
        if($product) {
            $requestData['value'] = $product->name;
            $requestData['price'] = $product->price;    

            $user = User::find($requestData['user_id']);
            $user['saldo'] = $user->saldo - $requestData['price'] * $requestData['qty'];
            $user->save();
        } else {
            $requestData['value'] = 'Deposit';
            
            $user = User::find($requestData['user_id']);
            $user['saldo'] = $user->saldo + $requestData['price'] * $requestData['qty'];
            $user->save();
        }

        $d=strtotime($requestData['date']);
        $requestData['date'] = date('Y-m-d',$d);

        $db = Transaction::create($requestData);

        Session::flash('flash_message', 'Success added!');

        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view("transactions.show", ['transaction' => $transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {   
        $this->checkAdmin();
        $transaction['date'] = date('m/d/Y', strtotime($transaction['date']));
        return view("transactions.edit", ['transaction' => $transaction]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {   
        $this->checkAdmin();
        $user = User::find($transaction->user_id);
        if($transaction->value == 'Deposit') {
            $user['saldo'] = $user->saldo - ($transaction->price * $transaction->qty);
        } else {
            $user['saldo'] = $user->saldo + ($transaction->price * $transaction->qty);
        }
        $user->save();

        $transaction->delete();
        return 'ok';
    }
}
