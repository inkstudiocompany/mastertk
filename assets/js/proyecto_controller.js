$(document).ready(function (){ 
    $("#agregar_proyecto").validate({
        rules: {
            nomProyecto: { lettersonly: true},
            objProyecto: { lettersonly: true},
            inicioProyecto: "required",
            finProyecto: "required",
            productivoProyecto: "required",
            idLider: {required: true},

		},
        messages: {
            nomProyecto: "No se permiten caracteres especiales",
            objProyecto: "No se permiten caracteres especiales",
            inicioProyecto: "Debe ingresar el INICIO del Proyecto",
            finProyecto: "Debe ingresar el FIN del Proyecto",
            productivoProyecto: "Debe ingresar SI / NO, esta Productivo",
            idLider:""
        }
    });
})

