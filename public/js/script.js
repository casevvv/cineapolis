const body = document.querySelector("body");
const darkLight = document.querySelector("#darkLight");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
const sidebarClose = document.querySelector(".collapse_sidebar");
const sidebarExpand = document.querySelector(".expand_sidebar");
sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

/*--*/
function ajustarTamañoDiv() {
  const redDiv = document.querySelector(".red_div");
  // Obtener el ancho actual del sidebar
  const sidebarWidth = window.getComputedStyle(sidebar).getPropertyValue("width");
  // Establecer el ancho del sidebar como el valor del left del div rojo
  redDiv.style.transition = "left 0.5s ease"; // Agregar transición
  redDiv.style.left = sidebar.classList.contains("close") ? "80px" : sidebarWidth;
}

// Ajustar el tamaño del div rojo cuando se fije o se cierre la barra lateral
sidebar.addEventListener("click", ajustarTamañoDiv);
window.addEventListener("resize", ajustarTamañoDiv);
window.addEventListener("load", ajustarTamañoDiv);
/*--*/


sidebarClose.addEventListener("click", () => {
  sidebar.classList.add("close", "hoverable");
});
sidebarExpand.addEventListener("click", () => {
  sidebar.classList.remove("close", "hoverable");
});

sidebar.addEventListener("mouseenter", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.remove("close");
  }
});
sidebar.addEventListener("mouseleave", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.add("close");
  }
});

darkLight.addEventListener("click", () => {
  body.classList.toggle("dark");
  if (body.classList.contains("dark")) {
    document.setI;
    darkLight.classList.replace("bx-sun", "bx-moon");
  } else {
    darkLight.classList.replace("bx-moon", "bx-sun");
  }
});

submenuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    item.classList.toggle("show_submenu");
    submenuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show_submenu");
      }
    });
  });
});

if (window.innerWidth < 768) {
  sidebar.classList.add("close");
} else {
  sidebar.classList.remove("close");
}



//--------------------------------//
function modalEdit(evento) {
  console.log("funciona")
  var idtabla = $(evento.target).parents("tr").find("td").eq(0).text().trim();
  var nombretabla = $(evento.target).parents("tr").find("td").eq(1).text().trim();
  var descripciontabla = $(evento.target).parents("tr").find("td").eq(2).text().trim();
  var imagentabla = $(evento.target).parents("tr").find("td").eq(3).find("img").attr("src").trim(); // Obtener la ruta de la imagen
  var salatabla = $(evento.target).parents("tr").find("td").eq(4).text().trim();
  var estadotabla = $(evento.target).parents("tr").find("td").eq(5).text().trim(); // Se cambia el índice al 5 para obtener el campo de estado

  // Convertir el valor del estado de la tabla a un texto legible
  var estadoLegible = estadotabla === 'Activo' ? '1' : '0'; // Si es 'Activo', asignar '1', de lo contrario, asignar '0'

  // Llenar los campos del formulario de edición con los valores obtenidos
  $("#idedit").val(idtabla);
  $("#nombreedit").val(nombretabla);
  $("#descripcionedit").val(descripciontabla);
  $("#salaedit").val(salatabla);
  

  // Establecer el estado seleccionado
  $("#estadoedit").val(estadoLegible);

  // Mostrar la vista previa de la imagen
  mostrarVistaPreviaEdicion(imagentabla);
}


function mostrarVistaPreviaEdicion(imagentabla) {
  var vistaPrevia = document.getElementById('vistaPreviaImagenEdit');

  if (imagentabla) {
    vistaPrevia.src = imagentabla;
    vistaPrevia.style.display = 'block'; // Mostrar la imagen
  } else {
    vistaPrevia.src = '#';
    vistaPrevia.style.display = 'none'; // Ocultar la imagen
  }
}

function vistaPreviaEdicion() {
  var archivoSeleccionado = document.getElementById('imagenedit').files[0];
  var vistaPrevia = document.getElementById('vistaPreviaImagenEdit');

  if (archivoSeleccionado) {
    var lector = new FileReader();

    lector.onload = function(event) {
      vistaPrevia.src = event.target.result;
      vistaPrevia.style.display = 'block';
    };

    lector.readAsDataURL(archivoSeleccionado);
  } else {
    vistaPrevia.src = '#';
    vistaPrevia.style.display = 'none';
  }
}



function activarboton(event) {
  $("#idedit").prop("disabled", false);
}


//--------------------------//
function vistaPreviaRegistro() {
  var input = document.getElementById('formFileMultiple');
  var vistaPrevia = document.getElementById('imagenPrevia');

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      vistaPrevia.src = e.target.result;
      vistaPrevia.style.display = 'block';
    }

    reader.readAsDataURL(input.files[0]);
  }
}

document.getElementById('formFileMultiple').addEventListener('change', function() {
  vistaPreviaRegistro();
});



//--------------------------//
//sweetaler2 de registrar 
document.getElementById('formregistrar').addEventListener('submit', function(event) {
  event.preventDefault();

  // Obtener el formulario y los datos del mismo
  const form = event.target;
  const formData = new FormData(form);

  // Hacer una solicitud POST al endpoint de Laravel
  axios.post('/guardar-pelicula', formData)
      .then(function(response) {
          // Mostrar una alerta SweetAlert2 si la película se guardó correctamente
          Swal.fire({
              title: 'Éxito',
              text: response.data.message,
              icon: 'success',
              confirmButtonText: 'Aceptar'
          }).then((result) => {
              if (result.isConfirmed) {
                  location.href = "/"; // Redireccionar a la página de películas
              }
          });
      })
      .catch(function(error) {
          // Manejar errores
          console.error('Error al guardar la película:', error);
          Swal.fire({
              title: 'Error',
              text: 'Error al guardar la película.',
              icon: 'error',
              confirmButtonText: 'Aceptar'
          });
      });
});

//sweetaler2 edit 
document.getElementById('formedit').addEventListener('submit', function(event) {
  event.preventDefault();

  // Obtener el formulario y los datos del mismo
  const form = event.target;
  const formData = new FormData(form);

  // Hacer una solicitud POST al endpoint de Laravel
  axios.post(form.action, formData)
      .then(function(response) {
          // Mostrar una alerta SweetAlert2 si la película se actualizó correctamente
          Swal.fire({
              title: 'Éxito',
              text: response.data.message,
              icon: 'success',
              confirmButtonText: 'Aceptar'
          }).then((result) => {
              if (result.isConfirmed) {
                  location.href = "/"; // Redireccionar a la página de películas
              }
          });
      })
      .catch(function(error) {
          // Manejar errores
          console.error('Error al actualizar la película:', error);
          Swal.fire({
              title: 'Error',
              text: 'Error al actualizar la película.',
              icon: 'error',
              confirmButtonText: 'Aceptar'
          });
      });
});

//-------------------------//
