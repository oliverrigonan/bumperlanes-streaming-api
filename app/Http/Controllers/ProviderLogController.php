<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use App\Models\ProviderLog;
use App\Http\Resources\ProviderLogResource;

class ProviderLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): AnonymousResourceCollection
    {
        $provider_logs = ProviderLog::with('provider')->paginate();
        return ProviderLogResource::collection($provider_logs);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  index_by_provider_id(Request $request): AnonymousResourceCollection
    {
        $provider_id = $request->provider_id;
        $provider_logs = ProviderLog::with('provider')->where('provider_id', $provider_id)->paginate();
        return ProviderLogResource::collection($provider_logs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): ProviderLogResource
    {
        $provider_log = ProviderLog::create($request->all());
        return new ProviderLogResource($provider_log);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): ProviderLogResource
    {
        $provider_log = ProviderLog::with('provider')->findOrFail($id);
        return new ProviderLogResource($provider_log);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): ProviderLogResource
    {
        $provider_log = ProviderLog::findOrFail($id);
        $provider_log->update($request->all());
        return new ProviderLogResource($provider_log->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): Response
    {
        $provider_log = ProviderLog::findOrFail($id);
        $provider_log->delete();
        return response()->noContent();
    }
}
