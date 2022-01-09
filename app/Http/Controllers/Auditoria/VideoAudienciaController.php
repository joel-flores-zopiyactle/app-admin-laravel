<?php

namespace App\Http\Controllers\Auditoria;

use App\Http\Controllers\Controller;
use App\Models\VideoAudiencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoAudienciaController extends Controller
{
    public function store(Request $request) {

        //  return $request->all();

        if($request->hasFile('video')) {

            $videoFormat = ['MP4', 'MKV', 'FLV', 'MOV', 'WEBM'];
            return  $fileExtension = strtoupper($request->file('video')->getClientOriginalExtension());
                       
            if(!in_array($fileExtension ,$videoFormat,true)) {
                return ['mensaje' => 'El formato que esta tratando de subir no es aceptado en la plataforma', 'status' => 500];
            }

            $fileName = $request->file('video')->getClientOriginalName();
            $path = $request->file('video')->store('public/VIDEO-AUDIENCIA'); 

            try {
                
                $video = new VideoAudiencia;
                $video->nombre        = $fileName;
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

    public function storeVideo(Request $request) {

        //  return $request->all();

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

    public function dowloadVideoAudiencia($id)
    {
        $id =  decrypt($id);
        $archivo = VideoAudiencia::find($id);

        //$file = public_path(). "/images/test.jpg";

        $headers = ['Content-Type: image/jpeg'];
    
        return Storage::download($archivo->url, $archivo->nombre);
    }
}
