function setTheme() {
  let select = document.getElementById('theme');
  let theme = select.options[select.selectedIndex].value;
  let formu = document.getElementById('nav-form');
  formu.acc.value = 'setTheme';
  formu.theme.value = theme;
  formu.submit();
}