<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{asset('backend/img/logo/favicon.png')}}" rel="icon">
  <title>Invento | Dashboard</title>
  <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('backend/css/ruang-admin.min.css')}}" rel="stylesheet">
  <link href="{{asset('backend/noty/noty.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('backend/noty/sunset.css')}}" rel="stylesheet" type="text/css">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body id="page-top">
 <div id="app">
    <div id="wrapper">
        <!-- Sidebar -->
        <nav v-if="$route.path === '/' || $route.path === '/register' || $route.path === '/forget-password' ? false : true">
            <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
                <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/dashboard">
                  <div class="sidebar-brand-icon">
                    <img src="{{asset('backend/img/logo/logo.png')}}">
                  </div>
                  <div class="sidebar-brand-text mx-2">Invento</div>
                </router-link>
                <hr class="sidebar-divider my-0">
                <li class="nav-item active border-div">
                  <router-link class="nav-link" to="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></router-link>
                </li>
                <li class="nav-item active border-div">
                    <router-link class="nav-link" to="/pos">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                        <span>POS</span>
                    </router-link>
                  </li>
                <div class="sidebar-heading mt-3">
                  Features
                </div>
                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee"
                    aria-expanded="true" aria-controls="collapseEmployee">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Employees</span>
                  </a>
                  <div id="collapseEmployee" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <router-link class="collapse-item" to="/employees/create">Add Employee</router-link>
                      <router-link class="collapse-item" to="/employees">All Employees</router-link>
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupplier"
                      aria-expanded="true" aria-controls="collapseSupplier">
                      <i class="far fa-fw fa-window-maximize"></i>
                      <span>Suppliers</span>
                    </a>
                    <div id="collapseSupplier" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                        <router-link class="collapse-item" to="/suppliers/create">Add Supplier</router-link>
                        <router-link class="collapse-item" to="/suppliers">All Suppliers</router-link>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer"
                      aria-expanded="true" aria-controls="collapseCustomer">
                      <i class="far fa-fw fa-window-maximize"></i>
                      <span>Customers</span>
                    </a>
                    <div id="collapseCustomer" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                        <router-link class="collapse-item" to="/customers/create">Add Customer</router-link>
                        <router-link class="collapse-item" to="/customers">All Customers</router-link>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
                      aria-expanded="true" aria-controls="collapseCategory">
                      <i class="far fa-fw fa-window-maximize"></i>
                      <span>Categories</span>
                    </a>
                    <div id="collapseCategory" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                        <router-link class="collapse-item" to="/categories/create">Add Category</router-link>
                        <router-link class="collapse-item" to="/categories">All Categories</router-link>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
                      aria-expanded="true" aria-controls="collapseProduct">
                      <i class="far fa-fw fa-window-maximize"></i>
                      <span>Products</span>
                    </a>
                    <div id="collapseProduct" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                        <router-link class="collapse-item" to="/products/create">Add Product</router-link>
                        <router-link class="collapse-item" to="/products">All Products</router-link>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" to="/orders">
                      <i class="fab fa-fw fa-wpforms"></i>
                      <span>Orders</span>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExpense"
                      aria-expanded="true" aria-controls="collapseExpense">
                      <i class="far fa-fw fa-window-maximize"></i>
                      <span>Expenses</span>
                    </a>
                    <div id="collapseExpense" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                        <router-link class="collapse-item" to="/expenses/create">Add Expense</router-link>
                        <router-link class="collapse-item" to="/expenses">All Expenses</router-link>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSalary"
                      aria-expanded="true" aria-controls="collapseSalary">
                      <i class="far fa-fw fa-window-maximize"></i>
                      <span>Salaries</span>
                    </a>
                    <div id="collapseSalary" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                        <router-link class="collapse-item" to="/salary/employees">Pay Salary</router-link>
                        <router-link class="collapse-item" to="/salaries">All Salaries</router-link>
                      </div>
                    </div>
                  </li>

                <hr class="sidebar-divider">
                <div class="version">Version 1.0.1</div>
              </ul>
        </nav>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
          <div id="content">
            <!-- TopBar -->
            <nav  v-if="$route.path === '/' || $route.path === '/register' || $route.path === '/forget-password' ? false : true" class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
              <button id="sidebarToggleTop" onclick="handleClick()" class="btn btn-link rounded-circle mr-3">
                <i class="fa fa-bars"></i>
              </button>
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="navbar-search">
                      <div class="input-group">
                        <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                          aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                        <div class="input-group-append">
                          <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </li>


                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle" src="{{asset('backend/img/boy.png')}}" style="max-width: 60px">
                    <span class="ml-2 d-none d-lg-inline text-white small user_name"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <router-link to='/logout' class="dropdown-item">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Logout
                    </router-link>
                  </div>
                </li>
              </ul>
            </nav>
            <!-- Topbar -->

            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">

                <router-view></router-view>

            </div>
            <!---Container Fluid-->
          </div>
          <!-- Footer -->
          <footer class="sticky-footer bg-white">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span>Copyright &copy; <span class="copyYear"> dsds </span> - Developed by
                  <b><a href="https://shakildev.com" target="_blank">Shakil</a></b>
                </span>
              </div>
            </div>
          </footer>
          <!-- Footer -->
        </div>
      </div>
 </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{asset('backend/noty/noty.js')}}"></script>

  <script>
    const handleClick = () => {
        document.body.classList.toggle("sidebar-toggled");
        document.querySelector(".sidebar").classList.toggle("toggled");
        if (document.querySelector(".sidebar").classList.contains("toggled")) {
        document.querySelector('.sidebar .collapse').classList.remove('show');
        }
    };

    let interval=setInterval(function() {
        if(localStorage.getItem('user')){
            document.querySelector('.user_name').innerHTML=localStorage.getItem('user')
            clearInterval(interval)
        }

        }, 500);

    document.querySelector('.copyYear').innerHTML=new Date().getFullYear()

  </script>

</body>

</html>

