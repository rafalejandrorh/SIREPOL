{{-- Modal editar rol --}}
<div class="modal fade" id="editar_password{{$persona->id}}" tabindex="-1" aria-labelledby="editar_ingreso" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
          <div class="modal-header bg-info">
              <a  class="unread label theme-bg4 text-white f-20 col-sm-12" >Editar Contraseña
              <span aria-hidden="true" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</span>
              </a>
          </div>
          {!! Form::model($persona, ['route' => ['persons.update', $persona->id], 'method' => 'PUT']) !!}
          <div class="modal-body">
              @include('persons.partials.form.f_pass')
          </div>
          
          <div class="modal-footer">
              {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
          </div>
          {!! Form::close() !!}
    </div>
  </div>
</div>
