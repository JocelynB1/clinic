
    @if($vitals->weight)
    <tr>
        <td>Weight</td>
        <td>{{$vitals->weight}}</td>
    </tr>
    @endif

    @if($vitals->height)
    <tr>
        <td>Height</td>
        <td>{{$vitals->height}}</td>
    </tr>
    @endif

    @if($vitals->abdominal_girth)
    <tr>
        <td>Abdominal Girth</td>
        <td>{{$vitals->abdominal_girth}}</td>
    </tr>
    @endif

    @if($vitals->bmi)
    <tr>
        <td>BMI</td>
        <td>{{$vitals->bmi}}</td>
     </tr>
     @endif

    @if($vitals->bmi_level)
     <tr>
        <td>BMI Level</td>
        <td>{{$vitals->bmi_level}}</td>
    </tr>
    @endif
    
    @if($vitals->systolic_bp)
    <tr>
       <td >Systolic</td>
       <td>{{$vitals->systolic_bp}}</td>        
    </tr>
    @endif

    @if($vitals->diastolic_bp)
    <tr>
        <td>Diastolic</td>
        <td>{{$vitals->diastolic_bp}}</td>        
    </tr>
    @endif

    @if($vitals->bp_category)
    <tr>
        <td>BP Category</td>
        <td>{{$vitals->bp_category}}</td>
    </tr>
    @endif

    @if($vitals->heart_rate)
     <tr>
        <td>Heart Rate</td>
        <td>{{$vitals->heart_rate}}</td>
    </tr>
    @endif

    @if($vitals->seen_by)

    <tr>
        <td>Vitals Recorded By</td>
        <td>{{$vitals->seen_by}}</td>
    </tr>
            
    @endif