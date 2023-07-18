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

function dismissError() {
  bootbox.alert('Loading...');

  let formu = document.createElement('form');
  formu.method = 'POST';
  formu.action = 'server.php';
  formu.style.display = 'none';

  let acc = document.createElement('input');
  acc.type = 'hidden';
  acc.name = 'acc';
  acc.id = 'acc';
  acc.value = 'dismissError';

  formu.appendChild(acc);
  document.body.appendChild(formu);
  formu.submit();
}

function testBootbox() {
  bootbox.alert('Hello, World!');
}