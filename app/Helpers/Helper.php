<?php



namespace App\Helpers;





use Image;

use File;

use Illuminate\Http\Request;

use Illuminate\Http\UploadedFile;





class Helper {



   //  public static function dateFormat($date) {

   //      if ($date) {

   //          $dt = new DateTime($date);



   //      return $dt->format("m/d/y"); // 10/27/2014

   //    }

   // }

   //



  public static function uploadImage($uploadImage,$location,$filename=null,$width=null,$height=null){

    if($location==null || $uploadImage==null){

      return;

    }

    $location = rtrim($location, '/');

    if($filename==null){

      $filename=str_random(15).time().".png";

    }else{

      $filename = $filename.".png";

    }

    ini_set('memory_limit', '-1');

      // $image = Image::make($uploadImage,'png');





    $uploadFolderName = 'uploads';

    if(!File::exists($uploadFolderName)) {

      File::makeDirectory($uploadFolderName);

    }



    if(!File::exists($location)) {

      File::makeDirectory($location);

    }



    $data = explode(",",$uploadImage)[1];

    $data = base64_decode($data);



    $im = imagecreatefromstring($data);

    if ($im !== false) {

      header('Content-Type: image/png');

        // integer representation of the color black (rgb: 0,0,0)

      $background = imagecolorallocate($im , 0, 0, 0);

               // removing the black from the placeholder

      imagecolortransparent($im, $background);

         // turning off alpha blending (to ensure alpha channel information

        // is preserved, rather than removed (blending with the rest of the

        // image in the form of black))

      imagealphablending($im, false);



        // turning on alpha channel information saving (to ensure the full range

        // of transparency is preserved)

      imagesavealpha($im, true);



      imagepng($im,$location."/".$filename);

      imagedestroy($im);

    }

    else {

      echo 'An error occurred.';

    }





    return response()->json([

                            'filename' => $filename,

                            'no_extension_filename' => rtrim($filename,'.png'),

                            'location' => str_finish($location, '/'),

                            'src'      => url($location."/".$filename)

                            ]);

  }







    // public static function uploadImage($uploadImage,$location, $cropdata=null) {

    //     if($location==null || $uploadImage==null){

    //         return;

    //     }



    //     $filename=str_random(50).time().".png";



    //     $image = Image::make($uploadImage,'png');



    //     if(isset($cropdata)){

    //         if(!$cropdata instanceOf stdClass){

    //             $cropdata = json_decode($cropdata);

    //         }

    //         $image->crop(

    //             floor($cropdata->width),

    //             floor($cropdata->height),

    //             floor($cropdata->left),

    //             floor($cropdata->top)

    //             );

    //     }

    //     if(!File::exists($location)) {

    //         File::makeDirectory($location);

    //     }

    //     $image->save($location.$filename);

    //     return $filename;

    // }







    // public static function uploadImage(UploadedFile $uploadImage, $cropdata=null,$location) {

    //     if($location==null || $uploadImage==null){

    //         return;

    //     }



    //     $filename=str_random(50).time().".".$uploadImage->getClientOriginalExtension();



    //     $image = Image::make($uploadImage);



    //     if(isset($cropdata)){

    //         if(!$cropdata instanceOf stdClass){

    //             $cropdata = json_decode($cropdata);

    //         }

    //         $image->crop(

    //             floor($cropdata->width),

    //             floor($cropdata->height),

    //             floor($cropdata->left),

    //             floor($cropdata->top)

    //             );

    //     }

    //     if(!File::exists($location)) {

    //         File::makeDirectory($location);

    //     }

    //     $image->save($location.$filename);

    //     return $filename;

    // }





  public static function truncate($content='', $limit=200)

  {

    if (mb_strwidth($content, 'UTF-8') > $limit)

    {

      $content = wordwrap($content, $limit,"\n<br>");

      $content = mb_substr($content, 0, strpos($content, "\n<br>"),'utf-8');

      $content.="...";

    }

    return $content;

  }



/*

    public function uploadImage($file, $width, $height)

     {

       if(!empty($file)) {

         $destinationPath = public_path() . '/uploads/';



         $file = str_replace('data:image/png;base64,', '', $file);

         $img = str_replace(' ', '+', $file);

         $data = base64_decode($img);

         $filename = date('ymdhis') . '_croppedImage' . ".png";

         $file = $destinationPath . $filename;

         $success = file_put_contents($file, $data);



         // THEN RESIZE IT

         $returnData = 'uploads/' . $filename;

         $image = Image::make(file_get_contents(url($returnData)));

         $image = $image->resize($width,$height)->save($destinationPath . $filename);



         if($success){

         return $returnData;

         }

       }

     }*/

   }

