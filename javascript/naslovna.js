
$(document).ready( function()
{

    napisi_naslov();

});

function napisi_naslov()
{
    let ctx = $('#cnv').get(0).getContext('2d');
    let w = $("#cnv").width();

    ctx.textAlign = "center";
    ctx.fillStyle = "firebrick";
    ctx.font = "100px Cursive";
    ctx.fillText( "ŠPECERAJ", w/2, 125 );
        
}




