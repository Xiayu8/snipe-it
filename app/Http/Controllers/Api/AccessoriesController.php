<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\Accessory;
use App\Http\Transformers\AccessoriesTransformer;


class AccessoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', Accessory::class);
        $allowed_columns = ['id','name','model_number','eol','notes','created_at','min_amt','company_id'];

        $accessories = Accessory::whereNull('accessories.deleted_at')->with('category', 'company', 'manufacturer', 'users', 'location');

        if ($request->has('search')) {
            $accessories = $accessories->TextSearch($request->input('search'));
        }

        if ($request->has('company_id')) {
            $accessories->where('company_id','=',$request->input('company_id'));
        }

        if ($request->has('manufacturer_id')) {
            $accessories->where('manufacturer_id','=',$request->input('manufacturer_id'));
        }

        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 50);
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';
        $sort = in_array($request->input('sort'), $allowed_columns) ? $request->input('sort') : 'created_at';

        switch ($sort) {
            case 'category':
                $accessories = $accessories->OrderCategory($order);
                break;
            case 'company':
                $accessories = $accessories->OrderCompany($order);
                break;
            default:
                $accessories = $accessories->orderBy($sort, $order);
                break;
        }

        $accessories->orderBy($sort, $order);

        $total = $accessories->count();
        $accessories = $accessories->skip($offset)->take($limit)->get();
        return (new AccessoriesTransformer)->transformAccessories($accessories, $total);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Accessory::class);
        $accessory = new Accessory;
        $accessory->fill($request->all());

        if ($accessory->save()) {
            return response()->json(Helper::formatStandardApiResponse('success', $accessory, trans('admin/accessories/message.create.success')));
        }
        return response()->json(Helper::formatStandardApiResponse('error', null, $accessory->getErrors()));

    }

    /**
     * Display the specified resource.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Accessory::class);
        $accessory = Accessory::findOrFail($id);
        return (new AccessoriesTransformer)->transformAccessory($accessory);
    }


    /**
     * Display the specified resource.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkedout($id)
    {
        $this->authorize('view', Accessory::class);
        $accessory = Accessory::findOrFail($id)->with('users')->first();
        $accessories_users = $accessory->users;
        $total = $accessories_users->count();
        return (new AccessoriesTransformer)->transformCheckedoutAccessories($accessories_users, $total);
    }


    /**
     * Update the specified resource in storage.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('edit', Accessory::class);
        $accessory = Accessory::findOrFail($id);
        $accessory->fill($request->all());

        if ($accessory->save()) {
            return response()->json(Helper::formatStandardApiResponse('success', $accessory, trans('admin/accessories/message.update.success')));
        }

        return response()->json(Helper::formatStandardApiResponse('error', null, $accessory->getErrors()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Accessory::class);
        $accessory = Accessory::findOrFail($id);
        $this->authorize('delete', $accessory);
        $accessory->delete();
        return response()->json(Helper::formatStandardApiResponse('success', null,  trans('admin/accessories/message.delete.success')));

    }
}
