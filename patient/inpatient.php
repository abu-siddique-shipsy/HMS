<?php

include __DIR__.'\..\config.php';
include root.'\assets\bootstrap.php';
include root.'\Common\header.php';

?>

<div class="container-fluid">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-3">
            <input type="text" name="" class="form-control" placeholder="Patient ID">
          
        </div>
        <div class="col-md-3">
            <label>Name:<span>Abu Bakkar Siddique S</span></label>
          
        </div>
        <div class="col-md-3">
            <label>Age:<span>25</span></label>
          
        </div>
        <div class="col-md-3">
            <label>Condition:<span>General Checkup</span></label>
          
        </div>
      </div>
    </div>
  </div>
  <div class="row">
      <div class="col-md-6">
        <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
              <div class="panel-body">
                <table class="table">
                  <thead>
                    <th>Name</th>
                    <th>Visited On</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>doc 1</td>
                      <td>24/7/2017 12:30:43</td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
              <div class="panel-body">
                <label>Change to Reallocate Bed<span>
                  <select class="form-control">
                    <option>Bed No.</option>
                  </select>
                </span></label>
              </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-body">
                <table class="table">
                  <thead>
                    <th></th>
                    <th>Medicine Name</th>
                    <th>Used Date</th>
                    <th>Prescriped Doctor</th>
                    
                  </thead>
                  <tbody>
                    <tr>
                      <td>doc 1</td>
                      <td>24/7/2017 12:30:43</td>
                    </tr>
                  </tbody>
                </table>
                <label class="pull-right">Total amt:<span>250</span></label>
              </div>
          </div>
        </div>
      </div>
    </div>
        <div class="col-md-6">
          <div class="panel panel-default">
              <div class="panel-body">
                <h3>Clinical Data</h3> 
                <table class="table">
                  <thead>
                    <th></th>
                    <th>BP-IID</th>
                    <th>BP-ID</th>
                    <th>UPD</th>
                    <th>BP-IID vs UPD</th>
                    <th>BP-IID vs BP-ID</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>doc 1</td>
                      <td>24/7/2017 12:30:43</td>
                    </tr>
                  </tbody>
                </table>
                <label class="pull-right">Total amt:<span>250</span></label>
              </div>
          </div>
        </div>
        
  </div>
  
</div>