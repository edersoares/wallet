<?php

namespace Wallet\Http\Controllers;

use Illuminate\Http\Request;
use Wallet\Wallet;

class WalletController extends Controller
{
    public function index()
    {
        return Wallet::paginate();
    }

    public function create(Request $request)
    {
        return Wallet::create($request->all());
    }

    public function browse($id)
    {
        return Wallet::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $wallet = Wallet::findOrFail($id);

        $wallet->update($request->all());

        return $wallet;
    }

    public function delete($id)
    {
        $wallet = Wallet::findOrFail($id);

        $wallet->delete();

        return $wallet;
    }
}
