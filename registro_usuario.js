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
        usuario: document.getElementById("id_usu").value, 
        contra: document.getElementById("id_contr").value,
        dni: document.getElementById("id_dni").value
    };
    var cadena = JSON.stringify(myObj);
    
    peticion = new XMLHttpRequest();
    peticion.onreadystatechange = function () {
        if( this.readyState == 4 && this.status == 200){
            document.getElementById("datos").innerHTML = this.responseText;
        }
    }
        
    peticion.open("GET", "registro.php?x="+cadena, true);
    ///si fuera con  metodo POST los datos se envian en la cadena, es decir, peticion.send(cadena);
    peticion.send(null);
}