
<?php
//session_start();

if (!isset($_SESSION['GBP'])){
$api_key = 'l1sb4dr7rnng4ftxp41smz54soubg2';
$req_url = 'https://v6.exchangerate-api.com/v6/b1c79e722136aa3fa32e5909/latest/EUR';
$response_json = file_get_contents($req_url);

  // Continuing if we got a result
  
  if(false !== $response_json) {
  
    // Try/catch for json_decode operation
    try {

    // Decoding
    $response2 = json_decode($response_json);
   
    // Check for success
    if('success' === $response2->result) {

      // YOUR APPLICATION CODE HERE, e.g.
      
      //$EUR_price = round(($base_price * $response2->conversion_rates->EUR), 2);
      
     
      $_SESSION['AED']=$response2->conversion_rates->AED;
      $_SESSION['AFN']=$response2->conversion_rates->AFN;
      $_SESSION['ALL']=$response2->conversion_rates->ALL;
      $_SESSION['AMD']=$response2->conversion_rates->AMD;
      $_SESSION['ANG']=$response2->conversion_rates->ANG;
      $_SESSION['AOA']=$response2->conversion_rates->AOA;
      $_SESSION['ARS']=$response2->conversion_rates->ARS;
      $_SESSION['AUD']=$response2->conversion_rates->AUD;
      $_SESSION['AWG']=$response2->conversion_rates->AWG;
      $_SESSION['AZN']=$response2->conversion_rates->AZN;
      $_SESSION['BAM']=$response2->conversion_rates->BAM;
      $_SESSION['BBD']=$response2->conversion_rates->BBD;
      $_SESSION['BDT']=$response2->conversion_rates->BDT;
      $_SESSION['BGN']=$response2->conversion_rates->BGN;
      $_SESSION['BHD']=$response2->conversion_rates->BHD;
      $_SESSION['BIF']=$response2->conversion_rates->BIF;
      $_SESSION['BMD']=$response2->conversion_rates->BMD;
      $_SESSION['BND']=$response2->conversion_rates->BND;
      $_SESSION['BOB']=$response2->conversion_rates->BOB;
      $_SESSION['BRL']=$response2->conversion_rates->BRL;
      $_SESSION['BSD']=$response2->conversion_rates->BSD;
     
      $_SESSION['BTN']=$response2->conversion_rates->BTN;
      $_SESSION['BWP']=$response2->conversion_rates->BWP;
      $_SESSION['BYN']=$response2->conversion_rates->BYN;
      $_SESSION['BZD']=$response2->conversion_rates->BZD;
      $_SESSION['CAD']=$response2->conversion_rates->CAD;
      $_SESSION['CDF']=$response2->conversion_rates->CDF;
      $_SESSION['CHF']=$response2->conversion_rates->CHF;
      
      $_SESSION['CLP']=$response2->conversion_rates->CLP;
     
      $_SESSION['CNY']=$response2->conversion_rates->CNY;
      $_SESSION['COP']=$response2->conversion_rates->COP;
      $_SESSION['CRC']=$response2->conversion_rates->CRC;
      
      $_SESSION['CUP']=$response2->conversion_rates->CUP;
      $_SESSION['CVE']=$response2->conversion_rates->CVE;
      $_SESSION['CZK']=$response2->conversion_rates->CZK;
      $_SESSION['DJF']=$response2->conversion_rates->DJF;
      $_SESSION['DKK']=$response2->conversion_rates->DKK;
      $_SESSION['DOP']=$response2->conversion_rates->DOP;
      $_SESSION['DZD']=$response2->conversion_rates->DZD;
      $_SESSION['EGP']=$response2->conversion_rates->EGP;
      $_SESSION['ERN']=$response2->conversion_rates->ERN;
      $_SESSION['ETB']=$response2->conversion_rates->ETB;
      $_SESSION['EUR']=$response2->conversion_rates->EUR;
      $_SESSION['FJD']=$response2->conversion_rates->FJD;
      $_SESSION['FKP']=$response2->conversion_rates->FKP;
      $_SESSION['GBP']=$response2->conversion_rates->GBP;
      $_SESSION['GEL']=$response2->conversion_rates->GEL;
      $_SESSION['GGP']=$response2->conversion_rates->GGP;
      $_SESSION['GHS']=$response2->conversion_rates->GHS;
      $_SESSION['GIP']=$response2->conversion_rates->GIP;
      $_SESSION['GMD']=$response2->conversion_rates->GMD;
      $_SESSION['GNF']=$response2->conversion_rates->GNF;
      $_SESSION['GTQ']=$response2->conversion_rates->GTQ;
      $_SESSION['GYD']=$response2->conversion_rates->GYD;
      $_SESSION['HKD']=$response2->conversion_rates->HKD;
      $_SESSION['HNL']=$response2->conversion_rates->HNL;
      $_SESSION['HRK']=$response2->conversion_rates->HRK;
      $_SESSION['HTG']=$response2->conversion_rates->HTG;
      $_SESSION['HUF']=$response2->conversion_rates->HUF;
      $_SESSION['IDR']=$response2->conversion_rates->IDR;
      $_SESSION['ILS']=$response2->conversion_rates->ILS;
      $_SESSION['IMP']=$response2->conversion_rates->IMP;
      $_SESSION['INR']=$response2->conversion_rates->INR;
      $_SESSION['IQD']=$response2->conversion_rates->IQD;
      $_SESSION['IRR']=$response2->conversion_rates->IRR;
      $_SESSION['ISK']=$response2->conversion_rates->ISK;
      $_SESSION['JEP']=$response2->conversion_rates->JEP;
      $_SESSION['JMD']=$response2->conversion_rates->JMD;
      $_SESSION['JOD']=$response2->conversion_rates->JOD;
      $_SESSION['JPY']=$response2->conversion_rates->JPY;
      $_SESSION['KES']=$response2->conversion_rates->KES;
      $_SESSION['KGS']=$response2->conversion_rates->KGS;
      $_SESSION['KHR']=$response2->conversion_rates->KHR;
      $_SESSION['KMF']=$response2->conversion_rates->KMF;
     
      $_SESSION['KRW']=$response2->conversion_rates->KRW;
      $_SESSION['KWD']=$response2->conversion_rates->KWD;
      $_SESSION['KYD']=$response2->conversion_rates->KYD; 
      $_SESSION['KZT']=$response2->conversion_rates->KZT;
      $_SESSION['LAK']=$response2->conversion_rates->LAK;
      $_SESSION['LBP']=$response2->conversion_rates->LBP;
      $_SESSION['LKR']=$response2->conversion_rates->LKR;
      $_SESSION['LRD']=$response2->conversion_rates->LRD;
      $_SESSION['LSL']=$response2->conversion_rates->LSL;
      $_SESSION['LYD']=$response2->conversion_rates->LYD;
      $_SESSION['MAD']=$response2->conversion_rates->MAD;
      $_SESSION['MDL']=$response2->conversion_rates->MDL;
      $_SESSION['MGA']=$response2->conversion_rates->MGA;
      $_SESSION['MKD']=$response2->conversion_rates->MKD;
      $_SESSION['MMK']=$response2->conversion_rates->MMK;
      $_SESSION['MNT']=$response2->conversion_rates->MNT;
      $_SESSION['MOP']=$response2->conversion_rates->MOP;
     
      $_SESSION['MUR']=$response2->conversion_rates->MUR;
      $_SESSION['MVR']=$response2->conversion_rates->MVR;
      $_SESSION['MWK']=$response2->conversion_rates->MWK;
      $_SESSION['MXN']=$response2->conversion_rates->MXN;
      $_SESSION['MYR']=$response2->conversion_rates->MYR;
      $_SESSION['MZN']=$response2->conversion_rates->MZN;
      $_SESSION['NAD']=$response2->conversion_rates->NAD;
      $_SESSION['NGN']=$response2->conversion_rates->NGN;
      $_SESSION['NIO']=$response2->conversion_rates->NIO;
      $_SESSION['NOK']=$response2->conversion_rates->NOK;
      $_SESSION['NPR']=$response2->conversion_rates->NPR;
      $_SESSION['NZD']=$response2->conversion_rates->NZD;
      $_SESSION['OMR']=$response2->conversion_rates->OMR;
      $_SESSION['PAB']=$response2->conversion_rates->PAB;
      $_SESSION['PEN']=$response2->conversion_rates->PEN;
      $_SESSION['PGK']=$response2->conversion_rates->PGK;
      $_SESSION['PHP']=$response2->conversion_rates->PHP;
      $_SESSION['PKR']=$response2->conversion_rates->PKR;
      $_SESSION['PLN']=$response2->conversion_rates->PLN;
      $_SESSION['PYG']=$response2->conversion_rates->PYG;
      $_SESSION['QAR']=$response2->conversion_rates->QAR;
      $_SESSION['RON']=$response2->conversion_rates->RON;
      $_SESSION['RSD']=$response2->conversion_rates->RSD;
      $_SESSION['RUB']=$response2->conversion_rates->RUB;
      $_SESSION['RWF']=$response2->conversion_rates->RWF;
      $_SESSION['SAR']=$response2->conversion_rates->SAR;
      $_SESSION['SBD']=$response2->conversion_rates->SBD;
      $_SESSION['SCR']=$response2->conversion_rates->SCR;
      $_SESSION['SDG']=$response2->conversion_rates->SDG;
      $_SESSION['SEK']=$response2->conversion_rates->SEK;
      $_SESSION['SGD']=$response2->conversion_rates->SGD;
      $_SESSION['SHP']=$response2->conversion_rates->SHP;
      $_SESSION['SLL']=$response2->conversion_rates->SLL;
      $_SESSION['SOS']=$response2->conversion_rates->SOS;
      $_SESSION['SRD']=$response2->conversion_rates->SRD;
      
     
      $_SESSION['SYP']=$response2->conversion_rates->SYP;
      $_SESSION['SZL']=$response2->conversion_rates->SZL;
      $_SESSION['THB']=$response2->conversion_rates->THB;
      $_SESSION['TJS']=$response2->conversion_rates->TJS;
      $_SESSION['TMT']=$response2->conversion_rates->TMT;
      $_SESSION['TND']=$response2->conversion_rates->TND;
      $_SESSION['TOP']=$response2->conversion_rates->TOP;
      $_SESSION['TRY']=$response2->conversion_rates->TRY;
      $_SESSION['TTD']=$response2->conversion_rates->TTD;
      $_SESSION['TWD']=$response2->conversion_rates->TWD;
      $_SESSION['TZS']=$response2->conversion_rates->TZS;
      $_SESSION['UAH']=$response2->conversion_rates->UAH;
      $_SESSION['UGX']=$response2->conversion_rates->UGX;
      $_SESSION['USD']=$response2->conversion_rates->USD;
      $_SESSION['UYU']=$response2->conversion_rates->UYU;
      $_SESSION['UZS']=$response2->conversion_rates->UZS;
      
      $_SESSION['VND']=$response2->conversion_rates->VND;
      $_SESSION['VUV']=$response2->conversion_rates->VUV;
      $_SESSION['WST']=$response2->conversion_rates->WST;
      $_SESSION['XAF']=$response2->conversion_rates->XAF;
      $_SESSION['XCD']=$response2->conversion_rates->XCD;
      $_SESSION['XOF']=$response2->conversion_rates->XOF;
      $_SESSION['XPF']=$response2->conversion_rates->XPF;
      $_SESSION['YER']=$response2->conversion_rates->YER;
      $_SESSION['ZAR']=$response2->conversion_rates->ZAR;
      $_SESSION['ZMW']=$response2->conversion_rates->ZMW;
      $_SESSION['ZWL']=$response2->conversion_rates->ZWL;


        
    }

    }
    catch(Exception $e) {
        // Handle JSON parse error...
    }

}
}
echo ('<div style="background-color:steelblue; color:white;">');
        echo ('<marquee behavior="scroll" scrollamount="8" width="100%" direction="left" height="20px">');
        
        echo ('GBP '.$_SESSION['GBP'].'€&nbsp;&nbsp;');
        echo ('NOK '.$_SESSION['NOK'].'€&nbsp;&nbsp;');
        echo ('SEK '.$_SESSION['SEK'].'€&nbsp;&nbsp;');
        echo ('DKK '.$_SESSION['DKK'].'€&nbsp;&nbsp;');
        echo ('CAD '.$_SESSION['CAD'].'€&nbsp;&nbsp;');
        echo ('USD '.$_SESSION['USD'].'€&nbsp;&nbsp;');
        echo ('AUD '.$_SESSION['AUD'].'€&nbsp;&nbsp;');
        echo ('NZD '.$_SESSION['NZD'].'€&nbsp;&nbsp;');
        echo ('CNY '.$_SESSION['CNY'].'€&nbsp;&nbsp;');
        echo ('JPY '.$_SESSION['JPY'].'€&nbsp;&nbsp;');
        echo ('EUR '.$_SESSION['EUR'].'€&nbsp;&nbsp;');
        echo ('RUB '.$_SESSION['RUB'].'€&nbsp;&nbsp;');
        
        
        
       
        echo ('</marquee>');
        echo ('</div>');

?>