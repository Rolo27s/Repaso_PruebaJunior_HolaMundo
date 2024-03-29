const URL = "http://localhost/Reto_HolaMundo/04_API_4metodos/";

// Función para crear un elemento de enlace
function createLink(text, url) {
    const link = document.createElement('a');
    link.href = url;
    link.textContent = text;
    return link;
}

// Hacer una solicitud GET a la API para obtener la lista de usuarios
fetch(URL)
.then(response => {
    // Verificar si la respuesta es exitosa
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    // Parsear la respuesta como JSON
    return response.json();
})
.then(data => {
    // Manipular los datos obtenidos (en este caso, agregarlos a una lista en la página)
    const userList = document.getElementById('user-list');
    data.forEach(user => {
        const listItem = document.createElement('tr');

        const idField = document.createElement('td');
        idField.textContent = user.id;

        const nameField = document.createElement('td');
        nameField.textContent = user.nombre;

        const lastNameField = document.createElement('td');
        lastNameField.textContent = user.apellidos;

        const dateField = document.createElement('td');
        dateField.textContent = user.fecha;

        const editField = document.createElement('td');
        const editLink = createLink('Editar', `edit.html?id=${user.id}`);
        editField.appendChild(editLink);

        const deleteField = document.createElement('td');
        const deleteLink = createLink('Eliminar', `delete.html?id=${user.id}`);
        deleteField.appendChild(deleteLink);

        // Agregar cada celda a la fila
        listItem.appendChild(idField);
        listItem.appendChild(nameField);
        listItem.appendChild(lastNameField);
        listItem.appendChild(dateField);
        listItem.appendChild(editField);
        listItem.appendChild(deleteField);

        userList.appendChild(listItem);
    });
})
.catch(error => {
    // Manejar cualquier error que ocurra durante la solicitud
    console.error('There was a problem with the fetch operation:', error);
});

// POST
const form = document.querySelector('form');

form.addEventListener('submit', (event) => {
    event.preventDefault(); // Evitar que el formulario se envíe tradicionalmente

    const formData = new FormData(form);
    const nombre = formData.get('nombre');
    const apellidos = formData.get('apellidos');
    const fecha = formData.get('fecha');

    const dataToSend = {
        nombre: nombre,
        apellidos: apellidos,
        fecha: fecha
    };

    // Realizar la solicitud POST utilizando fetch
    fetch(URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dataToSend)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // Manejar la respuesta de la API si es necesario
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
});
