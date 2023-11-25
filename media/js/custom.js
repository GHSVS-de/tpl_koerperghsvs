(function()
{
	const html = document.documentElement;
	// Opera mini doesn't accept both classes in one remove().
	html.classList.remove('no-js');
	html.classList.remove('jsNotActive');
	html.classList.add('jsActive');
})();
