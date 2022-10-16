<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Appointment as AppointmentRequest;
use App\Http\Resources\Appointment as AppointmentResource;
class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $events = Appointment::all();
        return response()->json(AppointmentResource::collection($events));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        //dd($request->all());

        Appointment::create([
            'reason' => $request->title,
            'begin' => $request->start,
            'end' => $request->end,
            //'session'=> $request->session,
            'booked_by' => (Auth::user()->isAdmin) ?  $request->user_id : $request->user_id,
            'user_id' => $request->user_id

        ]);
        return redirect()->back()->with('succès','réservation faite avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Appointment  $appointment
     * @return Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
