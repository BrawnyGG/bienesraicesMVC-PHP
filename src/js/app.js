document.addEventListener("DOMContentLoaded", function(){
    eventListeners();
})

function eventListeners(){
    menuMobile();
    darkMode();
    contactoCondicional();
    viewPassword();
}

function menuMobile(){
    const icono = document.querySelector(".menu-mobile");
    icono.addEventListener("click", function(){
        const navegacion = document.querySelector(".navegacion");
        
        navegacion.classList.toggle("mostrar");
    })
}

function darkMode(){
    const preferenciasSistema = window.matchMedia("(prefers-color-scheme:dark)");

    if (preferenciasSistema.matches){
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode");
    }
    //console.log(preferenciasSistema.matches)
    preferenciasSistema.addEventListener("change", function(){
        if (preferenciasSistema.matches){
            document.body.classList.add("dark-mode");
        } else {
            document.body.classList.remove("dark-mode");
        }
    })

    const botonDarkMode = document.querySelector(".icono-darkmode")
    botonDarkMode.addEventListener("click",function(){
        document.body.classList.toggle("dark-mode");
    })
}
function contactoCondicional(){
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function mostrarMetodosContacto(e){
    const divContacto = document.querySelector('#contacto');
    const input = e.target.value;
    
    if(input === "Telefono"){
        divContacto.innerHTML =  `
                <input type="tel" id="telefono" placeholder="Tu teléfono (10 digitos)"
                name="contacto[telefono]" required>
                <p>Eliga la fecha y hora para ser contactado:</p>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="contacto[fecha]" required>
                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="9:00" max="18:00" name="contacto[hora]" required>
        `;
    } else if(input === "Email"){
        divContacto.innerHTML =  `
                <input type="email" id="email" placeholder="Tu correo electrónico"
                name="contacto[email]" required>
        `;
    }
}

function viewPassword(){
    const icono = document.querySelector('.contrasena-campo svg');
    const input = document.querySelector('.contrasena-campo input');
    icono.onclick = function(){
        if (input.type == 'password'){
            input.type = 'text';
        } else {
            input.type ='password';
        }
    }
}