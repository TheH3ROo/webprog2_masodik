function diakok() {
    $.post(
        "felsofoku.php",
        {"op" : "diak"},
        function(data) {
            //$("#orszagselect").html('<option value="0">Válasszon ...</option>');
            $("<option>").val("0").text("Válasszon ...").appendTo("#diakselect");
            var lista = data.lista;
            for(i=0; i<lista.length; i++)
                //$("#orszagselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
                $("<option>").val(lista[i].id).text(lista[i].nev).appendTo("#diakselect");
        },
        "json"                                                    
    );
};

function targyak() {
    $("#targyselect").html("");
    $("#jegyselect").html("");
    $(".adat").html("");
    var orszagid = $("#diakselect").val();
    if (orszagid != 0) {
        $.post(
            "felsofoku.php",
            {"op" : "targy", "id" : orszagid},
            function(data) {
                $("#targyselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#targyselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
            },
            "json"                                                    
        );
    }
}

function jegyek() {
    $("#jegyselect").html("");
    $(".adat").html("");
    var varosid = $("#targyselect").val();
    if (varosid != 0) {
        $.post(
            "felsofoku.php",
            {"op" : "jegy", "id" : varosid},
            function(data) {
                $("#jegyselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#jegyselect").append('<option value="'+lista[i].id+'">'+lista[i].datum+'</option>');
            },
            "json"                                                    
        );
    }
}

function jegy() {
    $(".adat").html("");
    var intezmenyid = $("#jegyselect").val();
    if (intezmenyid != 0) {
        $.post(
            "felsofoku.php",
            {"op" : "info", "id" : intezmenyid},
            function(data) {
                $("#nev").text(data.tipus);
                $("#cim").text(data.ertek);
                $("#tel").text(data.datum);
            },
            "json"                                                    
        );
    }
}

$(document).ready(function() {
    diakok();
   
   $("#diakselect").change(diakok);
   $("#targyselect").change(targyak);
   $("#jegyselect").change(jegyek);
   
   $(".adat").hover(function() {
        $(this).css({"color" : "white", "background-color" : "black"});
    }, function() {
        $(this).css({"color" : "black", "background-color" : "white"});
    });
});