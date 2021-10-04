<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use App\Models\Facility;
use App\Http\Resources\FacilityResource;

class FacilityController extends Controller
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
            $facilities = Facility::where(function($q) use($filter) {
                                                                $q->orWhere('facility','like', '%' . $filter . '%');
                                                            })->paginate(10);
                                                                            
        }  else {
            $facilities = Facility::paginate(10);
        }

        return FacilityResource::collection($facilities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): FacilityResource
    {
        $facility = Facility::create($request->all());
        return new FacilityResource($facility);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): FacilityResource
    {
        $facility = Facility::findOrFail($id);
        return new FacilityResource($facility);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): FacilityResource
    {
        $facility = Facility::findOrFail($id);
        $facility->update($request->all());
        return new FacilityResource($facility->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): Response
    {
        $facility = Facility::findOrFail($id);
        $facility->delete();
        return response()->noContent();
    }
}
