
$(document).ready( function()
{
   if(localStorage.getItem('ukupno') === null)
        localStorage.setItem('ukupno', '0');
    dohvati_proizvode();

    $('#dodajUkosaricu').on('click', dodaj_proizvod);

    $('#nadi_najpovoljnije').on('click', nadi_trgovinu);

});


    function dodaj_proizvod(button_id)
    {
        
        let proizvod = $('#pr_'+button_id).html();

        let key = 'proizvod_'+broj_proizvoda;
        localStorage.setItem(key, proizvod);
        let t= +localStorage.getItem('ukupno');
        t++;

        localStorage.setItem('ukupno', ''+t);
        //dohvati_proizvode();
    }

    function obrisi_proizvod(btn_id)
    {
        console.log("hello");

        localStorage.removeItem(btn_id);
        let t= +localStorage.getItem('ukupno');
        t--;

        localStorage.setItem('ukupno', ''+t);
        dohvati_proizvode();

    }
    function dohvati_proizvode()
    {
        broj_proizvoda = 0;
        let temp = +localStorage.getItem('ukupno');
        let div = $('#div-popis');
        div.html('');

        while(temp>0)
        {
            let key = 'proizvod_'+broj_proizvoda;
            let proizvod= localStorage.getItem(key);

            if (proizvod === null)
                broj_proizvoda++;

            else          
            {
                let span = $('<span>');
                let but = $('<button onClick="obrisi_proizvod(this.id) "></button>');

                span.append(proizvod);
                span.append('<br>');
                span.prop('id', key);
                but.append("Obriši");
                but.prop('id', key);
    
                span.append(but);
                span.append('<br>');
                div.append(span);
                temp--;
                ++broj_proizvoda;

            }
            
        }
    }

    function nadi_trgovinu()
    {
        broj_proizvoda = 0;
        let proiz = [];
        let temp = +localStorage.getItem('ukupno');

        while(temp>0)
        {
            let key = 'proizvod_'+broj_proizvoda;
            let proizvod= localStorage.getItem(key);

            if (proizvod === null)
                broj_proizvoda++;

            else          
            {
                proiz.push(proizvod);
                temp--;
                ++broj_proizvoda;

            }
            
        }
        var data = proiz.join(','); 
        window.location = "index.php?rt=trgovine/najpovoljnija&data="+data; 


    }