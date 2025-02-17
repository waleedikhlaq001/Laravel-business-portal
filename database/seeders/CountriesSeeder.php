<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'country_id' => 1,
                'sort' => 'AF',
                'name' => 'Afghanistan',
                'phone_code' => 93
            ],
            [
                'country_id' => 2,
                'sort' => 'AL',
                'name' => 'Albania',
                'phone_code' => 355
            ],
            [
                'country_id' => 3,
                'sort' => 'DZ',
                'name' => 'Algeria',
                'phone_code' => 213
            ],
            [
                'country_id' => 4,
                'sort' => 'AS',
                'name' => 'American Samoa',
                'phone_code' => 1684
            ],
            [
                'country_id' => 5,
                'sort' => 'AD',
                'name' => 'Andorra',
                'phone_code' => 376
            ],
            [
                'country_id' => 6,
                'sort' => 'AO',
                'name' => 'Angola',
                'phone_code' => 244
            ],
            [
                'country_id' => 7,
                'sort' => 'AI',
                'name' => 'Anguilla',
                'phone_code' => 1264
            ],
            [
                'country_id' => 8,
                'sort' => 'AQ',
                'name' => 'Antarctica',
                'phone_code' => 0
            ],
            [
                'country_id' => 9,
                'sort' => 'AG',
                'name' => 'Antigua And Barbuda',
                'phone_code' => 1268
            ],
            [
                'country_id' => 10,
                'sort' => 'AR',
                'name' => 'Argentina',
                'phone_code' => 54
            ],
            [
                'country_id' => 11,
                'sort' => 'AM',
                'name' => 'Armenia',
                'phone_code' => 374
            ],
            [
                'country_id' => 12,
                'sort' => 'AW',
                'name' => 'Aruba',
                'phone_code' => 297
            ],
            [
                'country_id' => 13,
                'sort' => 'AU',
                'name' => 'Australia',
                'phone_code' => 61
            ],
            [
                'country_id' => 14,
                'sort' => 'AT',
                'name' => 'Austria',
                'phone_code' => 43
            ],
            [
                'country_id' => 15,
                'sort' => 'AZ',
                'name' => 'Azerbaijan',
                'phone_code' => 994
            ],
            [
                'country_id' => 16,
                'sort' => 'BS',
                'name' => 'Bahamas The',
                'phone_code' => 1242
            ],
            [
                'country_id' => 17,
                'sort' => 'BH',
                'name' => 'Bahrain',
                'phone_code' => 973
            ],
            [
                'country_id' => 18,
                'sort' => 'BD',
                'name' => 'Bangladesh',
                'phone_code' => 880
            ],
            [
                'country_id' => 19,
                'sort' => 'BB',
                'name' => 'Barbados',
                'phone_code' => 1246
            ],
            [
                'country_id' => 20,
                'sort' => 'BY',
                'name' => 'Belarus',
                'phone_code' => 375
            ],
            [
                'country_id' => 21,
                'sort' => 'BE',
                'name' => 'Belgium',
                'phone_code' => 32
            ],
            [
                'country_id' => 22,
                'sort' => 'BZ',
                'name' => 'Belize',
                'phone_code' => 501
            ],
            [
                'country_id' => 23,
                'sort' => 'BJ',
                'name' => 'Benin',
                'phone_code' => 229
            ],
            [
                'country_id' => 24,
                'sort' => 'BM',
                'name' => 'Bermuda',
                'phone_code' => 1441
            ],
            [
                'country_id' => 25,
                'sort' => 'BT',
                'name' => 'Bhutan',
                'phone_code' => 975
            ],
            [
                'country_id' => 26,
                'sort' => 'BO',
                'name' => 'Bolivia',
                'phone_code' => 591
            ],
            [
                'country_id' => 27,
                'sort' => 'BA',
                'name' => 'Bosnia and Herzegovina',
                'phone_code' => 387
            ],
            [
                'country_id' => 28,
                'sort' => 'BW',
                'name' => 'Botswana',
                'phone_code' => 267
            ],
            [
                'country_id' => 29,
                'sort' => 'BV',
                'name' => 'Bouvet Island',
                'phone_code' => 0
            ],
            [
                'country_id' => 30,
                'sort' => 'BR',
                'name' => 'Brazil',
                'phone_code' => 55
            ],
            [
                'country_id' => 31,
                'sort' => 'IO',
                'name' => 'British Indian Ocean Territory',
                'phone_code' => 246
            ],
            [
                'country_id' => 32,
                'sort' => 'BN',
                'name' => 'Brunei',
                'phone_code' => 673
            ],
            [
                'country_id' => 33,
                'sort' => 'BG',
                'name' => 'Bulgaria',
                'phone_code' => 359
            ],
            [
                'country_id' => 34,
                'sort' => 'BF',
                'name' => 'Burkina Faso',
                'phone_code' => 226
            ],
            [
                'country_id' => 35,
                'sort' => 'BI',
                'name' => 'Burundi',
                'phone_code' => 257
            ],
            [
                'country_id' => 36,
                'sort' => 'KH',
                'name' => 'Cambodia',
                'phone_code' => 855
            ],
            [
                'country_id' => 37,
                'sort' => 'CM',
                'name' => 'Cameroon',
                'phone_code' => 237
            ],
            [
                'country_id' => 38,
                'sort' => 'CA',
                'name' => 'Canada',
                'phone_code' => 1
            ],
            [
                'country_id' => 39,
                'sort' => 'CV',
                'name' => 'Cape Verde',
                'phone_code' => 238
            ],
            [
                'country_id' => 40,
                'sort' => 'KY',
                'name' => 'Cayman Islands',
                'phone_code' => 1345
            ],
            [
                'country_id' => 41,
                'sort' => 'CF',
                'name' => 'Central African Republic',
                'phone_code' => 236
            ],
            [
                'country_id' => 42,
                'sort' => 'TD',
                'name' => 'Chad',
                'phone_code' => 235
            ],
            [
                'country_id' => 43,
                'sort' => 'CL',
                'name' => 'Chile',
                'phone_code' => 56
            ],
            [
                'country_id' => 44,
                'sort' => 'CN',
                'name' => 'China',
                'phone_code' => 86
            ],
            [
                'country_id' => 45,
                'sort' => 'CX',
                'name' => 'Christmas Island',
                'phone_code' => 61
            ],
            [
                'country_id' => 46,
                'sort' => 'CC',
                'name' => 'Cocos (Keeling) Islands',
                'phone_code' => 672
            ],
            [
                'country_id' => 47,
                'sort' => 'CO',
                'name' => 'Colombia',
                'phone_code' => 57
            ],
            [
                'country_id' => 48,
                'sort' => 'KM',
                'name' => 'Comoros',
                'phone_code' => 269
            ],
            [
                'country_id' => 49,
                'sort' => 'CG',
                'name' => 'Republic Of The Congo',
                'phone_code' => 242
            ],
            [
                'country_id' => 50,
                'sort' => 'CD',
                'name' => 'Democratic Republic Of The Congo',
                'phone_code' => 242
            ],
            [
                'country_id' => 51,
                'sort' => 'CK',
                'name' => 'Cook Islands',
                'phone_code' => 682
            ],
            [
                'country_id' => 52,
                'sort' => 'CR',
                'name' => 'Costa Rica',
                'phone_code' => 506
            ],
            [
                'country_id' => 53,
                'sort' => 'CI',
                'name' => 'Cote D Ivoire (Ivory Coast)',
                'phone_code' => 225
            ],
            [
                'country_id' => 54,
                'sort' => 'HR',
                'name' => 'Croatia (Hrvatska)',
                'phone_code' => 385
            ],
            [
                'country_id' => 55,
                'sort' => 'CU',
                'name' => 'Cuba',
                'phone_code' => 53
            ],
            [
                'country_id' => 56,
                'sort' => 'CY',
                'name' => 'Cyprus',
                'phone_code' => 357
            ],
            [
                'country_id' => 57,
                'sort' => 'CZ',
                'name' => 'Czech Republic',
                'phone_code' => 420
            ],
            [
                'country_id' => 58,
                'sort' => 'DK',
                'name' => 'Denmark',
                'phone_code' => 45
            ],
            [
                'country_id' => 59,
                'sort' => 'DJ',
                'name' => 'Djibouti',
                'phone_code' => 253
            ],
            [
                'country_id' => 60,
                'sort' => 'DM',
                'name' => 'Dominica',
                'phone_code' => 1767
            ],
            [
                'country_id' => 61,
                'sort' => 'DO',
                'name' => 'Dominican Republic',
                'phone_code' => 1809
            ],
            [
                'country_id' => 62,
                'sort' => 'TP',
                'name' => 'East Timor',
                'phone_code' => 670
            ],
            [
                'country_id' => 63,
                'sort' => 'EC',
                'name' => 'Ecuador',
                'phone_code' => 593
            ],
            [
                'country_id' => 64,
                'sort' => 'EG',
                'name' => 'Egypt',
                'phone_code' => 20
            ],
            [
                'country_id' => 65,
                'sort' => 'SV',
                'name' => 'El Salvador',
                'phone_code' => 503
            ],
            [
                'country_id' => 66,
                'sort' => 'GQ',
                'name' => 'Equatorial Guinea',
                'phone_code' => 240
            ],
            [
                'country_id' => 67,
                'sort' => 'ER',
                'name' => 'Eritrea',
                'phone_code' => 291
            ],
            [
                'country_id' => 68,
                'sort' => 'EE',
                'name' => 'Estonia',
                'phone_code' => 372
            ],
            [
                'country_id' => 69,
                'sort' => 'ET',
                'name' => 'Ethiopia',
                'phone_code' => 251
            ],
            [
                'country_id' => 70,
                'sort' => 'XA',
                'name' => 'External Territories of Australia',
                'phone_code' => 61
            ],
            [
                'country_id' => 71,
                'sort' => 'FK',
                'name' => 'Falkland Islands',
                'phone_code' => 500
            ],
            [
                'country_id' => 72,
                'sort' => 'FO',
                'name' => 'Faroe Islands',
                'phone_code' => 298
            ],
            [
                'country_id' => 73,
                'sort' => 'FJ',
                'name' => 'Fiji Islands',
                'phone_code' => 679
            ],
            [
                'country_id' => 74,
                'sort' => 'FI',
                'name' => 'Finland',
                'phone_code' => 358
            ],
            [
                'country_id' => 75,
                'sort' => 'FR',
                'name' => 'France',
                'phone_code' => 33
            ],
            [
                'country_id' => 76,
                'sort' => 'GF',
                'name' => 'French Guiana',
                'phone_code' => 594
            ],
            [
                'country_id' => 77,
                'sort' => 'PF',
                'name' => 'French Polynesia',
                'phone_code' => 689
            ],
            [
                'country_id' => 78,
                'sort' => 'TF',
                'name' => 'French Southern Territories',
                'phone_code' => 0
            ],
            [
                'country_id' => 79,
                'sort' => 'GA',
                'name' => 'Gabon',
                'phone_code' => 241
            ],
            [
                'country_id' => 80,
                'sort' => 'GM',
                'name' => 'Gambia The',
                'phone_code' => 220
            ],
            [
                'country_id' => 81,
                'sort' => 'GE',
                'name' => 'Georgia',
                'phone_code' => 995
            ],
            [
                'country_id' => 82,
                'sort' => 'DE',
                'name' => 'Germany',
                'phone_code' => 49
            ],
            [
                'country_id' => 83,
                'sort' => 'GH',
                'name' => 'Ghana',
                'phone_code' => 233
            ],
            [
                'country_id' => 84,
                'sort' => 'GI',
                'name' => 'Gibraltar',
                'phone_code' => 350
            ],
            [
                'country_id' => 85,
                'sort' => 'GR',
                'name' => 'Greece',
                'phone_code' => 30
            ],
            [
                'country_id' => 86,
                'sort' => 'GL',
                'name' => 'Greenland',
                'phone_code' => 299
            ],
            [
                'country_id' => 87,
                'sort' => 'GD',
                'name' => 'Grenada',
                'phone_code' => 1473
            ],
            [
                'country_id' => 88,
                'sort' => 'GP',
                'name' => 'Guadeloupe',
                'phone_code' => 590
            ],
            [
                'country_id' => 89,
                'sort' => 'GU',
                'name' => 'Guam',
                'phone_code' => 1671
            ],
            [
                'country_id' => 90,
                'sort' => 'GT',
                'name' => 'Guatemala',
                'phone_code' => 502
            ],
            [
                'country_id' => 91,
                'sort' => 'XU',
                'name' => 'Guernsey and Alderney',
                'phone_code' => 44
            ],
            [
                'country_id' => 92,
                'sort' => 'GN',
                'name' => 'Guinea',
                'phone_code' => 224
            ],
            [
                'country_id' => 93,
                'sort' => 'GW',
                'name' => 'Guinea-Bissau',
                'phone_code' => 245
            ],
            [
                'country_id' => 94,
                'sort' => 'GY',
                'name' => 'Guyana',
                'phone_code' => 592
            ],
            [
                'country_id' => 95,
                'sort' => 'HT',
                'name' => 'Haiti',
                'phone_code' => 509
            ],
            [
                'country_id' => 96,
                'sort' => 'HM',
                'name' => 'Heard and McDonald Islands',
                'phone_code' => 0
            ],
            [
                'country_id' => 97,
                'sort' => 'HN',
                'name' => 'Honduras',
                'phone_code' => 504
            ],
            [
                'country_id' => 98,
                'sort' => 'HK',
                'name' => 'Hong Kong S.A.R.',
                'phone_code' => 852
            ],
            [
                'country_id' => 99,
                'sort' => 'HU',
                'name' => 'Hungary',
                'phone_code' => 36
            ],
            [
                'country_id' => 100,
                'sort' => 'IS',
                'name' => 'Iceland',
                'phone_code' => 354
            ],
            [
                'country_id' => 101,
                'sort' => 'IN',
                'name' => 'India',
                'phone_code' => 91
            ],
            [
                'country_id' => 102,
                'sort' => 'country_id',
                'name' => 'Indonesia',
                'phone_code' => 62
            ],
            [
                'country_id' => 103,
                'sort' => 'IR',
                'name' => 'Iran',
                'phone_code' => 98
            ],
            [
                'country_id' => 104,
                'sort' => 'IQ',
                'name' => 'Iraq',
                'phone_code' => 964
            ],
            [
                'country_id' => 105,
                'sort' => 'IE',
                'name' => 'Ireland',
                'phone_code' => 353
            ],
            [
                'country_id' => 106,
                'sort' => 'IL',
                'name' => 'Israel',
                'phone_code' => 972
            ],
            [
                'country_id' => 107,
                'sort' => 'IT',
                'name' => 'Italy',
                'phone_code' => 39
            ],
            [
                'country_id' => 108,
                'sort' => 'JM',
                'name' => 'Jamaica',
                'phone_code' => 1876
            ],
            [
                'country_id' => 109,
                'sort' => 'JP',
                'name' => 'Japan',
                'phone_code' => 81
            ],
            [
                'country_id' => 110,
                'sort' => 'XJ',
                'name' => 'Jersey',
                'phone_code' => 44
            ],
            [
                'country_id' => 111,
                'sort' => 'JO',
                'name' => 'Jordan',
                'phone_code' => 962
            ],
            [
                'country_id' => 112,
                'sort' => 'KZ',
                'name' => 'Kazakhstan',
                'phone_code' => 7
            ],
            [
                'country_id' => 113,
                'sort' => 'KE',
                'name' => 'Kenya',
                'phone_code' => 254
            ],
            [
                'country_id' => 114,
                'sort' => 'KI',
                'name' => 'Kiribati',
                'phone_code' => 686
            ],
            [
                'country_id' => 115,
                'sort' => 'KP',
                'name' => 'Korea North',
                'phone_code' => 850
            ],
            [
                'country_id' => 116,
                'sort' => 'KR',
                'name' => 'Korea South',
                'phone_code' => 82
            ],
            [
                'country_id' => 117,
                'sort' => 'KW',
                'name' => 'Kuwait',
                'phone_code' => 965
            ],
            [
                'country_id' => 118,
                'sort' => 'KG',
                'name' => 'Kyrgyzstan',
                'phone_code' => 996
            ],
            [
                'country_id' => 119,
                'sort' => 'LA',
                'name' => 'Laos',
                'phone_code' => 856
            ],
            [
                'country_id' => 120,
                'sort' => 'LV',
                'name' => 'Latvia',
                'phone_code' => 371
            ],
            [
                'country_id' => 121,
                'sort' => 'LB',
                'name' => 'Lebanon',
                'phone_code' => 961
            ],
            [
                'country_id' => 122,
                'sort' => 'LS',
                'name' => 'Lesotho',
                'phone_code' => 266
            ],
            [
                'country_id' => 123,
                'sort' => 'LR',
                'name' => 'Liberia',
                'phone_code' => 231
            ],
            [
                'country_id' => 124,
                'sort' => 'LY',
                'name' => 'Libya',
                'phone_code' => 218
            ],
            [
                'country_id' => 125,
                'sort' => 'LI',
                'name' => 'Liechtenstein',
                'phone_code' => 423
            ],
            [
                'country_id' => 126,
                'sort' => 'LT',
                'name' => 'Lithuania',
                'phone_code' => 370
            ],
            [
                'country_id' => 127,
                'sort' => 'LU',
                'name' => 'Luxembourg',
                'phone_code' => 352
            ],
            [
                'country_id' => 128,
                'sort' => 'MO',
                'name' => 'Macau S.A.R.',
                'phone_code' => 853
            ],
            [
                'country_id' => 129,
                'sort' => 'MK',
                'name' => 'Macedonia',
                'phone_code' => 389
            ],
            [
                'country_id' => 130,
                'sort' => 'MG',
                'name' => 'Madagascar',
                'phone_code' => 261
            ],
            [
                'country_id' => 131,
                'sort' => 'MW',
                'name' => 'Malawi',
                'phone_code' => 265
            ],
            [
                'country_id' => 132,
                'sort' => 'MY',
                'name' => 'Malaysia',
                'phone_code' => 60
            ],
            [
                'country_id' => 133,
                'sort' => 'MV',
                'name' => 'Maldives',
                'phone_code' => 960
            ],
            [
                'country_id' => 134,
                'sort' => 'ML',
                'name' => 'Mali',
                'phone_code' => 223
            ],
            [
                'country_id' => 135,
                'sort' => 'MT',
                'name' => 'Malta',
                'phone_code' => 356
            ],
            [
                'country_id' => 136,
                'sort' => 'XM',
                'name' => 'Man (Isle of)',
                'phone_code' => 44
            ],
            [
                'country_id' => 137,
                'sort' => 'MH',
                'name' => 'Marshall Islands',
                'phone_code' => 692
            ],
            [
                'country_id' => 138,
                'sort' => 'MQ',
                'name' => 'Martinique',
                'phone_code' => 596
            ],
            [
                'country_id' => 139,
                'sort' => 'MR',
                'name' => 'Mauritania',
                'phone_code' => 222
            ],
            [
                'country_id' => 140,
                'sort' => 'MU',
                'name' => 'Mauritius',
                'phone_code' => 230
            ],
            [
                'country_id' => 141,
                'sort' => 'YT',
                'name' => 'Mayotte',
                'phone_code' => 269
            ],
            [
                'country_id' => 142,
                'sort' => 'MX',
                'name' => 'Mexico',
                'phone_code' => 52
            ],
            [
                'country_id' => 143,
                'sort' => 'FM',
                'name' => 'Micronesia',
                'phone_code' => 691
            ],
            [
                'country_id' => 144,
                'sort' => 'MD',
                'name' => 'Moldova',
                'phone_code' => 373
            ],
            [
                'country_id' => 145,
                'sort' => 'MC',
                'name' => 'Monaco',
                'phone_code' => 377
            ],
            [
                'country_id' => 146,
                'sort' => 'MN',
                'name' => 'Mongolia',
                'phone_code' => 976
            ],
            [
                'country_id' => 147,
                'sort' => 'MS',
                'name' => 'Montserrat',
                'phone_code' => 1664
            ],
            [
                'country_id' => 148,
                'sort' => 'MA',
                'name' => 'Morocco',
                'phone_code' => 212
            ],
            [
                'country_id' => 149,
                'sort' => 'MZ',
                'name' => 'Mozambique',
                'phone_code' => 258
            ],
            [
                'country_id' => 150,
                'sort' => 'MM',
                'name' => 'Myanmar',
                'phone_code' => 95
            ],
            [
                'country_id' => 151,
                'sort' => 'NA',
                'name' => 'Namibia',
                'phone_code' => 264
            ],
            [
                'country_id' => 152,
                'sort' => 'NR',
                'name' => 'Nauru',
                'phone_code' => 674
            ],
            [
                'country_id' => 153,
                'sort' => 'NP',
                'name' => 'Nepal',
                'phone_code' => 977
            ],
            [
                'country_id' => 154,
                'sort' => 'AN',
                'name' => 'Netherlands Antilles',
                'phone_code' => 599
            ],
            [
                'country_id' => 155,
                'sort' => 'NL',
                'name' => 'Netherlands The',
                'phone_code' => 31
            ],
            [
                'country_id' => 156,
                'sort' => 'NC',
                'name' => 'New Caledonia',
                'phone_code' => 687
            ],
            [
                'country_id' => 157,
                'sort' => 'NZ',
                'name' => 'New Zealand',
                'phone_code' => 64
            ],
            [
                'country_id' => 158,
                'sort' => 'NI',
                'name' => 'Nicaragua',
                'phone_code' => 505
            ],
            [
                'country_id' => 159,
                'sort' => 'NE',
                'name' => 'Niger',
                'phone_code' => 227
            ],
            [
                'country_id' => 160,
                'sort' => 'NG',
                'name' => 'Nigeria',
                'phone_code' => 234
            ],
            [
                'country_id' => 161,
                'sort' => 'NU',
                'name' => 'Niue',
                'phone_code' => 683
            ],
            [
                'country_id' => 162,
                'sort' => 'NF',
                'name' => 'Norfolk Island',
                'phone_code' => 672
            ],
            [
                'country_id' => 163,
                'sort' => 'MP',
                'name' => 'Northern Mariana Islands',
                'phone_code' => 1670
            ],
            [
                'country_id' => 164,
                'sort' => 'NO',
                'name' => 'Norway',
                'phone_code' => 47
            ],
            [
                'country_id' => 165,
                'sort' => 'OM',
                'name' => 'Oman',
                'phone_code' => 968
            ],
            [
                'country_id' => 166,
                'sort' => 'PK',
                'name' => 'Pakistan',
                'phone_code' => 92
            ],
            [
                'country_id' => 167,
                'sort' => 'PW',
                'name' => 'Palau',
                'phone_code' => 680
            ],
            [
                'country_id' => 168,
                'sort' => 'PS',
                'name' => 'Palestinian Territory Occupied',
                'phone_code' => 970
            ],
            [
                'country_id' => 169,
                'sort' => 'PA',
                'name' => 'Panama',
                'phone_code' => 507
            ],
            [
                'country_id' => 170,
                'sort' => 'PG',
                'name' => 'Papua new Guinea',
                'phone_code' => 675
            ],
            [
                'country_id' => 171,
                'sort' => 'PY',
                'name' => 'Paraguay',
                'phone_code' => 595
            ],
            [
                'country_id' => 172,
                'sort' => 'PE',
                'name' => 'Peru',
                'phone_code' => 51
            ],
            [
                'country_id' => 173,
                'sort' => 'PH',
                'name' => 'Philippines',
                'phone_code' => 63
            ],
            [
                'country_id' => 174,
                'sort' => 'PN',
                'name' => 'Pitcairn Island',
                'phone_code' => 0
            ],
            [
                'country_id' => 175,
                'sort' => 'PL',
                'name' => 'Poland',
                'phone_code' => 48
            ],
            [
                'country_id' => 176,
                'sort' => 'PT',
                'name' => 'Portugal',
                'phone_code' => 351
            ],
            [
                'country_id' => 177,
                'sort' => 'PR',
                'name' => 'Puerto Rico',
                'phone_code' => 1787
            ],
            [
                'country_id' => 178,
                'sort' => 'QA',
                'name' => 'Qatar',
                'phone_code' => 974
            ],
            [
                'country_id' => 179,
                'sort' => 'RE',
                'name' => 'Reunion',
                'phone_code' => 262
            ],
            [
                'country_id' => 180,
                'sort' => 'RO',
                'name' => 'Romania',
                'phone_code' => 40
            ],
            [
                'country_id' => 181,
                'sort' => 'RU',
                'name' => 'Russia',
                'phone_code' => 70
            ],
            [
                'country_id' => 182,
                'sort' => 'RW',
                'name' => 'Rwanda',
                'phone_code' => 250
            ],
            [
                'country_id' => 183,
                'sort' => 'SH',
                'name' => 'Saint Helena',
                'phone_code' => 290
            ],
            [
                'country_id' => 184,
                'sort' => 'KN',
                'name' => 'Saint Kitts And Nevis',
                'phone_code' => 1869
            ],
            [
                'country_id' => 185,
                'sort' => 'LC',
                'name' => 'Saint Lucia',
                'phone_code' => 1758
            ],
            [
                'country_id' => 186,
                'sort' => 'PM',
                'name' => 'Saint Pierre and Miquelon',
                'phone_code' => 508
            ],
            [
                'country_id' => 187,
                'sort' => 'VC',
                'name' => 'Saint Vincent And The Grenadines',
                'phone_code' => 1784
            ],
            [
                'country_id' => 188,
                'sort' => 'WS',
                'name' => 'Samoa',
                'phone_code' => 684
            ],
            [
                'country_id' => 189,
                'sort' => 'SM',
                'name' => 'San Marino',
                'phone_code' => 378
            ],
            [
                'country_id' => 190,
                'sort' => 'ST',
                'name' => 'Sao Tome and Principe',
                'phone_code' => 239
            ],
            [
                'country_id' => 191,
                'sort' => 'SA',
                'name' => 'Saudi Arabia',
                'phone_code' => 966
            ],
            [
                'country_id' => 192,
                'sort' => 'SN',
                'name' => 'Senegal',
                'phone_code' => 221
            ],
            [
                'country_id' => 193,
                'sort' => 'RS',
                'name' => 'Serbia',
                'phone_code' => 381
            ],
            [
                'country_id' => 194,
                'sort' => 'SC',
                'name' => 'Seychelles',
                'phone_code' => 248
            ],
            [
                'country_id' => 195,
                'sort' => 'SL',
                'name' => 'Sierra Leone',
                'phone_code' => 232
            ],
            [
                'country_id' => 196,
                'sort' => 'SG',
                'name' => 'Singapore',
                'phone_code' => 65
            ],
            [
                'country_id' => 197,
                'sort' => 'SK',
                'name' => 'Slovakia',
                'phone_code' => 421
            ],
            [
                'country_id' => 198,
                'sort' => 'SI',
                'name' => 'Slovenia',
                'phone_code' => 386
            ],
            [
                'country_id' => 199,
                'sort' => 'XG',
                'name' => 'Smaller Territories of the UK',
                'phone_code' => 44
            ],
            [
                'country_id' => 200,
                'sort' => 'SB',
                'name' => 'Solomon Islands',
                'phone_code' => 677
            ],
            [
                'country_id' => 201,
                'sort' => 'SO',
                'name' => 'Somalia',
                'phone_code' => 252
            ],
            [
                'country_id' => 202,
                'sort' => 'ZA',
                'name' => 'South Africa',
                'phone_code' => 27
            ],
            [
                'country_id' => 203,
                'sort' => 'GS',
                'name' => 'South Georgia',
                'phone_code' => 0
            ],
            [
                'country_id' => 204,
                'sort' => 'SS',
                'name' => 'South Sudan',
                'phone_code' => 211
            ],
            [
                'country_id' => 205,
                'sort' => 'ES',
                'name' => 'Spain',
                'phone_code' => 34
            ],
            [
                'country_id' => 206,
                'sort' => 'LK',
                'name' => 'Sri Lanka',
                'phone_code' => 94
            ],
            [
                'country_id' => 207,
                'sort' => 'SD',
                'name' => 'Sudan',
                'phone_code' => 249
            ],
            [
                'country_id' => 208,
                'sort' => 'SR',
                'name' => 'Suriname',
                'phone_code' => 597
            ],
            [
                'country_id' => 209,
                'sort' => 'SJ',
                'name' => 'Svalbard And Jan Mayen Islands',
                'phone_code' => 47
            ],
            [
                'country_id' => 210,
                'sort' => 'SZ',
                'name' => 'Swaziland',
                'phone_code' => 268
            ],
            [
                'country_id' => 211,
                'sort' => 'SE',
                'name' => 'Sweden',
                'phone_code' => 46
            ],
            [
                'country_id' => 212,
                'sort' => 'CH',
                'name' => 'Switzerland',
                'phone_code' => 41
            ],
            [
                'country_id' => 213,
                'sort' => 'SY',
                'name' => 'Syria',
                'phone_code' => 963
            ],
            [
                'country_id' => 214,
                'sort' => 'TW',
                'name' => 'Taiwan',
                'phone_code' => 886
            ],
            [
                'country_id' => 215,
                'sort' => 'TJ',
                'name' => 'Tajikistan',
                'phone_code' => 992
            ],
            [
                'country_id' => 216,
                'sort' => 'TZ',
                'name' => 'Tanzania',
                'phone_code' => 255
            ],
            [
                'country_id' => 217,
                'sort' => 'TH',
                'name' => 'Thailand',
                'phone_code' => 66
            ],
            [
                'country_id' => 218,
                'sort' => 'TG',
                'name' => 'Togo',
                'phone_code' => 228
            ],
            [
                'country_id' => 219,
                'sort' => 'TK',
                'name' => 'Tokelau',
                'phone_code' => 690
            ],
            [
                'country_id' => 220,
                'sort' => 'TO',
                'name' => 'Tonga',
                'phone_code' => 676
            ],
            [
                'country_id' => 221,
                'sort' => 'TT',
                'name' => 'Trincountry_idad And Tobago',
                'phone_code' => 1868
            ],
            [
                'country_id' => 222,
                'sort' => 'TN',
                'name' => 'Tunisia',
                'phone_code' => 216
            ],
            [
                'country_id' => 223,
                'sort' => 'TR',
                'name' => 'Turkey',
                'phone_code' => 90
            ],
            [
                'country_id' => 224,
                'sort' => 'TM',
                'name' => 'Turkmenistan',
                'phone_code' => 7370
            ],
            [
                'country_id' => 225,
                'sort' => 'TC',
                'name' => 'Turks And Caicos Islands',
                'phone_code' => 1649
            ],
            [
                'country_id' => 226,
                'sort' => 'TV',
                'name' => 'Tuvalu',
                'phone_code' => 688
            ],
            [
                'country_id' => 227,
                'sort' => 'UG',
                'name' => 'Uganda',
                'phone_code' => 256
            ],
            [
                'country_id' => 228,
                'sort' => 'UA',
                'name' => 'Ukraine',
                'phone_code' => 380
            ],
            [
                'country_id' => 229,
                'sort' => 'AE',
                'name' => 'United Arab Emirates',
                'phone_code' => 971
            ],
            [
                'country_id' => 230,
                'sort' => 'GB',
                'name' => 'United Kingdom',
                'phone_code' => 44
            ],
            [
                'country_id' => 231,
                'sort' => 'US',
                'name' => 'United States',
                'phone_code' => 1
            ],
            [
                'country_id' => 232,
                'sort' => 'UM',
                'name' => 'United States Minor Outlying Islands',
                'phone_code' => 1
            ],
            [
                'country_id' => 233,
                'sort' => 'UY',
                'name' => 'Uruguay',
                'phone_code' => 598
            ],
            [
                'country_id' => 234,
                'sort' => 'UZ',
                'name' => 'Uzbekistan',
                'phone_code' => 998
            ],
            [
                'country_id' => 235,
                'sort' => 'VU',
                'name' => 'Vanuatu',
                'phone_code' => 678
            ],
            [
                'country_id' => 236,
                'sort' => 'VA',
                'name' => 'Vatican City State (Holy See)',
                'phone_code' => 39
            ],
            [
                'country_id' => 237,
                'sort' => 'VE',
                'name' => 'Venezuela',
                'phone_code' => 58
            ],
            [
                'country_id' => 238,
                'sort' => 'VN',
                'name' => 'Vietnam',
                'phone_code' => 84
            ],
            [
                'country_id' => 239,
                'sort' => 'VG',
                'name' => 'Virgin Islands (British)',
                'phone_code' => 1284
            ],
            [
                'country_id' => 240,
                'sort' => 'VI',
                'name' => 'Virgin Islands (US)',
                'phone_code' => 1340
            ],
            [
                'country_id' => 241,
                'sort' => 'WF',
                'name' => 'Wallis And Futuna Islands',
                'phone_code' => 681
            ],
            [
                'country_id' => 242,
                'sort' => 'EH',
                'name' => 'Western Sahara',
                'phone_code' => 212
            ],
            [
                'country_id' => 243,
                'sort' => 'YE',
                'name' => 'Yemen',
                'phone_code' => 967
            ],
            [
                'country_id' => 244,
                'sort' => 'YU',
                'name' => 'Yugoslavia',
                'phone_code' => 38
            ],
            [
                'country_id' => 245,
                'sort' => 'ZM',
                'name' => 'Zambia',
                'phone_code' => 260
            ],
            [
                'country_id' => 246,
                'sort' => 'ZW',
                'name' => 'Zimbabwe',
                'phone_code' => 26
            ],
        ];
        Country::insert($countries);
    }
}
