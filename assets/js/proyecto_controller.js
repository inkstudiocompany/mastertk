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
            inicioProyecto: "",
            finProyecto: "",
            productivoProyecto: "",
            idLider:""
        }
    });
})

