<?php

namespace App\Http\Controllers\Profile;

use App\Utils\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProviderFile;

class FilesController extends Controller
{
    public function index()
    {
        $files = ProviderFile::getProviderFiles(user()->id);
        return view('profile.files', compact('files'));
    }

    public function saveFiles($lang, Request $request)
    {
        $fileNames = collect();
        if ($request->files->count()) {
            try {
                $uploadImage = new UploadImage;
                $images      = $uploadImage->setExtensions('pdf,doc,docx,word')
                    ->setSize(120000)
                    ->multipleUpload('files', 'provider_files');
            } catch (\ValidationError $e) {
                return \JsonResponse::error(['message' => $e->getMessage()]);
            }

            foreach ($images as $key => $file) {
                $fileNames->push($file);
                ProviderFile::create([
                    'id_provider'    => user()->id,
                    'file'           => $file,
                    'name_ru'        => @$request->title[$key] ?: '',
                    'description_ru' => @$request->text[$key] ?: ''
                ]);
            }
        } elseif ($request->title && $request['fileuploader-list-files']) {
            $filesNames = json_decode($request['fileuploader-list-files'], true);

            foreach ($filesNames as $key => $path) {
                $file = basename($path['file']);
                ProviderFile::where('file', $file)
                            ->update([
                                'name_ru'        => @$request->title[$key] ?: '',
                                'description_ru' => @$request->text[$key] ?: ''
                            ]);
            }
        }

        return \JsonResponse::success(['message' => 'Данные успешно сохранены', 'reload' => true]);
    }

    public function delete($lang, Request $request)
    {
        ProviderFile::where('file', $request->name)->delete();
    }
}
