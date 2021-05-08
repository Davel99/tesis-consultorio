var fine = false;       //Variable para comprobar que todo lo introducido sea correcto

//CONJUNTO DE INSTRUCCIONES PARA AGREGAR SÍNTOMAS

var btn_Sintoma = $('#addSintoma'); //Botón para agregar sintomas
var area_Sintoma = $('#sintomas'); //Área para agregar síntomas
var num_Sintoma = 1; //Conteo de síntomas

btn_Sintoma.on('click', function () {
    num_Sintoma++;
    let template = '';
    template = `
                <input type="text" name="sintoma[]" class="form-control" placeholder="Sintoma #${num_Sintoma}">
`;
    area_Sintoma.append(template);
});

//CONJUNTO DE INSTRUCCIONES PARA AGREGAR MEDICAMENTOS
var btn_Med = $('#addMed');         //Botón para agregar sintomas
var area_Med = $('#medicamentos');  //Área para agregar síntomas
var num_Med = 1;                    //Conteo de medicamentos
btn_Med.on('click', function () {
    num_Med++;
    let template = '';
    template = `
        <hr>
                <input required type="text" name="medicamento[]" id="primerMedicamento" class="form-control" placeholder="Nombre del medicamento #1">
                <input required type="text" name="via[]" id="primerFrec" class="form-control" placeholder="Vía de administración | Ej. 'Oral'">
                <input required type="text" name="cantidad[]" id="primerCantidad" class="form-control" placeholder="Cantidad | Ej. '1 tableta de 50gr'">
                <input required type="text" name="frecuencia[]" id="primerFrec" class="form-control" placeholder="Frecuencia | Ej. 'c/8 horas'">
                <input required type="text" name="periodo[]" id="primerFrec" class="form-control" placeholder="Duración | Ej. '5 DÍAS'">
`;
    area_Med.append(template);
});
//OBTENIENDO DATOS DEL FORMULARIO

var formulario = $('#consulta'); //Formulario principal
var peso = $('#peso'); //Peso del paciente en cm
var temperatura = $('#temperatura'); //Temperatura en C
var altura = $('#altura'); //Altura en cm
var p_sis = $('#p_sis'); //Presión en mm/Hg
var p_dia = $('#p_dia'); //
var observacion = $('#observacion'); //Observaciones hechas por el médico

var alertas = $('#alertas');

function monitoreo() {
    var template = "";
    if (peso.val() == "" ||
            altura.val() == "" ||
            temperatura.val() == "" ||
            p_sis.val() == "" ||
            p_dia.val() == "") {

        template = `
                <div class="alert alert-danger" role="alert">
                
                Rellena todos los datos que se te piden
                
                </div>
                
`;
        alertas.html(template);
        fine = false;

    } else if (!parseInt(peso.val()) ||
            !parseInt(altura.val()) ||
            !parseInt(temperatura.val()) ||
            !parseInt(p_sis.val()) ||
            !parseInt(p_dia.val())) {

        template = `
                <div class="alert alert-danger" role="alert">
                
                Rellene los datos ÚNICAMENTE con números
                
                </div>
                
`;
        alertas.html(template);
        fine = false;


    } else {
        comprobaciones();
        fine = true;
    }

    return true;


}

function comprobaciones() {
    alertas.html('');
    calcularIMC();
    calcularFiebre();
    return true;
}

function calcularIMC() {
    var template = "";
    let kg = peso.val();
    let alt = parseFloat(altura.val() / 100);

    kg = parseFloat(kg);
    alt = parseFloat(alt);
    var imc = parseFloat(kg / (alt * alt));

    console.log(imc);

    if (imc > 24.9 && imc < 30) {
        template = `
                <div class="alert alert-warning" role="alert">
                
                El paciente sufre de sobrepeso 
                
                </div>
                
`;
    } else if (imc > 29.9) {
        template = `
                <div class="alert alert-danger" role="alert">
                
                El paciente sufre de obesidad
                
                </div>
                
`;
    }




    console.log('Imprimiendo');
    alertas.append(template);

    return true;


}

function calcularFiebre() {
    var template = "";
    var fiebre = parseFloat(temperatura.val());
    if (fiebre >= 37) {
        template = `
                <div class="alert alert-danger" role="alert">
                
                El paciente tiene fiebre
                
                </div>
                
`;
    }

    alertas.append(template);
    return true;
}


//RELOJ
var s = 0;
var m = 0;
var h = 0;
var segundos = $('#s');
var minutos = $('#m');
var horas = $('#h');


var monitorear;
var miReloj;
var imc_calc;
$(document).ready(function () {

    miReloj = setInterval(function () {
        s++;
        if (s > 59) {
            s = 0;
            m++;
        }
        if (m > 59) {
            m = 0;
            h++;
        }

        if (s < 10) {
            segundos.html('0' + s);
        } else {
            segundos.html(s);
        }


        if (m < 10) {
            minutos.html('0' + m);
        } else {
            minutos.html(m);
        }


        horas.html(h);
    }, 1000);
    monitorear = setInterval(monitoreo, 1000);
});


var sintoma = $('#primerSintoma');
var medicamento = $('#primerMedicamento');
var diagnostico = $('#diagnostico');

formulario.on('submit', function (e) {

    if (!fine) {

        e.preventDefault();
        alert('Rellene todos los datos correctamente. ');

    } else if (sintoma.val() == "" || medicamento.val() == "") {
        e.preventDefault();
        alert('Debe anotar al menos un síntoma y un medicamento');

    } else if (diagnostico.val() == "") {
        e.preventDefault();
        alert('Es importante que indique su diagnóstico');
    }

});