document.querySelectorAll('.course').forEach((item) =>{ 
	item.addEventListener('click', () => {
	let courseInterval = 100;
	for(let i = 1; i < 5; i++){
		// setTimeout(function() {
			if (i == 1 ){
				document.querySelector('.groups > div:nth-child(' + i + ')').style.transform = 'translateX(-40px) translateY(-40px)';
				document.querySelector('.groups > div:nth-child(' + i + ')').style.opacity = 0;
			}
			if (i == 2 ){
				document.querySelector('.groups > div:nth-child(' + i + ')').style.transform = 'translateX(-40px) translateY(40px)';
				document.querySelector('.groups > div:nth-child(' + i + ')').style.opacity = 0;
			}
			if (i == 3){
				document.querySelector('.groups > div:nth-child(' + i + ')').style.transform = 'translateX(40px) translateY(-40px)';
				document.querySelector('.groups > div:nth-child(' + i + ')').style.opacity = 0;
			}
			if (i == 4){
				document.querySelector('.groups > div:nth-child(' + i + ')').style.transform = 'translateX(40px) translateY(40px)';
				document.querySelector('.groups > div:nth-child(' + i + ')').style.opacity = 0;
			}
		// }, courseInterval);
		// courseInterval += 100;
	}
	 });
	document.querySelector('.groups > div:nth-child(4)').addEventListener('transitionend', () => {
		document.querySelector('.allInGroups').style.display = 'flex';
		document.querySelector('.allInGroups').style.flexWrap = 'wrap';
		document.querySelector('.allInGroups').style.justifyContent = 'space-evenly';
		// document.querySelector('.allInGroups').style.gridTemplateColumns = '0.3fr 1fr 0.1fr 1fr 0.1fr 1fr 0.1fr 1fr 0.3fr';
		// document.querySelector('.allInGroups').style.gridTemplateRows = '0.2fr 1fr 0.05fr 1fr 0.05fr 1fr 0.05fr 1fr 0.2fr';
		setTimeout(function() {
			let groupsInterval = 50;
			document.querySelectorAll('.inGroup').forEach((item) =>{
				item.style.opacity = 0;
				item.classList.remove('hidden');
				setTimeout(function() {
					item.style.opacity = 1;
				 }, groupsInterval);
				groupsInterval += 50;
			 });
		}, 100);
	});
});
document.querySelector('.mainUl > li').addEventListener('mouseover', () => {
	setTimeout(function() {
		document.querySelectorAll('.subMenu').forEach((item) =>{
			item.classList.remove('hiddenSub');
			item.style.position = 'absolute';
		});
	}, 1000);
			document.querySelectorAll('.subMenu').forEach((item) =>{
				item.style.transform = 'translateX(300px)';
			});
});