if('serviceWorker' in navigator){
	navigator.serviceWorker.register('./sw.js')
	.then(reg => console.log('Registro de SW exitoso',reg))
	.catch(err => console.warn('Error al tratar de registrar el sw',
	err))
}

/* if (navigator.serviceWorker.controller) {
	console.log('Service worker already registered.')
  } else {
	navigator.serviceWorker.register('./sw.js', {
	  scope: './dashboard'
	}).then(function(reg) {
		
	  console.log('Service worker has been registered for scope:'+ reg.scope);
	});
  }
 */
