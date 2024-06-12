const header = document.querySelector('.header');


var checkHeader = _.throttle(() => { 
    let scrollPosition = Math.round(window.scrollY);
    if (scrollPosition > 10){
        header.style.backgroundColor = 'white';
        header.style.transition= '0.3s';
    }else{
        header.style.backgroundColor = '';
    }

}, 300);


window.addEventListener('scroll', checkHeader);