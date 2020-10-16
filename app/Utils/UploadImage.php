<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Model;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Support\Facades\Validator;

class UploadImage
{
    private $request;

    private $ext = 'jpeg,jpg,png,svg,gif';

    private $size = 2;

    private $sortCollection = [];

    private $uploadedFileName = '';

    private $inputName;

    private $uploadPath;

    public static function init($inputName, $uploadPath)
    {
        return new self($inputName, $uploadPath);
    }

    function __construct($inputName, $uploadPath) {
        $this->request    = request();
        $this->uploadPath = $uploadPath;
        $this->inputName  = $inputName;
    }

    public function setExtensions($ext)
    {
        $this->ext = $ext;
        return $this;
    }

    public function setSize($size)
    {
        $this->size = $size*1000;
        return $this;
    }

    public function upload()
    {
        if (!$this->request->hasFile($this->inputName)) {
            return $this;
        }

        if (!$this->validate($this->inputName)) {
            throw new \ValidationError('Убедитесь что ваш файл содержит формат ' . $this->ext . ' и его размер не превышает ' . ($this->size/1000) . 'Мб' );
        }

        $file     = $this->request->file($this->inputName);
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $this->uploadPath     = public_path() . '/uploads/'.$this->uploadPath.'/';
        $file->move($this->uploadPath, $fileName);

        $this->optimize($this->uploadPath.$fileName);

        $this->uploadedFileName = $fileName;
        return $this;
    }

    private function optimize($pathToImg)
    {
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($pathToImg);
    }

    public function getUploadedFileName()
    {
        return $this->uploadedFileName;
    }

    public function update(Model $model, $id, $field)
    {
        if ($this->uploadedFileName) {
            $model->whereId($id)->update(["$field" => $this->uploadedFileName]);
        }
    }

    public function sort($items = false) {
        if($items instanceof \Illuminate\Support\Collection){
            $this->sortCollection = $items->keyBy('name');
        }
        return $this;
    }

    public function multipleUpload()
    {
        if ($this->validate($this->inputName .'.*') == false) {
            throw new \ValidationError('Убедитесь что ваш файл содержит формат ' . $this->ext . ' и его размер не превышает ' . ($this->size/1000) . 'Мб' );
        }

        $fileNames = [];
        foreach ($this->request[$this->inputName] as $key => $file) {
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/'.$this->uploadPath.'/', $fileName);
            if (!empty($this->sortCollection)) {
                $fileNames[] = [
                    'name'    => $fileName,
                    'page_up' => @$this->sortCollection[$file->getClientOriginalName()]['index'] ?: 1
                ];
            } else {
                $fileNames[] = $fileName;
            }
        }

        return $fileNames;
    }

    private function validate($name)
    {
        $validator = Validator::make($this->request->all(), [
            "{$name}" => 'required|file|mimes:' . $this->ext . '|max:' . $this->size * $this->countUploadFiles($name)
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }

    private function countUploadFiles($name) {
        if (strpos($name, '*') !== false) {
            $clearName = str_replace('.*', '', $name);
            return count($this->request[$clearName]);
        }
        return 1;
    }
}
