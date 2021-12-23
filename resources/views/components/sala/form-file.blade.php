<div>
    <div class="row mt-2">
        <div class="col-5">
           <form id="formFiles" enctype="multipart/form-data" method="POST">
               <input type="number" name="expediente_id" value="{{ $audienciaid }}" id="expediente_id" hidden>
              <div class="mb-3">
                 <label for="formFile" class="form-label">Subir archivos</label>
                 <input class="form-control" type="file" name="file" id="file">
               </div>

              <div class="mt-3">
                 <select class="form-select form-select-sm" name="tipo_archivo" id="tipo_archivo">
                    <option selected>Seleccione tipo de archivo</option>
                    <option value="pdf">PDF</option>
                    <option value="imagen">Imagen</option>
                    <option value="video">Video</option>
                    <option value="audio">Audio</option>  
                    <option value="doc">Documento de Word</option>  
                  </select>
              </div>

              <div class="mt-3 d-flex">
                 <button type="submit" class="btn btn-primary">Subir</button>
                 <div id="spinner-file"></div> {{-- Muestra el spinner de carga --}}
              </div>
           </form>
        </div>

        <div class="col-7">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                    <th scope="col">Archivos</th>
                    <th scope="col"></th>
               
                  </tr>
                </thead>

                <tbody id="tableListFiles">

                </tbody>
            </table>
          </div>
        </div>
     </div>
</div> 