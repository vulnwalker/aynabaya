<?php
function sendSMS($nomorTujuan,$isiPesan){
        $arrayData = array(
                                                        'editPhone' => $nomorTujuan,
                                                        'editIsi' => $isiPesan,
                                                        'editEmail' => 'nurmelly16@gmail.com',
        );
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL, "http://sms.vherolly.com/gammu/kirim/mobile_send_v2.php");
        curl_setopt($curl,CURLOPT_POST, sizeof($arrayData));
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36");
        curl_setopt($curl,CURLOPT_POSTFIELDS, $arrayData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        return $result;
}

for ($i=1; $i <=1 ; $i++) {
        $pesan = "Terimakasih telah berbelanja di aynabaya webshop. Total pembelanjaan anda adalah rp 134887, silahkan transfer sesuai angka"; 
        $numberTujuan = "08112107299";
        $response = json_decode(sendSMS($numberTujuan,$pesan));
        if($response->success == '1'){
                echo "$i. SUKSES SEND TO $numberTujuan => $pesan \n";
        }else{
                echo "$i. FAILED SEND TO $numberTujuan => $pesan \n";
        }
}
 ?>