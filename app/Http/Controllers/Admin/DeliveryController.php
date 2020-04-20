<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DeliveryRequest;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = Delivery::all();
        return view('admin.delivery.list', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryRequest $request)
    {
        $delivery = Delivery::create($request->validated());

        if ($request->hasFile('icon')) {
            $photo = $request->file('icon')->store('images/delivery/' . $delivery->id . '/');
            $delivery->icon = $photo;
            $delivery->save();
        }
        return redirect()->route('admin.delivery.index')->with('add', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        return view('admin.delivery.edit', compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Delivery $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryRequest $request, Delivery $delivery)
    {
        $delivery->update($request->validated());

        if ($request->hasFile('icon')) {
            $photo = $request->file('icon')->store('images/delivery/' . $delivery->id . '/');
            $delivery->icon = $photo;
            $delivery->save();
        }
        return redirect()->route('admin.delivery.index')->with('add', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return redirect()->route('admin.delivery.index')->with('delete', true);
    }
}
