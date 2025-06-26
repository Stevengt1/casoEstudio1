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
                window.location.href = "Practica2.html";
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


document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#formularioUsuario");
    const resultado = document.querySelector("#tablaUsuariosCarro");
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const nombre = document.getElementById("nomCliente").value;
        const placa = document.getElementById("numPlacaCarro").value;
        const fechaIngreso = document.getElementById("fechaIngresoCarro").value;
        const tipoServicio = document.getElementById("tipoServicio").value;

        const nuevaFila = document.createElement("tr");
        nuevaFila.innerHTML = `
            <td>${nombre}</td>
            <td>${placa}</td>
            <td>${fechaIngreso}</td>
            <td>${tipoServicio}</td>
        `;
        resultado.appendChild(nuevaFila);
        form.reset();
    });
});
