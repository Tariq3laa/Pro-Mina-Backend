<?php

namespace Modules\Common\Helpers\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploaderHelper
{

    /**
     * Generate file random name
     * @param $extension
     * @return String
     */
    public function generateFileRandomName($extension)
    {
        $time = time();
        //$str_random = str_random(8);
        $str_random = Str::random(8);
        return "{$time}_{$str_random}.{$extension}";
    }

    public function fileUpload($folder_name, $file, $file_name)
    {
        $filePath = $folder_name . '/' . $file_name;
        $file->move($folder_name, $file_name);
        return $filePath;
    }

    private function handleUploadWithResize(UploadedFile $file, $folder_name)
    {
        $data = [];
        if ($file) {
            $data = [
                'size'      => $file->getSize(),
                'extension' => $file->extension(),
                'type'      => $file->getMimeType(),
            ];
            $data['name'] = $file->hashName();
            $data['path'] = $this->fileUpload($folder_name, $file, $data['name']);
            $data['folder_name'] = $folder_name;
        }
        return $data;
    }

    /**
     * Check if allowed file extensions
     * @param string (CSV) comma seperated values
     * @return boolean
     */
    public function isAllowedFileExtensions($extensions, $file_extension)
    {
        $allowed_extensions = explode(',', $extensions);
        if (!in_array($file_extension, $allowed_extensions)) {
            throw new \Exception('Not Allowed file extension.');
        }
    }

    /**
     * Get file full path
     * @param file_path
     * @return string
     */
    public function getFileFullPath($file_name, $folder = null)
    {
        $file_path = Storage::disk('public')->url($file_name);
        return $file_path;
    }

    /**
     * Delete file
     * @param file_path
     * @return boolean
     */
    public function deleteFile($file_path)
    {
//		$root_directory = app(\Hyn\Tenancy\Website\Directory::class)->path();
//		$path_components = explode($root_directory, $file_path);
//		if(isset($path_components[1])){

//        file_exists(public_path());
        $arr = explode('/images/', $file_path);
        $file_name = array_last($arr);
        Storage::disk('s3')->delete('uploads/images/' . $file_name);
        return true;
//			return Storage::delete('public/'.$file_name);
        if (\File::exists(public_path('uploads/images/' . $file_name))) {
            return \File::delete(public_path('uploads/images/' . $file_name));
        }
//		}
//		return false;
    }
}

?>
