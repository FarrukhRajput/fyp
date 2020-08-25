<?php

namespace restro\Http\Controllers;

use restro\Vendor;
use restro\Purchase;
use restro\PurchaseItem;
use Illuminate\Http\Request;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('store.purchase');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::all();
        // dd($vendors);

        return view('store.create_purchase')->withVendors($vendors);
    }

   
    public function store(Request $request)
    {
        dd($request->all());
     
       try {
           $purchase = Purchase::create([
              'invoice_id' => uniqid(),
              'user_id' => \Auth::id(),
              'vendor_id' => $request->vendor_id,
              'purchase_date' => \Carbon\Carbon::parse($request->purchase_date),
              'total' => $request->total,
              'amount_paid' => $request->amount_paid ?  $request->amount_paid  : 0
           ]);

           dd($purchase);

           foreach ($request->purchase as $key => $purchase) {
                $purchase_items = PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'item_id' => $purchase['id'],
                    'qty' => $purchase['qty'],
                    'unit_price' => $purchase['price']
                ]);
           }


           return view('store.purchase')->with('success' , 'Purchase Stored Successfully');

       } catch (\Throwable $th) {
          dd($th);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \restro\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \restro\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \restro\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \restro\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
