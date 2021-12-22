<div>
    <div class="row mt-2">
        <div class="col-5">
           <form action="#" id="formFiles">
              <div class="mb-3">
                 <label for="formFile" class="form-label">Subir archivos</label>
                 <input class="form-control" type="file" name="file" id="formFile">
               </div>

               <div class="mt-3">
                 <select class="form-select form-select-sm" name="participante_id">
                    <option selected>Seleccione el participante</option>
                    @foreach ($participantes as $participante)
                      <option value="{{ $participante->id }}">{{ $participante->nombre }}</option>
                    @endforeach  
                  </select>
              </div>

              <div class="mt-3">
                 <select class="form-select form-select-sm" name="tipo_archivo">
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