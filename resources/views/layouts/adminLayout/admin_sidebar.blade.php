<?php $url = url()->current(); ?>
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if (preg_match("/dashboard/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/categor/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/add-category/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add-category')}}">Add Category</a></li>
        <li <?php if (preg_match("/view-categories/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-categories')}}">View Categories</a></li>
      </ul>
    </li>
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/product/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/add-product/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add-product')}}">Add Product</a></li>
        <li <?php if (preg_match("/view-products/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-products')}}">View Products</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/coupon/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/add-coupon/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add-coupon')}}">Add Coupon</a></li>
        <li <?php if (preg_match("/view-coupons/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-coupons')}}">View Coupons</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Orders</span> <span class="label label-important">1</span></a>
      <ul <?php if (preg_match("/orders/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/view-orders/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-orders')}}">View Orders</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banners</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/banner/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/add-banner/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add-banner')}}">Add Banner</a></li>
        <li <?php if (preg_match("/view-banners/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-banners')}}">View Banners</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Users</span> <span class="label label-important">1</span></a>
      <ul <?php if (preg_match("/users/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/view-users/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-users')}}">View Users</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>CMS Pages</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/cms-page/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/add-cms-page/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add-cms-page')}}">Add CMS Page</a></li>
        <li <?php if (preg_match("/view-cms-pages/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-cms-pages')}}">View CMS Pages</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Enquiries</span> <span class="label label-important">1</span></a>
      <ul <?php if (preg_match("/enquiries/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/view-enquiries/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-enquiries')}}">View Enquiries</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Currencies</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/currencies/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/add-currency/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add-currency')}}">Add Currency</a></li>
        <li <?php if (preg_match("/view-currencies/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-currencies')}}">View Currencies</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Shipping</span> <span class="label label-important">1</span></a>
      <ul <?php if (preg_match("/shipping/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/view-shipping/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-shipping')}}">Shipping Charges</a></li>
      </ul>
    </li>
  </ul>
</div>
<!--sidebar-menu-->