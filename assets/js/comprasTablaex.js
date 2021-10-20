/* enviar formulario de compras para generar la tabla */
const formCompras = document.getElementById("frmIdCompra");

  formCompras.addEventListener("submit", function (event) {
  let transactionFormData = new FormData(formCompras); // obtiene los datos del formulario

  let insertProducto = document.getElementById("registroProducto");
  let newProductoRow = insertProducto.insertRow(-1); //este retorna una fila en la ultima fila de 
  let newproductoCellNew = newProductoRow.insertCell(0);// posisicion de la celda
  newproductoCellNew.textContent = transactionFormData.get(valProducto)

  newproductoCellNew = newProductoRow.insertCell(1);// posisicion de la celda
  newproductoCellNew.textContent = transactionFormData.get("formProducto".text)

  newproductoCellNew = newProductoRow.insertCell(2);// posisicion de la celda
  newproductoCellNew.textContent = transactionFormData.get("inputPieza")

  newproductoCellNew = newProductoRow.insertCell(3);// posisicion de la celda
  newproductoCellNew.textContent = transactionFormData.get("inputPeso")

  newproductoCellNew = newProductoRow.insertCell(4);// posisicion de la celda
  newproductoCellNew.textContent = transactionFormData.get("inputLote")

  newproductoCellNew = newProductoRow.insertCell(5);// posisicion de la celda
  newproductoCellNew.textContent = transactionFormData.get("inputPrecio")

  newproductoCellNew = newProductoRow.insertCell(6);// posisicion de la celda
  newproductoCellNew.textContent = transactionFormData.get("inputSubtotal")
});