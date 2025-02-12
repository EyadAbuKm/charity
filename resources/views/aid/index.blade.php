@extends('layouts.app')

@section('title', 'إضافة دعم لأسرة')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/move.css') }}">

    @if (session('success'))
        <div class="alert alert-success" style="width: 40%; margin: 0px auto; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" style="width: 40%; margin: 0px auto; text-align: center;">
            {{ session('error') }}
        </div>
    @endif

    <h2 style="text-align: center;">إضافة دعم لأسرة</h2>
    <div class="card card-default" style="padding: 2%;">
        <div class="card-header" style="display: flex; justify-content: center;">

        </div>

        {{-- @if (session('error'))
    <div class="alert alert-danger" style="text-align: center;">
        {{ session('error') }}
    </div>
    @endif --}}

        <div class="row">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalForm"
                style= "width: 200px;margin-right:2%;" tabindex="2">
                إضافة مساعدة مالية
            </button>

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalForm2"
                style= "width: 200px;" tabindex="3">
                إضافة مساعدة عينية
            </button>

        </div>

        <form action="{{ route('aid.index') }}" method="GET" style="text-align: center; margin-bottom: 20px;">
            {{-- <button type="submit">رقم الأسرة</button>   --}}
            <input type="text" name="Family_ID" placeholder="           أدخل رقم الأسرة" required autofocus
                tabindex="1">

        </form>

        <!-- Family Details Table -->
        <h2 style="text-align: center;">بيانات العائلة</h2>
        <table id="family-table" class="display table-responsive" style="text-align: center; margin: 0px auto; width:98%"
            dir="rtl">
            <thead>
                <tr>
                    <th style="color:rgb(170, 19, 186);">رقم دفتر العائلة</th>
                    {{-- <th>المحافظة</th> --}}
                    <th>رقم الملف</th>
                    <th>تاريخ تقديم الطلب</th>
                    <th style="color:rgb(170, 19, 186);">الاسم</th>
                    <th>تصنيف الأسرة</th>
                    <th>هاتف</th>
                    <th>رقم الجوال</th>
                    {{-- <th>العنوان في داريا</th>
                    <th>العنوان الحالي</th>
                    <th>حالة السكن</th>
                    <th>الآجار الشهري</th>
                    <th>موارد إضافية</th>
                    <th>الملخص</th>
                    <th>ملاحظات</th>
                    <th>موظف الجمعية</th>   --}}
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td style="color: rgb(135, 6, 6); font-weight: bold;">{{ $family->Family_ID }}</td>
                    {{-- <td>{{ $family->governorate->name }}</td>   --}}
                    <td>{{ $family->FIle_No }}</td>
                    <td>{{ \Carbon\Carbon::parse($family->Application_Date)->format('Y-m-d') }}</td>
                    <td style="color: rgb(135, 6, 6); font-weight: bold;">{{ $family->Applicant_Name }}</td>
                    <td>{{ $family->familyRate->Rate }}</td>
                    <td>{{ $family->Tel_Number }}</td>
                    <td>{{ $family->Mob_Number }}</td>
                    {{-- <td>{{ $family->Daria_Address }}</td>  
            <td>{{ $family->Current_Address }}</td>  
            <td>{{ $family->homeStatus->status }}</td>  
            <td>{{ $family->Monthly_Rent }}</td>  
            <td>{{ $family->Another_Resources }}</td>  
            <td>{{ $family->Summary }}</td>  
            <td>{{ $family->Notes }}</td>  
            <td>{{ $family->File_Editor_Name }}</td>           --}}
                </tr>
            </tbody>
        </table>


        <!-- Cash Aid Table -->
        <h2 style="text-align: center;">المساعدات المالية</h2>
        <table id="cash-aid-table" class="display" style="text-align: center; width:98%; margin: 0px auto;" dir="rtl">
            <thead>
                <tr>
                    <th>ID</th>
                    {{-- <th>رقم دفتر العائلة</th>   --}}
                    <th>التاريخ</th>
                    <th>المبلغ</th>
                    <th>ملاحظات</th>
                    {{-- <th>تعديل</th>  
            <th>حذف</th> --}}
                    {{-- <th>Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($cashAids as $cashAid)
                    <tr>
                        <td>{{ $cashAid->ID }}</td>
                        {{-- <td>{{ $cashAid->Family_ID }}</td>   --}}
                        <td>{{ \Carbon\Carbon::parse($cashAid->Date_)->format('Y-m-d') }}</td>
                        {{-- <td>{{ $cashAid->Amount }}</td>   --}}

                        <!-- إضافة خاصية data-amount لتخزين القيمة الخام من المبلغ -->
                        <td class="amount" data-amount="{{ $cashAid->Amount }}">{{ $cashAid->Amount }}</td>


                        <td>{{ $cashAid->Comment }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Material Aid Table -->
        <h2 style="text-align: center;">المساعدات العينية</h2>
        <table id="material-aid" class="display" style="text-align: center; margin: 0px auto; width:98%" dir="rtl">

            <thead>
                <tr>
                    <th>ID</th>
                    {{-- <th>رقم دفتر العائلة</th>   --}}
                    <th>التاريخ</th>
                    <th>نوع المساعدة</th>
                    <th>العدد</th>
                    <th>ملاحظات</th>
                    {{-- <th>تعديل</th>  
            <th>حذف</th>   --}}
                    {{-- <th>Actions</th>   --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($materialAids as $materialAid)
                    <tr>
                        <td>{{ $materialAid->ID }}</td>
                        {{-- <td>{{ $materialAid->Family_ID }}</td>   --}}
                        <td>{{ \Carbon\Carbon::parse($materialAid->Date)->format('Y-m-d') }}</td>
                        <!-- Ensure date is formatted -->
                        <td>{{ $materialAid->typeOfMaterialAid->Name }}</td>
                        <td>{{ $materialAid->Amount }}</td>
                        <td>{{ $materialAid->Comment }}</td>
                        {{-- <td>  
                    <a href="/MaterialAid/edit/{{ $materialAid->ID }}" target="_blank"><i class="fas fa-edit"></i> Edit</a>  
                </td>  
                <td>  
                    <form action="{{ route('MaterialAid.delete', $materialAid->ID) }}" method="POST" target="_blank" style="display:inline;">  
                        @csrf  
                        @method('DELETE')  
                        <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Delete</button>  
                    </form>  
                </td>   --}}
                    </tr>
                @endforeach
            </tbody>
        </table>



    @endsection

    {{-- View for add Cash  support to family  --}}

    <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalFormTitle"aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalFormTitle">إضافة مساعدة لعائلة</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <form action="{{ route('aid.add') }}" method="POST"
                        style="text-align: right; margin: 0px auto; width:98%" dir="rtl">
                        @csrf
                        <div>
                            <input type="hidden" value="{{ $family->Family_ID }}" name="Family_ID"
                                class="form-control" id="Family_ID" required>
                            <input type="hidden" value="true" name="redirect_back" class="form-control"
                                id="Family_ID" required>

                        </div>

                        <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                            <div style="width: 48%;">
                                <label for="family_id">رقم دفتر العائلة</label>
                                <input type="number" id="Family_ID" name="Family_ID" value="{{ $family->Family_ID }}"
                                    style="text-align: center;" class="form-control" readonly>
                            </div>
                            {{-- <div style="width: 48%;">
                    <label for="applicant_name">اسم مقدم الطلب</label>
                    <input type="text" id="applicant_name" name="Applicant_Name" value="{{ $family->Applicant_Name }}" style="text-align: center;" class="form-control" readonly>
                </div> --}}
                        </div>

                        <div class="form-group">
                            <label for="date">التاريخ</label>
                            <input type="date" id="date" name="Date_" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="amount">المبلغ</label>
                            {{-- <input type="number" id="amount" name="Amount" placeholder="Amount" required>           --}}
                            {{-- <input type="number" id="amount" name="Amount" placeholder="المبلغ" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" autofocus > --}}
                            <input type="text" id="amount" name="Amount" placeholder="المبلغ"
                                oninput="formatNumber(this)" required autofocus class="form-control">
                            <!-- حقل مخفي لتخزين القيمة الفعلية المبلغ بدون تنسيق -->
                            <input type="hidden" id="RawAmount" name="Amount">
                        </div>

                        <div>
                            <input type="text" id="status" name="Status" value="3"
                                style="display:none;">
                        </div>

                        <div class="form-group">
                            <label for="comment">ملاحظات</label>
                            <input type="text" id="comment" name="Comment" placeholder="ملاحظات"
                                class="form-control">
                        </div>


                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary" style="width: 20%;">تسجيل</button>
                            <button type="reset" class="btn btn-primary  style=width: 20%;">إعادة تعيين</button>
                        </div>


                    </form>


                </div>

                <div class="modal-footer">


                    <button type="button" class="btn btn-primary" data-dismiss="modal">اغلاق</button>

                </div>

            </div>

        </div>

    </div>

    {{-- View for add Cash  support to family  --}}


    <div class="modal fade" id="exampleModalForm2" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalFormTitle2"aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalFormTitle2">إضافة مساعدة عينية لعائلة</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <form action="{{ route('aid.add_material') }}" method="POST"
                        style="text-align: right; margin: 0px auto; width:98%" dir="rtl">
                        @csrf
                        <div>
                            <input type="hidden" value="{{ $family->Family_ID }}" name="Family_ID"
                                class="form-control" id="Family_ID" required>
                            <input type="hidden" value="true" name="redirect_back" class="form-control"
                                id="Family_ID" required>

                        </div>


                        <div style="width: 48%;">
                            <label for="family_id">رقم دفتر العائلة</label>
                            <input type="number" id="Family_ID" name="Family_ID" value="{{ $family->Family_ID }}"
                                style="text-align: center;" class="form-control" readonly>
                        </div>

                        <label for="date">التاريخ</label>
                        <input type="date" name="Date" value="{{ date('Y-m-d') }}" required
                            class="form-control">
                        <br>

                        <label for="Type_Of_Aid">نوع المساعدة</label>
                        <select name="Type_Of_Aid" id="Type_Of_Aid" required class="form-control">
                            <option value="" disabled selected>Type Of Aid</option>
                            @foreach ($TypeOfMaterialAids as $TypeOfMaterialAid)
                                <option value="{{ $TypeOfMaterialAid->ID }}">{{ $TypeOfMaterialAid->Name }}</option>
                            @endforeach
                        </select>

                        <br>

                        <label for="amount">القيمة المالية</label>
                        <input type="number" name="Amount" placeholder="َالقيمة المالية" class="form-control">
                        <br>

                        <div>
                            <input type="text" id="status" name="Status" value="3"
                                style="display:none;">
                        </div>

                        <label for="comment">ملاحظات</label>
                        <input type="text" name="Comment" placeholder="Comment" class="form-control">
                        <br>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary" style="width: 20%;">تسجيل</button>
                            <button type="reset" class="btn btn-primary  style=width: 20%;">إعادة تعيين</button>
                        </div>


                    </form>


                </div>

                <div class="modal-footer">


                    <button type="button" class="btn btn-primary" data-dismiss="modal">اغلاق</button>

                </div>

            </div>

        </div>

    </div>



    @section('customJs')


        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" language="javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

        <script src="{{ asset('js/FamiliesTable.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#family-table, #members-table, #cash-aid-table, #material-aid').DataTable({
                    // Initialize DataTables for all tables with .display class  
                    // $('.display').DataTable({    
                    dom: 'Bfrtip',
                    buttons: ['excel'],
                    order: [
                        [0, 'desc'],
                    ] // Order by the first column (ID) in descending order  
                });
            });
        </script>

        {{-- لإظهار الفاصلة العائمة  --}}
        <script src="{{ asset('js/formatNumber.js') }}"></script>

        {{-- تنسيق قيم المبلغ عند تحميل الصفحة باستخدام JavaScript --}}
        {{-- تنسيق القيم الرقمية الخاصة بالمبالغ في خلايا الجدول عند تحميل الصفحة --}}
        <script src="{{ asset('js/formatNumberTable.js') }}"></script>

    @endsection
