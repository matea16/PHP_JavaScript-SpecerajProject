
$(document).ready( function()
{

    napisi_naslov();

});

function napisi_naslov()
{
    $("#cnv").css("width", window.innerWidth + "px");
    let ctx = $('#cnv').get(0).getContext('2d');
    let w = $("#cnv").width();
    
    
    ctx.textAlign = "center";
    ctx.fillStyle = "firebrick";
    ctx.font = "100px Cursive";
    let duljinaNaslova = ctx.measureText("ŠPECERAJ").width;
    ctx.fillText( "ŠPECERAJ", w/2 - duljinaNaslova/2, 125 );
    console.log(w);

        
}




