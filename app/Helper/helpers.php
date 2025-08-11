<?php


/** Handle file upload */

function handleUpload($inputName, $model=null){
    try{
        if(request()->hasFile($inputName)){
                        if($model && \File::exists(public_path($model->{$inputName}))){//deleting our previous image. $inputName=db column name
                            \File::delete(public_path($model->{$inputName}));
                        }

                    $file = request()->file($inputName);
                    $fileName = rand().$file->getClientOriginalName();
                    $file->move(public_path('/uploads'), $fileName);
                    $filePath = "/uploads/".$fileName;

                    return $filePath;

                }
    } catch(\Exception $e){
        throw $e;
    }
}

/** earlier, not generic File Upload function from Hero Controller, Update method*/
    // if($request->hasFile('image')){

    //             if($hero && File::exists(public_path($hero->image))){ //deleting our previous image
    //                 File::delete(public_path($hero->image));
    //             }

    //             $image = $request->file('image');
    //             $imageName = rand().$image->getClientOriginalName();
    //             $image->move(public_path('/uploads'), $imageName);
    //             $imagePath = "/uploads/".$imageName;

    //         }

    /** Delete File */

    function deleteFileIfExist($filePath){
        try{
            if(\File::exists(public_path($filePath))){
            \File::delete(public_path($filePath));
        }
        } catch(\Exception $e){
            throw $e;
        }
    }

    /** get dynamic colors */

    function getColor($index){
        $colors = ['#558bff', '#fecc90', '#ff885e', '#282828', '#190844', '#9dd3ff'];

        return $colors[$index % count($colors)];
    }
    
