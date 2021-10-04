<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use App\Models\Provider;
use App\Http\Resources\ProviderResource;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $filter = $request->query('filter');

        if(!is_null($filter)) {
            $providers = Provider::with('facility')->where(function($q) use($filter) {
                                                                                $q->orWhere('first_name','like', '%' . $filter . '%')
                                                                                    ->orWhere('last_name','like', '%' . $filter . '%');
                                                                            })->paginate(10);
                                                                            
        }  else {
            $providers = Provider::with('facility')->paginate(10);
        }
        
        return ProviderResource::collection($providers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): ProviderResource
    {
        $provider = Provider::create($request->all());
        return new ProviderResource($provider);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): ProviderResource
    {
        $provider = Provider::with('facility')->findOrFail($id);
        return new ProviderResource($provider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): ProviderResource
    {
        $provider = Provider::findOrFail($id);
        $provider->update($request->all());
        return new ProviderResource($provider->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): Response
    {
        $provider = Provider::findOrFail($id);
        $provider->delete();
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  blob $image
     */
    public function upload_image(Request $request) {
        $result = $request->file('image')->store('public/images');
        return response()->json(['url' => $result], 200);
    }
}
