// Usuarios registrados para el test de inicio de sesión
const usuariosRegistrados = [
    { usuario: "pollito1", contrasena: "123" },
    { usuario: "pollito2", contrasena: "456" },
    { usuario: "pollito3", contrasena: "789" },
    { usuario: "pollito4", contrasena: "111" }
];

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formularioInicioSesionUsuario");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const usuarioInput = document.getElementById("usuario").value;
        const contrasenaInput = document.getElementById("contrasena").value;

        const usuarioValido = usuariosRegistrados.find(user =>
            user.usuario === usuarioInput && user.contrasena === contrasenaInput
        );

        if (usuarioValido) {
            Swal.fire({
                icon: "success",
                title: "¡Bienvenido!",
                text: `Hola, ${usuarioInput}`,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "http://localhost/casoEstudio1/Solicitud_Servicio.php";
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                    text: "Usuario o contraseña incorrectos"
                });
            }
        });
        
});

// Lectura y escritura de órdenes de servicio
document.addEventListener("DOMContentLoaded", () => {

  const formulario = document.getElementById("formularioUsuario");
  const tabla = document.getElementById("tablaOrdenesServicio").getElementsByTagName("tbody")[0];
  const modal = new bootstrap.Modal(document.getElementById("modalFormularioCliente"));

  function agregarFila(orden) {
    const tr = document.createElement("tr");

    const hoy = new Date();
    const ingreso = new Date(orden.fechaIngreso);
    let clase = "";
    const diffDias = Math.floor((hoy - ingreso) / (1000 * 60 * 60 * 24));
    if (diffDias > 7) clase = "table-warning";
    if (orden.estadoPago.toLowerCase() === "no") clase = "table-danger";

    if (clase) tr.classList.add(clase);

    tr.innerHTML = `
      <td>${orden.nombreCliente}</td>
      <td>${orden.placaCarro}</td>
      <td>${orden.fechaIngreso}</td>
      <td>${orden.tipoServicio}</td>
      <td>${orden.estadoPago}</td>
      <td>${orden.fechaFinalizacion || ''}</td>
    `;
    tabla.appendChild(tr);
  }

  // Cargar órdenes de localStorage al cargar página
  const ordenesLS = JSON.parse(localStorage.getItem("ordenes")) || [];
  ordenesLS.forEach(agregarFila);

  formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    const nombre = document.getElementById("nomCliente").value.trim();
    const placa = document.getElementById("placaCarro").value.trim();
    const ingreso = document.getElementById("fechaIngresoCarro").value;
    const tipo = document.getElementById("tipoServicio").value;
    const estadoServicio = document.getElementById("estadoServicioCarro").value; 
    const pago = document.getElementById("estadoPagoServicio").value;
    const fechaFinal = document.getElementById("fechaFinalizacion").value;

    if (nombre && placa && ingreso && tipo && pago && fechaFinal) {
      const nuevaOrden = {
        nombreCliente: nombre,
        placaCarro: placa,
        fechaIngreso: ingreso,
        tipoServicio: tipo,
        estadoServicio: estadoServicio,
        estadoPago: pago,
        fechaFinalizacion: fechaFinal
      };

      // Guardar en localStorage
      ordenesLS.push(nuevaOrden);
      localStorage.setItem("ordenes", JSON.stringify(ordenesLS));

      // Agregar fila a tabla
      agregarFila(nuevaOrden);

      // Mostrar alerta
      Swal.fire({
        icon: "success",
        title: "Orden guardada",
        text: "La orden se ha guardado correctamente.",
        timer: 1500,
        showConfirmButton: false
      });

      // Cerrar modal
      modal.hide();

      // Limpiar formulario
      formulario.reset();
    } else {
      Swal.fire({
        icon: "warning",
        title: "Advertencia",
        text: "Por favor, complete todos los campos."
      });
    }
  });

});
