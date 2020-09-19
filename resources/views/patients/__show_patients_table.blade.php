        <tr>
            <td class="inverseRow">ID</td>
            <td class="okayDoctor">{{$record->pid}}</td>
        </tr>
        @if($record->name)
            <tr>
                <td>Name</td>
                <td>{{$record->name}}</td>
            </tr>
        @endif

        @if($record->gender)
        <tr>
            <td>Gender</td>
            <td>{{$record->gender}}</td>
        </tr>
        @endif

        @if($record->birth_date)
        <tr>
            <td>Birth Date</td>
            <td>{{$record->birth_date}}</td>
        </tr>
        @endif

        @if($record->area_of_residence)
        <tr>
            <td>Area of Residence</td>
            <td>{{$record->area_of_residence}}</td>
        </tr>
        @endif

        @if($record->mobile_phone_number)
        <tr>
            <td>Mobile Number</td>
            <td>{{$record->mobile_phone_number}}</td>
        </tr>
        @endif

        @if($record->alternative_phone_number)
            <tr>
                <td>Alternative Phone number</td>
                <td>{{$record->alternative_phone_number}}</td>
            </tr>
        @endif
    
        @if($record->created_at)
        
        <tr>
            <td>Date of First Visit</td>
            <td>{{$record->created_at}}</td>
        </tr>
         @endif