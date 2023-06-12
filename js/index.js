function toggleChecked(id) {
  bootbox.alert('Loading...');
  let formu = document.getElementById('formu');
  let checkbox = document.getElementById('checked-' + id);
  formu.acc.value = 'toggleChecked';
  formu.todoId.value = id;
  if (checkbox.checked) {
    formu.checked.value = 1;
  }

  formu.submit();
}

function crearLista() {
  bootbox.prompt('Nueva lista', crearLIstaDo);
}

function crearLIstaDo(nombreLista) {
  let form = document.createElement('form');
  form.method = 'post';
  form.action = 'server.php';
  let acc = document.createElement('input');
  acc.id = 'acc';
  acc.name = 'acc';
  acc.type = 'hidden';
  acc.value = 'createList';
  form.appendChild(acc);

  let descripcion = document.createElement('input');
  descripcion.id = 'descripcion';
  descripcion.name = 'descripcion';
  descripcion.type = 'hidden';
  descripcion.value = nombreLista;
  form.appendChild(descripcion);

  document.body.appendChild(form);

  form.submit();
}

function selectList(id) {
  location.href = '/todos/?todoList=' + id;
}

function dismissError() {
  bootbox.alert('Loading...');
  let formu = document.getElementById('formu');
  formu.acc.value = 'dismissError';
  formu.submit();
}

function testBootbox() {
  bootbox.alert('Hello, World!');
}