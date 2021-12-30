<?php

namespace App\Http\Controllers\Auditoria;

use App\Http\Controllers\Controller;
use App\Models\Archivo as ArchivoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $typeFile = strtolower($request->tipo_archivo);

        if(is_file($request->file)) {

            $fileExtension = strtoupper($request->file('file')->getClientOriginalExtension()); 

            $path = ''; // Obtiene la ruta donde se almacena el archivo

            // List Array Formats
            $videoFormat = ['MP4', 'AVI', 'MPG', 'WMV', 'H.264', 'MOV', 'MKV', 'DIVX', 'XVID', 'MWV', 'FLV'];
            $audioFormat = ['MP3', 'OGG', 'AAC', 'WMA'];
            $imageFormat = ['JPG', 'PNG', 'GIF', 'BMP'];
            $docsFormat  = ['DOC', 'TXT', 'DOCX'];

            $errorMensaje = array('status' => 500, 'mensaje' => "El archivo que esta subiendo no es admitido");  

            // Me permite especificar que carpeta guardar el archivo para llevar un mejor control
            switch ($typeFile) {
                case 'pdf':
                    
                    if(!in_array($fileExtension ,['PDF'],true)) {  
                        return $errorMensaje;
                    }
                    
                    $path = $request->file('file')->store('public/PDF'); 
                    
                    break;

                case 'video':
                   
                    if(!in_array($fileExtension ,$videoFormat,true)) {
                        return $errorMensaje;
                    }

                    $path = $request->file('file')->store('public/VIDEO'); 
                    break;

                case 'audio':

                    if(!in_array($fileExtension ,$audioFormat,true)) {
                        return $errorMensaje;
                    }

                    $path = $request->file('file')->store('public/AUDIO'); 
                    break;

                case 'imagen':

                    if(!in_array($fileExtension ,$imageFormat,true)) {
                        return $errorMensaje;
                    }   
                    
                    $path = $request->file('file')->store('public/IMAGEN'); 
                    
                    break;  

                case 'doc':
                    if(!in_array($fileExtension ,$docsFormat,true)) {
                        return $errorMensaje;
                    } 

                    $path = $request->file('file')->store('public/DOC'); 

                    break;                        
                
                default:
                    return $errorMensaje;
                    break;
            }

            $nameFile = $request->file('file')->getClientOriginalName(); //Obtenemos el nombre del archivo
            $urlFile  =  $path;

            try {

                $archivo = new ArchivoModel;
                $archivo->tipo_archivo  = $typeFile; 
                $archivo->url           = $urlFile;
                $archivo->nombre        = $nameFile;
                $archivo->expediente_id = $request->expediente_id;

                if($archivo->save()) {
                    return array('status' => 201, 'mensaje' => "Archivo subido correctamente");
                }

            } catch (\Throwable $th) {
                return array('status' => 500, 'mensaje' => "Ocurrio un error al guaradar el archivo");  

            }

        }

        return  array('status' => 500, 'mensaje' => "No ha seleccionado ningún archivo");  
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $archivos = ArchivoModel::where('expediente_id', $id)->select('id', 'nombre')->orderBy('id', 'desc')->get();

        return $archivos;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $archivo = ArchivoModel::find($id);

            // $arrayRuta = explode("/", $archivo->url); // Dividimos en un array el directorio del archivo

            // $fileDelete = end($arrayRuta); // Obetner el ultimo valor del array en este caso el nombre del archivo
            // $folder = strtoupper($archivo->tipo_archivo); // Obtener e directorio del archivo y convertimos en MAYUSCULA

            // $rutaFile = $folder . '/' . $fileDelete;  // Unimos ambos variable para crear el url del archivo 
           
            // Storage::disk('public')->delete( $rutaFile);
            
            Storage::delete(  $archivo->url );

            if($archivo->delete()) {
                return array( 'status' =>  200, 'mensaje' => "Archivo $archivo->nombre eliminado correctamente!");
            } 

            return array( 'status' =>  404, 'mensaje' => "Archivo $archivo->nombre eliminado correctamente!");

        } catch (\Throwable $th) {
            return array( 'status' =>  500, 'mensaje' => "Fallo al eliminar los datos del archivo!");
        }
    }


    public function dowload($id)
    {
        $id =  decrypt($id);
        $archivo = ArchivoModel::find($id);

        //$file = public_path(). "/images/test.jpg";

        $headers = ['Content-Type: image/jpeg'];
    
        return Storage::download($archivo->url, $archivo->nombre);
    }

    public function showFile($id)
    {
        # code...
    }

    
}
