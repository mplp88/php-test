function dismissError() {
  showLoading();

  let form = document.createElement('form');
  form.method = 'POST';
  form.action = 'server.php';
  form.style.display = 'none';

  let acc = document.createElement('input');
  acc.type = 'hidden';
  acc.name = 'acc';
  acc.id = 'acc';
  acc.value = 'dismissError';

  form.appendChild(acc);
  document.body.appendChild(form);
  form.submit();
}

function showLoading() {
  bootbox.alert('Cargando...');
}