<h3 class="h5 mt-3">Agregar Notas</h3>
<hr>
<div class="row p-2 bg-white shadow mt-3 borders">
    <div class="col-5">
       <form class="mb-4" id="formNote">
          <input type="text" name="expediente_id" id="expediente_id" required hidden value="{{ $audienciaid }}" />
          <div>
             <textarea name="nota" id="nota" class="form-control" rows="2" placeholder="Ingrese su Nota..." minlength="4" required></textarea>
          </div>

          <div class="mb-3 mt-3 form-check">
             <input type="checkbox" class="form-check-input" name="visibilidad" id="visibilidad">
             <label class="form-check-label" id="visibilidad_label" for="visibilidad">Privado</label>
           </div>

          <div class="mt-3 d-flex">
             <button type="submit" class="btn btn-sm btn-primary">Agregar nota</button>
             <div id="spinner-note"></div> {{-- Muestra el spinner de carga --}}
          </div>

         

       </form>
    </div>
    {{-- Lista de notas --}}
    <div class="col-7">
       <table class="table table-striped">
          <thead class="table-primary">
            <tr>
              <th scope="col">Nota</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody id="lista-notas">
                          
          </tbody>
        </table>
    </div>
 </div>