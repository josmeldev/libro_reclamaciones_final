document.getElementById('consultar').addEventListener('click', function() {
    var ruc = document.getElementById('ruc').value;
    var token = document.getElementById('ruc').getAttribute('data-token');
    var url = 'https://dniruc.apisperu.com/api/v1/ruc/' + ruc + '?token=' + token;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            // Actualizar los campos del formulario con la respuesta de la API
            document.getElementById('razon_social').value = data.razonSocial;
            document.getElementById('direccion').value = data.direccion;

        })
        .catch(error => console.error('Error:', error));
});
