//Link Ativo
for(var i = 0; i < document.links.length; i++){
    if(document.links[i].href == document.URL){
        document.links[i].classList.add('active');
    }
}

// "Toggle"
var toggleMenu = document.querySelectorAll('.toggleMenu');
var aside = document.querySelector('.aside');

for(var i = 0; i < toggleMenu.length; i++){
  toggleMenu[i].addEventListener('click', actionToggle);
}

function actionToggle(){
  if(aside.classList.contains('hideDeviceSmall')){
    aside.classList.remove('hideDeviceSmall');
    aside.animate([
      { transform: 'translateX(-300px)' },
      { transform: 'translateX(0)' }
    ], {
      duration: 300,
    });
  }else{
    aside.classList.add('hideDeviceSmall');
  }
}

// "Carroussel"
const sliderElm = document.querySelector(".slideUl");
const btnLeft = document.querySelector(".leftAction");
const btnRight = document.querySelector(".rightAction");

const numberSliderBoxs = sliderElm.children.length;
let idxCurrentSlide = 0;

// Funções:
function moveSlider() {
  let leftMargin = (sliderElm.clientWidth / 5) * idxCurrentSlide;
  sliderElm.style.marginLeft = -leftMargin + "px";
  console.log(sliderElm.clientWidth, leftMargin);
}
function moveLeft() {
  if (idxCurrentSlide === 0) idxCurrentSlide = numberSliderBoxs - 1;
  else idxCurrentSlide--;

  moveSlider();
}
function moveRight() {
  if (idxCurrentSlide === numberSliderBoxs - 1) idxCurrentSlide = 0;
  else idxCurrentSlide++;

  moveSlider();
}

// Event Listeners:
btnLeft.addEventListener("click", moveLeft);
btnRight.addEventListener("click", moveRight);
window.addEventListener("resize", moveSlider);



  