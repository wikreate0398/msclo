<?php

namespace App\Utils;
use Illuminate\Http\Request;   
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Support\Facades\Validator;

class UploadImage  
{  
    private $request;

    private $ext = 'jpeg,jpg,png,svg,gif';

    private $size = 2000;

    private $sortCollection = [];

	function __construct() {
	    $this->request = request();
    }

    public function setExtensions($ext)
    {
        $this->ext = $ext;
        return $this;
    }

    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

	public function upload($name, $path, $fileName = '')
	{
        if (!$this->request->hasFile($name)) return false;

        if ($this->validate($name) == false) {
            throw new \ValidationError('Убедитесь что ваш файл содержит формат ' . $this->ext . ' и его размер не превышает ' . ($this->size/1000) . 'Мб' );
        }

        $file     = $this->request->file($name);
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $path     = public_path() . '/uploads/'.$path.'/';
        $file->move($path, $fileName);   

        $optimizerChain = OptimizerChainFactory::create(); 
        $optimizerChain->optimize($path.$fileName); 
        
        return $fileName;
	}

	public function sort($items = false) {
        if($items instanceof \Illuminate\Support\Collection){
            $this->sortCollection = $items->keyBy('name');
        }
        return $this;
    }

    public function multipleUpload($name, $path)
    {
        if ($this->validate($name .'.*') == false) {
            throw new \ValidationError('Убедитесь что ваш файл содержит формат ' . $this->ext . ' и его размер не превышает ' . (($this->size*$this->countUploadFiles($name))/1000) . 'Мб' );
        }

        $fileNames = [];
        foreach ($this->request[$name] as $key => $file) {
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension(); 
            $file->move(public_path() . '/uploads/'.$path.'/', $fileName);
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