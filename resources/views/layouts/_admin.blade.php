<li class="nav-item dropdown">
        <span class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage Patients
        </span>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('patients.create') }}">Add Patients</a>
          <a class="dropdown-item" href="{{ route('patients.createPrevious') }}">Previous Patients</a>
          <a class="dropdown-item" href="{{ route('patients.index') }}">Manage Patients</a>
          <a class="dropdown-item" href="{{ route('visits.index') }}">Manage Medical History</a>
          <a class="dropdown-item" href="{{ route('vitals.index') }}">Manage Vitals</a>
          <a class="dropdown-item" href="{{ route('labs.index') }}">Manage Labs History</a>
          <a class="dropdown-item" href="{{ route('consultations.index') }}">Manage Consultations</a>
        </div> 
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register Users</a>
            </li>
