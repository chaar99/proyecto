var peticion;
document.addEventListener("readystatechange", cargarEventos, false);
function cargarEventos(evento) {
    if(document.readyState == "interactive"){
       
        document.getElementById("mostrar").addEventListener("click", recibir, false);
       // no funciona 
       // document.getElementById("buscar").addEventListener("change", enviar_recibir, false);
    }  
}

function recibir(evento){
    
    evento.preventDefault();

    evento.stopPropagation();
    var recog;
    var tablaEntera;
    
    peticion = new XMLHttpRequest();
    peticion.onreadystatechange = function () {
        debugger;
        if( this.readyState == 4 && this.status == 200){
            
            recog = this.responseText;
            recog = JSON.parse(recog);
           // tablaEntera = ;
            document.getElementById("table").innerHTML = creacionTabla(recog);
        
        }
    }
        
    peticion.open("GET", "index.php?", true);
   
    peticion.send(null);
   
}
/* no funciona 
function enviar_recibir(evento){
    
    evento.preventDefault();
    evento.stopPropagation();

    var myObj = {
        nombre: document.getElementById("buscar").value
    };
    
    var cadena = JSON.stringify(myObj);
    var recog;
    var tablaEntera;
    
    peticion = new XMLHttpRequest();
    peticion.onreadystatechange = function () {
        debugger;
        if( this.readyState == 4 && this.status == 200){
            
            recog = this.responseText;
            recog = JSON.parse(recog);
           // tablaEntera = ;
            document.getElementById("table").innerHTML = creacionTabla(recog);
        
        }
    }
        
    peticion.open("GET", "index.php?x="+cadena, true);
   
    peticion.send(null);
   
}*/

function creacionTabla(array){
    var tbody = document.getElementsByTagName("tbody")[0];
    
    for (var i = 0; i < array.length ; i++) {
        var fila = document.createElement("tr");
                
        var celda_a = document.createElement("td");
        var texto_a = document.createTextNode(array[i][0]);
        celda_a.appendChild(texto_a);
        fila.appendChild(celda_a);

        var celda_b = document.createElement("td");
        var texto_b = document.createTextNode(array[i][1]);
        celda_b.appendChild(texto_b);
        fila.appendChild(celda_b);
/* no lo quiero asi pero funciona 
        var celda_c = document.createElement("td");
        var input = document.createElement("input");
        input.setAttribute("type","button"); 
        input.setAttribute("value","borrar"); 
        input.setAttribute("id",i+array[i][0]);  
        celda_c.appendChild(input);
        fila.appendChild(celda_c);
*/
        tbody.appendChild(fila);
    }

}