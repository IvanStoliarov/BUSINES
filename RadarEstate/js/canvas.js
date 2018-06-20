
var Create = function(options) {
    var content = {};
    myCanvas = options;
    content.myCanvas = options;
    var passed =  parseInt(options.parentNode.querySelector(".progress__value").innerHTML);
    var left = 100 - passed;
    content.myVinyls = {
        "passed": passed,
        "left": left
    };
    return content;
}

var fields = document.querySelectorAll(".canvas");
for (var i = 0; i < fields.length; i++) {
    var newCanvas = new Create(fields[i]);
    fields[i].width = 45;
    fields[i].height = 45;

    var ctx = newCanvas.myCanvas.getContext("2d");
    
    function drawPieSlice(ctx,centerX, centerY, radius, startAngle, endAngle, color) {
        ctx.fillStyle = color;
        ctx.beginPath();
        ctx.moveTo(centerX,centerY);
        ctx.arc(centerX, centerY, radius, startAngle, endAngle);
        ctx.closePath();
        ctx.fill();
    }

    Number.prototype.toRad = function() {
        return this * Math.PI / 180;
    };

    var PieChart = function(options) {
        this.options = options;
        this.canvas = options.canvas;
        this.ctx = this.canvas.getContext("2d");
        this.colors = options.colors;

        this.draw = function() {
            var total_value = 0;
            var color_index = 0;
            for (var categ in this.options.data) {
                var val = this.options.data[categ];
                total_value += val;
            }

            var start_angle = (270).toRad();
            for (categ in this.options.data) {
                val = this.options.data[categ];
                var slice_angle = 2 * Math.PI * val / total_value;

                drawPieSlice(
                    this.ctx,
                    this.canvas.width / 2,
                    this.canvas.height / 2,
                    Math.min(this.canvas.width / 2,this.canvas.height / 2),
                    start_angle,
                    start_angle + slice_angle,
                    this.colors[color_index % this.colors.length]
                );

                start_angle += slice_angle;
                color_index++;
            }


            if (this.options.doughnutHoleSize) {
                drawPieSlice(
                    this.ctx,
                    this.canvas.width/2,
                    this.canvas.height/2,
                    this.options.doughnutHoleSize * Math.min(this.canvas.width / 1.7,this.canvas.height / 1.7),
                    0,
                    2 * Math.PI,
                    "#fff"
                );
            }
        }
    };

    var myDougnutChart = new PieChart(
        {
            canvas: newCanvas.myCanvas,
            data: newCanvas.myVinyls,
            colors: ["#f8ce46","#e1e3ea"],
            doughnutHoleSize: 0.5
        }
    );

    myDougnutChart.draw();
    
}



