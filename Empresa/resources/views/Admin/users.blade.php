<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('panel/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('panel/assets/img/favicon.png') }}">
  <title>Gestión de Usuarios</title>
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <link href="{{ asset('panel/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('panel/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('panel/assets/css/soft-ui-dashboard.css?v=1.1.0') }}" rel="stylesheet" />

  <!-- 🧁 SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
              <h6>Usuarios</h6>
              <a href="javascript:;" class="btn btn-sm btn-primary" id="btnAgregar" data-bs-toggle="modal" data-bs-target="#modalUsuario">
                + Agregar usuario
              </a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th>Usuario</th>
                      <th>Rol</th>
                      <th class="text-center">Estado</th>
                      <th class="text-center">Fecha de Ingreso</th>
                      <th class="text-center">Asignar Dispositivo</th>
                      <th class="text-center">Carta Poder</th>
                      <th class="text-center">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('panel/assets/img/default-avatar.png') }}" class="avatar avatar-sm me-3" alt="user-avatar">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ ucfirst($user->role) }}</p>
                        <p class="text-xs text-secondary mb-0">{{ $user->department ?? '—' }}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        @if($user->active)
                          <span class="badge bg-gradient-success">ACTIVO</span>
                        @else
                          <span class="badge bg-gradient-secondary">INACTIVO</span>
                        @endif
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">
                          {{ $user->hired_at ? \Carbon\Carbon::parse($user->hired_at)->format('d/m/Y') : '—' }}
                        </span>
                      </td>
                      <td class="align-middle text-center">
                        @if($user->dispositivo_id)
                          <span class="badge bg-gradient-success">Asignado</span>
                        @else
                          <a href="javascript:;" 
                             class="text-secondary font-weight-bold text-xs btnAsignar"
                             data-id="{{ $user->id }}">
                             Asignar
                          </a>
                        @endif
                      </td>
                      <td class="align-middle text-center">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs">Generar</a>
                      </td>
                      <td class="align-middle text-center">
                        <a href="javascript:;" 
                           class="text-secondary font-weight-bold text-xs me-3 btnEditar"
                           data-id="{{ $user->id }}"
                           data-name="{{ $user->name }}"
                           data-email="{{ $user->email }}"
                           data-role="{{ $user->role }}"
                           data-department="{{ $user->department }}"
                           data-active="{{ $user->active }}"
                           data-hired_at="{{ $user->hired_at }}">
                           Editar
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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

      <!-- Modal Agregar/Editar Usuario -->
      <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalUsuarioLabel">Agregar nuevo usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <form id="formUsuario" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="inputMetodo" value="POST">

                <div class="mb-3">
                  <label class="form-label">Nombre completo</label>
                  <input type="text" class="form-control" name="name" id="name" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Correo electrónico</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Rol</label>
                  <select class="form-control" name="role" id="role" required>
                    <option value="">Seleccionar...</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Programador">Programador</option>
                    <option value="Ejecutivo">Ejecutivo</option>
                    <option value="Soporte">Soporte</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label">Departamento</label>
                  <input type="text" class="form-control" name="department" id="department">
                </div>

                <div class="mb-3">
                  <label class="form-label">Estado</label>
                  <select class="form-control" name="active" id="active" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label">Fecha de ingreso</label>
                  <input type="date" class="form-control" name="hired_at" id="hired_at">
                </div>

                <div class="mb-3">
                  <label class="form-label">Contraseña</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="••••••" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Avatar (opcional)</label>
                  <input type="file" class="form-control" name="avatar" id="avatar" accept="image/*">
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

      <!-- Modal Asignar Dispositivo -->
      <div class="modal fade" id="modalAsignar" tabindex="-1" aria-labelledby="modalAsignarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalAsignarLabel">Asignar dispositivo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <form id="formAsignar" method="POST" action="{{ route('dispositivos.asignar') }}">
                @csrf
                <input type="hidden" name="usuario_id" id="asignar_usuario_id">

                <div class="mb-3">
                  <label class="form-label">Seleccionar dispositivo</label>
                  <select class="form-control" name="dispositivo_id" id="dispositivo_id" required>
                    <option value="">Seleccionar...</option>
                    @foreach($dispositivos as $dispositivo)
                      @if($dispositivo->usuario_id === null)
                        <option value="{{ $dispositivo->id }}">{{ $dispositivo->tipo }} - {{ $dispositivo->marca }} ({{ $dispositivo->numero_serie }})</option>
                      @endif
                    @endforeach
                  </select>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Asignar</button>
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
    // ➕ Modal Agregar Usuario
    document.getElementById('btnAgregar').addEventListener('click', function() {
      document.getElementById('modalUsuarioLabel').textContent = 'Agregar nuevo usuario';
      document.getElementById('formUsuario').action = '{{ route("users.store") }}';
      document.getElementById('inputMetodo').value = 'POST';
      document.getElementById('formUsuario').reset();
      document.getElementById('password').required = true;
    });

    // ✏️ Modal Editar Usuario
    document.querySelectorAll('.btnEditar').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.dataset.id;
        document.getElementById('modalUsuarioLabel').textContent = 'Editar usuario';
        document.getElementById('formUsuario').action = '/users/' + id;
        document.getElementById('inputMetodo').value = 'PUT';

        document.getElementById('name').value = this.dataset.name;
        document.getElementById('email').value = this.dataset.email;
        document.getElementById('role').value = this.dataset.role;
        document.getElementById('department').value = this.dataset.department ?? '';
        document.getElementById('active').value = this.dataset.active;
        document.getElementById('hired_at').value = this.dataset.hired_at ? this.dataset.hired_at.split(' ')[0] : '';
        document.getElementById('password').value = '';
        document.getElementById('password').required = false;

        new bootstrap.Modal(document.getElementById('modalUsuario')).show();
      });
    });

    // 📱 Modal Asignar Dispositivo
    let currentBtn = null;

    document.querySelectorAll('.btnAsignar').forEach(btn => {
      btn.addEventListener('click', function() {
        currentBtn = this;
        const userId = this.dataset.id;
        document.getElementById('asignar_usuario_id').value = userId;
        new bootstrap.Modal(document.getElementById('modalAsignar')).show();
      });
    });

    // ✅ Cuando se asigne dispositivo
    document.getElementById('formAsignar').addEventListener('submit', function(e) {
      e.preventDefault();

      const form = this;
      const formData = new FormData(form);
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      fetch(form.action, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken },
        body: formData
      })
      .then(res => {
        if (!res.ok) throw new Error('Error en la solicitud');
        return res.text();
      })
      .then(() => {
        // Cambiar texto "Asignar" a badge verde "Asignado"
        const badge = document.createElement('span');
        badge.className = 'badge bg-gradient-success';
        badge.textContent = 'Asignado';
        currentBtn.replaceWith(badge);

        // Cerrar modal
        bootstrap.Modal.getInstance(document.getElementById('modalAsignar')).hide();

        // 💚 SweetAlert de éxito
        Swal.fire({
          icon: 'success',
          title: '¡Dispositivo asignado!',
          text: 'El dispositivo fue asignado correctamente.',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar'
        });
      })
      .catch(() => {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo un problema al asignar el dispositivo.',
          confirmButtonColor: '#d33'
        });
      });
    });
  </script>

  <script src="{{ asset('panel/assets/js/soft-ui-dashboard.min.js?v=1.1.0') }}"></script>
</body>
</html>
