@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Enquiries</a> <a href="#" class="current">View Enquiries</a> </div>
    <h1>Enquiries</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Enquiries</h5>
          </div>
          <div class="widget-content nopadding">
            <div id="app">
              <input style="margin-top: 10px; margin-left: 5px;" type="text" v-model="search" placeholder="Searh Name">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="text-align: left;">Name</th>
                    <th style="text-align: left;">Email</th>
                    <th style="text-align: left;">Subject</th>
                    <th style="text-align: left;">Message</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="enquiry in filteredEnquiries">
                    <td>@{{enquiry.name}}</td>
                    <td>@{{enquiry.email}}</td>
                    <td>@{{enquiry.subject}}</td>
                    <td>@{{enquiry.message}}</td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection