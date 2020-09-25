<?php

namespace App\Http\Controllers\Profile;

use App\Models\Provider\ProviderServiceIntersect;
use App\Models\Provider\ProviderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    public function index()
    {
        $options = ProviderService::orderByPageUp()->where('parent_id', 0)->with('childs')->get();
        $values  = ProviderServiceIntersect::where('provider_id', user()->id)->get()->groupBy('service_id');
        return view('profile.services', compact('options', 'values'));
    }

    public function save($lang, Request $request, $insert = [])
    {
        ProviderServiceIntersect::where('provider_id', user()->id)->delete();

        foreach ($request->char as $type => $options) {
            if ($type == 'input') {
                foreach ($options as $char_id => $value) {
                    $insert[] = [
                        'service_id'  => $char_id,
                        'value'       => $value,
                        'provider_id' => user()->id
                    ];
                }
            } else {
                foreach ($options as $char_id => $values) {
                    foreach ($values as $key => $value) {
                        if (!empty($value)) {
                            $insert[] = [
                                'service_id'  => $char_id,
                                'value'       => $value,
                                'provider_id' => user()->id
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
