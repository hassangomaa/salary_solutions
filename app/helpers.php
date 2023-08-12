<?php

//namespace App;

use Illuminate\Support\Str;
class Helpers
{
    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }
}

if ( !function_exists('upload_file') ) {

    function upload_file ( $id , $directory , $file , $old_file = null)
    {
        if( $old_file ) {
           deleteImage($old_file) ;
        }

		$newName = $id.'-'.Str::random(3).'.'.$file->getClientOriginalExtension();

		$path = storage_path('app/public/uploads/').$directory;
		$file->move( $path,$newName );
		return $path.'/'.$newName;
    }


	function deleteImage( $path )
    {
		$fullPath = ( isset( explode ( '/public/storage/',$path)[1] ) ? explode ( '/public/storage/',$path)[1] : '' );

		if( Storage::disk('public')->exists($fullPath) ){
			Storage::disk('public')->delete($fullPath);
		}
		return true;

    }


}

