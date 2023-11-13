<?php
include("server/control.php");
include("inc/sidebar.php");


$auth = $_SESSION["key"];
$control = $conn->query("SELECT * FROM apiusers WHERE auth_key = '{$auth}'")->fetch();


?>

            
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">


                                </div>
                            </div>
                        </div>
                           

                      

                         <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Market</h4>
                                        <br>
                                        <br>
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-footer">
				<button type="submit" id="btnAngeris" data-bs-dismiss="modal" class="btn btn-primary">Değiştir</button>
			</div>
		</div>
	</div>
</div>

<table class="table">
  <tr>
    <th>Özellik</th>
    <th>Fiyat</th>
    <th>Satın Al</th>
  </tr>
  <tr>
  </tr>
  <tr>
    <td>Premium Haftalık</td>
   <td>50₺</td>
   <td><a href="https://https://discord.gg/qfyZqkeHZa"><button type="button" class="btn btn-success">Satın Al</button></a></td>
  </tr>
  <tr>
    <td>Premium Aylık</td>
   <td>100₺</td>
   <td><a href="https://https://discord.gg/qfyZqkeHZa"><button type="button" class="btn btn-success">Satın Al</button></a></td>
  </tr>
  <tr>
  <td>Premium 3 Aylık</td>
   <td>250₺</td>
   <td><a href="https://https://discord.gg/qfyZqkeHZa"><button type="button" class="btn btn-success">Satın Al</button></a></td>
  </tr>
  <td>Premium Yıllık</td>
   <td>500₺</td>
   <td><a href="https://https://discord.gg/qfyZqkeHZa"><button type="button" class="btn btn-success">Satın Al</button></a></td>
  </tr>
</table>           

                                                   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>


              
<?php
include("inc/main_js.php");

?>
