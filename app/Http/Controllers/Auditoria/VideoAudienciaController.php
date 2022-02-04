<?php

namespace App\Http\Controllers\Auditoria;

use App\Http\Controllers\Controller;
use App\Models\ControlDeConsumoDisco;
use App\Models\VideoAudiencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoAudienciaController extends Controller
{
    public function store(Request $request) {

        //return $request->all();
       
        try {
                
            $video = new VideoAudiencia;
            $video->nombre        = $request->video;
            $video->url           = $request->ubicacion;
            $video->duracion      = $request->duracion;
            $video->expediente_id = $request->expediente_id;

            if($video->save()) {                

                $controlDiscoConsumoMB = new ControlDeConsumoDisco;
                $controlDiscoConsumoMB->unidad = $request->unidad;
                $controlDiscoConsumoMB->total_mb_usado = floatval(filesize($request->ubicacion));
                $controlDiscoConsumoMB->expediente_id =$request->expediente_id;

                if($controlDiscoConsumoMB->save()) { 
                    return ['mensaje' => 'Video subido correctamente!', 'status' => 201];
                }                
            }

            return ['mensaje' => 'No se pudo guardar el video!', 'status' => 500];

        } catch (\Throwable $th) {
            return ['error' => 'El video no se pudo subir a la plataforma!, Intentalo de nuevo', 'status' => 500];
        }

        // if($request->hasFile('video')) {

        //     $videoFormat = ['MP4', 'MKV', 'FLV', 'MOV', 'WEBM'];
        //     $fileExtension = strtoupper($request->file('video')->getClientOriginalExtension());
                       
        //     if(!in_array($fileExtension ,$videoFormat,true)) {
        //         return ['mensaje' => 'El formato que esta tratando de subir no es aceptado en la plataforma', 'status' => 500];
        //     }

        //     $fileName = $request->file('video')->getClientOriginalName();
        //     $path = $request->file('video')->store('public/VIDEO-AUDIENCIA'); 

        //     try {
                
        //         $video = new VideoAudiencia;
        //         $video->nombre        = $fileName;
        //         $video->url           = $path;
        //         $video->duracion      = $request->duracion;
        //         $video->expediente_id = $request->expediente_id;

        //         if($video->save()) {
        //             return ['mensaje' => 'Video subido correctamente!', 'status' => 201];
        //         }

        //     } catch (\Throwable $th) {
        //         return ['error' => 'El video no se pudo subir a la plataforma!, Intentalo de nuevo', 'status' => 500];
        //     }
            
        // }

        // return ['mensaje' => 'No ha seleccionado nungún video', 'status' => 404];

    }

    /* Primer version para subir un video */
    public function storeVideo(Request $request) {
       
        //return $request->all();

        if($request->hasFile('video')) {

            $fileName = $request->file('video')->getClientOriginalName();
            $path = $request->file('video')->store('public/VIDEO-AUDIENCIA'); 

            try {
                
                $video = new VideoAudiencia;
                $video->nombre        = $request->nameVideo;
                $video->url           = $path;
                $video->duracion      = $request->duracion;
                $video->expediente_id = $request->expediente_id;

                if($video->save()) {
                    return ['mensaje' => 'Video subido correctamente!', 'status' => 201];
                }

            } catch (\Throwable $th) {
                return ['error' => 'El video no se pudo subir a la plataforma!, Intentalo de nuevo', 'status' => 500];
            }
            
        }

        return ['mensaje' => 'No ha seleccionado nungún video', 'status' => 404];

    }

    public function dowloadVideoAudiencia($id) // Descarga el video de la audiencia grabada 
    {
        $id =  decrypt($id);
        $archivo = VideoAudiencia::find($id);

        //$file = public_path(). "/images/test.jpg";
    
        return Storage::download($archivo->url, $archivo->nombre);
    }
}
