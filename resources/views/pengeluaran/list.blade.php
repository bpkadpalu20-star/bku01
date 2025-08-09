@extends('layouts.master')
@section('content')
<script src="{{ URL::asset('assets/js/jquery-3.7.1.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- Plugins css -->
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('assets/js/select2.js')}}"></script>

<link rel="stylesheet" href="../assets/libs/prismjs/themes/prism-coy.min.css">

{{-- <script src="{{ URL::asset('assets/js/jQuery v3.7.1.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> --}}

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Pengeluaran</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">>Data BKU Pengeluaran</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex my-xl-auto right-content align-items-center">
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-info btn-icon me-2 btn-b"><i class="mdi mdi-filter-variant"></i></button>
        </div>
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-danger btn-icon me-2"><i class="mdi mdi-star"></i></button>
        </div>
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-warning  btn-icon me-2"><i class="mdi mdi-refresh"></i></button>
        </div>
    </div>
</div>
<!-- Page Header Close -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row" id="caridata">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="input-label" class="form-label">No. SP2D</label>
                            <input type="text" id="cari_no_bku" name="cari_no_bku" class="form-control sp2dfilter" placeholder="Enter Kode">
                        </div>
                        <div class="form-group mb-3">
                            <label for="input-label" class="form-label">No. Penguji</label>
                            <input type="text" id="cari_no_penguji" name="cari_no_penguji" class="form-control pengujifilter" placeholder="Enter Kode">
                        </div>
                        <div class="form-group mb-3">
                            <label for="input-label" class="form-label">OPD</label>
                            <select name="cari_id_opd" id="cari_id_opd" class="form-control form-select opdfilter" data-toggle="select2" data-trigger name="choices-single-default">
                                <option value="">Select Country</option>
                                @foreach($opd as $skpd)

                                <option value="{{ $skpd->id }}">{{ $skpd->uraian_skpd }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="input-label" class="form-label">Bank</label>
                            <select name="cari_id_bank" id="cari_id_bank" class="form-control form-select bankfilter" data-toggle="select2" data-trigger name="choices-single-default">
                                <option value="">Select Bank</option>
                                @foreach($bank as $row)

                                <option value="{{ $row->id }}">{{ $row->kode_bank }}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="input-label" class="form-label">Nilai SP2D</label>
                                    <input type="text" action="harusHuruf()" class="form-control nilaifilter" id="cari_nilai_sp2d" name="cari_nilai_sp2d" placeholder="Enter Kode" value="" style="text-align: right;">
                                </div>
                            </div> <!-- end col -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="input-label" class="form-label">Bulan SP2D</label>
                                    <select name="cari_bulan" id="cari_bulan" class="form-control bulanfilter " data-toggle="select2" data-trigger name="choices-single-default">

                                    </select>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end col -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center">
        <div class="pe-1 mb-xl-0">
            @can('create opd')
            <a href="javascript:void(0)" class="btn btn-outline-primary waves-effect waves-light float-right Createpengeluaran" id="Createpengeluaran"><i class="mdi mdi-plus-box me-2 d-inline-block"></i>Create</a>
            @endcan
        </div>
    </div>
</div>
<!-- Page Header Close -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="data-table" class="table table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Nomer SP2D</th>
                            <th width="80px">Uraian SP2D</th>
                            <th width="80px">Sumber Dana</th>
                            <th width="80px">OPD</th>
                            <th width="80px">Pihak Ketiga</th>
                            <th width="80px">Bank</th>
                            <th width="80px">Nilai</th>
                            <th width="180px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
<div class="modal fade modal-dialog-scrollable" id="ajaxModelupdate" tabindex="-1" aria-labelledby="ajaxModelupdate" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modelHeading"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form id="BkuPgFormupdate" name="BkuPgFormupdate" class="form-horizontal">

                @csrf
                {{ csrf_field() }}
                <div class="hasilupdate" id="hasilupdate"></div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success mt-2" id="saveBtnupdate" value="update"><i class="fa fa-save"></i> Submit
                    </button>
                </div>
             </form>

        </div>
      </div>
    </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->
<div class="modal fade modal-dialog-scrollable" id="ajaxModelcreate" tabindex="-1" aria-labelledby="ajaxModelcreate" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modelHeadingcreate"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="BkuPnFormcreate" name="BkuPnFormcreate" class="form-horizontal">
                    @csrf
                    {{ csrf_field() }}

                    <div class="hasilcreate" id="hasilcreate"></div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success mt-2" id="saveBtncreate" value="create"><i class="fa fa-save"></i> Submit
                        </button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->
<!-- sample modal content -->
<div id="carisp2d" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="carisp2dLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="carisp2dLabel">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <table id="basic-datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>$162,700</td>
                        </tr>
                        <tr>
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012/12/02</td>
                            <td>$372,000</td>
                        </tr>
                        <tr>
                            <td>Herrod Chandler</td>
                            <td>Sales Assistant</td>
                            <td>San Francisco</td>
                            <td>59</td>
                            <td>2012/08/06</td>
                            <td>$137,500</td>
                        </tr>
                        <tr>
                            <td>Rhona Davidson</td>
                            <td>Integration Specialist</td>
                            <td>Tokyo</td>
                            <td>55</td>
                            <td>2010/10/14</td>
                            <td>$327,900</td>
                        </tr>
                        <tr>
                            <td>Colleen Hurst</td>
                            <td>Javascript Developer</td>
                            <td>San Francisco</td>
                            <td>39</td>
                            <td>2009/09/15</td>
                            <td>$205,500</td>
                        </tr>
                        <tr>
                            <td>Sonya Frost</td>
                            <td>Software Engineer</td>
                            <td>Edinburgh</td>
                            <td>23</td>
                            <td>2008/12/13</td>
                            <td>$103,600</td>
                        </tr>
                        <tr>
                            <td>Jena Gaines</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>30</td>
                            <td>2008/12/19</td>
                            <td>$90,560</td>
                        </tr>
                        <tr>
                            <td>Quinn Flynn</td>
                            <td>Support Lead</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2013/03/03</td>
                            <td>$342,000</td>
                        </tr>
                        <tr>
                            <td>Charde Marshall</td>
                            <td>Regional Director</td>
                            <td>San Francisco</td>
                            <td>36</td>
                            <td>2008/10/16</td>
                            <td>$470,600</td>
                        </tr>
                        <tr>
                            <td>Haley Kennedy</td>
                            <td>Senior Marketing Designer</td>
                            <td>London</td>
                            <td>43</td>
                            <td>2012/12/18</td>
                            <td>$313,500</td>
                        </tr>
                        <tr>
                            <td>Tatyana Fitzpatrick</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>19</td>
                            <td>2010/03/17</td>
                            <td>$385,750</td>
                        </tr>
                        <tr>
                            <td>Michael Silva</td>
                            <td>Marketing Designer</td>
                            <td>London</td>
                            <td>66</td>
                            <td>2012/11/27</td>
                            <td>$198,500</td>
                        </tr>
                        <tr>
                            <td>Paul Byrd</td>
                            <td>Chief Financial Officer (CFO)</td>
                            <td>New York</td>
                            <td>64</td>
                            <td>2010/06/09</td>
                            <td>$725,000</td>
                        </tr>
                        <tr>
                            <td>Gloria Little</td>
                            <td>Systems Administrator</td>
                            <td>New York</td>
                            <td>59</td>
                            <td>2009/04/10</td>
                            <td>$237,500</td>
                        </tr>
                        <tr>
                            <td>Bradley Greer</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>41</td>
                            <td>2012/10/13</td>
                            <td>$132,000</td>
                        </tr>
                        <tr>
                            <td>Dai Rios</td>
                            <td>Personnel Lead</td>
                            <td>Edinburgh</td>
                            <td>35</td>
                            <td>2012/09/26</td>
                            <td>$217,500</td>
                        </tr>
                        <tr>
                            <td>Jenette Caldwell</td>
                            <td>Development Lead</td>
                            <td>New York</td>
                            <td>30</td>
                            <td>2011/09/03</td>
                            <td>$345,000</td>
                        </tr>
                        <tr>
                            <td>Yuri Berry</td>
                            <td>Chief Marketing Officer (CMO)</td>
                            <td>New York</td>
                            <td>40</td>
                            <td>2009/06/25</td>
                            <td>$675,000</td>
                        </tr>
                        <tr>
                            <td>Caesar Vance</td>
                            <td>Pre-Sales Support</td>
                            <td>New York</td>
                            <td>21</td>
                            <td>2011/12/12</td>
                            <td>$106,450</td>
                        </tr>
                        <tr>
                            <td>Doris Wilder</td>
                            <td>Sales Assistant</td>
                            <td>Sidney</td>
                            <td>23</td>
                            <td>2010/09/20</td>
                            <td>$85,600</td>
                        </tr>
                        <tr>
                            <td>Angelica Ramos</td>
                            <td>Chief Executive Officer (CEO)</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2009/10/09</td>
                            <td>$1,200,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Joyce</td>
                            <td>Developer</td>
                            <td>Edinburgh</td>
                            <td>42</td>
                            <td>2010/12/22</td>
                            <td>$92,575</td>
                        </tr>
                        <tr>
                            <td>Jennifer Chang</td>
                            <td>Regional Director</td>
                            <td>Singapore</td>
                            <td>28</td>
                            <td>2010/11/14</td>
                            <td>$357,650</td>
                        </tr>
                        <tr>
                            <td>Brenden Wagner</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>28</td>
                            <td>2011/06/07</td>
                            <td>$206,850</td>
                        </tr>
                        <tr>
                            <td>Fiona Green</td>
                            <td>Chief Operating Officer (COO)</td>
                            <td>San Francisco</td>
                            <td>48</td>
                            <td>2010/03/11</td>
                            <td>$850,000</td>
                        </tr>
                        <tr>
                            <td>Shou Itou</td>
                            <td>Regional Marketing</td>
                            <td>Tokyo</td>
                            <td>20</td>
                            <td>2011/08/14</td>
                            <td>$163,000</td>
                        </tr>
                        <tr>
                            <td>Michelle House</td>
                            <td>Integration Specialist</td>
                            <td>Sidney</td>
                            <td>37</td>
                            <td>2011/06/02</td>
                            <td>$95,400</td>
                        </tr>
                        <tr>
                            <td>Suki Burks</td>
                            <td>Developer</td>
                            <td>London</td>
                            <td>53</td>
                            <td>2009/10/22</td>
                            <td>$114,500</td>
                        </tr>
                        <tr>
                            <td>Prescott Bartlett</td>
                            <td>Technical Author</td>
                            <td>London</td>
                            <td>27</td>
                            <td>2011/05/07</td>
                            <td>$145,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Cortez</td>
                            <td>Team Leader</td>
                            <td>San Francisco</td>
                            <td>22</td>
                            <td>2008/10/26</td>
                            <td>$235,500</td>
                        </tr>
                        <tr>
                            <td>Martena Mccray</td>
                            <td>Post-Sales support</td>
                            <td>Edinburgh</td>
                            <td>46</td>
                            <td>2011/03/09</td>
                            <td>$324,050</td>
                        </tr>
                        <tr>
                            <td>Unity Butler</td>
                            <td>Marketing Designer</td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2009/12/09</td>
                            <td>$85,675</td>
                        </tr>
                        <tr>
                            <td>Howard Hatfield</td>
                            <td>Office Manager</td>
                            <td>San Francisco</td>
                            <td>51</td>
                            <td>2008/12/16</td>
                            <td>$164,500</td>
                        </tr>
                        <tr>
                            <td>Hope Fuentes</td>
                            <td>Secretary</td>
                            <td>San Francisco</td>
                            <td>41</td>
                            <td>2010/02/12</td>
                            <td>$109,850</td>
                        </tr>
                        <tr>
                            <td>Vivian Harrell</td>
                            <td>Financial Controller</td>
                            <td>San Francisco</td>
                            <td>62</td>
                            <td>2009/02/14</td>
                            <td>$452,500</td>
                        </tr>
                        <tr>
                            <td>Timothy Mooney</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>37</td>
                            <td>2008/12/11</td>
                            <td>$136,200</td>
                        </tr>
                        <tr>
                            <td>Jackson Bradshaw</td>
                            <td>Director</td>
                            <td>New York</td>
                            <td>65</td>
                            <td>2008/09/26</td>
                            <td>$645,750</td>
                        </tr>
                        <tr>
                            <td>Olivia Liang</td>
                            <td>Support Engineer</td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2011/02/03</td>
                            <td>$234,500</td>
                        </tr>
                        <tr>
                            <td>Bruno Nash</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>38</td>
                            <td>2011/05/03</td>
                            <td>$163,500</td>
                        </tr>
                        <tr>
                            <td>Sakura Yamamoto</td>
                            <td>Support Engineer</td>
                            <td>Tokyo</td>
                            <td>37</td>
                            <td>2009/08/19</td>
                            <td>$139,575</td>
                        </tr>
                        <tr>
                            <td>Thor Walton</td>
                            <td>Developer</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2013/08/11</td>
                            <td>$98,540</td>
                        </tr>
                        <tr>
                            <td>Finn Camacho</td>
                            <td>Support Engineer</td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2009/07/07</td>
                            <td>$87,500</td>
                        </tr>
                        <tr>
                            <td>Serge Baldwin</td>
                            <td>Data Coordinator</td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2012/04/09</td>
                            <td>$138,575</td>
                        </tr>
                        <tr>
                            <td>Zenaida Frank</td>
                            <td>Software Engineer</td>
                            <td>New York</td>
                            <td>63</td>
                            <td>2010/01/04</td>
                            <td>$125,250</td>
                        </tr>
                        <tr>
                            <td>Zorita Serrano</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>56</td>
                            <td>2012/06/01</td>
                            <td>$115,000</td>
                        </tr>
                        <tr>
                            <td>Jennifer Acosta</td>
                            <td>Junior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>43</td>
                            <td>2013/02/01</td>
                            <td>$75,650</td>
                        </tr>
                        <tr>
                            <td>Cara Stevens</td>
                            <td>Sales Assistant</td>
                            <td>New York</td>
                            <td>46</td>
                            <td>2011/12/06</td>
                            <td>$145,600</td>
                        </tr>
                        <tr>
                            <td>Hermione Butler</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2011/03/21</td>
                            <td>$356,250</td>
                        </tr>
                        <tr>
                            <td>Lael Greer</td>
                            <td>Systems Administrator</td>
                            <td>London</td>
                            <td>21</td>
                            <td>2009/02/27</td>
                            <td>$103,500</td>
                        </tr>
                        <tr>
                            <td>Jonas Alexander</td>
                            <td>Developer</td>
                            <td>San Francisco</td>
                            <td>30</td>
                            <td>2010/07/14</td>
                            <td>$86,500</td>
                        </tr>
                        <tr>
                            <td>Shad Decker</td>
                            <td>Regional Director</td>
                            <td>Edinburgh</td>
                            <td>51</td>
                            <td>2008/11/13</td>
                            <td>$183,000</td>
                        </tr>
                        <tr>
                            <td>Michael Bruce</td>
                            <td>Javascript Developer</td>
                            <td>Singapore</td>
                            <td>29</td>
                            <td>2011/06/27</td>
                            <td>$183,000</td>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="ajaxModelshow" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="hasil-show" ></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModelban" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="pengeluaranbanForm" name="pengeluaranbanForm" class="form-horizontal">
                    @csrf
                    <div class="batal" id="batal"></div>
                    <div class="col-sm-offset-2 col-sm-10">

                        <button type="submit" class="btn btn-success mt-2" id="saveBtnban" value="create"><i class="fa fa-save"></i> Submit
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModelunban" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

                <form id="pengeluaranunbanForm" name="pengeluaranunbanForm" class="form-horizontal">
                    @csrf

                    <div class="unbatal" id="unbatal"></div>
                    <div class="col-sm-offset-2 col-sm-10">

                        <button type="submit" class="btn btn-success mt-2" id="saveBtnunban" value="create"><i class="fa fa-save"></i> Submit
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<script>

    var rupiah2 = document.getElementById('cari_nilai_sp2d');
            rupiah2.addEventListener('keyup', function(e){
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah2.value = formatRupiah(this.value, '');
            });

           /* Fungsi formatRupiah */
		function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

    function harusHuruf(evt){
             var charCode = (evt.which) ? evt.which : event.keyCode
             if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
                 return false;
             return true;
    }
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#create_nama_opd').select2({dropdownParent: $("#ajaxModelcreate")});
});
$(document).on('click', '.pilihsp2d', function (e) {
                document.getElementById("username_pengoreksi").value = $(this).attr('data-username');


				//var modal = document.getElementById('staticBackdrop');
				$("#carisp2d").modal('hide');
				//modal.element.classList.remove("show");
				//modal.
				myModal.hide()

            });
    var getLastMonths = function(n) {
    var arr = new Array();

    arr.push(moment().format('MMMM'));

    for(var i=1; i< 12; i++){
        arr.push(moment().add(i*-1, 'Month').format('MMMM'));
    }

    return arr;
    }

    var appendOptions = function(arr) {
    var html = '';

    for(var i=0; i<arr.length; i++) {
        html += '<option value="' + arr[i] + '">' + arr[i] + '</option>'
    }

    document.getElementById('cari_bulan').innerHTML = html;

    }

    var months = getLastMonths(4);
    appendOptions(months);
</script>

<script type="text/javascript">

$(document).ready(function() {
    // $('.data-table').dataTable({searching: false});
} );



</script>
<script type="text/javascript">

      $(function () {

        /*------------------------------------------
         --------------------------------------------
         Pass Header Token
         --------------------------------------------
         --------------------------------------------*/
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });

        /*------------------------------------------
        --------------------------------------------
        Render DataTable
        --------------------------------------------
        --------------------------------------------*/
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: "{{ route('bku-pengeluaran.index') }}",
                data: function (d) {
                    d.cari_id_opd = $('.opdfilter').val(),
                    d.cari_id_bank = $('.bankfilter').val(),
                    d.cari_no_bku = $('.sp2dfilter').val(),
                    d.cari_no_penguji = $('.pengujifilter').val(),
                    d.cari_nilai_sp2d = $('.nilaifilter').val(),
                    d.cari_bulan = $('.bulanfilter').val(),
                    d.search = $('input[type="search"]').val()
                    }
            },
            columns: [
                {data: 'id_bku', name: 'id_bku'},
                {data: 'no_bku', name: 'no_bku'},
                {data: 'uraian_bku', name: 'uraian_bku'},
                {data: 'kode_dana', name: 'kode_dana'},
                {data: 'uraian_skpd', name: 'uraian_skpd'},
                {data: 'nama_rekanan', name: 'nama_rekanan'},
                {data: 'kode_bank', name: 'kode_bank'},
                { data: 'nilai_sp2d',  render: $.fn.dataTable.render.number( '.', ',', 0, '' )},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $(".opdfilter").keyup(function(){
            table.draw();
        });
        $(".sp2dfilter").keyup(function(){
            table.draw();
        });
        $(".pengujifilter").keyup(function(){
            table.draw();
        });
        $(".bankfilter").keyup(function(){
            table.draw();
        });
        $(".nilaifilter").keyup(function(){
            table.draw();
        });
        $(".bulanfilter").keyup(function(){
            table.draw();
        });
        $('body').on('change', '.opdfilter', function () {
            table.draw();
        });
        $('body').on('change', '.bankfilter', function () {
            table.draw();

        });
        $('body').on('change', '.bulanfilter', function () {
            table.draw();

        });
        /*------------------------------------------
        --------------------------------------------
        Click to Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.Createpengeluaran', function () {
            $('#saveBtncreate').val("create-dana");
            $('#pengeluaran_id').val('');
            $('#BkuPnFormcreate').trigger("reset");
            $('#modelHeadingcreate').html("<i class='fa fa-plus'></i> Create New Pengeluaran");
            // $('#create_sumber_dana').select2({
            //         dropdownParent: $('#ajaxModelcreate')
            // });
            // $('#create_nama_opd').select2({
            //         dropdownParent: $('#ajaxModelcreate')
            // });
                    $.ajax({
                        type : 'get',
                        url: "{{ route('bku-pengeluaran.create') }}",
                        // data :  'id='+ id,
                        success : function(data){
                        $('#hasilcreate').html(data);//menampilkan data ke dalam modal
                        $('#ajaxModelcreate').modal('show');

                        }
                    });
            // })
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.editbaru', function () {
            var pengeluaran_id = $(this).data('id');
            $('#modelHeading').html("<i class='fa-regular fa-pen-to-square'></i> Edit BKU Pengeluaran");
            $('#saveBtnupdate').val("edit_user");
            $.ajax({
                        type : 'get',
                        url: "{{ route('bku-pengeluaran.index') }}" +'/' + pengeluaran_id +'/edit',
                        data :  'pengeluaran_id='+ pengeluaran_id,
                        success : function(data){
                        $('#hasilupdate').html(data);//menampilkan data ke dalam modal
                        $('#ajaxModelupdate').modal('show');

                        }
                    });

        });
        // $('body').on('click', '.editPengeluaran', function () {
        //   var pengeluaran_id = $(this).data('id');
        //   $.get("{{ route('bku-pengeluaran.index') }}" +'/' + pengeluaran_id +'/edit', function (data) {
        //       $('#modelHeading').html("<i class='fa-regular fa-pen-to-square'></i> Edit BKU Pengeluaran");
        //       $('#saveBtnupdate').val("edit_user");
        //     //   $('#ajaxModelupdate').modal('show');
        //       $('#edit_pengeluaran_id').val(data.id);
        //       $('#edit_uraian_bku').val(data.uraian_bku);
        //       $('#edit_no_bku').val(data.no_bku);
        //       $('#edit_baru_sp2d').val(data.no_bku);
        //       $('#edit_no_penguji').val(data.no_penguji);
        //       $('#edit_tgl_penguji').val(moment(data.tgl_penguji).format('MM/DD/YYYY'));
        //       $('#edit_id_dana').select2({
        //             dropdownParent: $('#ajaxModelupdate')
        //         });
        //       $('#edit_id_dana').val(data.id_dana).trigger('change');
        //       $('#edit_id_opd').val(data.id_opd).trigger('change');
        //       $('#edit_id_opd').select2({
        //             dropdownParent: $('#ajaxModelupdate')
        //         });
        //       $('#edit_nama_rekanan').val(data.nama_rekanan);
        //       $('#edit_id_bank').val(data.id_bank).trigger('change');
        //       $('#edit_tanggal_bku').val(moment(data.tanggal_bku).format('MM/DD/YYYY'));

        //       var a1 = data.nilai_sp2d;
        //       var b1 = Math.ceil(a1);
        //       var 	bilangan = b1;
        //                 var	number_string = bilangan.toString(),
        //                     split	= number_string.split('.'),
        //                     sisa 	= split[0].length % 3,
        //                     rupiah 	= split[0].substr(0, sisa),
        //                     ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);

        //                 if (ribuan) {
        //                     separator = sisa ? ',' : '';
        //                     rupiah += separator + ribuan.join(',');
        //                 }
        //                 rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
        //       $('#edit_nilai_sp2d').val(rupiah);
        //       $.ajax({
        //                 type : 'get',
        //                 url: "{{ route('bku-pengeluaran.index') }}" +'/' + pengeluaran_id +'/edit',
        //                 data :  'pengeluaran_id='+ pengeluaran_id,
        //                 success : function(data){
        //                 $('#hasilupdate').html(data);//menampilkan data ke dalam modal
        //                 $('#ajaxModelupdate').modal('show');

        //                 }
        //             });

        //   })
        // });

        /*------------------------------------------
        --------------------------------------------
        Create bank Code
        --------------------------------------------
        --------------------------------------------*/
        $('#BkuPnFormcreate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtncreate').html('Sending...');

            $.ajax({
                    type:'POST',
                    url: "{{ route('bku-pengeluaran.create') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        $('.hasil-show').html(response);//menampilkan data ke dalam modal
                        $('#saveBtncreate').html('Submit');
                        $('#BkuPnFormcreate').trigger("reset");
                        $('#ajaxModelcreate').modal('hide');
                        $('#ajaxModelshow').modal('show');
                        table.draw();
                    },
                    error: function(error){
                        $('#saveBtncreate').html('Submit');
                        // $("#alert-create_no_bku").find("ul").html('');
                        // $("#alert-create_no_bku").css('display','block');
                        // $.each( error.responseJSON.create_no_bku, function( key, value ) {
                        //     $("#alert-create_no_bku").find("ul").append('<li>'+value+'</li>');
                        // });
                        if (error.responseJSON.create_tanggal_bku) {
                            $("#alert-create_tanggal_bku").find("ul").html('');
                            $("#alert-create_tanggal_bku").css('display','block');
                            $('#alert-create_tanggal_bku').html(error.responseJSON.create_tanggal_bku);
                            $.each( error.responseJSON.create_tanggal_bku, function( key, value ) {
                                $("#alert-create_tanggal_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_tanggal_bku").find("ul").html('');
                            $("#alert-create_tanggal_bku").css('display','none');
                            $.each( error.responseJSON.create_tanggal_bku, function( key, value ) {
                                $("#alert-create_tanggal_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_no_bku) {
                            $("#alert-create_no_bku").find("ul").html('');
                            $("#alert-create_no_bku").css('display','block');
                            $('#alert-create_no_bku').html(error.responseJSON.create_no_bku);
                            $.each( error.responseJSON.create_no_bku, function( key, value ) {
                                $("#alert-create_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_no_bku").find("ul").html('');
                            $("#alert-create_no_bku").css('display','none');
                            $.each( error.responseJSON.create_no_bku, function( key, value ) {
                                $("#alert-create_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_tgl_penguji) {
                            $("#alert-create_tgl_penguji").find("ul").html('');
                            $("#alert-create_tgl_penguji").css('display','block');
                            $('#alert-create_tgl_penguji').html(error.responseJSON.create_tgl_penguji);
                            $.each( error.responseJSON.create_tgl_penguji, function( key, value ) {
                                $("#alert-create_tgl_penguji").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_tgl_penguji").find("ul").html('');
                            $("#alert-create_tgl_penguji").css('display','none');
                            $.each( error.responseJSON.create_tgl_penguji, function( key, value ) {
                                $("#alert-create_tgl_penguji").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_no_penguji) {
                            $("#alert-create_no_penguji").find("ul").html('');
                            $("#alert-create_no_penguji").css('display','block');
                            $('#alert-create_no_penguji').html(error.responseJSON.create_no_penguji);
                            $.each( error.responseJSON.create_no_penguji, function( key, value ) {
                                $("#alert-create_no_penguji").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_no_penguji").find("ul").html('');
                            $("#alert-create_no_penguji").css('display','none');
                            $.each( error.responseJSON.create_no_penguji, function( key, value ) {
                                $("#alert-create_no_penguji").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_uraian_bku) {
                            $("#alert-create_uraian_bku").find("ul").html('');
                            $("#alert-create_uraian_bku").css('display','block');
                            $('#alert-create_uraian_bku').html(error.responseJSON.create_uraian_bku);
                            $.each( error.responseJSON.create_uraian_bku, function( key, value ) {
                                $("#alert-create_uraian_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_uraian_bku").find("ul").html('');
                            $("#alert-create_uraian_bku").css('display','none');
                            $.each( error.responseJSON.create_uraian_bku, function( key, value ) {
                                $("#alert-create_uraian_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_sumber_dana) {
                            $("#alert-create_sumber_dana").find("ul").html('');
                            $("#alert-create_sumber_dana").css('display','block');
                            $('#alert-create_sumber_dana').html(error.responseJSON.create_sumber_dana);
                            $.each( error.responseJSON.create_sumber_dana, function( key, value ) {
                                $("#alert-create_sumber_dana").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_sumber_dana").find("ul").html('');
                            $("#alert-create_sumber_dana").css('display','none');
                            $.each( error.responseJSON.create_sumber_dana, function( key, value ) {
                                $("#alert-create_sumber_dana").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_nama_opd) {
                            $("#alert-create_nama_opd").find("ul").html('');
                            $("#alert-create_nama_opd").css('display','block');
                            $('#alert-create_nama_opd').html(error.responseJSON.create_nama_opd);
                            $.each( error.responseJSON.create_nama_opd, function( key, value ) {
                                $("#alert-create_nama_opd").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_nama_opd").find("ul").html('');
                            $("#alert-create_nama_opd").css('display','none');
                            $.each( error.responseJSON.create_nama_opd, function( key, value ) {
                                $("#alert-create_nama_opd").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_nama_rekanan) {
                            $("#alert-create_nama_rekanan").find("ul").html('');
                            $("#alert-create_nama_rekanan").css('display','block');
                            $('#alert-create_nama_rekanan').html(error.responseJSON.create_nama_rekanan);
                            $.each( error.responseJSON.create_nama_rekanan, function( key, value ) {
                                $("#alert-create_nama_rekanan").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_nama_rekanan").find("ul").html('');
                            $("#alert-create_nama_rekanan").css('display','none');
                            $.each( error.responseJSON.create_nama_rekanan, function( key, value ) {
                                $("#alert-create_nama_rekanan").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_nama_bank) {
                            $("#alert-create_nama_bank").find("ul").html('');
                            $("#alert-create_nama_bank").css('display','block');
                            $('#alert-create_nama_bank').html(error.responseJSON.create_nama_bank);
                            $.each( error.responseJSON.create_nama_bank, function( key, value ) {
                                $("#alert-create_nama_bank").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_nama_bank").find("ul").html('');
                            $("#alert-create_nama_bank").css('display','none');
                            $.each( error.responseJSON.create_nama_bank, function( key, value ) {
                                $("#alert-create_nama_bank").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_nilai_sp2d) {
                            $("#alert-create_nilai_sp2d").find("ul").html('');
                            $("#alert-create_nilai_sp2d").css('display','block');
                            $('#alert-create_nilai_sp2d').html(error.responseJSON.create_nilai_sp2d);
                            $.each( error.responseJSON.create_nilai_sp2d, function( key, value ) {
                                $("#alert-create_nilai_sp2d").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_nilai_sp2d").find("ul").html('');
                            $("#alert-create_nilai_sp2d").css('display','none');
                            $.each( error.responseJSON.create_nilai_sp2d, function( key, value ) {
                                $("#alert-create_nilai_sp2d").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.double_no_bku) {
                            $("#alert-double_no_bku").find("ul").html('');
                            $("#alert-double_no_bku").css('display','block');
                            $('#alert-double_no_bku').html(error.responseJSON.double_no_bku);
                            $.each( error.responseJSON.double_no_bku, function( key, value ) {
                                $("#alert-double_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-double_no_bku").find("ul").html('');
                            $("#alert-double_no_bku").css('display','none');
                            $.each( error.responseJSON.double_no_bku, function( key, value ) {
                                $("#alert-double_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }


                    }
               });

        });

        /*------------------------------------------
        --------------------------------------------
        Edit bank Code
        --------------------------------------------
        --------------------------------------------*/
        $('#BkuPgFormupdate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtnupdate').html('Sending...');

            $.ajax({
                    type:'POST',
                    url: "{{ route('bku-pengeluaran.update') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                          $('#saveBtnupdate').html('Submit');
                          $('#BkuPgFormupdate').trigger("reset");
                          $('#ajaxModelupdate').modal('hide');
                          table.draw();
                    },
                    error: function(error){
                        $('#saveBtnupdate').html('Submit');
                        // $("#alert-edit_no_bku").find("ul").html('');
                        // $("#alert-edit_no_bku").css('display','block');
                        // $.each( error.responseJSON.edit_no_bku, function( key, value ) {
                        //     $("#alert-edit_no_bku").find("ul").append('<li>'+value+'</li>');
                        // });
                        if (error.responseJSON.edit_tanggal_bku) {
                            $("#alert-edit_tanggal_bku").find("ul").html('');
                            $("#alert-edit_tanggal_bku").css('display','block');
                            $('#alert-edit_tanggal_bku').html(error.responseJSON.edit_tanggal_bku);
                            $.each( error.responseJSON.edit_tanggal_bku, function( key, value ) {
                                $("#alert-edit_tanggal_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_tanggal_bku").find("ul").html('');
                            $("#alert-edit_tanggal_bku").css('display','none');
                            $.each( error.responseJSON.edit_tanggal_bku, function( key, value ) {
                                $("#alert-edit_tanggal_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_no_bku) {
                            $("#alert-edit_no_bku").find("ul").html('');
                            $("#alert-edit_no_bku").css('display','block');
                            $('#alert-edit_no_bku').html(error.responseJSON.edit_no_bku);
                            $.each( error.responseJSON.edit_no_bku, function( key, value ) {
                                $("#alert-edit_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_no_bku").find("ul").html('');
                            $("#alert-edit_no_bku").css('display','none');
                            $.each( error.responseJSON.edit_no_bku, function( key, value ) {
                                $("#alert-edit_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_tgl_penguji) {
                            $("#alert-edit_tgl_penguji").find("ul").html('');
                            $("#alert-edit_tgl_penguji").css('display','block');
                            $('#alert-edit_tgl_penguji').html(error.responseJSON.edit_tgl_penguji);
                            $.each( error.responseJSON.edit_tgl_penguji, function( key, value ) {
                                $("#alert-edit_tgl_penguji").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_tgl_penguji").find("ul").html('');
                            $("#alert-edit_tgl_penguji").css('display','none');
                            $.each( error.responseJSON.edit_tgl_penguji, function( key, value ) {
                                $("#alert-edit_tgl_penguji").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_no_penguji) {
                            $("#alert-edit_no_penguji").find("ul").html('');
                            $("#alert-edit_no_penguji").css('display','block');
                            $('#alert-edit_no_penguji').html(error.responseJSON.edit_no_penguji);
                            $.each( error.responseJSON.edit_no_penguji, function( key, value ) {
                                $("#alert-edit_no_penguji").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_no_penguji").find("ul").html('');
                            $("#alert-edit_no_penguji").css('display','none');
                            $.each( error.responseJSON.edit_no_penguji, function( key, value ) {
                                $("#alert-edit_no_penguji").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_uraian_bku) {
                            $("#alert-edit_uraian_bku").find("ul").html('');
                            $("#alert-edit_uraian_bku").css('display','block');
                            $('#alert-edit_uraian_bku').html(error.responseJSON.edit_uraian_bku);
                            $.each( error.responseJSON.edit_uraian_bku, function( key, value ) {
                                $("#alert-edit_uraian_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_uraian_bku").find("ul").html('');
                            $("#alert-edit_uraian_bku").css('display','none');
                            $.each( error.responseJSON.edit_uraian_bku, function( key, value ) {
                                $("#alert-edit_uraian_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_sumber_dana) {
                            $("#alert-edit_sumber_dana").find("ul").html('');
                            $("#alert-edit_sumber_dana").css('display','block');
                            $('#alert-edit_sumber_dana').html(error.responseJSON.edit_sumber_dana);
                            $.each( error.responseJSON.edit_sumber_dana, function( key, value ) {
                                $("#alert-edit_sumber_dana").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_sumber_dana").find("ul").html('');
                            $("#alert-edit_sumber_dana").css('display','none');
                            $.each( error.responseJSON.edit_sumber_dana, function( key, value ) {
                                $("#alert-edit_sumber_dana").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_nama_opd) {
                            $("#alert-edit_nama_opd").find("ul").html('');
                            $("#alert-edit_nama_opd").css('display','block');
                            $('#alert-edit_nama_opd').html(error.responseJSON.edit_nama_opd);
                            $.each( error.responseJSON.edit_nama_opd, function( key, value ) {
                                $("#alert-edit_nama_opd").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_nama_opd").find("ul").html('');
                            $("#alert-edit_nama_opd").css('display','none');
                            $.each( error.responseJSON.edit_nama_opd, function( key, value ) {
                                $("#alert-edit_nama_opd").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_nama_rekanan) {
                            $("#alert-edit_nama_rekanan").find("ul").html('');
                            $("#alert-edit_nama_rekanan").css('display','block');
                            $('#alert-edit_nama_rekanan').html(error.responseJSON.edit_nama_rekanan);
                            $.each( error.responseJSON.edit_nama_rekanan, function( key, value ) {
                                $("#alert-edit_nama_rekanan").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_nama_rekanan").find("ul").html('');
                            $("#alert-edit_nama_rekanan").css('display','none');
                            $.each( error.responseJSON.edit_nama_rekanan, function( key, value ) {
                                $("#alert-edit_nama_rekanan").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_nama_bank) {
                            $("#alert-edit_nama_bank").find("ul").html('');
                            $("#alert-edit_nama_bank").css('display','block');
                            $('#alert-edit_nama_bank').html(error.responseJSON.edit_nama_bank);
                            $.each( error.responseJSON.edit_nama_bank, function( key, value ) {
                                $("#alert-edit_nama_bank").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_nama_bank").find("ul").html('');
                            $("#alert-edit_nama_bank").css('display','none');
                            $.each( error.responseJSON.edit_nama_bank, function( key, value ) {
                                $("#alert-edit_nama_bank").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_nilai_sp2d) {
                            $("#alert-edit_nilai_sp2d").find("ul").html('');
                            $("#alert-edit_nilai_sp2d").css('display','block');
                            $('#alert-edit_nilai_sp2d').html(error.responseJSON.edit_nilai_sp2d);
                            $.each( error.responseJSON.edit_nilai_sp2d, function( key, value ) {
                                $("#alert-edit_nilai_sp2d").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_nilai_sp2d").find("ul").html('');
                            $("#alert-edit_nilai_sp2d").css('display','none');
                            $.each( error.responseJSON.edit_nilai_sp2d, function( key, value ) {
                                $("#alert-edit_nilai_sp2d").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.double_no_bku) {
                            $("#alert-double_no_bku").find("ul").html('');
                            $("#alert-double_no_bku").css('display','block');
                            $('#alert-double_no_bku').html(error.responseJSON.double_no_bku);
                            $.each( error.responseJSON.double_no_bku, function( key, value ) {
                                $("#alert-double_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-double_no_bku").find("ul").html('');
                            $("#alert-double_no_bku").css('display','none');
                            $.each( error.responseJSON.double_no_bku, function( key, value ) {
                                $("#alert-double_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }


                    }
               });

        });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.banrecord', function () {
      var pengeluaran_idban = $(this).data('id');
      $.ajax({
            type : 'get',
            url: "{{ route('bku-pengeluaran.index') }}" +'/' + pengeluaran_idban +'/batal',
            data :  'pengeluaran_idban='+ pengeluaran_idban,
            success : function(data){
                $('#batal').html(data);//menampilkan data ke dalam modal
                $('#ajaxModelban').modal('show');
                $('#saveBtnban').val("edit-user");
            }
        });
    });
    $('#pengeluaranbanForm').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        $('#saveBtnban').html('Sending...');

        $.ajax({
                type:'POST',
                url: "{{ route('bku-pengeluaran.update1') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                      $('#saveBtnban').html('Submit');
                      $('#pengeluaranbanForm').trigger("reset");
                      $('#ajaxModelban').modal('hide');
                      table.draw();
                },
                error: function(response){
                    $('#saveBtnban').html('Submit');
                    $('#pengeluaranbanForm').find(".print-error-msg").find("ul").html('');
                    $('#pengeluaranbanForm').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#pengeluaranbanForm').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
           });

    });
/*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.unbanrecord', function () {
      var pengeluaran_idunban = $(this).data('id');
        $.ajax({
            type : 'get',
            url: "{{ route('bku-pengeluaran.index') }}" +'/' + pengeluaran_idunban +'/unbatal',
            data :  'pengeluaran_idunban='+ pengeluaran_idunban,
            success : function(data){
                $('#unbatal').html(data);//menampilkan data ke dalam modal
                $('#ajaxModelunban').modal('show');
                $('#saveBtnunban').val("edit-user");
            }
        });
    //   $.get("{{ route('bku-pengeluaran.index') }}" +'/' + pengeluaran_idunban, function (data) {

    //       $('#saveBtnunban').val("edit-user");
    //       $('#ajaxModelunban').modal('show');
    //       $('#pengeluaran_idunban').val(data.id);
    //       $('.pengeluaran_id_bkuunban').text(data.id_bku);
    //       $('.pengeluaran_no_bkuunban').text(data.no_bku);
    //   })
    });
    $('#pengeluaranunbanForm').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        $('#saveBtnunban').html('Sending...');

        $.ajax({
                type:'POST',
                url: "{{ route('bku-pengeluaran.update2') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                      $('#saveBtnunban').html('Submit');
                      $('#pengeluaranunbanForm').trigger("reset");
                      $('#ajaxModelunban').modal('hide');
                      table.draw();
                },
                error: function(response){
                    $('#saveBtnunban').html('Submit');
                    $('#pengeluaranunbanForm').find(".print-error-msg").find("ul").html('');
                    $('#pengeluaranunbanForm').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#pengeluaranunbanForm').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
           });

    });

});
</script>
<script type="text/javascript">
    // Lakukan ini sebelum Anda menginisialisasi salah satu modal Anda
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
$(document).ready(function() {
$('#create_sumber_dana').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_nama_opd').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_nama_bank').select2({
        dropdownParent: $('#ajaxModelcreate')
});
});
$(document).ready(function() {
$('#edit_id_dana').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_id_opd').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_id_bank').select2({
        dropdownParent: $('#ajaxModelupdate')
});
});
jQuery(function() {

  $('#create_sumber_dana').each(function() {
    $(this).select2({
      theme: "bootstrap-5",
      dropdownParent: $(this).parent(), // fix select2 search input focus bug
    })
  });

  // fix select2 bootstrap modal scroll bug
  $(document).on('select2:close', '#create_sumber_dana', function(e) {
    var evt = "scroll.select2"
    $(e.target).parents().off(evt)
    $(window).off(evt)
  })

});
$('body').on('shown.bs.modal', '.modal', function() {
  $(this).find('select').each(function() {
    var dropdownParent = $(document.body);
    if ($(this).parents('.modal.in:first').length !== 0)
      dropdownParent = $(this).parents('.modal.in:first');
    $(this).select2({
      dropdownParent: dropdownParent
      // ...
    });
  });
});
</script>
<script type="text/javascript">
$('#date').pickadate({
  selectMonths: true, // Creates a dropdown to control month
  selectYears: 15 // Creates a dropdown of 15 years to control year
});
$('#ajaxModelupdate').on('shown.bs.modal', function() {
  $('#edit_tanggal_bku').datepicker({});
});
</script>
@endsection

