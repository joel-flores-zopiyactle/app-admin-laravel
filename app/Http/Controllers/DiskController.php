<?php

namespace App\Http\Controllers;

use App\Models\ControlDeConsumoDisco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiskController extends Controller
{
    public function get_disk_total_space()
    {
        $allDisksInfo = array();
        
        foreach ($this->get_disks() as $unidad) {
            try {
                /*
                    Consulta del total del disco duro 
                */
                $unidad =strtoupper($unidad .':');

                $totalDisk = disk_total_space($unidad);  // Megas
                $base = 1024;
                $countDisckTotalMB = ($totalDisk/$base)/$base; // en MegaBYtes
                $countDisckTotalMB.' MB<br>'; // Imprime por ejemplo: 26295.1289062 MB el total

                $totalDiskGB = round(disk_total_space($unidad) / 1024 / 1024 / 1024); // GB
                // print("Espacio Total en el servidor: $totalDiskGB GB");
                // echo '<br>'; // Imprime por ejemplo:

                /* 
                    Consulta total del disco duro disponible
                */
                
                $totalDiskAvailable = disk_free_space($unidad); 
                $base = 1024;
                $countDisckAvailableMB = ($totalDiskAvailable/$base)/$base; // en MegaBYtes
                $countDisckAvailableMB.' MB<br>'; // Imprime por ejemplo: 26295.1289062 MB

                $totalAvailable = round(disk_free_space($unidad) / 1024 / 1024 / 1024);
                // print("Espacio Disponible en el servidor: $totalAvailable GB");
                // echo '<br>'; // Imprime por ejemplo:
                /* Imprimira Espacio Disponible en el servidor: 26 GB por ejemplo. */

            

                $consumido =  $countDisckTotalMB - $countDisckAvailableMB; 
                $consumido.' MB<br>'; // Imprime por ejemplo: 26295.1289062 MB
                $totalConsumido  = round($consumido / 1024);
                // print("Espacio Consumido en el servidor: $totalConsumido GB");
                // echo '<br>'; // Imprime por ejemplo:
        
                $freespace_percent = ($totalDiskAvailable/$totalDisk)*100;     
                $freespace_percent=number_format($freespace_percent,2,",",".");
            
                
                // echo "<br />";

                // echo "Porcentaje de espacio libre: $freespace_percent %"; // Porcentaje disponible

                // echo "<br />";

                $freespace_percent = ($totalDiskAvailable/$totalDisk)*100;  
                $used_percent = (1-($totalDiskAvailable/$totalDisk))*100;  
                
                //echo sprintf("Porcentaje de Uso:  %.2f%%\n", $used_percent);  // Porcentaje en uso


                $arrInfoDisk = array(
                    'disk_total'   => array('total_MB' => $countDisckTotalMB, 'total_GB' => $totalDiskGB),
                    'disponible'   => array('total_MB' => $countDisckAvailableMB, 'total_GB' => $totalAvailable),
                    'consumido'    => array('total_MB' => $consumido, 'total_GB' => $totalConsumido),
                    'espacio_disponible_porcentaje' => sprintf("%.2f%%\n", $freespace_percent),
                    'espacio_usado_porcentaje'      => sprintf("%.2f%%\n", $used_percent),
                    'unidad'      => $unidad,
                );

                
                array_push($allDisksInfo, $arrInfoDisk); // Agregamos en cada ciclo um muevo arreglo a la array principal
                
            } catch (\Throwable $th) {
                //throw $th;
            }

        }  
        
        return $allDisksInfo;
        
  
    } 

    public function get_disks(){

        $unidades = [];

        if(php_uname('s')=='Windows NT'){
            // windows
            $disks=`fsutil fsinfo drives`;
            $disks= str_word_count($disks,1);

            foreach ($disks as $disk) {
                if(strtolower($disk) !== 'unidades') {
                    array_push($unidades, $disk);
                }
            }
           
        }else{
            // unix
            $data=`mount`;
            $data=explode(' ',$data);
            $disks=array();
            foreach($data as $token)if(substr($token,0,5)=='/dev/')$disks[]=$token;
            return $disks;
        }

        return   $unidades;
    
    }

    public function pruebas( )
    {

        
       echo 'pruebas <br/>';
       echo $this->FileSizeConvert(floatval(disk_free_space(('c:'))));

      
    }

    public function FileSizeConvert($totalBytes)
    {

        $bytes = $totalBytes;
        
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

        foreach($arBytes as $arItem)
        {
            if($bytes >= $arItem["VALUE"])
            {
                $result = $bytes / $arItem["VALUE"];
                $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
                break;
            }
        }
        return $result;
    }

    
    
}
