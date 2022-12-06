function orszagok() {
    $.post(
        "ajax.php",
        {"op" : "diak"},
        function(data) {
            $("<option>").val("0").text("Válasszon ...").appendTo("#orszagselect");
            var lista = data.lista;
            for(i=0; i<lista.length; i++)
                $("<option>").val(lista[i].id).text(lista[i].nev).appendTo("#orszagselect");
        },
        "json"                                                    
    );
};

function varosok() {
    $("#varosselect").html("");
    $("#intezmenyselect").html("");
    $(".adat").html("");
    var orszagid = $("#orszagselect").val();
    if (orszagid != 0) {
        $.post(
            "ajax.php",
            {"op" : "jegy", "id" : orszagid},
            function(data) {
                $("#varosselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#varosselect").append('<option value="'+lista[i].id+'">'+lista[i].tipus+'</option>');
            },
            "json"                                                    
        );
    }
}

function intezmenyek() {
    $("#intezmenyselect").html("");
    $(".adat").html("");
    var varosid = $("#varosselect").val();
    if (varosid != 0) {
        $.post(
            "ajax.php",
            {"op" : "targy", "id" : varosid},
            function(data) {
                $("#intezmenyselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#intezmenyselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
            },
            "json"                                                    
        );
    }
}

function intezmeny() {
    $(".adat").html("");
    var intezmenyid = $("#intezmenyselect").val();
    if (intezmenyid != 0) {
        $.post(
            "ajax.php",
            {"op" : "info", "id" : intezmenyid},
            function(data) {
                $("#osztaly").text(data.osztaly);
                $("#ertek").text(data.ertek);
                $("#datum").text(data.datum);
            },
            "json"                                                    
        );
    }
}

$(document).ready(function() {
   orszagok();
   
   $("#orszagselect").change(varosok);
   $("#varosselect").change(intezmenyek);
   $("#intezmenyselect").change(intezmeny);
   
   $(".adat").hover(function() {
        $(this).css({"color" : "white", "background-color" : "black"});
    }, function() {
        $(this).css({"color" : "black", "background-color" : "white"});
    });
});