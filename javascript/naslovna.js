
$(window).on( 'load',function()
{
    let image=new Image();
    let imagePath = ('naslovna.jpg');
    image.src=imagePath;

    $("image").ready(napisi_naslov);
//    napisi_naslov();



function napisi_naslov()
{
    $("#cnv").css("width", window.innerWidth + "px");
    let ctx = $('#cnv').get(0).getContext('2d');
    let w = $("#cnv").width();
    let h = $("#cnv").height();
    ctx.drawImage(image, 50, 50, image.width, image.height, 0,  0, w, h)
    
    
    ctx.textAlign = "center";
    ctx.fillStyle = "firebrick";
    ctx.font = "100px Cursive";
    let duljinaNaslova = ctx.measureText("ŠPECERAJ").width;
    ctx.fillText( "ŠPECERAJ", w/2 - duljinaNaslova/2, 125 );
    console.log(w);

    

        
}

});


