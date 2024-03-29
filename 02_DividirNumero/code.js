const enviar = document.getElementById('enviar');

enviar.addEventListener('click', (e) => {
    e.preventDefault();

    const dividendo = parseInt(document.getElementById('dividendo').value);
    const divisor = parseInt(document.getElementById('divisor').value);

    // Control de divisor para no caer en infinitos.
    if (divisor <= 0) {
        alert('Divisor incorrecto');
        return;
    }

    let cociente = 0;
    
    for (let i = 0 ; i < dividendo ; i += divisor) {
        if (i + divisor <= dividendo) {
            cociente++;
        }
    }
    // console.log(dividendo + '/' + divisor + '=' + cociente);

    let resultDiv = document.createElement('div');
    let resultContent = document.createTextNode(`${dividendo}/${divisor}=${cociente}`);

    resultDiv.appendChild(resultContent);

    document.body.appendChild(resultDiv);
});
