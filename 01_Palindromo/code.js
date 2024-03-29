const enviar = document.getElementById('enviar');

enviar.addEventListener('click', (e) => {
    let palabra = document.getElementById('palabra').value;
    palabra = palabra.toLowerCase();
    
    e.preventDefault();

    let invertirPalabra = '';

    for (let i = palabra.length - 1 ; i >= 0  ; i--) {
        invertirPalabra += palabra[i];
    }

    if (palabra == invertirPalabra) {
        alert("String palindromo. Status OK.");
    } else {
        alert("String no palindromo. Status INVALID.");
    }
});
