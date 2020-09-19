<?php
$visits=null;
if(isset($patient)){
$allVisits=$patient->visits->all();
$allVitals=$patient->vitals->all();
$vitals=null;
$allLabs=$patient->labs->all();
$consultationLength=count($patient->consultations->all());
$allConsultations=$patient->consultations->all();
}else{
$patient=null;
}
?>
           
            @if($patient==null)                    
                @else
                <h1>Biographical Data For {{$patient->name}}</h1>

                <table>
                <hr>
                    <tbody>
                        @include('patients.__show_patients_table')  
                    </tbody>
                </table>
            @endif
            @foreach ($allVisits as $visits)
            <h1>Medical History as of {{$visits->created_at->format("d-m-y")}}</h1>

               <table>
                    <tbody>
                        @include('visits.__show_visits_table_all')
                    </tbody>
                </table>
            @endforeach
          
            @foreach($allVitals as $vitals)
            <h1>Vitals Recorded on {{$vitals->created_at->format("d-m-y")}}</h1>

            <table>
                    <tbody>
                         @include('vitals.__show_vitals_all')
                    </tbody>
                </table>
            @endforeach
          
            @foreach ($allLabs as $labs)
            <h1>Test Results Recorded on {{$labs->created_at->format("d-m-y")}}</h1>

            <table>
                    <tbody>
                            @include('labs.__show_labs_table_all')
                    </tbody>
                </table>                    
            @endforeach
            @foreach ($allConsultations as $consultations)
            <h1>Consulted on {{$consultations->created_at->format("d-m-y")}}</h1>

            <table>
         
                <tbody>
                        @include('consultations.__show_consultations_table_all')
                </tbody>
            </table>                    
        @endforeach

         