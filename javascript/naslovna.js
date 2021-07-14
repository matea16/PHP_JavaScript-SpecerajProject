let image=new Image();
let imagePath = ('naslovna.jpg');
image.src=imagePath;
$("image").ready(function()
{
    napisi_naslov();

function napisi_naslov()
{
    $window = $(window);

    $("#cnv").attr("width", $window.width()+70);
    let ctx = $('#cnv').get(0).getContext('2d');
    let w = $("#cnv").width();
    let h = $("#cnv").height();
    ctx.drawImage(image, 20, 20, image.width, image.height, 0,  0, w, h)
    
    
    ctx.textAlign = "center";
    ctx.fillStyle = "#63614a";
    ctx.font = "90px Source Sans Pro";
    let duljinaNaslova = ctx.measureText("ŠPECERAJ").width;
    ctx.fillText( "ŠPECERAJ", w/2 - duljinaNaslova/2, 125 );
    console.log(w);

}

});



