document.querySelectorAll('.js-scroll-next').forEach((btn) => {
	btn.addEventListener('click', (e) => {
		e.preventDefault();
		const next = btn.closest('section')?.nextElementSibling;
		if (next) next.scrollIntoView({ behavior: 'smooth' });
	});
});
