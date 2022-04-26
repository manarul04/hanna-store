<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mari Belajar Coding</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Css Styles -->
     <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="../../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/style.css" type="text/css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.0/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/id.min.js"></script>  
  <script src="../../asset/js/app.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Mari Belajar Coding</a>
    </div>   
  </div>
</nav>
<div class="container-fluid">
  <div class="row">
<div class="col-lg-12">
                            <label for="cun">Ongkir<span>*</span></label> 
                                <div class="row">
                                    <div class="col-sm-9">
                                    <input type="text"  id="berat" name="berat" required readonly>
                                    </div>
                                    <div class="col-sm-3">
                                    <a href="#" class="primary-btn" data-toggle="modal" data-target="#cekOngkir">Cek</a>
                                    </div>
                                </div>
                            </div>  
                            </div>
                            </div>
                            
                            <!-- Modal -->
<div class="modal fade" id="cekOngkir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cek Ongkir</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-5">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <form class="form-horizontal" id="ongkir" method="POST">
                      <div class="form-group">
                        <label class="control-label col-sm-3">Kota Asal:</label>
                        <div class="col-sm-9">
                          <select class="form-control" id="kota_asal" name="kota_asal" required="">
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-3">Kota Tujuan</label>
                        <div class="col-sm-9">          
                          <select class="form-control" id="kota_tujuan" name="kota_tujuan" required="">
                            <option></option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-3">Kurir</label>
                        <div class="col-sm-9">          
                          <select class="form-control" id="kurir" name="kurir" required="">
                            <option value="jne">JNE</option>
                            <option value="tiki">TIKI</option>
                            <option value="pos">POS INDONESIA</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-3">Berat (Kg)</label>
                        <div class="col-sm-9">          
                          <input type="text" class="form-control" id="berat" name="berat" required="">
                        </div>
                      </div>
                      <div class="form-group" id="response">      
                      </div>
                      <div class="form-group">        
                        <div class="col-sm-offset-3 col-sm-8">
                          <button type="submit" class="btn btn-default">Cek</button>
                        </div>
                      </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
                    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning"><i class="icon_bag_alt"></i> Cek</button>
                <!-- <a class="btn btn-warning" href="?halaman=detail&id=<?=$produk['id_produk'];?>"><i class="icon_bag_alt"></i> Keranjang</a> -->
            </div>
            </form>
        </div>
    </div>
</div>
    



 <!-- Js Plugins -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <!-- <script src="../../js/jquery-3.3.1.min.js"></script> -->
    <!-- <script src="../../js/bootstrap.min.js"></script>-->
    <script src="../../js/jquery-ui.min.js"></script>
    <script src="../../js/jquery.countdown.min.js"></script>
    <script src="../../js/jquery.nice-select.min.js"></script>
    <script src="../../js/jquery.zoom.min.js"></script>
    <script src="../../js/jquery.dd.min.js"></script>
    <script src="../../js/jquery.slicknav.js"></script>
    <script src="../../js/owl.carousel.min.js"></script>
    <script src="../../js/main.js"></script> 

</body>
</html>
