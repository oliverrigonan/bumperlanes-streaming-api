<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use App\Models\ProviderOffice;
use App\Http\Resources\ProviderOfficeResource;

class ProviderOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): AnonymousResourceCollection
    {
        $provider_offices = ProviderOffice::with('provider')->paginate();
        return ProviderOfficeResource::collection($provider_offices);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  index_by_provider_id(Request $request): AnonymousResourceCollection
    {
        $provider_id = $request->provider_id;
        $provider_offices = ProviderOffice::with('provider')->where('provider_id', $provider_id)->paginate();
        return ProviderOfficeResource::collection($provider_offices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): ProviderOfficeResource
    {
        $provider_office = ProviderOffice::create($request->all());
        return new ProviderOfficeResource($provider_office);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): ProviderOfficeResource
    {
        $provider_office = ProviderOffice::with('provider')->findOrFail($id);
        return new ProviderOfficeResource($provider_office);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): ProviderOfficeResource
    {
        $provider_office = ProviderOffice::findOrFail($id);
        $provider_office->update($request->all());
        return new ProviderOfficeResource($provider_office->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): Response
    {
        $provider_office = ProviderOffice::findOrFail($id);
        $provider_office->delete();
        return response()->noContent();
    }
}
