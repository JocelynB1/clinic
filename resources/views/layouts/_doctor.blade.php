<?php

$unseenPatients=\App\PatientVital::where('has_seen_doctor?',false)->count();


?>


<li class="nav-item dropdown">
        <a class="nav-link " href="{{ route('consultations.index') }}" id="navbarDropdown" role="button"  aria-haspopup="true" aria-expanded="false">
          Consult Patients <span class="badge badge-pill badge-primary">{{ $unseenPatients}}</span>
        </a>
        
</li>

<li class="nav-item dropdown">
 
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Patients
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="{{ route('patients.index') }}">Manage Patients</a>
      <a class="dropdown-item" href="{{ route('patients.create') }}">Add Patients</a>
      <div class="nav-item dropdown-submenu">
          <span class="dropdown-item" role="button" href="#">
              Previous Patients
          </span>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('patients.createPrevious') }}">Find Previous Patients By ID</a>
                <a class="dropdown-item" href="{{ route('patients.searchByName') }}">Find Previous Patients By Name</a>
                <a class="dropdown-item" href="{{ route('patients.searchByPhoneNumber') }}">Find Previous Patients By Phone Number</a>      
            </div>
          </div>
        
    </div> 
  </li>
<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reports 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('reports.setPatientsPerPeriod') }}">Patients Per Period</a>
          <a class="dropdown-item" href="{{ route('reports.setDisposalsPerPeriod') }}">Disposals Per Period</a>
          <a class="dropdown-item" href="{{ route('reports.setBpCategoryPerPeriod') }}">Bp Category Per Period</a>
          <a class="dropdown-item" href="{{ route('reports.setGenderPerPeriod') }}">Gender Per Period</a>
          <a class="dropdown-item" href="{{ route('reports.setPatientsByAgePerPeriod') }}">Patients By Age Per Period</a>
          <a class="dropdown-item" href="{{ route('reports.setPatientsByRiskLevel') }}">Patients By Risk level</a>
        <!--  <a class="dropdown-item" href="{{ route('reports.setPatientsByRiskFactor') }}">Patients By Risk Factor</a> !-->
          <a class="dropdown-item" href="{{ route('reports.getPatientsWhoHaveNotAttendedForSixMonths') }}">Follow Up Report</a>
          
        </div>

</li>



  


  
