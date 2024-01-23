<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Gentelella Alela! | </title>

</head>

<?php include "../asset_default/side_bar.php" ?>

<body class="nav-md">
  <div class="container body">
    <div class="right_col" role="main">
      <div class="content">
        <div class="page-title">
        </div>

        <!-- page content -->
        <div class="x_panel">
          <div class="x_title">
            <h2>Form Input Grid <small>form input </small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <div class="item form-group ">
                  <div class="col-md-5 col-sm-5">
                    <button class="btn btn-primary" type="button">Cancel</button>
                  </div>
                  <div class="col-md-5 col-sm-5">
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>
              </li>

              <li><a class="collapse-link"><i class="fa fa-chevron-up justify-content-end"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            <Form>
              <div class="row">
                <div class="col-md-6 col-sm-12  form-group">
                  <label class="control-label col-md-3" for="first-name">First Name </label>
                  <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control">
                  </div>
                </div>

                <div class="col-md-6 col-sm-12  form-group">
                  <label class="control-label col-md-3" for="last-name">Last Name </label>
                  <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control">
                  </div>
                </div>

                <div class="col-md-6 col-sm-12  form-group">
                  <label class="control-label col-md-3" for="age">Age </label>
                  <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control">
                  </div>
                </div>

                <div class="col-md-6 col-sm-12  form-group">
                  <label class="control-label col-md-3" for="address">Address </label>
                  <div class="col-md-9">
                    <input type="text" placeholder="" class="form-control">
                  </div>
                </div>
              </div>
            </Form>

            <br>
            <div class="x_panel">
              <div class="x_title">
                <h2>Tabel Data</h2>
                <ul class="nav navbar-right panel_toolbox justify-content-end">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card-box table-responsive">
                      <h4 class="text-muted font-13 m-b-30">
                        Tabel Data
                      </h4>
                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                          </tr>
                          <tr>
                            <td>Donna Snider</td>
                            <td>Customer Support</td>
                            <td>New York</td>
                            <td>27</td>
                            <td>2011/01/25</td>
                            <td>$112,000</td>
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

        <!--page content -->
      </div>
    </div>
  </div>


</body>

</html>