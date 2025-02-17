<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'name' => 'Afghani',
                'symbol' => '؋',
                'code' => 'AFN',
                'country_code' => 'AF',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lek',
                'symbol' => 'Lek',
                'code' => 'ALL',
                'country_code' => 'AL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Netherlands Antillian Guilder',
                'symbol' => 'ƒ',
                'code' => 'ANG',
                'country_code' => 'AN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Argentine Peso',
                'symbol' => '$',
                'code' => 'ARS',
                'country_code' => 'AR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Australian Dollar',
                'symbol' => '$',
                'code' => 'AUD',
                'country_code' => 'AU',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Aruban Guilder',
                'symbol' => 'ƒ',
                'code' => 'AWG',
                'country_code' => 'AW',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Azerbaijanian Manat',
                'symbol' => 'ман',
                'code' => 'AZN',
                'country_code' => 'AZ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Convertible Marks',
                'symbol' => 'KM',
                'code' => 'BAM',
                'country_code' => 'BA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bangladeshi Taka',
                'symbol' => '৳',
                'code' => 'BDT',
                'country_code' => 'BD',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Barbados Dollar',
                'symbol' => '$',
                'code' => 'BBD',
                'country_code' => 'BB',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bulgarian Lev',
                'symbol' => 'лв',
                'code' => 'BGN',
                'country_code' => 'BG',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bermudian Dollar',
                'symbol' => '$',
                'code' => 'BMD',
                'country_code' => 'BM',
                'created_at' => now(),
                'updated_at' => now()],
            [
                'name' => 'Brunei Dollar',
                'symbol' => '$',
                'code' => 'BND',
                'country_code' => 'BN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'BOV Boliviano Mvdol',
                'symbol' => '$b',
                'code' => 'BOB',
                'country_code' => 'BO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Brazilian Real',
                'symbol' => 'R$',
                'code' => 'BRL',
                'country_code' => 'BR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bahamian Dollar',
                'symbol' => '$',
                'code' => 'BSD',
                'country_code' => 'BS',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pula',
                'symbol' => 'P',
                'code' => 'BWP',
                'country_code' => 'BW',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Belarussian Ruble',
                'symbol' => '₽',
                'code' => 'BYR',
                'country_code' => 'BY',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Belize Dollar',
                'symbol' => 'BZ$',
                'code' => 'BZD',
                'country_code' => 'BZ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Canadian Dollar',
                'symbol' => '$',
                'code' => 'CAD',
                'country_code' => 'CA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Swiss Franc',
                'symbol' => 'CHF',
                'code' => 'CHF',
                'country_code' => 'CH',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'CLF Chilean Peso Unidades de fomento',
                'symbol' => '$',
                'code' => 'CLP',
                'country_code' => 'CL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yuan Renminbi',
                'symbol' => '¥',
                'code' => 'CNY',
                'country_code' => 'CN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'COU Colombian Peso Unidad de Valor Real',
                'symbol' => '$',
                'code' => 'COP',
                'country_code' => 'CO',
                'created_at' => now(),
                'updated_at' => now()],
            [
                'name' => 'Costa Rican Colon',
                'symbol' => '₡', 'created_at' => now(),
                'code' => 'CRC',
                'country_code' => 'CR',
                'updated_at' => now()
            ],
            [
                'name' => 'CUC Cuban Peso Peso Convertible',
                'symbol' => '₱',
                'code' => 'CUP',
                'country_code' => 'CU',
                'created_at' => now(),
                'updated_at' => now()],
            [
                'name' => 'Czech Koruna',
                'symbol' => 'Kč',
                'code' => 'CZK',
                'country_code' => 'CZ',
                'created_at' => now(),
                'updated_at' => now()],
            [
                'name' => 'Danish Krone',
                'symbol' => 'kr',
                'code' => 'DKK',
                'country_code' => 'DK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dominican Peso',
                'symbol' => 'RD$',
                'code' => 'DOP',
                'country_code' => 'DO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Egyptian Pound',
                'symbol' => '£',
                'code' => 'EGP',
                'country_code' => 'EG',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Euro',
                'symbol' => '€',
                'code' => 'EUR',
                'country_code' => 'EU',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Fiji Dollar',
                'symbol' => '$',
                'code' => 'FJD',
                'country_code' => 'FJ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Falkland Islands Pound',
                'symbol' => '£',
                'code' => 'FKP',
                'country_code' => 'FK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pound Sterling',
                'symbol' => '£',
                'code' => 'GBP',
                'country_code' => 'GB',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Gibraltar Pound',
                'symbol' => '£',
                'code' => 'GIP',
                'country_code' => 'GI',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Quetzal',
                'symbol' => 'Q',
                'code' => 'GTQ',
                'country_code' => 'GT',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Guyana Dollar',
                'symbol' => '$',
                'code' => 'GYD',
                'country_code' => 'GY',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Hong Kong Dollar',
                'symbol' => '$',
                'code' => 'HKD',
                'country_code' => 'HK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lempira',
                'symbol' => 'L',
                'code' => 'HNL',
                'country_code' => 'HN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Croatian Kuna',
                'symbol' => 'kn',
                'code' => 'HRK',
                'country_code' => 'HR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Forint',
                'symbol' => 'Ft',
                'code' => 'HUF',
                'country_code' => 'HU',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Rupiah',
                'symbol' => 'Rp',
                'code' => 'IDR',
                'country_code' => 'ID',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'New Israeli Sheqel',
                'symbol' => '₪',
                'code' => 'ILS',
                'country_code' => 'IL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Iranian Rial',
                'symbol' => '﷼',
                'code' => 'IRR',
                'country_code' => 'IR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Iceland Krona',
                'symbol' => 'kr',
                'code' => 'ISK',
                'country_code' => 'IS',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jamaican Dollar',
                'symbol' => 'J$',
                'code' => 'JMD',
                'country_code' => 'JM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yen',
                'symbol' => '¥',
                'code' => 'JPY',
                'country_code' => 'JP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Som',
                'symbol' => 'лв',
                'code' => 'KGS',
                'country_code' => 'KG',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Riel',
                'symbol' => '៛',
                'code' => 'KHR',
                'country_code' => 'KH',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'North Korean Won',
                'symbol' => '₩',
                'code' => 'KPW',
                'country_code' => 'KP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Won',
                'symbol' => '₩',
                'code' => 'KRW',
                'country_code' => 'KR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cayman Islands Dollar',
                'symbol' => '$',
                'code' => 'KYD',
                'country_code' => 'KY',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tenge',
                'symbol' => 'лв',
                'code' => 'KZT',
                'country_code' => 'KZ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kip',
                'symbol' => '₭',
                'code' => 'LAK',
                'country_code' => 'LA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lebanese Pound',
                'symbol' => '£',
                'code' => 'LBP',
                'country_code' => 'LB',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sri Lanka Rupee',
                'symbol' => '₨',
                'code' => 'LKR',
                'country_code' => 'LK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Liberian Dollar',
                'symbol' => '$',
                'code' => 'LRD',
                'country_code' => 'LR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lithuanian Litas',
                'symbol' => 'Lt',
                'code' => 'LTL',
                'country_code' => 'LT',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Latvian Lats',
                'symbol' => 'Ls',
                'code' => 'LVL',
                'country_code' => 'LV',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Denar',
                'symbol' => 'ден',
                'code' => 'MKD',
                'country_code' => 'MK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tugrik',
                'symbol' => '₮',
                'code' => 'MNT',
                'country_code' => 'MN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mauritius Rupee',
                'symbol' => '₨',
                'code' => 'MUR',
                'country_code' => 'MU',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'MXV Mexican Peso Mexican Unidad de Inversion (UDI]',
                'symbol' => '$',
                'code' => 'MXN',
                'country_code' => 'MX',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Malaysian Ringgit',
                'symbol' => 'RM',
                'code' => 'MYR',
                'country_code' => 'MY',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Metical',
                'symbol' => 'MT',
                'code' => 'MZN',
                'country_code' => 'MZ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Naira',
                'symbol' => '₦',
                'code' => 'NGN',
                'country_code' => 'NG',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cordoba Oro',
                'symbol' => 'C$',
                'code' => 'NIO',
                'country_code' => 'NI',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Norwegian Krone',
                'symbol' => 'kr',
                'code' => 'NOK',
                'country_code' => 'NO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Nepalese Rupee',
                'symbol' => '₨',
                'code' => 'NPR',
                'country_code' => 'NP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'New Zealand Dollar',
                'symbol' => '$',
                'code' => 'NZD',
                'country_code' => 'NZ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Rial Omani',
                'symbol' => '﷼',
                'code' => 'OMR',
                'country_code' => 'OM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'USD Balboa US Dollar',
                'symbol' => 'B/.',
                'code' => 'PAB',
                'country_code' => 'PA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Nuevo Sol',
                'symbol' => 'S/.',
                'code' => 'PEN',
                'country_code' => 'PE',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Philippine Peso',
                'symbol' => 'Php',
                'code' => 'PHP',
                'country_code' => 'PH',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pakistan Rupee',
                'symbol' => '₨',
                'code' => 'PKR',
                'country_code' => 'PK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Zloty',
                'symbol' => 'zł',
                'code' => 'PLN',
                'country_code' => 'PL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Guarani',
                'symbol' => 'Gs',
                'code' => 'PYG',
                'country_code' => 'PY',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Qatari Rial',
                'symbol' => '﷼',
                'code' => 'QAR',
                'country_code' => 'QA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'New Leu',
                'symbol' => 'lei',
                'code' => 'RON',
                'country_code' => 'RO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Serbian Dinar',
                'symbol' => 'Дин.',
                'code' => 'RSD',
                'country_code' => 'RS',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Russian Ruble',
                'symbol' => 'руб',
                'code' => 'RUB',
                'country_code' => 'RU',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Saudi Riyal',
                'symbol' => '﷼',
                'code' => 'SAR',
                'country_code' => 'SA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Solomon Islands Dollar',
                'symbol' => '$',
                'code' => 'SBD',
                'country_code' => 'SB',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Seychelles Rupee',
                'symbol' => '₨',
                'code' => 'SCR',
                'country_code' => 'SC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Swedish Krona',
                'symbol' => 'kr',
                'code' => 'SEK',
                'country_code' => 'SE',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Singapore Dollar',
                'symbol' => '$',
                'code' => 'SGD',
                'country_code' => 'SG',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Saint Helena Pound',
                'symbol' => '£',
                'code' => 'SHP',
                'country_code' => 'SH',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Somali Shilling',
                'symbol' => 'S',
                'code' => 'SOS',
                'country_code' => 'SO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Surinam Dollar',
                'symbol' => '$',
                'code' => 'SRD',
                'country_code' => 'SR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'USD El Salvador Colon US Dollar',
                'symbol' => '$',
                'code' => 'SVC',
                'country_code' => 'SV',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Syrian Pound',
                'symbol' => '£',
                'code' => 'SYP',
                'country_code' => 'SY',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Baht',
                'symbol' => '฿',
                'code' => 'THB',
                'country_code' => 'TH',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Turkish Lira',
                'symbol' => 'TL',
                'code' => 'TRY',
                'country_code' => 'TR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Trinidad and Tobago Dollar',
                'symbol' => 'TT$',
                'code' => 'TTD',
                'country_code' => 'TT',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'New Taiwan Dollar',
                'symbol' => 'NT$',
                'code' => 'TWD',
                'country_code' => 'TW',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Hryvnia',
                'symbol' => '₴',
                'code' => 'UAH',
                'country_code' => 'UA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'US Dollar',
                'symbol' => '$',
                'code' => 'USD',
                'country_code' => 'US',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'UYI Uruguay Peso en Unidades Indexadas',
                'symbol' => '$U',
                'code' => 'UYU',
                'country_code' => 'UY',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Uzbekistan Sum',
                'symbol' => 'лв',
                'code' => 'UZS',
                'country_code' => 'UZ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bolivar Fuerte',
                'symbol' => 'Bs',
                'code' => 'VEF',
                'country_code' => 'VE',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dong',
                'symbol' => '₫',
                'code' => 'VND',
                'country_code' => 'VN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'East Caribbean Dollar',
                'symbol' => '$',
                'code' => 'XCD',
                'country_code' => 'XC',
                'created_at' => now(),
                'updated_at' => now()],
            [
                'name' => 'Yemeni Rial',
                'symbol' => '﷼',
                'code' => 'YER',
                'country_code' => 'YE',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Rand',
                'symbol' => 'R',
                'code' => 'ZAR',
                'country_code' => 'ZA',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];
        Currency::insert($currencies);
    }
}
// http://beta1.vicomma.com/privacy-policy