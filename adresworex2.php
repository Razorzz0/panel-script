<?php
$token1 = "75dba3fa013f3b02d7c75669ed63ad24dc9731274eca1b1ed8a2a1abb25d39d891c1a80ded7e8883a581f1842b2eb68761dcbbf31bf829cb32a46143ad4e2fa5";

$author = isset($_GET['author']) ? $_GET['author'] : '';

if ($author === 'yabani123') {
    function tcpro_post($url) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Curl error: " . $err;
        } else {
            return $response;
        }
    }

    if (isset($_GET['tc'])) {
        $tc = $_GET['tc'];

        $url = "https://intvrg.gib.gov.tr/intvrg_server/dispatch?cmd=EBynYetkiIslemleri_vknGirisi&callid=1c13f11301193-13&token=$token1&jp=%7B%22mukellefVergiNo%22%3A%22%22%2C%22mukellefTCKimlikNo%22%3A%22$tc%22%2C%22arac%C4%B1l%C4%B1kSozlesmeTipi%22%3A%220%22%7D";
        $veri = tcpro_post($url);

        // Parse JSON response and format it
        $response = json_decode($veri, true);

        if (isset($response['data']['mukellef_vergino']) || isset($response['data']['mukellef_vdkodu']['vergidaireleri'][0]['vdkodu'])) {
            $mukellef_vergino = $response['data']['mukellef_vergino'];
            $vdkodu = $response['data']['mukellef_vdkodu']['vergidaireleri'][0]['vdkodu'];
            $vdadi = $response['data']['mukellef_vdkodu']['vergidaireleri'][0]['vdadi'];
            $mukellef_ad = $response['data']['mukellef_ad'];
            $mukellef_tc = $response['data']['mukellef_tckimlikno'];


            // Yeni bir URL oluştur
            $sube_url = "https://intvrg.gib.gov.tr/intvrg_server/dispatch?cmd=EBynYetkiIslemleri_subeNoGetir&callid=e3c364fa5ccd1-88&token=$token1&jp=%7B%22mukellefVergiNo%22%3A%22$mukellef_vergino%22%2C%22bagliVd%22%3A%22$vdkodu%22%7D";
            $sube_veri = tcpro_post($sube_url);

            // Parse JSON response
            $sube_response = json_decode($sube_veri, true);

            if (isset($sube_response['data']['sube_no'][1]['text'])) {
                $sube_adres = $sube_response['data']['sube_no'][1]['text'];

                $result = array(
                    'tc' => $mukellef_tc,
                    'adsoyad' => $mukellef_ad,
                    'adres' => $sube_adres,
                    'vergino' => $mukellef_vergino,
                    'vergidairesikodu' => $vdkodu,
                    'vergidairesiadi' => $vdadi
                    );

                header('Content-Type: application/json');
                echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                echo "Şube adresi bulunamadı.";
            }
        } else {
            echo "Mükellef adresi veya mükellef vergi numarası bulunamadı.";
        }
    } else {
        // ...
    }
} else {
    echo "Orusbu Çocugu Yanlış author.";
}
?>