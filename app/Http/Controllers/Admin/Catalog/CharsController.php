<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Char;

class CharsController extends Controller
{
    private $method = 'catalog/chars';

    private $folder = 'catalog.chars';

    private $redirectRoute = 'admin_chars';

    private $returnDataFields = ['name'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->model  = new Char;
        $this->method = config('admin.path') . '/' . $this->method;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {  
        $data = [
            'data'   => $this->model->orderByRaw('page_up asc, id desc')->get(),
            'table'  => $this->model->getTable(),
            'method' => $this->method
        ]; 

        return view('admin.'.$this->folder.'.list', $data);
    }  

    public function create(Request $request)
    {
        if (!$request->type) {
            return \JsonResponse::error(['messages' => 'Укажите тип']);
        }

        $data = array_merge(\Language::returnData($this->returnDataFields),
        [
           'type' => $request->type
        ]);

        $id = $this->model->create($data)->id;
        $this->saveValues($id, $request->value, $request->type);
        return \App\Utils\JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save')); 
    }

    public function showeditForm($id)
    { 
        return view('admin.'.$this->folder.'.edit', [
            'method'        => $this->method,
            'table'         => $this->model->getTable(),
            'data'          => $this->model->with('childs')->findOrFail($id),
        ]);
    }

    public function update($id, Request $request)
    {
        if (!$request->type) {
            return \JsonResponse::error(['messages' => 'Укажите тип']);
        }

        $updateData = array_merge(\Language::returnData($this->returnDataFields),
        [
            'type' => $request->type
        ]);

        $data = $this->model->findOrFail($id);
        $data->fill($updateData)->save();
        $this->saveValues($id, $request->value, $request->type);

        return \JsonResponse::success(['redirect' => route($this->redirectRoute)], trans('admin.save'));
    }

    private function saveValues($id, $values, $type, $insert = [])
    {
        if (!empty($values)) {
            $pageUp = 1;
            foreach (sortValue($values) as $key => $items) {
                $row = [
                    'parent_id' => $id,
                    'page_up'   => $pageUp,
                    'type'      => $type
                ];

                foreach ($items as $lang => $value) {
                    $row["name_$lang"] = $value;
                }

                if (!preg_match('/\id:\b/', $key)) {
                    $insert[] = $row;
                } else {
                    $valueId  = str_replace('id:', '', $key);
                    $update[] = $row;
                    Char::whereId($valueId)->update($row);
                }

                $pageUp++;
            }

            if (!empty($insert)) {
                Char::insert($insert);
            }
        }
    }
}
