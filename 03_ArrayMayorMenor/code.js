const MyArray = [-2, -30, 0, 50, 7, 200, 32, -300];

let menor = MyArray[0];
let mayor = MyArray[0];

for (const element of MyArray) {
    if (element < menor) {
        menor = element;
    }

    if (element > mayor) {
        mayor = element;
    }
}

document.write(`El numero mayor es ${mayor}`);
document.write(`<br />`)
document.write(`El numero menor es ${menor}`);
