
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/master.js"></script>
<script>
	const targets = document.querySelectorAll('img');
	const lazyload = target => {
		const io = new IntersectionObserver((entries, observer) => {
			// console.log(entries);
			entries.forEach(entry => {
				// console.log('☺');
				if (entry.isIntersecting) {
					const img = entry.target;
					const src = img.getAttribute('data-lazy');

					img.src = src;
					// img.parentElement.classList.remove('lazyload');
					observer.disconnect();
				}
			});
		});
		io.observe(target);
	};
	targets.forEach(lazyload);
</script>