<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->name}}</p>

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{route('dashboard')}}"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>
        @can('user_index')
          
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('user_create')
              
            <li class="active"><a href="{{route('user.create')}}"><i class="fa fa-circle-o"></i> Add User</a></li>
            @endcan
            <li><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i> User List</a></li>
          </ul>
        </li>
        @endcan
        @can('permission_index')
          
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Permission</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('permission_create')
              
            <li class="active"><a href="{{route('permission.create')}}"><i class="fa fa-circle-o"></i> Add Permission</a></li>
            @endcan
            <li><a href="{{route('permission.index')}}"><i class="fa fa-circle-o"></i> Permission List</a></li>
          </ul>
        </li>
        @endcan
        @can('page_index')
          
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Page</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('page_create')
              
            <li class="active"><a href="{{route('page.create')}}"><i class="fa fa-circle-o"></i> Add Page</a></li>
            @endcan
            <li><a href="{{route('page.index')}}"><i class="fa fa-circle-o"></i> Page List</a></li>
          </ul>
        </li>
        @endcan
        @can('slider_index')
          
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Slider</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('slider_create')
              
            <li class="active"><a href="{{route('slider.create')}}"><i class="fa fa-circle-o"></i> Add Slider</a></li>
            @endcan
            <li><a href="{{route('slider.index')}}"><i class="fa fa-circle-o"></i> Slider List</a></li>
          </ul>
        </li>
        @endcan
        @can('block_index')
          
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Block</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('block_create')
              
            <li class="active"><a href="{{route('block.create')}}"><i class="fa fa-circle-o"></i> Add Block</a></li>
            @endcan
            <li><a href="{{route('block.index')}}"><i class="fa fa-circle-o"></i> Block List</a></li>
          </ul>
        </li>
        @endcan
        @can('product_index')
          
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Product</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('product_create')
              
            <li class="active"><a href="{{route('product.create')}}"><i class="fa fa-circle-o"></i> Add Product</a></li>
            @endcan
            <li><a href="{{route('product.index')}}"><i class="fa fa-circle-o"></i> Product List</a></li>
          </ul>
        </li>
        @endcan
        @can('category_index')
          
        
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Category</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('category_create')
              
            <li class="active"><a href="{{route('category.create')}}"><i class="fa fa-circle-o"></i> Add Category</a></li>
            @endcan
            <li><a href="{{route('category.index')}}"><i class="fa fa-circle-o"></i> Category List</a></li>
          </ul>
        </li>
        @endcan
        @can('attribute_index')
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Attribute</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('attribute_create')
              
            <li class="active"><a href="{{route('attribute.create')}}"><i class="fa fa-circle-o"></i> Add Attribute</a></li>
            @endcan
            <li><a href="{{route('attribute.index')}}"><i class="fa fa-circle-o"></i> Attribute List</a></li>
          </ul>
        </li>
        @endcan
        @can('enquiry_index')
          
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Enquiry</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{route('enquiry')}}"><i class="fa fa-circle-o"></i>Enquiry List</a></li>
          </ul>
        </li>
        @endcan
        @can('order_index')
          
        <li class="active treeview">
          <a href="{{route('manageorder')}}">
            <i class="fa fa-puzzle-piece"></i> <span>Manage Order</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{route('manageorder')}}"><i class="fa fa-circle-o"></i>manage order</a></li>
          </ul>
        </li>
        @endcan
        @can('customer_index')
          
        <li class="active treeview">
          <a href="">
            <i class="fa fa-puzzle-piece"></i> <span>Manage customer</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{route('manage.customer')}}"><i class="fa fa-circle-o"></i>customer</a></li>
          </ul>
        </li>
        @endcan
        @can('role_index')
          
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Role</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('role_create')
              
            <li class="active"><a href="{{route('role.create')}}"><i class="fa fa-circle-o"></i> Add Role</a></li>
            @endcan
            <li><a href="{{route('role.index')}}"><i class="fa fa-circle-o"></i> Role List</a></li>
          </ul>
        </li>
        @endcan
        @can('coupon_index')
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Coupon</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('coupon_create')
              
            <li class="active"><a href="{{route('coupons.create')}}"><i class="fa fa-circle-o"></i> Add Coupon</a></li>
            @endcan
            <li><a href="{{route('coupons.index')}}"><i class="fa fa-circle-o"></i> Coupon List</a></li>
          </ul>
        </li>
        @endcan
      </li>
    </ul>
  </section>
    <!-- /.sidebar -->
</aside>