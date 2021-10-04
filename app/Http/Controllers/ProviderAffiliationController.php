<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use App\Models\ProviderAffiliation;
use App\Http\Resources\ProviderAffiliationResource;

class ProviderAffiliationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): AnonymousResourceCollection
    {
        $provider_affiliations = ProviderAffiliation::paginate();
        return ProviderAffiliationResource::collection($provider_affiliations);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  index_by_provider_id(Request $request): AnonymousResourceCollection
    {
        $provider_id = $request->provider_id;
        $provider_affiliations = ProviderAffiliation::with('provider','facility')->where('provider_id', $provider_id)->paginate();
        return ProviderAffiliationResource::collection($provider_affiliations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): ProviderAffiliationResource
    {
        $provider_affiliation = ProviderAffiliation::create($request->all());
        return new ProviderAffiliationResource($provider_affiliation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): ProviderAffiliationResource
    {
        $provider_affiliation = ProviderAffiliation::findOrFail($id);
        return new ProviderAffiliationResource($provider_affiliation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): ProviderAffiliationResource
    {
        $provider_affiliation = ProviderAffiliation::findOrFail($id);
        $provider_affiliation->update($request->all());
        return new ProviderAffiliationResource($provider_affiliation->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): Response
    {
        $provider_affiliation = ProviderAffiliation::findOrFail($id);
        $provider_affiliation->delete();
        return response()->noContent();
    }
}
