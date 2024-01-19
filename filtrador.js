function mostrarTodos() {
  // Obtén todos los elementos con la clase 'low-stock'
  var elementos = document.getElementsByClassName('low-stock');
  // Itera sobre cada elemento y establece su estilo de visualización a 'table-row'
  for (var i = 0; i < elementos.length; i++) {
    elementos[i].style.display = 'table-row';
  }
  // Obtén todos los elementos con la clase 'suficiente-stock'
  var elementos2 = document.getElementsByClassName('suficiente-stock');
  // Itera sobre cada elemento y establece su estilo de visualización a 'table-row'
  for (var i = 0; i < elementos2.length; i++) {
    elementos2[i].style.display = 'table-row';
  }
}

  
function mostrarConStock() {
  // Oculta todos los elementos con la clase 'low-stock'
  var elementos = document.getElementsByClassName('low-stock');
  for (var i = 0; i < elementos.length; i++) {
      elementos[i].style.display = 'none';
  }
  // Muestra todos los elementos con la clase 'suficiente-stock'
  var elementos2 = document.getElementsByClassName('suficiente-stock');
  for (var i = 0; i < elementos2.length; i++) {
      elementos2[i].style.display = 'table-row';
  }
}

  
  function mostrarMenosDe10() {
    // Muestra todos los elementos con la clase 'low-stock'
    var elementos = document.getElementsByClassName('low-stock');
    for (var i = 0; i < elementos.length; i++) {
      elementos[i].style.display = 'table-row';
    }
    // Oculta todos los elementos con la clase 'suficiente-stock'
    var elementos2 = document.getElementsByClassName('suficiente-stock');
    for (var i = 0; i < elementos2.length; i++) {
      elementos2[i].style.display = 'none';
    }
  }
  




