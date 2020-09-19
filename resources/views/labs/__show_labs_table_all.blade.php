    @if($labs->random_blood_sugar)
    <tr>
        <td>Random Blood Sugar</td>
        <td>{{$labs->random_blood_sugar}}</td>
    </tr>
    @endif

    @if($labs->fasting_blood_sugar)
    <tr>
        <td>Fasting Blood Sugar</td>
        <td>{{$labs->fasting_blood_sugar}}</td>
    </tr>
    @endif

    @if($labs->hba1c)
    <tr>
        <td>HBA1C</td>
        <td>{{$labs->hba1c}}</td>
    </tr>
    @endif

    @if($labs->cholesterol)
    <tr>
        <td>Cholesterol</td>
        <td>{{$labs->cholesterol}}</td>
    </tr>
    @endif

    @if($labs->hdl_cholesterol)
    <tr>
        <td>HDL Cholesterol</td>
        <td>{{$labs->hdl_cholesterol}}</td>
    </tr>
    @endif

    @if($labs->renal_function)
    <tr>
        <td>Renal Function</td>
        <td>{{$labs->renal_function}}</td>
    </tr>
    @endif
    @if($labs->ecg)
    <tr>
        <td>ECG</td>
        <td>{{$labs->ecg}}</td>
    </tr>
    @endif

    @if($labs->bun)
    <tr> 
        <td>Bun</td>
        <td>{{$labs->bun}}</td>
    </tr>
    @endif

    @if($labs->creatinine)
        <tr>
            <td>Creatinine</td>
            <td>{{$labs->creatinine}}</td>
        </tr>
    @endif
  
    @if($labs->seen_by)
        <tr>
            <td>Recorded By</td>
            <td>{{$labs->seen_by}}</td>
        </tr>
    @endif
