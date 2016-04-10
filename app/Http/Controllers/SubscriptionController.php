<?php

namespace Animociel\Http\Controllers;

use Animociel\AvailableSubscription;
use Animociel\Http\Requests;
use Animociel\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * SubscriptionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();
        $customer = $user->asStripeCustomer();
        $subscription = $user->subscription();
        $stripeSubscription = $subscription !== null ? $subscription->asStripeSubscription() : null;
        $availableSubscriptions = AvailableSubscription::all();

        //$user->newSubscription('default', 'monthly')->quantity(3)->create();

        return view('dashboard.billing.subscription')->with(compact('user', 'customer', 'subscription',
            'stripeSubscription', 'availableSubscriptions'));
    }

    public function update(Request $request, Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();

        if (!$user->card_last_four) {
            return redirect()->route('dashboard.billing.creditcard.edit');
        }

        $plan = AvailableSubscription::whereIdentifier($request->plan)->firstOrFail();

        if ($user->subscription()) {
            $user->subscription()
                ->updateQuantity($request->quantity ?? $user->subscription()->quantity ?? 1)
                ->swap($request->plan);

            session()->flash('message',
                "Votre abonnement a été modifié avec succès! Vous êtes maintenant abonné au plan {$plan->name}.");
        } else {
            $user->newSubscription('default', $request->plan)
                ->quantity($request->quantity ?? 1)
                ->create();

            session()->flash('message',
                "Vous êtes maintenant abonné au plan {$plan->name}!");
        }

        return redirect()->back();
    }

    public function updateQuantity(Request $request, Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();

        $this->validate($request, [
            'quantity' => 'required|min:1|max:100',
        ]);

        $startingQuantity = $user->subscription()->quantity;

        $user->subscription()->updateQuantity($request->quantity);

        $user->invoice();

        return redirect()->back();
    }

    public function reactivate(Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();

        $user->subscription()->resume();

        session()->flash('message', 'Votre abonnement a été réactivé avec succès!');

        return redirect()->back();
    }

    public function destroy(Request $request, Guard $auth)
    {
        /** @var User $user */
        $user = $auth->user();

        $user->subscription()->cancel();

        session()->flash('message',
            'Votre abonnement a été annulé avec succès! Il sera mis à terme à la fin de votre période de paiement, soit le '
            . $user->subscription()->ends_at->toFormattedDateString() . '.');

        return redirect()->back();
    }
}
