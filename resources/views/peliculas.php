<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Boxicons CSS -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Dashboard</title>
  <!-- Enlace al archivo CSS de Bootstrap -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Enlace a tu archivo de estilos personalizado -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <!-- Icono del sitio -->
  <link rel="icon" href="{{ asset('img/cinepolislogo.ico') }}" type="image/x-icon">
</head>


<body>
  <!-- navbar -->
  <nav class="navbar">
    <div class="logo_item">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <img src="{{ asset('img/cinepolislogo.png') }}" alt=""></i>CinePolis
    </div>
    <div class="navbar_content">
      <i class="bi bi-grid"></i>
      <i class='bx bx-sun' id="darkLight"></i>
    </div>
  </nav>

  <!-- sidebar -->
  <nav class="sidebar">
    <div class="menu_content">
      <ul class="menu_items">
        <div class="menu_title menu_dahsboard"></div>
        <!-- duplicate or remove this li tag if you want to add or remove navlink with submenu -->
        <!-- start -->
        <li class="item">
          <div href="#" class="nav_link submenu_item">
            <span class="navlink_icon">
              <i class="bx bx-home-alt"></i>
            </span>
            <span class="navlink">Peliculas</span>
          </div>
        </li>
        <!-- end -->

        <!-- Sidebar Open / Close -->
        <div class="bottom_content">
          <div class="bottom expand_sidebar">
            <span> Fijar</span>
            <i class='bx bx-log-in'></i>
          </div>
          <div class="bottom collapse_sidebar">
            <span> Cerrar</span>
            <i class='bx bx-log-out'></i>
          </div>
        </div>
    </div>
  </nav>




  <div class="red_div">
    <div class="arriba">
      <div class="arriba1" style="margin-left:10px;">
      </div>
      <div class="arriba1">
        <h1>PELICULAS</h1>
      </div>
      <div class="arriba1">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#RegistrarUsuario">
          Registrar Pelicula
        </button>
      </div>
    </div>

    <div class="abajo">
      <div class="table-container">
        <table class="tabla_registro">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Imágenes</th>
              <th>Sala</th>
              <th>Estado</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            @foreach($peliculas as $pelicula)
            <tr>
              <td>{{ $pelicula->id }}</td>
              <td>{{ $pelicula->nombre }}</td>
              <td>{{ $pelicula->descripcion }}</td>
              <td>
                <!-- Mostrar la imagen aquí -->
                <img src="data:image/jpeg;base64,{{ $pelicula->imagen }}" alt="Imagen de la película" style="max-width: 100px;">
              </td>
              <td>{{ $pelicula->sala }}</td>
              <td>
                @if($pelicula->estado == 1)
                <span style="color: green;">Activo</span>
                @else
                <span style="color: red;">Inactivo</span>
                @endif
              </td>
              <td>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#EdtiarUsuario" onclick="modalEdit(event);"><i class="fas fa-pencil-alt"></i></button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Registro-->
  <div class="modal fade" id="RegistrarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Registrar Pelicula</h5>
          <button type="button" class="close" id="cerrarmodal" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('guardar_pelicula') }}" enctype="multipart/form-data" id="formregistrar">
            @csrf
            <div class="form-group">
              <label for="nombre">Nombre:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" required autocomplete="off">
            </div>
            <br>
            <div class="form-group">
              <label for="descripcion">Descripción:</label>
              <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <br>
            <div class="form-group">
              <label for="nombre">Sala:</label>
              <select name="sala" id="sala" class="form-control" required>
                <option value="" disabled selected>Selecione una opcion</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="estado">Estado:</label>
              <select name="estado" id="estado" class="form-control" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="imagen">Imagen:</label>
              <div class="mb-3 d-flex justify-content-center align-items-center flex-column">
                <input class="form-control" type="file" id="formFileMultiple" name="imagen" multiple required onchange="vistaPreviaRegistro()">
                <br>
                <div class="text-center mt-2">
                  <img id="imagenPrevia" src="#" alt="Vista previa de la imagen" style="max-width: 200px; max-height: 200px; display: none;">
                </div>
              </div>
            </div>

            <!-- Botón de guardar dentro del formulario -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal edit -->
  <div class="modal fade" id="EdtiarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Pelicula</h5>
          <button type="button" class="close" id="cerrarmodal" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('actualizar_pelicula') }}" enctype="multipart/form-data" id="formedit">
            @csrf
            <div class="form-group">
              <label for="nombre">Id:</label>
              <input type="text" class="form-control" id="idedit" name="idedit" required disabled>
            </div>
            <br>
            <div class="form-group">
              <label for="nombre">Nombre:</label>
              <input type="text" class="form-control" id="nombreedit" name="nombreedit" required>
            </div>
            <br>
            <div class="form-group">
              <label for="descripcion">Descripción:</label>
              <textarea class="form-control" id="descripcionedit" name="descripcionedit" required></textarea>
            </div>
            <br>
            <div class="form-group">
              <label for="nombre">Sala:</label>
              <select name="salaedit" id="salaedit" class="form-control" required>
                <option value="" disabled selected>Selecione una opcion</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="estado">Estado:</label>
              <select name="estadoedit" id="estadoedit" class="form-control" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="imagenedit">Imagen:</label>
              <div class="mb-3" style="position: relative;">
                <input class="form-control" type="file" id="imagenedit" name="imagenedit" multiple onchange="vistaPreviaEdicion()">
                <!-- Mostrar la vista previa de la imagen aquí -->
                <br>
                <div class="text-center mt-2">
                  <img id="vistaPreviaImagenEdit" src="#" alt="Vista previa de la imagen" style="max-width: 200px; max-height: 200px; display: none; margin: auto;">
                </div>
              </div>
            </div>
            <!-- Botón de guardar dentro del formulario -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" name="edit" id="edit" class="btn btn-primary" onclick="activarboton(event);">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <!-- SweetAlert2 JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Bootstrap JavaScript -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <!-- Tu propio script -->
  <script src="{{ asset('js/script.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.js"></script>

</html>