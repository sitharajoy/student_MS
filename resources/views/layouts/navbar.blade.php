<nav class="navbar navbar-expand-lg navbar-light bg-light top-header">
  <div class="container-fluid">
    <a class="navbar-brand text-white font-weight-bold" href="{{ URL::Route('studentList') }}">STUDENT MS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active btn-xs font-weight-bold text-white" aria-current="page" href="{{ URL::Route('addStudentMarkView') }}">Marks</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>