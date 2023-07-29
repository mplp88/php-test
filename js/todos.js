function selectList(id) {
  showLoading();
  location.href = '/todos/?todoList=' + id;
}

function closeList() {
  showLoading();
  location.href = '/todos/';
}

function toggleChecked(id) {
  showLoading();
  let form = document.createElement('form');
  form.style.display = 'none';
  form.action = 'server.php';
  form.method = 'post';

  let acc = document.createElement('input');
  acc.type = 'hidden';
  acc.name = 'acc';
  acc.id = 'acc';
  acc.value = 'toggleChecked';
  form.appendChild(acc);

  let listId = document.createElement('input');
  listId.type = 'hidden';
  listId.name = 'listId';
  listId.id = 'listId';
  listId.value = new URL(location).searchParams.get('todoList');
  form.appendChild(listId);

  let todoId = document.createElement('input');
  todoId.type = 'hidden';
  todoId.name = 'todoId';
  todoId.id = 'todoId';
  todoId.value = id;
  form.appendChild(todoId);

  let checkbox = document.getElementById('checked-' + id);
  let checked = document.createElement('input');
  checked.type = 'hidden';
  checked.name = 'checked';
  checked.id = 'checked';
  checked.value = checkbox.checked ? 1 : 0;
  form.appendChild(checked);

  document.body.appendChild(form);
  form.submit();
}

function crearLista() {
  bootbox.prompt('Nueva lista', crearListaDo);
}

function crearListaDo(nombreLista) {
  if (nombreLista == null) {
    return;
  }

  if (nombreLista == '') {
    bootbox.alert('El nombre de la lista no puede estar vacío!');
    return;
  }

  showLoading();

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

function validate(el) {
  let valid = true;
  let form = document.getElementsByClassName('needs-validation')[0];
  form.classList.remove('was-validated');

  if (form.descripcion.value == '') {
    valid = false;
  }

  form.classList.add('was-validated');
  return valid;
}