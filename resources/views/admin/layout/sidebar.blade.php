 <!-- left sidebar -->
 <?php $data_for_url = session('data_for_url');
    //   dd($data_for_url);
      ?>
      <style>
        .sidebar li .submenu{
    list-style: none;
    margin: 0;
    padding: 0;
    padding-left: 1rem;
    padding-right: 1rem;
}
        </style>
      <nav class="sidebar sidebar-offcanvas fixed-nav" id="sidebar">
          <ul class="nav">
              <li class="nav-item nav-profile">
                  <div class="nav-link">
                      {{-- <div class="profile-image">
                          <img src="images/faces/face5.jpg" alt="image" />
                      </div> --}}
                      <div class="profile-name">
                          <p class="name">
                              Welcome <b>{{ session()->get('f_name') }} {{ session()->get('m_name') }} {{ session()->get('l_name') }}</b>
                          </p>
                          <p class="designation">
                          {{ session()->get('role_name') }}
                          </p>                      </div>
                  </div>
              </li>
              <li
              class="{{request()->is('dashboard*')
                    ? 'nav-item active' : 'nav-item' }}">
                  <a class="{{request()->is('dashboard*')
                                    ? 'nav-link active' : 'nav-link' }}" href="{{ route('/dashboard') }}">
                      <i class="fa fa-home menu-icon"></i>
                      <span class="menu-title">Dashboard</span>
                  </a>
              </li>    
              
             

             
                  <li class="{{request()->is('list-role*')
                    ? 'nav-item active' : 'nav-item' }}">
                      <a class="{{request()->is('list-role*')
                                    ? 'nav-link active' : 'nav-link' }}" data-toggle="collapse" href="#master" aria-expanded="false"
                          aria-controls="master">
                          <i class="fa fa-th-large menu-icon"></i>
                          <span class="menu-title">Area</span>
                          <i class="menu-arrow"></i>
                      </a>
                      <div class="collapse" id="master">
                          <ul class="nav flex-column sub-menu">
                              
                                  <li class="nav-item d-none d-lg-block"><a class="{{request()->is('list-district*')
                                    ? 'nav-link active' : 'nav-link' }}"
                                          href="{{ route('list-district') }}">District</a></li>
                              
                                  <li class="nav-item d-none d-lg-block"><a class="{{request()->is('list-taluka*')
                                    ? 'nav-link active' : 'nav-link' }}"
                                          href="{{ route('list-taluka') }}">Taluka</a></li>
                              
                                  <li class="nav-item d-none d-lg-block"><a class="{{request()->is('list-village*')
                                    ? 'nav-link active' : 'nav-link' }}"
                                          href="{{ route('list-village') }}">Village</a></li>
                              
                              

                          </ul>
                      </div>
                  </li>
         


        <li class="{{request()->is('list-users*')
            ? 'nav-item active' : 'nav-item' }}">
            <?php $currenturl = Request::url(); ?>
              <a class="nav-link" href="{{ route('list-users') }}">
                  <i class="fas fa-user menu-icon"></i>
                  <span class="menu-title">Distributor Management</span>
              </a>
          </li>
             <li class="{{request()->is('list-gramsevak-tablet-distribution*')
                ? 'nav-item active' : 'nav-item' }}">
                <?php $currenturl = Request::url(); ?>
                <a class="nav-link" href="{{ route('list-gramsevak-tablet-distribution') }}">
                    <i class="fas fa-file-alt fa-lg menu-icon"></i>
                    <span class="menu-title">Tablet Distribution</span>
                </a>
            </li>
          
           
 
      {{-- @endif --}}
          </ul>
      </nav>
<!-- partial -->
 
      <script>
       
      </script>