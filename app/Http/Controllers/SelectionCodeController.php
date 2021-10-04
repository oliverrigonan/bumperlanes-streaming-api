<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use App\Models\SelectionCode;
use App\Http\Resources\SelectionCodeResource;

class SelectionCodeController extends Controller
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
            $selection_codes = SelectionCode::orderBy('code')->where(function($q) use($filter) {
                                                                                                        $q->orWhere('code','like', '%' . $filter . '%')
                                                                                                            ->orWhere('value','like', '%' . $filter . '%')
                                                                                                            ->orWhere('category','like', '%' . $filter . '%');
                                                                                                    })->paginate(10);
                                                                            
        }  else {
            $selection_codes = SelectionCode::orderBy('code')->paginate(10);
        }

        return SelectionCodeResource::collection($selection_codes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_by_category(Request $request): AnonymousResourceCollection
    {
        $category = $request->category;
        $selection_codes = SelectionCode::where('category', $category)->orderBy('code')->get();
        return SelectionCodeResource::collection($selection_codes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): SelectionCodeResource
    {
        $selection_code = SelectionCode::create($request->all());
        return new SelectionCodeResource($selection_code);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): SelectionCodeResource
    {
        $selection_code = SelectionCode::findOrFail($id);
        return new SelectionCodeResource($selection_code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): SelectionCodeResource
    {
        $selection_code = SelectionCode::findOrFail($id);
        $selection_code->update($request->all());
        return new SelectionCodeResource($selection_code->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): Response
    {
        $selection_code = SelectionCode::findOrFail($id);
        $selection_code->delete();
        return response()->noContent();
    }
}
