const fade = document.getElementById("lr_fade");
var opacityValue = 0;

window.onload = function() {
    if(fade !== null) {
        console.log('フェードインを実行します');
        setInterval(()=>{
            if(opacityValue <= 1){
                changeOpacity();
            }
        }, 70);
    }else {
        console.log('フェードインを実行しません');
    }
};

function changeOpacity() {
    this.opacityValue += 0.1;
    fade.style.opacity = this.opacityValue;
    console.log('opacity値を' + this.opacityValue + 'に変更');
}


