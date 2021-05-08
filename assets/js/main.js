//VARIABLES PARA USARSE GLOBALMENTE
var base_url = 'http://localhost/Pruebas/Apps/miconsultorio_appV2/';

//FUNCIONES PARA USAR EN TODA LA WEB

//CARGA DE IMAGENES
function cargarImagen(element, name){
        let bg = $('.'+element);
        if(bg != null && bg.length > 0){
            bg[0].style.backgroundImage="url("+base_url+"assets/images/"+name;                
        }
}

$(document).ready(function(){
        var bg = $('.main-bg');
        if(bg !=null && bg.length > 0){
                bg[0].style.backgroundImage="url("+base_url+"assets/images/bg-salud.jpg";
        }
        
});


