// Draw the canvas
function ahorcado(donde,fallos) {
    var canvas = document.getElementById(donde);
     var c = canvas.getContext('2d');
    // reset the canvas and set basic styles
    canvas.width = canvas.width;
    c.lineWidth = 10;
    c.strokeStyle = 'green';
    c.font = 'bold 24px Optimer, Arial, Helvetica, sans-serif';
    c.fillStyle = 'red';
    // suelo
    drawLine(c, [20,190], [180,190]);
    if (fallos > 0) {
        c.strokeStyle = '#A52A2A';
        drawLine(c, [30,185], [30,10]);
        if (fallos > 1) {
            c.lineTo(150,10);
            c.stroke();
        }
        if (fallos > 2) {
            c.strokeStyle = 'black';
            c.lineWidth = 3;
            drawLine(c, [145,15], [145,30]);
            c.beginPath();
            c.moveTo(160, 45);
            c.arc(145, 45, 15, 0, (Math.PI/180)*360);
            c.stroke(); 
        }
        if (fallos > 3) {
            drawLine(c, [145,60], [145,130]);
        }
        if (fallos > 4) {
            drawLine(c, [145,80], [110,90]);
        }
        if (fallos > 5) {
            drawLine(c, [145,80], [180,90]);
        }
        if (fallos > 6) {
            drawLine(c, [145,130], [130,170]);
        }
        if (fallos > 7) {
            drawLine(c, [145,130], [160,170]);
            c.fillText('AHORCADO', 45, 110);
  
        }
    }
   
}
function drawLine(context, from, to) {
    context.beginPath();
    context.moveTo(from[0], from[1]);
    context.lineTo(to[0], to[1]);
    context.stroke();
}