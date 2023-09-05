<div class="offcanvas-body p-3 p-xl-0">
    <div class="bg-dark border rounded-3 p-3 w-100">
        <div class="list-group list-group-dark list-group-borderless collapse-list"> 
            <a class="list-group-item" data-bs-toggle="collapse" href="#collapseauthentication1" role="button" aria-expanded="false" aria-controls="collapseauthentication"> <i class="bi bi-ui-checks-grid fa-fw me-2"></i>Dashboard</a>
            <ul class="nav collapse flex-column" id="collapseauthentication1" data-bs-parent="#navbar-sidebar">
                <li class="nav-item"> <a class="nav-link" href="#">Dashboard Knowledge</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Dashboard Learning</a></li>
            </ul>
            <a class="list-group-item" data-bs-toggle="collapse" href="#collapseauthentication2" role="button" aria-expanded="false" aria-controls="collapseauthentication"> <i class="bi bi-card-checklist fa-fw me-2"></i>Permintaan Saya</a>
            <ul class="nav collapse flex-column" id="collapseauthentication2" data-bs-parent="#navbar-sidebar">
                <li class="nav-item"> <a class="nav-link" href="#">Permintaan Knowledge</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Permintaan Learning</a></li>
            </ul>
            <a class="list-group-item" href="student-dashboard.html"><i class="bi bi-journal-text"></i>Knowledge Saya</a> 
            <a class="list-group-item" href="student-dashboard.html"><i class="bi bi-journal-text"></i>Learning Saya</a>
            <a class="list-group-item" href="student-quiz.html"><i class="bi bi-question-diamond fa-fw me-2"></i>Kuis</a>
            <a class="list-group-item" href="instructor-edit-profile.html"><i class="bi bi-patch-check"></i>Sertifikat Saya</a>
            <a class="list-group-item" href="instructor-edit-profile.html"><i class="bi bi-pencil-square fa-fw me-2"></i>Edit Profile</a>
            <a class="list-group-item text-danger bg-danger-soft-hover" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign Out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>