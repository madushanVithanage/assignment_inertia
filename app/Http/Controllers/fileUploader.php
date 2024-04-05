<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class fileUploader extends Controller
{
    //file upload contoller
    public function file_up(Request $request, $file_name, $upload_path){
        if ($request->hasFile($file_name)) {

           //get folder path
           $folder_file_path = File::files(public_path($upload_path));
           //get number of filels
           $countFiles = 0;
           if ($folder_file_path !== false) {
               //get number of count
               $countFiles = count($folder_file_path);

           } 

           // get requeste file
           $file=$request->file($file_name);
           //get file extention
           $extetion = $file->getClientOriginalExtension();
           //upload change file name
           $upload_file_name = $countFiles.time().".".$extetion;
           //upload file
           $file->move($upload_path,$upload_file_name);

           return $upload_file_name;
        }

    }

    // multiple file upload
        public function multyple_file_up(Request $request, $file_name, $upload_path){
            if ($request->hasFile($file_name)) {

                $uploadedFileNames = "";

                foreach ($request->file($file_name) as $file) {

                    // Get folder path
                    $folderFilePath = File::files(public_path($upload_path));

                    // Get number of files
                    $countFiles = count($folderFilePath);

                    // Get file extension
                    $extension = $file->getClientOriginalExtension();

                    // Upload changed file name
                    $uploadFileName = $countFiles . '_' . time() . '.' . $extension;

                    // Upload file
                    $file->move($upload_path, $uploadFileName);

                    $uploadedFileNames .= $uploadFileName."-";
                }

                return $uploadedFileNames;
            }

            return null; // Handle the case where no file is uploaded
    }

}
