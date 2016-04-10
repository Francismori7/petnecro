<?php

namespace Animociel\Http\Controllers;

use Animociel\Http\Requests;
use Animociel\User;
use Illuminate\Contracts\Auth\Guard;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();
        $invoices = $user->invoices();
        
        return view('dashboard.billing.invoices')->with(compact('user', 'invoices'));
    }

    public function show($invoice, Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();

        return $user->findInvoiceOrFail('in_' . $invoice)->view([
            'vendor' => 'Animociel',
        ]);
    }
}
