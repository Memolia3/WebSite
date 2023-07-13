const typeTarget = document.querySelectorAll('.type');

let options = {
    rootMargin: '0px',
    threshold: .10
}

let callback = (entries, observer) => {
    window.setTimeout(changeMainContainer, 13000);
    entries.forEach(entry => {
        if (entry.intersectionRatio > .10 && entry.target.classList.contains('active') == false) {
            let typeContent = entry.target.textContent;
            let typeSprit = typeContent.split('');
            let typeSpeed = entry.target.getAttribute('data-speed');
            entry.target.textContent = '';
            entry.target.classList.add('active');

            let typeLength = 0;
            let typeInterval = setInterval(() => {
                if (typeSprit[typeLength] == undefined) {
                    clearInterval(typeInterval);
                    return false;
                }
                entry.target.textContent += typeSprit[typeLength];
                typeLength++;
            }, typeSpeed);

        }
    });
}

let observer = new IntersectionObserver(callback, options);

typeTarget.forEach(e => {
    observer.observe(e);
});



function changeMainContainer() {
    const mainContainer = document.getElementById('main');
    mainContainer.style.display = 'block';
    alert('繧医≧縺薙◎?');
}

function changeImage() {
    const image = document.getElementById('pic');
    image.src = '../images/cuteGhost.png';
}

function clickQuestion() {
    document.getElementById("question").innerHTML = "you know this";
    document.getElementById("question").style.color = 'red';
    document.getElementById("question").style.webkitTextStrokeColor= 'white';
}

function clickName() {
    document.getElementById("myName").innerHTML = "I'm Memolia";
    document.getElementById("myName").style.color = 'red';
    document.getElementById("myName").style.webkitTextStrokeColor= 'white';
}

function clickHelp() {
    document.getElementById("help").innerHTML = "why??";
    document.getElementById("help").style.color = 'red';
    document.getElementById("help").style.webkitTextStrokeColor= 'white';
}

function clickChange() {
    document.getElementById('change').innerHTML = "okay";
    document.getElementById("change").style.color = 'red';
    document.getElementById("change").style.webkitTextStrokeColor= 'white';
    window.setTimeout(changeImage, 2000);
}