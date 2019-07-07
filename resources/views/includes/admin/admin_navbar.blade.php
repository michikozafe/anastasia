<nav class="col-md-2 d-none d-md-block sidebar px-0 text-center">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <div class="mt-4">
                <img src="{{asset('images/profile-photo.png')}}" height="100">
            </div>
            <li class="nav-item">
              <a class="nav-link text-dark text-uppercase font-weight-bold" href="/admin/profile">
                  {{Auth::user()->name}}
              </a>
            </li>
            <li class="nav-item mb-3">
              <p class="nav-link" href="/admin/profile">
                  {{Auth::user()->email}}
              </p>
            </li>
            <li class="nav-item dashboard-links">
              <a class="nav-link" href="/admin/dashboard">
                HOME
              </a>
            </li>
            <li class="nav-item dashboard-links">
              <a class="nav-link" href="/admin/profile">
                PROFILE
              </a>
            </li>
            <li class="nav-item dashboard-links">
                <a class="nav-link" href="/admin/users">
                    USERS
                </a>
            </li>
            <li class="nav-item dashboard-links">
              <a class="nav-link" href="/admin/categories/index">
                CATEGORIES
              </a>
            </li>
            <li class="nav-item dashboard-links">
              <a class="nav-link" href="/admin/products">
                PRODUCTS
              </a>
            </li>
            <li class="nav-item dashboard-links">
                <a class="nav-link" href="/admin/inventory">
                    INVENTORY
                </a>
            </li>
            <li class="nav-item dashboard-links">
              <a class="nav-link" href="/admin/transactions">
                  TRANSACTIONS
              </a>
            </li>
          </ul>
        </div>
      </nav>
