<?php

namespace App\Http\Controllers\Profile;

use App\Models\Provider\ProviderServiceIntersect;
use App\Models\Provider\ProviderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class ServicesController extends Controller
{ 
    public function index()
    {
        $options = ProviderService::orderByPageUp()->where('parent_id', 0)->with('childs')->get();
        $values  = ProviderServiceIntersect::where('id_provider', user()->id)->get()->groupBy('id_service');
        return view('profile.services', compact('options', 'values'));
    }

    public function save($lang, Request $request, $insert = [])
    {
        ProviderServiceIntersect::where('id_provider', user()->id)->delete();

        foreach ($request->char as $type => $options) {
            if ($type == 'input') {
                foreach ( $options as $id_char => $value) {
                    $insert[] = [
                        'id_service'  => $id_char,
                        'value'       => $value,
                        'id_provider' => user()->id
                    ];
                }
            } else {
                foreach ($options as $id_char => $values) {
                    foreach ($values as $key => $value) {
                        if (!empty($value)) {
                            $insert[] = [
                                'id_service'  => $id_char,
                                'value'       => $value,
                                'id_provider' => user()->id
                            ];
                        }
                    }
                }
            }
        }


        if (!empty($insert)) {
            ProviderServiceIntersect::insert($insert);
        }

        return \JsonResponse::success(['messages' => 'Данные успешно изменены', 'reload' => true]);
    }
}