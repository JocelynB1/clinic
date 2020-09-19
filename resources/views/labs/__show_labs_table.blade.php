<tr>
    <td>Fasting Blood Sugar</td>
    <td>{{$labs->fasting_blood_sugar}}</td>
</tr>
<tr>
    <td>HBA1C</td>
    <td>{{$labs->hba1c}}</td>
</tr>
<tr>
    <td>Cholesterol</td>
    <td>{{$labs->cholesterol}}</td>
</tr>
<tr>
        <td>HDL Cholesterol</td>
        <td>{{$labs->hdl_cholesterol}}</td>
    </tr>
    <tr>
        @if($labs->renal_function!="Mild" && $labs->renal_function!="Moderate")
        <td class="inverseRow">Renal Function</td>
        <td class="dangerDoctor">{{$labs->renal_function}}</td>
        @endif
    </tr>
    <tr>
    @if($labs->ecg!="Minor" && $labs->ecg!="Normal")
    <td class="inverseRow">ECG</td>
    <td class="dangerDoctor">{{$labs->ecg}}</td>
    @endif
</tr>
<tr>
    @if($labs->bun<7)
    <td class="inverseRow">Bun</td>
    <td class="dangerDoctor">{{$labs->bun}}</td>
    @endif
    @if($labs->bun>20)
    <td class="inverseRow">Bun</td>
    <td class="dangerDoctor">{{$labs->bun}}</td>
    @endif
    @if($labs->bun<7 &&$labs->bun>20)
    <td>Bun</td>
    <td>{{$labs->bun}}</td>
    @endif
</tr>
<tr>
        @if($labs->creatinine<7)
        <td class="inverseRow">Creatinine</td>
        <td class="dangerDoctor">{{$labs->creatinine}}</td>
        @endif
        @if($labs->creatinine>20)
        <td class="inverseRow">Creatinine</td>
        <td class="dangerDoctor">{{$labs->creatinine}}</td>
        @endif
        @if($labs->creatinine<7 &&$labs->creatinine>20)
        <td>Creatinine</td>
        <td>{{$labs->creatinine}}</td>
        @endif
    </tr>
    <tr>
        <td>Recorded By</td>
        <td>{{$labs->seen_by}}</td>
    </tr>