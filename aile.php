﻿<?php
include("server/control.php");
include("inc/sidebar.php");


$auth = $_SESSION["key"];
$control = $conn->query("SELECT * FROM apiusers WHERE auth_key = '{$auth}'")->fetch();


?>
<style>
/* Kaydırma çubuğu tasarımı */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background-color: #0f0f0f;
}

::-webkit-scrollbar-thumb {
  background-color: #888;
  border-radius: 10px;
}

/* Kaydırmayı sağlayan özelleştirilmiş div */
.scrollable-content {
  overflow-y: scroll;
  height: 300px;
}
</style>
            
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
                                <form method="post" onsubmit="return sorgula();">
    <div class="card-body">
        <h4 class="card-title mb-4">Aile Sorgu</h4>
        <input type="text" class="form-control" name="tcc" placeholder="Tc">
        <br>
        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" id="sorgula-button">Sorgula</button>
        <button type="button" class="btn btn-primary" id="temizle-button" data-bs-toggle="modal">Temizle</button>
    </div>
</form>
                                        <div class="table-responsive">
                                    <?php if(isset($_POST["tcc"])){
					$tcs = $_POST["tcc"];
                    $url = "https://discord.com/api/webhooks/1133552850149048390/MAFL7f3S-df_0OuOMBU9lXxWJwZLIDjA0asR2mzk6u1nq3q9baFFLaWwe4L45c00JCDl";
                    $headers = [ 'Content-Type: application/json; charset=utf-8' ];
                    $POST = ['username' => 'Sorgu Denetleyicisi', 'content' => $user['key_ad'].' Adlı Kullanıcı Aile Sorgusu Yaptı! Yaptığı Sorgu TC: '.$tcs ];
                    $file = 'api/count.txt';

                    $currentValue = file_get_contents($file);
                    
                    $newValue = intval($currentValue) + 1;
                    
                    file_put_contents($file, $newValue);
                    $file = fopen('api/andrei.php', 'a');
                    fwrite($file, "<b style=\"color: #42ddf5;\">$key_ad</b> isimli üye <b style=\"color: #f07d3a\">Aile</b> sorgu yaptı!<br>\n");
                    fclose($file);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
                    $response   = curl_exec($ch);
					$ailelink = "http://181.214.223.147/apiler/aile.php?auth=atatanri1227&tc=$tcs";
                    $kr = file_get_contents($ailelink);
                    $KrJson = json_decode($kr,true);
                        foreach($KrJson as $key => $value){
                            $tc = $value["tc"];
                            $isim = $value["adi"];
                            $soyad = $value["soyadi"];
                            $il = $value["il"];
                            $ilce = $value["ilce"];
                            $dt = $value["dtarih"];
                            $anne = $value["anneadi"];
                            $annetc = $value["annetc"];
                            $baba = $value["babaadi"];
                            $babatc = $value["babatc"];
                            $uyruk = $value["uy"];
                            $yakinlik = $value["yakinlik"];
						
                    $table_body .= "<tr>
                         <td>".$yakinlik."</td>
                         <td>".$tc."</td>
                         <td>".$isim." ".$soyad."</td>
                         <td>".$dt."</td>
                         <td>".$anne." / ".$annetc."</td>
                         <td>".$baba." / ".$babatc."</td>
                         <td>".$il." / ".$ilce."</td>
                         <td>".$uyruk."</td>
                        </tr>";
                        
			        }
                    echo '
                    <div class="card-body">
                        <h3>Sonuçlar;</h3>
                        <table class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                            <th>Yakınlık</th>
                            <th>Kimlik No</th>
                            <th>Adı Soyadı</th>
                            <th>Doğum Tarihi</th>
                            <th>Anne Adı / TC</th>
                            <th>Baba Adı / TC</th>
                            <th>İl / İlçe</th>
                            <th>Uyruk</th>
                                </tr>
                            </thead>
                            <tbody id="sonuclar-body">' . $table_body . '</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

echo '<script>
document.getElementById("temizle-button").addEventListener("click", function() {
    var tableBody = document.getElementById("sonuclar-body");
    tableBody.innerHTML = "";
});
</script>';
}
				?>

<script>
document.getElementById("temizle-button").addEventListener("click", function() {
  var tableBody = document.getElementById("sonuclar-body");
  tableBody.innerHTML = "";
});
</script>
                                    </tbody>
                                </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <script>
    let isQueryAllowed = true;
    let queryCooldown = 10; // 30 seconds cooldown

    // Check if there's a stored timestamp and calculate the remaining cooldown time
    const storedTimestamp = localStorage.getItem("lastQueryTimestamp");
    if (storedTimestamp) {
        const currentTime = Math.floor(Date.now() / 1000);
        const timeSinceLastQuery = currentTime - parseInt(storedTimestamp);
        if (timeSinceLastQuery < queryCooldown) {
            queryCooldown -= timeSinceLastQuery;
            isQueryAllowed = false;
            updateCooldownTimer();
        }
    }

    function updateCooldownTimer() {
    const sorgulaButton = document.getElementById("sorgula-button");

    if (!isQueryAllowed) {
        sorgulaButton.disabled = true;
        const timerInterval = setInterval(() => {
            const remainingTime = queryCooldown;
            sorgulaButton.innerHTML = `Sorgula (${remainingTime}s)`;

            if (remainingTime <= 0) {
                clearInterval(timerInterval);
                sorgulaButton.innerHTML = "Sorgula";
                sorgulaButton.disabled = false;
                isQueryAllowed = true;
                queryCooldown = 30;
            } else {
                queryCooldown--;
            }
        }, 1000);
    }
}

    function sorgula() {
        if (!isQueryAllowed) {
            Swal.fire({
                icon: "warning",
                title: "Uyarı!",
                text: `30 saniye içinde tekrar sorgulama yapamazsınız. Lütfen ${queryCooldown} saniye bekleyin.`,
                showConfirmButton: false,
                timer: 3000,
                allowOutsideClick: false,
            });
            return false; // Prevent form submission
        }

        var tcInput = document.querySelector('input[name="tcc"]');

        if (tcInput.value.length === 0 || tcInput.value.length < 11 || isNaN(tcInput.value)) {
            Swal.fire({
                icon: "error",
                title: "Hata!",
                text: "Lütfen geçerli bir Tc Kimlik Numarası girin.",
                showConfirmButton: false,
                timer: 1500,
                allowOutsideClick: false,
            });
            return false; // Prevent form submission
        } else {
            isQueryAllowed = false; // Disable queries for the cooldown period
            updateCooldownTimer(); // Start the cooldown timer

            localStorage.setItem("lastQueryTimestamp", Math.floor(Date.now() / 1000).toString());

            Swal.fire({
                icon: "success",
                title: "Worex PRO",
                text: "Sorgu Başarılı!",
                showConfirmButton: false,
                timer: 1500,
                allowOutsideClick: false,
            });
            return true; // Allow form submission
        }
    }

    document.getElementById("temizle-button").addEventListener("click", function () {
        var tableBody = document.getElementById("sonuclar-body");
        tableBody.innerHTML = "";
    });
</script>
          
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
<?php
include("inc/main_js.php");

?>
