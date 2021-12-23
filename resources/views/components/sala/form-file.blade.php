<div>
    <div class="row mt-2">
        <div class="col-5">
           <form id="formFiles" enctype="multipart/form-data">
               <input type="number" name="expediente_id" value="{{ $audienciaid }}" id="expediente_id" hidden>
              <div class="mb-3">
                 <label for="formFile" class="form-label">Subir archivos</label>
                 <input class="form-control" type="file" name="file" id="file">
               </div>

              <div class="mt-3">
                 <select class="form-select form-select-sm" name="tipo_archivo" id="tipo_archivo">
                    <option selected>Seleccione tipo de archivo</option>
                    <option value="pdf">PDF</option>
                    <option value="img">Imagen</option>
                    <option value="video">Video</option>
                    <option value="audio">Audio</option>  
                  </select>
              </div>

              <div class="mt-3">
                 <button type="submit" class="btn btn-primary">Subir</button>
              </div>
           </form>
        </div>
     </div>
</div> 