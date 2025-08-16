<?php
use Illuminate\Support\Facades\Session;

public function index()
{
    $cart = Session::get('cart', []);
    return view('cart.index', compact('cart'));
}
