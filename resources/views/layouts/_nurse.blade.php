<li class="nav-item">
    <a class="nav-link " href="{{ route('patients.create') }}" id="navbarDropdown" role="button"  aria-haspopup="true" aria-expanded="false">
      New Patients
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Previous Patients
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('patients.createPrevious') }}">Find Previous Patients By ID</a>
        <a class="dropdown-item" href="{{ route('patients.searchByName') }}">Find Previous Patients By Name</a>
        <a class="dropdown-item" href="{{ route('patients.searchByPhoneNumber') }}">Find Previous Patients By Phone Number</a>    
        <a class="dropdown-item" href="{{ route('patients.index') }}">Manage Patients</a>
    </div>
  </li>



  