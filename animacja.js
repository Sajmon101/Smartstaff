var lista="";

function pokaz(result)
{
    lista = lista + result;
    $("#cegly").html(lista);
}

function dodaj(nr_dania, nr_stol)
{
    $.ajax({
        type: 'POST',
        url: "ajax_dodaj.php",
        data: 
        {
            nr:nr_dania
        },
        success: function (result) 
        {
            pokaz(result);
            razem(nr_stol);
        }
    });
}

// nr 1 oznacza checkbox kelnera a nr 2 checkbox kucharza
function checkbox(id_zam,nr)
{
    $.ajax({
        type: 'POST',
        url: "ajax_checkbox.php",
        data: 
        {
            id_zam:id_zam,
            nr:nr
        },
        success: function (result) 
        {
        }
    });
}

function razem(nr_stol)
{
    $.ajax({
        type: 'POST',
        url: "ajax_razem.php",
        data: 
        {
            nr_stol:nr_stol
        },
        success: function (result) 
        {
            $("#wynik").html(result);
            $("#suma").html(result);
        }
    });
}

function usun(id)
{
    $.ajax({
        type: 'POST',
        url: "ajax_usun.php",
        data: 
        {
            id:id
        },
        success: function (result) 
        {
            location.reload();
        }
    });
}

function kafelki(nazwa)
{
    $.ajax({
        type: 'POST',
        url: "ajax_kafelki.php",
        data: 
        {
            nazwa:nazwa
        },
        success: function (result) 
        {
            $("#kafelki").html(result);
        }
    });
}

function rachunek()
{
    document.querySelector(".poup").style.display = "flex";
    $("#all").css("opacity", "0.3");
}

function close_rachunek()
{
    document.querySelector(".poup").style.display = "none";
    $("#all").css("opacity", "1");
}

function final_rachunek(nr_stol)
{
    close_rachunek();

    $.ajax({
        type: 'POST',
        url: "ajax_usun-all.php",
        data: 
        {
            nr_stol:nr_stol
        },
        success: function (result) 
        {
            location.reload();
        }
    });
}

function gotowe(id_zam, id_prac)
{
    $.ajax({
        type: 'POST',
        url: "ajax_gotowe.php",
        data: 
        {
            id_zam:id_zam,
            id_prac:id_prac
        },
        success: function (result) 
        {
            location.reload();
        }
    });
}