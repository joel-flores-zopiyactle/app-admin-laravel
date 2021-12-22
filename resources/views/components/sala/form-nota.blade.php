<div class="row mt-2">
    <div class="col-5">
       <form class="py-5" id="formNote">
          <div>
             <textarea name="nota" class="form-control" rows="2" placeholder="Nota"></textarea>
          </div>

          <div class="mt-3">
             <select class="form-select form-select-sm" name="participante_id">
                <option selected>Seleccione el participante</option>
                @foreach ($participantes as $participante)
                  <option value="{{ $participante->id }}">{{ $participante->nombre }}</option>
                @endforeach  
              </select>
          </div>

          <div class="mb-3 mt-3 form-check">
             <input type="checkbox" class="form-check-input" name="visibilidad" id="visibilidad">
             <label class="form-check-label" for="visibilidad">Privado</label>
           </div>

          <div class="mt-3">
             <button type="submit" class="btn btn-sm btn-primary">Agregar nota</button>
          </div>
       </form>
    </div>
    {{-- Lista de notas --}}
    <div class="col-7">
       <table class="table table-striped">
          <thead class="table-primary">
            <tr>
              <th scope="col">Nota</th>
            </tr>
          </thead>
          <tbody id="lista-notas">
                          
          </tbody>
        </table>
    </div>
 </div>