

<aside class="left-sidebar sidebar-dark" id="left-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
      <!-- Aplication Brand -->
      <div class="app-brand">
        <a href="/index.html">
          <img src="images/logo.png" alt="Mono">
          <span class="brand-name"></span>
        </a>
      </div>
      <!-- begin sidebar scrollbar -->
      <div class="sidebar-left" data-simplebar style="height: 100%;">
        <!-- sidebar menu -->
        <ul class="nav sidebar-inner" id="sidebar-menu">
            <li
             >
              <a class="sidenav-item-link" href="{{ route('home') }}">
                <i class="mdi mdi-briefcase-account-outline"></i>
                <h3 style="color: white; border-bottom: 2px solid white; padding-bottom: 5px;">الرئيسية</h3>
              </a>
            </li>
            <li class="section-title">
              <h4 style="color: white; border-bottom: 2px solid white; padding-bottom: 5px;">الإدارة</h4>

            </li>
            @can('donation')
            <li
             >
              <a class="sidenav-item-link" href="{{ route('Donors.create') }}">
                <i class="mdi mdi-account-heart"></i>
                <span class="nav-text">تسجيل تبرع</span>
              </a>
            </li>
            @endcan

            <li
             >

              <a class="sidenav-item-link" href="{{ route('families.create') }}">
                <i class="mdi mdi-account-group"></i>
                <span class="nav-text">إضافة أسرة</span>
              </a>
            </li>

            
            <li
             >
              <a class="sidenav-item-link" href="{{ route('visits.create') }}">
                <i class="mdi mdi-map-marker-plus"></i>
                <span class="nav-text">إضافة زيارة</span>
              </a>
            </li>

            <li>
              <a class="sidenav-item-link" href= "{{ route('aid.index',['Family_ID' => 0] ) }}" class="btn" target="_blank">
                <i class="mdi mdi-cash-multiple"></i>
                <span class="nav-text">إضافة دعم لأسرة</span>
              </a>
            </li>

            <li class="section-title">
              <h4 style="color: white; border-bottom: 2px solid white; padding-bottom: 5px;">الدعم الجماعي النقدي</h4>

            </li>


            <li>
              <a class="sidenav-item-link" href= "{{ route('GroupCashAid.create') }}" class="btn" target="_blank">
                <i class="mdi mdi-account-group"></i>
                <span class="nav-text">إضافة أرقام الدعم النقدي الجماعي</span>
              </a>
            </li>

            <li>
              <a class="sidenav-item-link" href= "{{ route('GroupCashAid.index') }}" class="btn" target="_blank">
                <i class="mdi mdi-account-group"></i>
                <span class="nav-text">الدعم النقدي الجماعي/موافقة</span>
              </a>
            </li>


            <li>
              <a class="sidenav-item-link" href= "{{ route('GroupCashAid.index2') }}" class="btn" target="_blank">
                <i class="mdi mdi-account-group"></i>
                <span class="nav-text">الدعم النقدي الجماعي/تسليم</span>
              </a>
            </li>

            <li class="section-title">
              <h4 style="color: white; border-bottom: 2px solid white; padding-bottom: 5px;">الدعم الجماعي العيني</h4>

            </li>

            <li>
              <a class="sidenav-item-link" href= "{{ route('GroupMaterialAid.create') }}" class="btn" target="_blank">
                <i class="mdi mdi-account-group"></i>
                <span class="nav-text">إضافة أرقام الدعم الجماعي</span>
              </a>
            </li>

            <li>
              <a class="sidenav-item-link" href= "{{ route('GroupMaterialAid.index') }}" class="btn" target="_blank">
                <i class="mdi mdi-account-group"></i>
                <span class="nav-text">الدعم العيني الجماعي/موافقة</span>
              </a>
            </li>


            <li>
              <a class="sidenav-item-link" href= "{{ route('GroupMaterialAid.index2') }}" class="btn" target="_blank">
                <i class="mdi mdi-account-group"></i>
                <span class="nav-text">الدعم العيني الجماعي/تسليم</span>
              </a>
            </li>



            <li class="section-title">
              <h4 style="color: white; border-bottom: 2px solid white; padding-bottom: 5px;">التقارير</h4>

            </li>

            <li>
              <a class="sidenav-item-link" href="{{ route('Donors.index') }}">
                <i class="mdi mdi-heart"></i>
                <span class="nav-text">التبرعات</span>
              </a>
            </li>


            <li>
              <a class="sidenav-item-link" href="{{ route('families.index') }}">
              <i class="mdi mdi-account-group"></i>
                <span class="nav-text">جميع الأسر</span>
              </a>
            </li>

            <li>
              <a class="sidenav-item-link" href="{{ route('families.full_details',['Family_ID' => 0]) }}" class="btn" target="_blank">
                <i class="mdi mdi-file-document"></i>
                <span class="nav-text">بيانات أسرة محددة</span>
              </a>
            </li>

            <li>
             <a class="sidenav-item-link" href= "{{ route('family_members.index') }}">
              <i class="mdi mdi-account-multiple"></i>
               <span class="nav-text">جميع الأفراد</span>
             </a>
           </li>


           <li>
            <a class="sidenav-item-link" href= "{{ route('CashAid.index') }}">
              <i class="mdi mdi-cash-multiple"></i>
              <span class="nav-text">المساعدات المالية</span>
            </a>
          </li>

          <li>
            <a class="sidenav-item-link" href= "{{ route('MaterialAid.index') }}">
              <i class="mdi mdi-gift"></i>
              <span class="nav-text">المساعدات العينية</span>
            </a>
          </li>

          <li>
            <a class="sidenav-item-link" href= "{{ route('visits.full_visits') }}">
              <i class="mdi mdi-file-document"></i>
              <span class="nav-text">الزيارات</span>
            </a>
          </li>

            <li class="section-title">
              <h6 style="color: white; border-bottom: 2px solid white; padding-bottom: 5px;"> إدارة المستخدمين والصلاحيات</h6>
            </li>
            <li>
              <a class="sidenav-item-link" href= "{{ route('users.create') }}">
                <i class="mdi mdi-account-plus"></i>
                <span class="nav-text">إضافة مستخدم</span>
              </a>
            </li>

            <li>
              <a class="sidenav-item-link" href= "{{ route('users.index') }}">
                <i class="mdi mdi-account"></i>
                <span class="nav-text">المستخدمون</span>
              </a>
            </li>


        </ul>

      </div>
    </div>
  </aside>
