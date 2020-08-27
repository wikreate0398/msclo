<?php

namespace App\Http\Controllers\Admin;

use App\Repository\CatalogRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; 

class AjaxController extends Controller
{ 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}
  
    public function depthSort(Request $request)
    {
        $arr   = $request->arr;
        $table = $request->table;
        $depth = !empty($request->depth) ? $request->depth : 1;
 
        if ($depth > 1) {
            foreach ($arr as $key => $value) {
               $data[] = $value; 
               $this->sort($data, 0, $table);  
            }
        } else {
            foreach ($arr as $key => $value) {
               DB::table($table)->where('id', $value['id'])
                                ->update(['page_up' => $key+1]);  
            }
        }

        return \JsonResponse::success(['message' => trans('admin.ajax_true')]);
    }

    private function sort($arr, $parent = 0, $table)
    {
        $i = 1;
        foreach ($arr as $item) {
            DB::table($table)->where('id', $item['id'])
                              ->update(['parent_id' => $parent, 'page_up' => $i]);

            if (!empty($item['children'])) {
                $this->sort($item['children'], $item['id'], $table, 1);
            }   
            $i++;
        }   
    }

    public function viewElement(Request $request)
    {
        $id    = $request->id;
        $table = $request->table;
        $row   = $request->row ?: 'view';
        
        $query = DB::table($table)->where('id', $id)->first();  
        DB::table($table)->where('id', $id)
                         ->update(["{$row}" => !empty($query->$row) ? '0' : '1']); 
        return \JsonResponse::success(['message' => trans('admin.ajax_true')]);
    }     

    public function deleteElement(Request $request)
    {
        $id    = $request->input('id');
        $table = $request->input('table');

        if(Schema::hasColumn($table, 'deleted_at')) {
            DB::table($table)->where('id', $id)->update(['deleted_at' => \Carbon\Carbon::now()]);
        } else {
            DB::table($table)->where('id', $id)->delete();
        }

        if ($table == 'categories') {
            $repository = new CatalogRepository;
            $allCats  = $repository->getCats()->keyBy('id');
            $idsCats  = array_merge([$id], $repository->getSubcatsIds($allCats->toArray(), $id));
            DB::table($table)->whereIn('id', $idsCats)->delete();
        } else if (Schema::hasColumn($table, 'parent_id')) {
            DB::table($table)->where('parent_id', $id)->delete();
        }

        return \App\Utils\JsonResponse::success(['message' => trans('admin.delete_true')]);
    } 

    public function deleteImg(Request $request)
    {
        $id        = $request->input('id');
        $table     = $request->input('table'); 
        $nameField = $request->input('name') ? $request->input('name') : 'image';

        if($table == 'settings')
        {
            $nameField = 'value';
        }

        if (Schema::hasColumn($table, $nameField)) {
            DB::table($table)->where('id', $id)->update([$nameField => '']);   
        }
        return \App\Utils\JsonResponse::success(['message' => trans('admin.delete_true')]);
    }

    public function sortElement(Request $request) {
        foreach ($request->arr as $i => $value) {
            DB::table($request->table)->where('id', $value)->update([
                'page_up' => $i
            ]);
        }
        return \App\Utils\JsonResponse::success(['message' => trans('admin.ajax_true')]);
    }

    public function deleteImageByField(Request $request)
    {
        DB::table($request->table)->where("{$request->field}", $request->value)->delete();
    }
}
