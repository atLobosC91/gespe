/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector("#sidebarToggle");
  if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener("click", (event) => {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        document.body.classList.contains("sb-sidenav-toggled")
      );
    });
  }
});

// Seleccionar todos los botones de "Ver" y agregar un listener
document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM completamente cargado y analizado");

  // Seleccionar todos los botones de "Ver" y agregar un listener
  document.querySelectorAll(".verPermiso").forEach((button) => {
    button.addEventListener("click", function () {
      // Obtener los datos de la solicitud desde el atributo data-permiso
      const permiso = JSON.parse(this.getAttribute("data-permiso"));

      // Llenar los detalles en el bloque correspondiente
      document.getElementById("detalleId").textContent = permiso.id_solicitud;
      document.getElementById("detalleTipoPermiso").textContent =
        permiso.id_permiso;
      document.getElementById("detalleFechaInicio").textContent =
        permiso.fecha_hora_inicio;
      document.getElementById("detalleFechaFin").textContent =
        permiso.fecha_hora_fin;
      document.getElementById("detalleEstado").textContent =
        permiso.estado_solicitud;
      document.getElementById("detalleMotivo").textContent =
        permiso.motivo || "Sin Motivo";

      // Mostrar el bloque de detalles
      document.getElementById("detallesPermiso").style.display = "block";
    });
  });
});



