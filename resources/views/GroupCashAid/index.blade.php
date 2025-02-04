@extends('layouts.app')

@section('title', 'الموافقة/مجموعات المساعدات النقدية')

@section('content')  

<div class="card card-default">
    <div class="card-header" style="display: flex; justify-content: center;">
        <h2>مجموعات المساعدات النقدية /الموافقة</h2>  
    </div> 



    <div class="form-container"> 
    <table id="table" class="display table-responsive" style="text-align: center; margin: 0px auto; width:98%" dir="rtl">
        <thead>
            <tr>
                <th style="padding: 10px;">ID</th>
                <th style="padding: 10px;">التاريخ</th>
                <th style="padding: 20px;">اسم المجموعة</th>
                <th style="padding: 20px;">القيمة المالية للدعم</th>
                <th style="padding: 20px;">ملاحظات</th>
                <th style="padding: 10px;">عدد المستفيدين</th>
                <th style="padding: 10px;">عدد الموافقات</th>
                <th style="padding: 10px;">عدد الباقي</th>
                <th style="padding: 10px;">عرض التفاصيل</th>
            </tr>
        </thead>
        
        {{-- line under headers  --}}
        <tr>
            <td colspan="5" style="border-bottom: 1px solid #241f1f; height: 10px;"></td>
        </tr> 


        <tbody>
            @foreach($cashAids as $groupId => $group)
            <tr style="margin-bottom: 5%">
                <td>{{ \App\Models\CashAidGroup::find($groupId)->ID }}</td>
                <td>{{ $group->first()->Date }}</td>                
                <td>{{ \App\Models\CashAidGroup::find($groupId)->Name }}</td>
                {{-- <td>{{ $group->first()->typeOfMaterialAid->Name ?? 'N/A' }}</td> --}}
                
                <td class="amount" data-amount="{{ $group->first()->Amount ?? '0' }}">{{ $group->first()->Amount ?? 'N/A' }}</td>

                <td>{{ $group->first()->Comment ?? 'N/A' }}</td> 
                <td>{{ $group->count() }}</td>
                <td>{{ $group->where('Status', '!=', 1)->count() }}</td>
                <td style="color: red;">{{ $group->where('Status', '=', 1)->count() }}</td>

                <td>
                    <button class="btn btn-primary btn-sm show-details" data-group-id="{{ $groupId }}" style="margin-bottom: 5%;margin-top: 20%">
                        عرض التفاصيل
                    </button>
                </td>
            </tr>


            <tr class="details-row" data-group-id="{{ $groupId }}" style="display: none;margin-bottom: 5%">
                
                    <td colspan="5">
                        {{-- للبحث في الجدول --}}
                        <div class="search-container" style="margin-bottom: 20px;">
                            <input type="text" id="searchInput-{{ $groupId }}" placeholder="ابحث عن عنصر..." class="form-control" style="width: 300px; display: inline-block;">
                        </div>

                    <table class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>رقم العائلة</th>
                                <th>اسم العائلة</th>
                                {{-- <th>التاريخ</th>
                                <th>نوع الدعم</th>
                                <th>القيمة المالية للدعم</th>
                                <th>ملاحظات</th> --}}
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($group as $aid)
                            <tr>
                                <td>{{ $aid->ID }}</td>
                                <td>{{ $aid->Family_ID }}</td>
                                <td>{{ $aid->family->Applicant_Name }}</td>
                                {{-- <td>{{ $aid->Date }}</td>
                                <td>{{ $aid->typeOfMaterialAid->Name ?? 'N/A' }}</td>
                                <td class="amount" data-amount="{{ $aid->Amount }}">{{ $aid->Amount }}</td>
                                <td>{{ $aid->Comment }}</td> --}}
                                <td>
                                    @if($aid->Status == 1)
                                        معلق
                                    @elseif($aid->Status == 2)
                                    <span class="status-text" style="color: red;">موافق</span>
                                    @else
                                    <span class="status-text" style="color: green;">تسليم</span>                                    @endif
                                </td>
                             <td>
                                    
                                <button class="btn btn-primary btn-sm action-button" data-aid-id="{{ $aid->ID }}" 
                                                                                     data-status="{{ $aid->Status }}">
                                    @if($aid->Status == 1)
                                        معلق
                                    @elseif($aid->Status == 2)
                                        موافق
                                    @endif
                                </button>
                                    
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

@endsection

{{-- <script src="{{ asset('js/FamiliesTable.js') }}"></script>  --}}

{{-- لإظهار الفاصلة العائمة  --}}
<script src="{{ asset('js/formatNumberTable.js') }}"></script> 

@section('customJs')  


{{-- لعرض تفاصيل المساعدات الجماعية  --}}
<script src="{{ asset('js/DisplayDetailsOfGroupAid.js') }}"></script>


 {{-- البحث ضمن المجموعة --}}
 <script src="{{ asset('js/SearchInGroup.js') }}"></script>


{{-- update status --}}
<script src="{{ asset('js/UpdateStatus.js') }}"></script>
    
@endsection
