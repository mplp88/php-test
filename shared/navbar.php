<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">MartínPonce.com.ar</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse">
    <div class="navbar-nav mr-auto">
      <div class="nav-item">
        <a href="/" class="nav-link">Inicio</a>
      </div>
      <div class="nav-item">
        <a href="/todos" class="nav-link">To Do List</a>
      </div>
      <div class="nav-item">
        <a href="/about" class="nav-link">Acerca de mi</a>
      </div>
      <div class="nav-item">
        <a href="/config" class="nav-link">Configuracion</a>
      </div>
    </div>
  </div>
</nav>
<form id="nav-form" action="/server.php" method="post">
      <input type="hidden" name="acc" id="acc" value="" />
      <input type="hidden" name="theme" id="theme" value="" />
    </form>
<script src="/js/navbar.js"></script>