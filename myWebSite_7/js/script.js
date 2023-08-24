const fade = document.getElementById("lr_fade");
var opacityValue = 0;

window.onload = function() {
    if(fade !== null) {
        setInterval(()=>{
            if(opacityValue <= 1){
                changeOpacity();
            }
        }, 70);
    }
};

function changeOpacity() {
    this.opacityValue += 0.1;
    fade.style.opacity = this.opacityValue;
}

