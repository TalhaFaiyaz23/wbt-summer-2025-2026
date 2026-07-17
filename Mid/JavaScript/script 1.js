const calculateBtn = document.getElementById("calculate");
const clearBtn = document.getElementById("clear");

const resultBox = document.querySelector(".result");
const heading = document.querySelector("#heading");

const laptopPrice = 900;
const mousePrice = 20;
const keyboardPrice = 35;

calculateBtn.addEventListener("click", (event)=>{

    console.log("Button Clicked :", event.target.id);

    const laptopQty = Number(document.getElementById("laptopQty").value);
    const mouseQty = Number(document.getElementById("mouseQty").value);
    const keyboardQty = Number(document.getElementById("keyboardQty").value);

    const laptopTotal = laptopQty * laptopPrice;
    const mouseTotal = mouseQty * mousePrice;
    const keyboardTotal = keyboardQty * keyboardPrice;

    const subTotal = laptopTotal + mouseTotal + keyboardTotal;
    const vat = subTotal * 0.10;
    const grandTotal = subTotal + vat;

    document.getElementById("laptopCost").innerHTML =
        `<strong>Laptop Cost:</strong> $${laptopTotal}`;

    document.getElementById("mouseCost").innerHTML =
        `<strong>Mouse Cost:</strong> $${mouseTotal}`;

    document.getElementById("keyboardCost").innerHTML =
        `<strong>Keyboard Cost:</strong> $${keyboardTotal}`;

    document.getElementById("subtotal").innerHTML =
        `<strong>Subtotal:</strong> $${subTotal.toFixed(2)}`;

    document.getElementById("vat").innerHTML =
        `<strong>VAT (10%):</strong> $${vat.toFixed(2)}`;

    document.getElementById("grandTotal").innerHTML =
        `<strong>Grand Total:</strong> $${grandTotal.toFixed(2)}`;

    resultBox.style.background = "#d5f5e3";
    resultBox.style.border = "2px solid green";
    resultBox.style.fontSize = "18px";

    heading.style.color = "green";
});

clearBtn.addEventListener("click", (event)=>{

    console.log("Button Clicked :", event.target.id);

    document.getElementById("laptopQty").value = 0;
    document.getElementById("mouseQty").value = 0;
    document.getElementById("keyboardQty").value = 0;

    document.getElementById("laptopCost").innerHTML = "";
    document.getElementById("mouseCost").innerHTML = "";
    document.getElementById("keyboardCost").innerHTML = "";
    document.getElementById("subtotal").innerHTML = "";
    document.getElementById("vat").innerHTML = "";
    document.getElementById("grandTotal").innerHTML = "";

    resultBox.style.background = "#ecf0f1";
    resultBox.style.border = "none";
    resultBox.style.fontSize = "16px";

    heading.style.color = "#2c3e50";
});