var peticion;
document.addEventListener("readystatechange", cargarEventos, false);
function cargarEventos(evento) {
    if(document.readyState == "interactive"){
       
        document.getElementById("enviar").addEventListener("click", enviar_recibir, false);
    }  
}

function enviar_recibir(evento){

    evento.preventDefault();
    evento.stopPropagation();

    var myObj = {
        correo: document.getElementById("id_correo").value, 
        contra: document.getElementById("id_contr").value
    };
    var cadena = JSON.stringify(myObj);
    
    peticion = new XMLHttpRequest();
    peticion.onreadystatechange = function () {
        
        if( this.readyState == 4 && this.status == 200){
            debugger;
            var recog = this.responseText;

            if(recog == 3){
               crearCookie(document.getElementById("id_correo").value);
                location.href ="index.html";
            }else if(recog == 0){
                document.getElementById("datos").innerHTML = "la contraseña es incorrecta";
            }else{
                document.getElementById("datos").innerHTML = "el usuario es incorrecto";
            }
        }
    }
        
    peticion.open("GET", "inicio_sesion.php?x="+cadena, true);
    ///si fuera con  metodo POST los datos se envian en la cadena, es decir, peticion.send(cadena);
    peticion.send(null);
}
function crearCookie(nombre){
    localStorage.setItem("correo",nombre);
}