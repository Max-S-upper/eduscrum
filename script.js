let paralaxImg = document.querySelector('.paralaxImg');
paralaxImg.addEventListener('mouseover', () => {
  paralaxImg.style.transform = 'scale3d(1.1, 1.1, 1.1) perspective(300px)'; 
  paralaxImg.style.perspective = '300px';
  let x = ((document.querySelector('.paralaxImg').getBoundingClientRect().x + document.querySelector('.paralaxImg').getBoundingClientRect().width / 2) - event.clientX) / (document.documentElement.getBoundingClientRect().height / 150);
    let y = ((document.querySelector('.paralaxImg').getBoundingClientRect().y + document.querySelector('.paralaxImg').getBoundingClientRect().height / 2) - event.clientY) / (document.documentElement.getBoundingClientRect().height / 150);
    if (y < 0) x *= (-1);
    // if (y > 0) y *= (-1);
    if (x < 31 && x > (-31) && y < 31 && y > (-31)) paralaxImg.style.transform = 'rotateY('+x+'deg) rotateX('+y+'deg) scale(1.1)';
    paralaxImg.addEventListener('mousemove', () => {
      x = (event.clientX - (document.querySelector('.paralaxImg').getBoundingClientRect().x + document.querySelector('.paralaxImg').getBoundingClientRect().width / 2)) / (document.documentElement.getBoundingClientRect().height / 150);
      y = (event.clientY - (document.querySelector('.paralaxImg').getBoundingClientRect().y + document.querySelector('.paralaxImg').getBoundingClientRect().height / 2)) / (document.documentElement.getBoundingClientRect().height / 150);
      if (y < 0) x *= (-1);
      // if (y > 0) y *= (-1);
      if (x < 31 && x > (-31) && y < 31 && y > (-31)) paralaxImg.style.transform = 'rotateY('+x+'deg) rotateX('+y+'deg) scale(1.1)';
    });
});

paralaxImg.addEventListener('mouseout', () => {
  paralaxImg.style.transform = 'scale(1)';
});
document.querySelector('.createAcc').addEventListener('click', () => {
	let gogo = document.querySelector('main').getBoundingClientRect().width / 4.5;
	let content = document.querySelector('.content');
	content.style.transform = 'translateX(' + (-gogo) + 'px)';
	content.style.opacity = 0;
	paralaxImg.parentNode.style.transform = 'translateX(' + gogo + 'px)';
	paralaxImg.parentNode.style.opacity = 0;
	paralaxImg.parentNode.addEventListener('transitionend', () => {
		paralaxImg.parentNode.classList.add('hidden');
		content.classList.add('hidden');
		document.querySelector('.signUp').style.opacity = 0;
		document.querySelector('.signUp').classList.remove('hidden');
		document.querySelector('.signUp').style.transform = 'translateX(' + (document.querySelector('main').getBoundingClientRect().width / 10 * (-1)) + 'px)';	
		document.querySelector('.signUp').style.transform = 'translateX(' + (document.querySelector('main').getBoundingClientRect().width / 10 * (-1)) + 'px)';
		document.querySelector('.signUp').style.opacity = 1;

		document.querySelector('.about').style.opacity = 0;
		document.querySelector('.about').classList.remove('hidden');
		document.querySelector('.about').style.transform = 'translateX(' + (document.querySelector('main').getBoundingClientRect().width / 10 * (1)) + 'px)';	
		document.querySelector('.about').style.transform = 'translateX(' + (document.querySelector('main').getBoundingClientRect().width / 10 * (1)) + 'px)';
		document.querySelector('.about').style.opacity = 1;
	});
});
document.querySelector('.signBtn1 span').addEventListener('click', () => {
	let content = document.querySelector('.content');
	document.querySelector('.signUp').style = 'translateX(' + (document.querySelector('main').getBoundingClientRect().width * (-1)) + 'px)';
	document.querySelector('.signUp').style.opacity = 0;
	document.querySelector('.about').style = 'translateX(' + (document.querySelector('main').getBoundingClientRect().width * (1)) + 'px)';
	document.querySelector('.about').style.opacity = 0;
	document.querySelector('.about').addEventListener('transitionend', aboutTransitionEnd);
	function aboutTransitionEnd() {
		content.classList.remove('hidden');
		paralaxImg.parentNode.classList.remove('hidden');
		document.querySelector('.signUp').classList.add('hidden');
		document.querySelector('.about').classList.add('hidden');
		content.style = '';
		paralaxImg.parentNode.style = '';
		document.querySelector('.about').removeEventListener('transitionend', aboutTransitionEnd);
	}
});
document.querySelector('.signUp > select:nth-child(12)').addEventListener('change', () => {
	let pin = document.querySelector('.signUp > input[name=PIN]'),
	group = document.querySelector('.signUp > select[name=group]');
	if (document.querySelector('.signUp > select:nth-child(12)').value == 'teacher') {
		group.style.transform = 'translateX(-80px)';
		group.style.opacity = 0;
		// document.querySelector('.signUp > .fa-users').style.transform = 'translateX(-80px)';
		// document.querySelector('.signUp > .fa-users').style.opacity = 0;
		group.addEventListener('transitionend', function() {
			this.classList.add('hidden');
			pin.style.transform = 'translateX(-80px)';
			pin.style.opacity = '0';
			pin.classList.remove('hidden');
			pin.style = '';
			// document.querySelector('.signUp > .fa-users').style = '';
		})
	}
	else{
		pin.style.transform = 'translateX(-80px)';
		pin.style.opacity = 0;
		// document.querySelector('.signUp > i:nth-child(14)').style.transform = 'translateX(-80px)';
		// document.querySelector('.signUp > i:nth-child(14)').style.opacity = 0;
		pin.addEventListener('transitionend', () => {
			pin.classList.add('hidden');
			group.style.transform = 'translateX(-80px)';
			group.style.opacity = '0';
			group.classList.remove('hidden');
			group.style = '';
			// document.querySelector('.signUp > i:nth-child(14)').style = '';
		})
	}
});
if (document.querySelector('.err')) {
  let pause = 0;
  for (let i = 0; i < 5; i++) {
    setTimeout(() => {
      let d;
      if (i % 2 == 0) d = 1;
      else d = -1;
      if (i == 4) d = 0;
      if (i == 0) {
        document.querySelector('.signIn').children[1].style.boxShadow = '0px 0px 3px red';
        document.querySelector('.signIn').children[3].style.boxShadow = '0px 0px 3px red';
      }

      document.querySelector('.signIn').children[1].style.transform = 'rotateZ(' + 2.5 * (d) + 'deg)';
      document.querySelector('.signIn').children[2].style.transform = 'rotateZ(' + 2.5 * (d) + 'deg)';
      document.querySelector('.signIn').children[3].style.transform = 'rotateZ(' + 2.5 * (d) + 'deg)';
      document.querySelector('.signIn').children[4].style.transform = 'rotateZ(' + 2.5 * (d) + 'deg)';
      document.querySelector('.signIn').children[5].style.transform = 'translateX(' + 5 * (d) + 'px)';
    }, pause + 100);
    pause += 100;
  }
}
if (document.querySelector('.groups > div:first-child')) document.querySelector('.groups > div:first-child').addEventListener('click', () => {
	document.querySelector('.groups > div:first-child').style.transform = 'translateX(40px)';
	document.querySelector('.groups > div:first-child').style.opacity = 0;
});




