<table>
    <thead>
    <tr>
        <th>{{translate('First Name'))}}</th>
        <th>{{translate('Last Name'))}}</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($listing) && !empty($listing))
        @foreach($listing as $listingVal)
        <tr>
            <td>{{isset($listingVal->first_name)?$listingVal->first_name:'N/A'}}</td>
            <td>{{isset($listingVal->last_name)?$listingVal->last_name:'N/A'}}</td>
        </tr>
        @endforeach
        @endif
    
    </tbody>
</table>