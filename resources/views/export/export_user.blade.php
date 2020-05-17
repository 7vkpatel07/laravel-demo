<table width="100%" align="center">
    <thead>
        <tr>
            <th>{{translate('First Name')}}</th>
            <th>{{translate('Last Name')}}</th>
            <th>{{translate('Email')}}</th>
            <th>{{translate('Country Code')}}</th>
            <th>{{translate('Mobile')}}</th>
            <th>{{translate('Phone Number')}}</th>
            <th>{{translate('Date of Birth')}}</th>
            <th>{{translate('Social Id')}}</th>
            <th>{{translate('House Number')}}</th>
            <th>{{translate('Street')}}</th>
            <th>{{translate('City')}}</th>
            <th>{{translate('Country')}}</th>
            <th>{{translate('Zip Code')}}</th>
            <th>{{translate('Fax')}}</th>
            <th>{{translate('User Skills')}}</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($listing) && !empty($listing))
        @foreach($listing as $listingVal)
        <tr>
            @if(currentLanguage()==1)
            <td>{{isset($listingVal->first_name)?$listingVal->first_name:'N/A'}}</td>
            <td>{{isset($listingVal->last_name)?$listingVal->last_name:'N/A'}}</td>
            @else
            <td>{{isset($listingVal->first_name_en)?$listingVal->first_name_en:'N/A'}}</td>
            <td>{{isset($listingVal->last_name_en)?$listingVal->last_name_en:'N/A'}}</td>
            @endif
            <td>{{isset($listingVal->email)?$listingVal->email:'N/A'}}</td>
            <td>{{isset($listingVal->country->country_code)?$listingVal->country->country_code:'N/A'}}</td>
            <td>{{isset($listingVal->mobile_phone)?$listingVal->mobile_phone:'N/A'}}</td>
            <td>{{isset($listingVal->phone)?$listingVal->phone:'N/A'}}</td>
            <td>{{isset($listingVal->birth_date)?convertDate($listingVal->birth_date):'N/A'}}</td>
            <td>{{isset($listingVal->social_id_number)?$listingVal->social_id_number:'N/A'}}</td>
            <td>{{isset($listingVal->address_street_number)?$listingVal->address_street_number:'N/A'}}</td>
            <td>{{isset($listingVal->address_street)?$listingVal->address_street:'N/A'}}</td>
            <td>{{isset($listingVal->address_city_en)?$listingVal->address_city_en:'N/A'}}</td>
            <td>{{isset($listingVal->country->country_name_en)?$listingVal->country->country_name_en:'N/A'}}</td>
            <td>{{isset($listingVal->address_zip)?$listingVal->address_zip:'N/A'}}</td>
            <td>{{isset($listingVal->fax)?$listingVal->fax:'N/A'}}</td>
            <td>
                @if($listingVal->skills && !empty($listingVal->skills))
                @foreach($listingVal->skills as $skillsVals)
                @if(currentLanguage() == 1)
                {{$skillsVals->skill_name}},
                @else
                {{$skillsVals->skill_name_en}},
                @endif
                @endforeach
                @endif
            </td>
        </tr>
        @endforeach
        @endif

    </tbody>
</table>