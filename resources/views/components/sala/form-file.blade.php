<div>

   <h3 class="h5 mt-3">Subir archivo</h3>
   <hr>

   <input type="text" name="expediente_id" id="expediente_id" required hidden value="{{ $audienciaid }}" />
   <div>
      {{-- Componente de vue js --}}
      <form-file>
   </div>

    {{-- <div class="row mt-2">
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
                 <div id="spinner-file"></div>
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
     </div> --}}
</div> 