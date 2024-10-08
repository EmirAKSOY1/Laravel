<ul class="menu_items">
    <li>
        <a href="{{ route('tests.index') }}" style="color:#707070;" class="menu_title menu_dashboard">Test İşlemleri</a>
    </li>
</ul>
<ul class="menu_items">
    <div class="menu_title menu_editor"></div>
    <!-- duplicate these li tag if you want to add or remove navlink only -->
    <!-- Start -->
    <li class="item">
        <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-edit"></i>
              </span>
            <span class="navlink">Başvuru İşlemleri</span>
        </a>
    </li>
    <!-- End -->
    <li class="item">
        <a href="{{ route('candidate.index') }}" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-user"></i>
              </span>
            <span class="navlink">Aday Düzenleme</span>
        </a>
    </li>

</ul>
<ul class="menu_items">
    <div class="menu_title menu_setting"></div>
    <li class="item">
        <a href="{{ route('cognitive.index') }}" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-medal"></i>
              </span>
            <span class="navlink">Bilişsel Düzey</span>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('branches.index') }}" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-spreadsheet"></i>
              </span>
            <span class="navlink">Alan-Kazanım</span>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('disabilities.index') }}" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bx-group'></i>
              </span>
            <span class="navlink">Grup Tanımlama</span>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('organisation.index') }}" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bxs-school'></i>
              </span>
            <span class="navlink">Kurum Tanımlama</span>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('add_user.index') }}" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bx-user-plus'></i>
              </span>
            <span class="navlink">Kullanıcı Tanımlama</span>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('notices.index') }}" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-news"></i>
              </span>
            <span class="navlink">Duyuru</span>
        </a>
    </li>
</ul>
