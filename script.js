// slideshow for part3
const left = document.querySelector('.arrow_left');
const right = document.querySelector('.arrow_right');
const slider = document.querySelector('.slider');
const card2 = document.querySelectorAll('.card2');

let slideNumber = 1;
const length = card2.length;
// right arrow
const nextSlide = () => {
  slider.style.transform = `translateX(-${slideNumber * 1000}px)`;
  slideNumber++;
};

const getFirstSlide = () => {
  slider.style.transform = `translateX(0px)`;
  slideNumber = 1;
};

right.addEventListener('click', () => {
  slideNumber < length ? nextSlide() : getFirstSlide();
});
//left arrow
const prevSlide = () => {
  slider.style.transform = `translateX(-${(slideNumber-2) * 1000}px)`;
  slideNumber--;
};

const getLastSlide = () => {
  slider.style.transform = `translateX(-${(length-1) * 1000}px)`;
  slideNumber = length;
};

left.addEventListener('click', () => {
  slideNumber > 1 ? prevSlide() : getLastSlide();
});


// movement of buttons
const faders = document.querySelectorAll('.buttons');

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, {
  threshold: 0.1
});

faders.forEach(fader => observer.observe(fader));
