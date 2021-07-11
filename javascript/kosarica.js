$(document).ready( function()
{
    dohvati_proizvode();

    $('#dodajUkosaricu').on('click', dodaj_proizvod);

    //$('body').on('change', 'input', obavi_posao);

});


    function dodaj_proizvod(button_id)
    {
        let proizvod = $('#pr_'+button_id).html();

        let key = 'proizvod_'+broj_proizvoda;
        localStorage.setItem(key, proizvod);

        dohvati_proizvode();
    }

    function dohvati_proizvode()
    {
        broj_proizvoda = 0;

        let div = $('#div-popis');
        div.html('');

        while(1)
        {
            let key = 'proizvod_'+broj_proizvoda;
            let proizvod= localStorage.getItem(key);

            if (proizvod === null)
                break;
            
            let span = $('<span>');

            span.append(proizvod);
            span.append('<br>');
            span.prop('id', key);

            div.append(span);

            

            ++broj_proizvoda;
        }
    }