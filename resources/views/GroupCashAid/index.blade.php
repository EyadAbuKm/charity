@extends('layouts.app')

@section('title', 'الموافقة/مجموعات المساعدات النقدية')

@section('content')  

<div class="card card-default">
    <div class="card-header" style="display: flex; justify-content: center;">
        <h2>مجموعات المساعدات النقدية /الموافقة</h2>  
    </div> 

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif



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
                {{-- <td style="color: red;">{{ $group->where('Status', '=', 1)->count() }}</td> --}}

                {{-- يظهر اللون الأحمر إن كانت القيمة أكبر من صفر --}}
                <td style="{{ $group->where('Status', '=', 1)->count() > 0 ? 'color: red;' : '' }}">  
                {{ $group->where('Status', '=', 1)->count() }}  
                </td>

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
     
                                <td class="status-text">  
                                    @if($aid->Status == 1)  
                                        معلق  
                                    @elseif($aid->Status == 2)  
                                        <span class="status-text" style="color: red;">موافق</span>
                                    @elseif($aid->Status == 3)  
                                    <span class="status-text" style="color: rgb(20, 205, 23);">تسليم</span>
                                    @endif  
                                </td>  
                                <td>  
                                    <button class="btn btn-primary btn-sm action-button"   
                                            data-aid-id="{{ $aid->ID }}"   
                                            data-status="{{ $aid->Status }}">  
                                        @if($aid->Status == 1)  
                                            معلق  
                                        @elseif($aid->Status == 2)  
                                            موافق 
                                        @elseif($aid->Status == 3)  
                                            تسليم  
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


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  --}}


{{-- لإظهار الفاصلة العائمة  --}}
<script src="{{ asset('js/formatNumberTable.js') }}"></script> 

@section('customJs')  


{{-- لعرض تفاصيل المساعدات الجماعية  --}}
<script src="{{ asset('js/DisplayDetailsOfGroupAid.js') }}"></script>


 {{-- البحث ضمن المجموعة --}}
 <script src="{{ asset('js/SearchInGroup.js') }}"></script>


{{-- update status --}}
{{-- <script src="{{ asset('js/UpdateStatus.js') }}"></script>  --}}
<script>
$(document).ready(function() {  
    // عندما يتم تحميل الصفحة، نبدأ بإعداد المستمع على الزر  
    $('.action-button').on('click', function() {  
        var aidId = $(this).data('aid-id'); // الحصول على ID المساعدة من البيانات المرتبطة بالزر  
        var status = $(this).data('status'); // الحصول على الحالة الحالية من البيانات المرتبطة بالزر  
        
        // الاستمرار فقط إذا كانت الحالة 1  
        if (status == 1) {  
            $.ajax({  
                url: '/update-aid-status', // تعديل عنوان URL حسب الضرورة  
                method: 'POST',   // تحديد طريقة الطلب كـ POST  
                data: {  
                    id: aidId,  // تمرير ID المساعدة إلى الخادم  
                    _token: '{{ csrf_token() }}' // تضمين توكن CSRF لأغراض الأمان  
                },  
                success: function(response) {  
                    // هذا الجزء ينفذ عند نجاح الطلب  
                    if (response.status === 'success') {  
                        // تحديث نص الزر إلى "موافق"  
                        $(this).text('موافق').data('status', 2); // تحديث البيانات المرتبطة  

                        // تحديث نص الحقل "Status" في الصف لهذه المساعدة فقط  
                        $(this).closest('tr').find('.status-text').text('موافق').css('color', 'red'); // تحديث نص الحالة                         
                    } 
                   
                    else if (response.newStatus === 3) {  
                            $(this).text('تسليم').data('status', 3);
                            $(this).text('تسليم').data('status', 3);  
                            $(this).closest('tr').find('.status-text').text('تسليم'); // تحديث نص الحالة إلى "تسليم"  
                        }  

                }.bind(this), // ربط 'this' للوصول إلى الزر داخل دالة النجاح  
                error: function(xhr) {  
                    // في حالة حدوث خطأ، يمكن طباعة رسالة خطأ  
                    console.error('حدث خطأ:', xhr.responseText);  
                }  
            });  
        } else {  
            // إذا كانت الحالة ليست 1، تجاوز الطلب  
            console.log('تمت الموافقة مُسبقاً');  
        }  
    });  
});  
</script>

@endsection
