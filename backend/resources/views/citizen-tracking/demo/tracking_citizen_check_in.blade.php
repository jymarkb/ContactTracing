@extends('layouts.layout_tracking')

@section('title', ' Citizen Tracking')
    

@section('content')


<section id="citizen">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-xl-12 text-center">
                <h1 class="mt-3">COVID-19 Contact Tracing Libmanan</h1>
                <h3 class="form_sub_title_registration">Citizen Check-in</h3>
            </div>

            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-11 col-12 track-columns  mt-3 mb-5">
                <div class="row">
                  <div class="col-xl-4 col-lg-5 col-md-4 col-sm-12 col-12 text-center">
                    <div class="row justify-content-center">
                      <div class="col-xl-6 col-lg-6 col-md-8 col-sm-5 col-5">
                        <img src="/images/profile/format.jpg" class="w-100 align-middle rounded-circle" alt="">
                      </div>
                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 col-7">
                        <h5 class="card-title mt-2">First Name M. Last Name</h5>
                        <p class="m-0">Zone 6, Bagumbayan, <br/> Libmanan, Camarines Sur</p>
                        <p class="m-0">+639XX-XXXX-XXX</p>
                        <p class="m-0 text-success">Negative for COVID-19</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-8 col-lg-7 col-md-8 col-sm-12 col-12 citizen-history">
                    <h3 class="mt-3">Citizen History</h3>
                    <p class="font-italic">Updated as of 09-20-2020 | 12:00 AM</p>


                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Date</span>
                          </div>
                          <input type="text" class="form-control" id="datepicker">
                          <div class="input-group-append">
                            <span class="input-group-text" id="callendarIcon"><i class="far fa-calendar"></i></span>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Status</label>
                          </div>
                          <select class="custom-select" id="inputGroupSelect01">
                            <option selected hidden>Show all</option>
                            <option value="1">Check in</option>
                            <option value="2">Cehck out</option>
                          </select>
                        </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <table id="tableCitizen" class="table table-hover display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                              <th>Establishment</th>
                              <th>Status</th>
                              <th>Date</th>
                              <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>qweqweqwe werqcweqw</td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Eercqwerqew ercqwer</td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            <tr>
                              <td>Establishment Establishment </td>
                              <td>Check in</td>
                              <td>09-20-2020</td>
                              <td>7:31 AM</td>
                            </tr>
                            



                        </tbody>

                      </table> 

                      
                    </div>
                  </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        $('#tableCitizen').DataTable({
            responsive:true,
            "scrollColapse": true,
            "columns": [{ "width": "40%" },null,null,null]
        });
     </script>
    
</section>

@endsection