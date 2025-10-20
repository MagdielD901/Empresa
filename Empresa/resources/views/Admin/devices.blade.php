<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('panel/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('panel/assets/img/favicon.png') }}">
  <title>Gestión de Dispositivos</title>
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <link href="{{ asset('panel/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('panel/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('panel/assets/css/soft-ui-dashboard.css?v=1.1.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('layouts.aside')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layouts.navbar')

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
              <h6>Dispositivos</h6>
              <a href="javascript:;" class="btn btn-sm btn-primary" id="btnAgregar" data-bs-toggle="modal" data-bs-target="#modalDispositivo">
                + Agregar dispositivo
              </a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tipo</th>
                      <th>Marca</th>
                      <th>Modelo</th>
                      <th>Número de Serie</th>
                      <th>Estado</th>
                      <th class="text-center">Asignado a</th>
                      <th class="text-center">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($dispositivos as $dispositivo)
                    <tr>
                      <td>{{ $dispositivo->id }}</td>
                      <td>{{ $dispositivo->tipo }}</td>
                      <td>{{ $dispositivo->marca }}</td>
                      <td>{{ $dispositivo->modelo }}</td>
                      <td>{{ $dispositivo->numero_serie }}</td>

                      <td>
                        @if($dispositivo->estado == 'Disponible')
                          <span class="badge bg-gradient-success">Disponible</span>
                        @elseif($dispositivo->estado == 'En uso')
                          <span class="badge bg-gradient-warning">En uso</span>
                        @else
                          <span class="badge bg-gradient-danger">{{ $dispositivo->estado }}</span>
                        @endif
                      </td>

                      <td class="text-center">{{ $dispositivo->usuario?->name ?? 'No asignado' }}</td>

                      <td class="text-center">
                        <a href="javascript:;" 
                           class="text-secondary font-weight-bold text-xs me-3 btnEditar"
                           data-id="{{ $dispositivo->id }}"
                           data-tipo="{{ $dispositivo->tipo }}"
                           data-marca="{{ $dispositivo->marca }}"
                           data-modelo="{{ $dispositivo->modelo }}"
                           data-numero_serie="{{ $dispositivo->numero_serie }}"
                           data-estado="{{ $dispositivo->estado }}">
                           Editar
                        </a>

                        <form action="{{ route('dispositivos.destroy', $dispositivo->id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-link text-danger font-weight-bold text-xs p-0 m-0">Eliminar</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Agregar/Editar Dispositivo -->
      <div class="modal fade" id="modalDispositivo" tabindex="-1" aria-labelledby="modalDispositivoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalDispositivoLabel">Agregar nuevo dispositivo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <form id="formDispositivo" method="POST" action="{{ route('dispositivos.store') }}">
                @csrf
                <input type="hidden" name="_method" id="inputMetodo" value="POST">

                <div class="mb-3">
                  <label class="form-label">Tipo</label>
                  <select class="form-control" name="tipo" id="tipo" required>
                    <option value="">Seleccionar...</option>
                    <option value="Tablet">Tablet</option>
                    <option value="Teléfono">Teléfono</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label">Marca</label>
                  <input type="text" class="form-control" name="marca" id="marca" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Modelo</label>
                  <input type="text" class="form-control" name="modelo" id="modelo" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Número de serie</label>
                  <input type="text" class="form-control" name="numero_serie" id="numero_serie" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Estado</label>
                  <select class="form-control" name="estado" id="estado" required>
                    <option value="Disponible">Disponible</option>
                    <option value="En uso">En uso</option>
                    <option value="Dañado">Dañado</option>
                  </select>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      @include('layouts.footer')
    </div>
  </main>

  @include('layouts.configuration')

  <script src="{{ asset('panel/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('panel/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('panel/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('panel/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

  <script>
    // Resetea el modal para agregar
    document.getElementById('btnAgregar').addEventListener('click', function() {
      document.getElementById('modalDispositivoLabel').textContent = 'Agregar nuevo dispositivo';
      document.getElementById('formDispositivo').action = '{{ route("dispositivos.store") }}';
      document.getElementById('inputMetodo').value = 'POST';
      document.getElementById('formDispositivo').reset();
    });

    // Abre modal para editar
    document.querySelectorAll('.btnEditar').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.dataset.id;
        document.getElementById('modalDispositivoLabel').textContent = 'Editar dispositivo';
        document.getElementById('formDispositivo').action = '/devices/' + id;
        document.getElementById('inputMetodo').value = 'PUT';

        document.getElementById('tipo').value = this.dataset.tipo;
        document.getElementById('marca').value = this.dataset.marca;
        document.getElementById('modelo').value = this.dataset.modelo;
        document.getElementById('numero_serie').value = this.dataset.numero_serie;
        document.getElementById('estado').value = this.dataset.estado;

        new bootstrap.Modal(document.getElementById('modalDispositivo')).show();
      });
    });
  </script>

  <script src="{{ asset('panel/assets/js/soft-ui-dashboard.min.js?v=1.1.0') }}"></script>
</body>
</html>
