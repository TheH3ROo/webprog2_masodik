function orszagok() {
    $.post(
        "felsofoku.php",
        {"op" : "orszag"},
        function(data) {
            //$("#orszagselect").html('<option value="0">Válasszon ...</option>');
            $("<option>").val("0").text("Válasszon ...").appendTo("#orszagselect");
            var lista = data.lista;
            for(i=0; i<lista.length; i++)
                //$("#orszagselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
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
            "felsofoku.php",
            {"op" : "varos", "id" : orszagid},
            function(data) {
                $("#varosselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#varosselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
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
            "felsofoku.php",
            {"op" : "intezmeny", "id" : varosid},
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
            "felsofoku.php",
            {"op" : "info", "id" : intezmenyid},
            function(data) {
                $("#nev").text(data.nev);
                $("#cim").text(data.cim);
                $("#tel").text(data.tel);
                $("#mail").text(data.email);
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