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
  let formu = document.getElementById('formu');
  formu.acc.value = 'dismissError';
  formu.submit();
}

function testBootbox() {
  bootbox.alert('Hello, World!');
}