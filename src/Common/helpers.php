<?php
if (!function_exists('encryptAES')) {
    function encryptAES($str, $key)
    {
        $str = pkcs5_pad($str);
        $iv = "PGKEYENCDECIVSPC";
        $encrypted = openssl_encrypt($str, "aes-256-cbc", $key, OPENSSL_ZERO_PADDING, $iv);
        $encrypted = base64_decode($encrypted);
        $encrypted = unpack('C*', ($encrypted));
        $encrypted = byteArray2Hex($encrypted);
        $encrypted = urlencode($encrypted);
        return $encrypted;
    }
}
if (!function_exists('decryptAES')) {
    function decryptAES($code, $key)
    {
        $code = hex2ByteArray(trim($code));
        $code = byteArray2String($code);
        $iv = "PGKEYENCDECIVSPC";
        $code = base64_encode($code);
        $decrypted = openssl_decrypt($code, 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        return pkcs5_unpad($decrypted);
    }
}
if (!function_exists('pkcs5_pad')) {
    function pkcs5_pad($text)
    {
        $blocksize = 16;
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
}
if (!function_exists('byteArray2Hex')) {
    function byteArray2Hex($byteArray)
    {
        $chars = array_map("chr", $byteArray);
        $bin = join($chars);
        return bin2hex($bin);
    }
}
if (!function_exists('hex2ByteArray')) {
    function hex2ByteArray($hexString)
    {
        $string = hex2bin($hexString);
        return unpack('C*', $string);
    }
}
if (!function_exists('byteArray2String')) {
    function byteArray2String($byteArray)
    {
        $chars = array_map("chr", $byteArray);
        return join($chars);
    }
}
if (!function_exists('pkcs5_unpad')) {
    function pkcs5_unpad($text)
    {
        if (strlen($text) < 1) {
            return '';
        }
        $pad = ord($text[strlen($text) - 1]);
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }
}

if (!function_exists('getCurrency')) {
    function getCurrency($currency)
    {
        return array(
            'AFA' => array('name' => 'Afghanistan Afghani', 'code' => '004'),
            'ALL' => array('name' => 'Albanian Lek', 'code' => '008'),
            'DZD' => array('name' => 'Algerian Dinar', 'code' => '012'),
            'USD' => array('name' => 'US Dollar', 'code' => '840'),
            'ESP' => array('name' => 'Spanish Peseta', 'code' => '724'),
            'FRF' => array('name' => 'French Franc', 'code' => '250'),
            'ADP' => array('name' => 'Andorran Peseta', 'code' => '020'),
            'AOA' => array('name' => 'Kwanza', 'code' => '973'),
            'XCD' => array('name' => 'East Caribbean Dollar', 'code' => '951'),
            'XCD' => array('name' => 'East Caribbean Dollar', 'code' => '951'),
            'ARS' => array('name' => 'Argentine Peso', 'code' => '032'),
            'AMD' => array('name' => 'Armenian Dram', 'code' => '051'),
            'AWG' => array('name' => 'Aruban Guilder', 'code' => '533'),
            'AUD' => array('name' => 'Australian Dollar', 'code' => '036'),
            'ATS' => array('name' => 'Austrian Schilling', 'code' => '040'),
            'AZM' => array('name' => 'Azerbaijanian Manat', 'code' => '031'),
            'BSD' => array('name' => 'Bahamian Dollar', 'code' => '044'),
            'BHD' => array('name' => 'Bahraini Dinar', 'code' => '048'),
            'BDT' => array('name' => 'Bangladeshi Taka', 'code' => '050'),
            'BBD' => array('name' => 'Barbados Dollar', 'code' => '052'),
            'BYB' => array('name' => 'Belarussian Ruble', 'code' => '112'),
            'RYR' => array('name' => 'Belarussian Ruble', 'code' => '974'),
            'BEF' => array('name' => 'Belgian Franc', 'code' => '056'),
            'BZD' => array('name' => 'Belize Dollar', 'code' => '084'),
            'XOF' => array('name' => 'CFA Franc (BCEAO)', 'code' => '952'),
            'BMD' => array('name' => 'Bermuda Dollar', 'code' => '060'),
            'INR' => array('name' => 'Indian Rupee', 'code' => '356'),
            'BTN' => array('name' => 'Ngultrum', 'code' => '064'),
            'BOB' => array('name' => 'Boliviano', 'code' => '068'),
            'BOV' => array('name' => 'Mvdol', 'code' => '984'),
            'BAM' => array('name' => 'Convertible Marks', 'code' => '977'),
            'BWP' => array('name' => 'Pula', 'code' => '072'),
            'NOK' => array('name' => 'Norwegian Krone', 'code' => '578'),
            'BRL' => array('name' => 'Brazil Real', 'code' => '986'),
            'BND' => array('name' => 'Brunei Dollar', 'code' => '096'),
            'BGL' => array('name' => 'Lev', 'code' => '100'),
            'BGN' => array('name' => 'Bulgarian Lev', 'code' => '975'),
            'BIF' => array('name' => 'Burundi Franc', 'code' => '108'),
            'KHR' => array('name' => 'Cambodian Riel', 'code' => '116'),
            'XAF' => array('name' => 'CFA Franc (BEAC)', 'code' => '950'),
            'CAD' => array('name' => 'Canadian Dollar', 'code' => '124'),
            'CVE' => array('name' => 'Cape Verde Escudo', 'code' => '132'),
            'KYD' => array('name' => 'Cayman Islands Dollar', 'code' => '136'),
            'XAF' => array('name' => 'CFA Franc (BEAC)', 'code' => '950'),
            'XAF' => array('name' => 'CFA Franc (BEAC)', 'code' => '950'),
            'CLP' => array('name' => 'Chilean Peso', 'code' => '152'),
            'CLF' => array('name' => 'Unidates de fomento', 'code' => '990'),
            'CNY' => array('name' => 'Yuan Renminbi', 'code' => '156'),
            'HKD' => array('name' => 'Hong Kong Dollar', 'code' => '344'),
            'MOP' => array('name' => 'Pataca', 'code' => '446'),
            'COP' => array('name' => 'Colombian Peso', 'code' => '170'),
            'KMF' => array('name' => 'Comoro Franc', 'code' => '174'),
            'XAF' => array('name' => 'CFA Franc (BEAC)', 'code' => '950'),
            'CDF' => array('name' => 'Franc Congolais', 'code' => '976'),
            'NZD' => array('name' => 'New Zealand Dollar', 'code' => '554'),
            'CRC' => array('name' => 'Costa Rican Colon', 'code' => '188'),
            'HRK' => array('name' => 'Croatian Kuna', 'code' => '191'),
            'CUP' => array('name' => 'Cuban Peso', 'code' => '192'),
            'CYP' => array('name' => 'Cyprus Pound', 'code' => '196'),
            'CZK' => array('name' => 'Czech Koruna', 'code' => '203'),
            'DKK' => array('name' => 'Danish Krone', 'code' => '208'),
            'DJF' => array('name' => 'Djibouti Franc', 'code' => '262'),
            'XCD' => array('name' => 'East Caribbean Dollar', 'code' => '951'),
            'DOP' => array('name' => 'Dominican Peso', 'code' => '214'),
            'TPE' => array('name' => 'Timor Escudo', 'code' => '626'),
            'IDE' => array('name' => 'Rupiah', 'code' => '360'),
            'ECS' => array('name' => 'Sucre', 'code' => '218'),
            'ECV' => array('name' => 'Unidad de Valor Constante (UVC)', 'code' => '983'),
            'EGP' => array('name' => 'Egyptian Pound', 'code' => '818'),
            'SVC' => array('name' => 'El Salvador Colon', 'code' => '222'),
            'XAF' => array('name' => 'CFA Franc (BEAC)', 'code' => '950'),
            'ERN' => array('name' => 'Nafka', 'code' => '232'),
            'EEK' => array('name' => 'Kroon', 'code' => '233'),
            'ETB' => array('name' => 'Ethiopian Birr', 'code' => '230'),
            'DKK' => array('name' => 'Danish Krone', 'code' => '208'),
            'XEU' => array('name' => 'euro', 'code' => '954'),
            'EUR' => array('name' => 'European Currency Unit', 'code' => '978'),
            'FKP' => array('name' => 'Falkland Islands Pound', 'code' => '238'),
            'FJD' => array('name' => 'Fiji Dollar', 'code' => '242'),
            'FIM' => array('name' => 'Finnish Markka', 'code' => '246'),
            'FRF' => array('name' => 'French Franc', 'code' => '250'),
            'FRF' => array('name' => 'French Franc', 'code' => '250'),
            'XPF' => array('name' => 'CFP Franc', 'code' => '953'),
            'XPF' => array('name' => 'CFP Franc', 'code' => '953'),
            'XAF' => array('name' => 'CFA Franc (BEAC)', 'code' => '950'),
            'GMD' => array('name' => 'Dalasi', 'code' => '270'),
            'GEL' => array('name' => 'Lari', 'code' => '981'),
            'DEM' => array('name' => 'Deutsche Mark', 'code' => '276'),
            'GHC' => array('name' => 'Ghana Cedi', 'code' => '288'),
            'GIP' => array('name' => 'Gibraltar Pound', 'code' => '292'),
            'GRD' => array('name' => 'Drachma', 'code' => '300'),
            'DKK' => array('name' => 'Danish Krone', 'code' => '208'),
            'XCD' => array('name' => 'East Caribbean Dollar', 'code' => '951'),
            'FRF' => array('name' => 'French Franc', 'code' => '250'),
            'GTQ' => array('name' => 'Guatemalan Quetzal', 'code' => '320'),
            'GNF' => array('name' => 'Guinea Franc', 'code' => '324'),
            'GWP' => array('name' => 'Guinea-Bissau Peso', 'code' => '624'),
            'GYD' => array('name' => 'Guyana Dollar', 'code' => '328'),
            'HTG' => array('name' => 'Haiti Gourde', 'code' => '332'),
            'ITL' => array('name' => 'Italian Lira', 'code' => '380'),
            'HNL' => array('name' => 'Honduran Lempira', 'code' => '340'),
            'HUF' => array('name' => 'Forint', 'code' => '348'),
            'ISK' => array('name' => 'Iceland Krona', 'code' => '352'),
            'IDR' => array('name' => 'Indonesian Rupiah', 'code' => '360'),
            'XDR' => array('name' => 'SDR', 'code' => '960'),
            'IRR' => array('name' => 'Iranian Rial', 'code' => '364'),
            'IQD' => array('name' => 'Iraqi Dinar', 'code' => '368'),
            'IEP' => array('name' => 'Irish Pound', 'code' => '372'),
            'ILS' => array('name' => 'New Israeli Sheqel', 'code' => '376'),
            'ITL' => array('name' => 'Italian Lira', 'code' => '380'),
            'JMD' => array('name' => 'Jamaican Dollar', 'code' => '388'),
            'JPY' => array('name' => 'Yen', 'code' => '392'),
            'JOD' => array('name' => 'Jordanian Dinar', 'code' => '400'),
            'KZT' => array('name' => 'Kazakhstan Tenge', 'code' => '398'),
            'KES' => array('name' => 'Kenyan Shilling', 'code' => '404'),
            'KPW' => array('name' => 'North Korean Won', 'code' => '408'),
            'KRW' => array('name' => 'South Korean Won', 'code' => '410'),
            'KWD' => array('name' => 'Kuwaiti Dinar', 'code' => '414'),
            'KGS' => array('name' => 'Kyrgyzstan Som', 'code' => '417'),
            'LAK' => array('name' => 'Laos Kip', 'code' => '418'),
            'LVL' => array('name' => 'Latvian Lats', 'code' => '428'),
            'LBP' => array('name' => 'Lebanese Pound', 'code' => '422'),
            'ZAR' => array('name' => 'Rand', 'code' => '710'),
            'LSL' => array('name' => 'Loti', 'code' => '426'),
            'LRD' => array('name' => 'Liberian Dollar', 'code' => '430'),
            'LYD' => array('name' => 'Libyan Dinar', 'code' => '434'),
            'CHF' => array('name' => 'Swiss Franc', 'code' => '756'),
            'LTL' => array('name' => 'Lithuanian Litas', 'code' => '440'),
            'LUF' => array('name' => 'Luxembourg Franc', 'code' => '442'),
            'MKD' => array('name' => 'Macedonian Denar', 'code' => '807'),
            'MGF' => array('name' => 'Malagasy Franc', 'code' => '450'),
            'MWK' => array('name' => 'Kwacha', 'code' => '454'),
            'MYR' => array('name' => 'Malaysian Ringgit', 'code' => '458'),
            'MVR' => array('name' => 'Maldives Rufiyaa', 'code' => '462'),
            'MTL' => array('name' => 'Maltese Lira', 'code' => '470'),
            'FRF' => array('name' => 'French Franc', 'code' => '250'),
            'MRO' => array('name' => 'Mauritanian Ouguiya', 'code' => '478'),
            'MUR' => array('name' => 'Mauritius Rupee', 'code' => '480'),
            'MXN' => array('name' => 'Mexican Peso', 'code' => '484'),
            'MXV' => array('name' => 'Mexican Unidad de Inversion (UDI)', 'code' => '979'),
            'MDL' => array('name' => 'Moldovan Leu', 'code' => '498'),
            'FRF' => array('name' => 'French Franc', 'code' => '250'),
            'MNT' => array('name' => 'Mongolian Tugrik', 'code' => '496'),
            'XCD' => array('name' => 'East Caribbean Dollar', 'code' => '951'),
            'MAD' => array('name' => 'Moroccan Dirham', 'code' => '504'),
            'MZM' => array('name' => 'Mozambique Metical', 'code' => '508'),
            'MMK' => array('name' => 'Myanmar Kyat', 'code' => '104'),
            'ZAR' => array('name' => 'Rand', 'code' => '710'),
            'NAD' => array('name' => 'Namibia Dollar', 'code' => '516'),
            'NPR' => array('name' => 'Nepalese Rupee', 'code' => '524'),
            'ANG' => array('name' => 'Netherlands Antillian Guilder', 'code' => '532'),
            'NLG' => array('name' => 'Netherlands Gulder', 'code' => '528'),
            'XPF' => array('name' => 'CFP Franc', 'code' => '953'),
            'NZD' => array('name' => 'New Zealand Dollar', 'code' => '554'),
            'NIO' => array('name' => 'Nicaraguan Cordoba Oro', 'code' => '558'),
            'NGN' => array('name' => 'Nigerian Naira', 'code' => '566'),
            'NZD' => array('name' => 'New Zealand Dollar', 'code' => '554'),
            'NOK' => array('name' => 'Norwegian Krone', 'code' => '578'),
            'OMR' => array('name' => 'Rial Omani', 'code' => '512'),
            'PKR' => array('name' => 'Pakistan Rupee', 'code' => '586'),
            'PAB' => array('name' => 'Balboa', 'code' => '590'),
            'PGK' => array('name' => 'Papua New Guinea Kina', 'code' => '598'),
            'PYG' => array('name' => 'Paraguay Guarani', 'code' => '600'),
            'PEN' => array('name' => 'Peru Nuevo Sol', 'code' => '604'),
            'PHP' => array('name' => 'Philippine Peso', 'code' => '608'),
            'NZD' => array('name' => 'New Zealand Dollar', 'code' => '554'),
            'PLN' => array('name' => 'Poland Zloty', 'code' => '985'),
            'PTE' => array('name' => 'Portuguese Escudo', 'code' => '620'),
            'USD' => array('name' => 'US Dollar', 'code' => '840'),
            'QAR' => array('name' => 'Qatari Rial', 'code' => '634'),
            'FRF' => array('name' => 'French Franc', 'code' => '250'),
            'RON' => array('name' => 'Romanian Leu', 'code' => '642'),
            'RUR' => array('name' => 'Russian Ruble', 'code' => '810'),
            'RUB' => array('name' => 'Russian Ruble', 'code' => '643'),
            'RWF' => array('name' => 'Rwanda Franc', 'code' => '646'),
            'XCD' => array('name' => 'East Caribbean Dollar', 'code' => '951'),
            'FRF' => array('name' => 'East Caribbean Dollar', 'code' => '951'),
            'XCD' => array('name' => 'French Franc', 'code' => '250'),
            'XCD' => array('name' => 'East Caribbean Dollar', 'code' => '951'),
            'SHP' => array('name' => 'St. Helena Pound', 'code' => '654'),
            'WST' => array('name' => 'Tala', 'code' => '882'),
            'ITL' => array('name' => 'Italian Lira', 'code' => '380'),
            'STD' => array('name' => 'Sao Tome and Principe Dobra', 'code' => '678'),
            'SAR' => array('name' => 'Saudi Riyal', 'code' => '682'),
            'SCR' => array('name' => 'Seychelles Rupee', 'code' => '690'),
            'SLL' => array('name' => 'Sierra Leone Leone', 'code' => '694'),
            'SGD' => array('name' => 'Singapore Dollar', 'code' => '702'),
            'SKK' => array('name' => 'Slovak Koruna', 'code' => '703'),
            'SIT' => array('name' => 'Slovenia Tolar', 'code' => '705'),
            'SBD' => array('name' => 'Solomon Islands Dollar', 'code' => '90'),
            'SOS' => array('name' => 'Somalia Shilling', 'code' => '706'),
            'ZAR' => array('name' => 'South African Rand', 'code' => '710'),
            'ESP' => array('name' => 'Spanish Peseta', 'code' => '724'),
            'LKR' => array('name' => 'Sri Lanka Rupee', 'code' => '144'),
            'SDP' => array('name' => 'Sudanese Dinar', 'code' => '736'),
            'SRG' => array('name' => 'Suriname Guilder', 'code' => '740'),
            'NOK' => array('name' => 'Norwegian Krone', 'code' => '578'),
            'SZL' => array('name' => 'Swaziland Lilangeni', 'code' => '748'),
            'SEK' => array('name' => 'Swedish Krona', 'code' => '752'),
            'CHF' => array('name' => 'Swiss Franc', 'code' => '756'),
            'SYP' => array('name' => 'Syrian Pound', 'code' => '760'),
            'TWD' => array('name' => 'New Taiwan Dollar', 'code' => '901'),
            'TJR' => array('name' => 'Tajik Ruble', 'code' => '762'),
            'TZS' => array('name' => 'Tanzanian Shilling', 'code' => '834'),
            'THB' => array('name' => 'Thai Baht', 'code' => '764'),
            'NZD' => array('name' => 'New Zealand Dollar', 'code' => '554'),
            'TOP' => array('name' => 'Tonga Paanga', 'code' => '776'),
            'TTD' => array('name' => 'Trinidad and Tobago Dollar', 'code' => '780'),
            'TND' => array('name' => 'Tunisian Dinar', 'code' => '788'),
            'TRL' => array('name' => 'Turkish Lira', 'code' => '792'),
            'TMM' => array('name' => 'Manat', 'code' => '795'),
            'UGX' => array('name' => 'Ugandan Shilling', 'code' => '800'),
            'UAH' => array('name' => 'Hryvnia', 'code' => '980'),
            'AED' => array('name' => 'UAE Dirham', 'code' => '784'),
            'GBP' => array('name' => 'Pound Sterling', 'code' => '826'),
            'UYU' => array('name' => 'Peso Uruguayo', 'code' => '858'),
            'UZS' => array('name' => 'Uzbekistan Sum', 'code' => '860'),
            'VUV' => array('name' => 'Vanuatu Vatu', 'code' => '548'),
            'VEB' => array('name' => 'Venezuela Bolivar', 'code' => '862'),
            'VND' => array('name' => 'Viet Nam Dong', 'code' => '704'),
            'XPF' => array('name' => 'CFP Franc', 'code' => '953'),
            'MAD' => array('name' => 'Moroccan Dirham', 'code' => '504'),
            'YER' => array('name' => 'Yemeni Rial', 'code' => '886'),
            'YUN' => array('name' => 'Yugoslavian Dinar', 'code' => '891'),
            'ZRN' => array('name' => 'Unknown', 'code' => '180'),
            'ZMK' => array('name' => 'Zambia Kwacha', 'code' => '894'),
            'ZWD' => array('name' => 'Zimbabwe Dollar', 'code' => '716')
        )[$currency];
    }
}
