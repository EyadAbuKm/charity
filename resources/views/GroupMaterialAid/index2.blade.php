@extends('layouts.app')

@section('title', 'تسليم/مجموعات المساعدات العينية')

@section('content')  

<div class="card card-default">
    <div class="card-header" style="display: flex; justify-content: center;">
        <h2>مجموعات المساعدات العينية/تسليم</h2>  
    </div> 



    <div class="form-container"> 
    <table id="table" class="display table-responsive" style="text-align: center; margin: 0px auto; width:98%" dir="rtl">
        <thead>
            <tr>
                <th style="padding: 10px;">ID</th>
                <th style="padding: 10px;">التاريخ</th>
                <th style="padding: 20px;">اسم المجموعة</th>
                <th style="padding: 20px;">نوع الدعم</th>
                <th style="padding: 20px;">القيمة المالية للدعم</th>
                <th style="padding: 20px;">ملاحظات</th>
                <th style="padding: 10px;">عدد المستفيدين</th>
                <th style="padding: 10px;">عرض التفاصيل</th>
            </tr>
        </thead>
        
        {{-- line under headers  --}}
        <tr>
            <td colspan="5" style="border-bottom: 1px solid #241f1f; height: 10px;"></td>
        </tr> 


        <tbody>
            @foreach($materialAids as $groupId => $group)
            <tr style="margin-bottom: 5%">
                <td>{{ \App\Models\MaterialAidGroupName::find($groupId)->ID }}</td>
                <td>{{ $group->first()->Date }}</td>                
                <td>{{ \App\Models\MaterialAidGroupName::find($groupId)->Name }}</td>
                <td>{{ $group->first()->typeOfMaterialAid->Name ?? 'N/A' }}</td>
                
                <td class="amount" data-amount="{{ $group->first()->Amount ?? '0' }}">{{ $group->first()->Amount ?? 'N/A' }}</td>

                <td>{{ $group->first()->Comment ?? 'N/A' }}</td> 
                <td>{{ $group->count() }}</td>
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
                                {{-- <th>الحالة</th> --}}
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
                          
                                <td class="status-text">  
                                    @if($aid->Status == 2)  
                                        موافق  
                                    @elseif($aid->Status == 3)  
                                        <span class="status-text" style="color: rgb(19, 219, 89);">تسليم</span>  
                                    @endif  
                                </td> 

                             <td>  
                                <button class="btn btn-primary btn-sm action-button"   
                                        data-aid-id="{{ $aid->ID }}"   
                                        data-status="{{ $aid->Status }}">  
                                    @if($aid->Status == 2)  
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

{{-- <script src="{{ asset('js/FamiliesTable.js') }}"></script>  --}}

{{-- لإظهار الفاصلة العائمة  --}}
<script src="{{ asset('js/formatNumberTable.js') }}"></script> 

@section('customJs')  

{{-- لعرض تفاصيل المساعدات الجماعية  --}}
 <script src="{{ asset('js/DisplayDetailsOfGroupAid.js') }}"></script>
       

 {{-- البحث ضمن المجموعة --}}
<script src="{{ asset('js/SearchInGroup.js') }}"></script>



{{-- update status --}}

<script>
    $(document).ready(function() {  
        // عندما يتم تحميل الصفحة، نبدأ بإعداد المستمع على الزر  
        $('.action-button').on('click', function() {  
            var aidId = $(this).data('aid-id'); // الحصول على ID المساعدة من البيانات المرتبطة بالزر  
            var status = $(this).data('status'); // الحصول على الحالة الحالية من البيانات المرتبطة بالزر  
            
            // الاستمرار فقط إذا كانت الحالة 1  
            if (status == 2) {  
                $.ajax({  
                    url: '/Fianl-update-material-aid-status', // تعديل عنوان URL حسب الضرورة  
                    method: 'POST',   // تحديد طريقة الطلب كـ POST  
                    data: {  
                        id: aidId,  // تمرير ID المساعدة إلى الخادم  
                        _token: '{{ csrf_token() }}' // تضمين توكن CSRF لأغراض الأمان  
                    },  
                    success: function(response) {  
                        // هذا الجزء ينفذ عند نجاح الطلب  
                        if (response.status === 'success') {  
                            // تحديث نص الزر إلى "موافق"  
                            $(this).text('تسليم').data('status', 3); // تحديث البيانات المرتبطة  
    
                            // تحديث نص الحقل "Status" في الصف لهذه المساعدة فقط  
                            $(this).closest('tr').find('.status-text').text('تسليم').css('color', 'green'); // تحديث نص الحالة                         
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



{{-- <script>
$(document).on('click', '.action-button', function() {
    var button = $(this);
    var aidId = button.data('aid-id');
    var currentStatus = button.data('status');

    console.log('Aid ID:', aidId);
    console.log('Current Status:', currentStatus);

    var newStatus;
    var buttonText;
    var buttonColor;

    if (currentStatus == 1) {
        newStatus = 2;
        buttonText = 'موافق';
        buttonColor = 'btn-danger'; // اللون الأحمر
    } else if (currentStatus == 2) {
        newStatus = 3;
        buttonText = 'تسليم';
        buttonColor = 'btn-success'; // اللون الأخضر
    } else if (currentStatus == 3) {
        return; // لا تفعل شيئًا إذا كانت الحالة 3
    }

    // تحديث الزر
    button.data('status', newStatus);
    button.text(buttonText);
    button.removeClass('btn-primary').addClass(buttonColor);

    // تخزين الحالة في Local Storage
    localStorage.setItem('aidStatus_' + aidId, newStatus);

    // تنفيذ طلب AJAX لتحديث الحالة
    $.ajax({
        url: '/update-aid-status',
        method: 'POST',
        data: {
            id: aidId,
            status: newStatus,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            console.log('Status updated successfully:', response);
        },
        error: function(xhr) {
            console.error('Error updating status:', xhr);
            // إعادة الحالة القديمة إذا حدث خطأ
            button.data('status', currentStatus);
            button.text(currentStatus == 1 ? 'معلق' : (currentStatus == 2 ? 'موافق' : 'تسليم'));
            button.removeClass(buttonColor).addClass('btn-primary');
        }
    });
});

// استرجاع الحالة من Local Storage عند تحميل الصفحة
$(document).ready(function() {
    $('.action-button').each(function() {
        var button = $(this);
        var aidId = button.data('aid-id');
        var storedStatus = localStorage.getItem('aidStatus_' + aidId);

        if (storedStatus) {
            button.data('status', storedStatus);
            if (storedStatus == 2) {
                button.text('موافق').removeClass('btn-primary').addClass('btn-danger');
            } else if (storedStatus == 3) {
                button.text('تسليم').removeClass('btn-primary').addClass('btn-success');
            }
        }
    });
});
</script> --}}

@endsection
