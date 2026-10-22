import './bootstrap';

const products = [
        { id: 1, code: 'BRG001', barcode: '899123456001', name: 'Kunci Pas Ring 10 mm', price: 35000, stock: 40 },
        { id: 2, code: 'BRG002', barcode: '899123456002', name: 'Kunci Pas Ring 12 mm', price: 42000, stock: 50 },
        { id: 3, code: 'BRG003', barcode: '899123456003', name: 'Set Kunci L 9 pcs', price: 65000, stock: 35 },
        { id: 4, code: 'BRG004', barcode: '899123456004', name: 'Obeng Plus', price: 18000, stock: 20 },
        { id: 5, code: 'BRG005', barcode: '899123456005', name: 'Obeng Minus', price: 18000, stock: 25 },
        { id: 6, code: 'BRG006', barcode: '899123456006', name: 'Tang Kombinasi', price: 45000, stock: 30 },
        { id: 7, code: 'BRG007', barcode: '899123456007', name: 'Tang Potong', price: 40000, stock: 45 },
        { id: 8, code: 'BRG008', barcode: '899123456008', name: 'Tang Jepit', price: 35000, stock: 55 },
        { id: 9, code: 'BRG009', barcode: '899123456009', name: 'Kunci Inggris 8 inci', price: 85000, stock: 40 },
        { id: 10, code: 'BRG010', barcode: '899123456010', name: 'Kunci Busi 21 mm', price: 25000, stock: 38 },
        { id: 11, code: 'BRG011', barcode: '899123456011', name: 'Busi Standar', price: 28000, stock: 60 },
        { id: 12, code: 'BRG012', barcode: '899123456012', name: 'Oli Mesin 10W-40 0.8L', price: 65000, stock: 32 },
        { id: 13, code: 'BRG013', barcode: '899123456013', name: 'Oli Gardan', price: 18000, stock: 18 },
        { id: 14, code: 'BRG014', barcode: '899123456014', name: 'Kampas Rem Depan', price: 45000, stock: 22 },
        { id: 15, code: 'BRG015', barcode: '899123456015', name: 'Kampas Rem Belakang', price: 38000, stock: 36 },
        { id: 16, code: 'BRG016', barcode: '899123456016', name: 'Rantai Motor', price: 120000, stock: 24 },
        { id: 17, code: 'BRG017', barcode: '899123456017', name: 'Gear Set Motor', price: 180000, stock: 28 },
        { id: 18, code: 'BRG018', barcode: '899123456018', name: 'Ban Dalam 14 inci', price: 70000, stock: 34 },
        { id: 19, code: 'BRG019', barcode: '899123456019', name: 'Peralatan Tambal Ban', price: 18000, stock: 31 },
        { id: 20, code: 'BRG020', barcode: '899123456020', name: 'Pompa Angin Mini', price: 95000, stock: 27 },
        { id: 21, code: 'BRG021', barcode: '899123456021', name: 'Aki Motor 12V', price: 350000, stock: 29 },
        { id: 22, code: 'BRG022', barcode: '899123456022', name: 'Lampu LED Motor', price: 65000, stock: 26 },
        { id: 23, code: 'BRG023', barcode: '899123456023', name: 'Spion Motor Universal', price: 55000, stock: 21 },
        { id: 24, code: 'BRG024', barcode: '899123456024', name: 'Handle Grip Motor', price: 30000, stock: 70 },
        { id: 25, code: 'BRG025', barcode: '899123456025', name: 'Kabel Gas Motor', price: 25000, stock: 33 },
        { id: 26, code: 'BRG026', barcode: '899123456026', name: 'Kabel Rem Motor', price: 22000, stock: 68 },
        { id: 27, code: 'BRG027', barcode: '899123456027', name: 'Filter Udara Motor', price: 35000, stock: 18 },
        { id: 28, code: 'BRG028', barcode: '899123456028', name: 'Filter Oli Motor', price: 28000, stock: 42 },
        { id: 29, code: 'BRG029', barcode: '899123456029', name: 'Kampas Kopling', price: 120000, stock: 39 },
        { id: 30, code: 'BRG030', barcode: '899123456030', name: 'Per Kopling Motor', price: 45000, stock: 20 },
        { id: 31, code: 'BRG031', barcode: '899123456031', name: 'Bearing Roda Motor', price: 38000, stock: 25 },
        { id: 32, code: 'BRG032', barcode: '899123456032', name: 'Seal Shock Depan', price: 25000, stock: 30 },
        { id: 33, code: 'BRG033', barcode: '899123456033', name: 'Minyak Rem', price: 30000, stock: 23 },
        { id: 34, code: 'BRG034', barcode: '899123456034', name: 'Cairan Pendingin Radiator', price: 45000, stock: 36 },
        { id: 35, code: 'BRG035', barcode: '899123456035', name: 'Pembersih Rantai Motor', price: 40000, stock: 24 },
        { id: 36, code: 'BRG036', barcode: '899123456036', name: 'Pelumas Rantai Motor', price: 55000, stock: 28 },
        { id: 37, code: 'BRG037', barcode: '899123456037', name: 'Lap Microfiber', price: 18000, stock: 17 },
        { id: 38, code: 'BRG038', barcode: '899123456038', name: 'Sikat Rantai Motor', price: 22000, stock: 22 },
        { id: 39, code: 'BRG039', barcode: '899123456039', name: 'Toolkit Darurat Motor', price: 150000, stock: 19 },
        { id: 40, code: 'BRG040', barcode: '899123456040', name: 'Multimeter Digital', price: 95000, stock: 12 },
        { id: 41, code: 'BRG041', barcode: '899123456041', name: 'Sarung Tangan Mekanik', price: 60000, stock: 35 },
        { id: 42, code: 'BRG042', barcode: '899123456042', name: 'Jas Hujan Motor', price: 85000, stock: 14 },
        { id: 43, code: 'ALF-043', barcode: '899123456043', name: 'Cover Motor', price: 120000, stock: 8 },
        { id: 44, code: 'ALF-044', barcode: '899123456044', name: 'Busi Iridium', price: 75000, stock: 15 },
        { id: 45, code: 'ALF-045', barcode: '899123456045', name: 'Klakson Motor', price: 55000, stock: 10 },
        { id: 47, code: 'BRG047', barcode: '899123456047', name: 'Helm Full Face Grafis', price: 450000, stock: 8 },
        { id: 48, code: 'BRG048', barcode: '899123456048', name: 'Velg Racing Motor Set', price: 650000, stock: 8 },
    ];
    const customProductStorageKey = 'vitomart-custom-products';
    const appUrl = document.querySelector('meta[name="app-url"]')?.content || '';
    const productImageBase = document.querySelector('meta[name="product-image-base"]')?.content || '/images/products/motorcycle';
    const defaultProductImage = document.querySelector('meta[name="default-product-image"]')?.content || '/images/products/product-default.jpg';
    const productPhotos = {
        1: 'combination-wrench-photo.jpg',
        2: 'wrench-set-photo.jpg',
        3: 'hex-key-photo.jpg',
        4: 'screwdrivers-photo.jpg',
        5: 'flathead-screwdriver-photo.jpg',
        6: 'needle-pliers-photo.jpg',
        7: 'cutting-pliers-photo.jpg',
        11: 'spark-plug-photo.jpg',
        12: 'engine-oil.jpg',
        14: 'brake-pads-photo.jpg',
        16: 'rear-wheel-chain.jpg',
        17: 'sprockets-photo.jpg',
        21: 'battery-photo.jpg',
        23: 'motorcycle-mirror.jpg',
        27: 'air-filter-photo.jpg',
        35: 'chain-lubricant.jpg',
        39: 'tools.jpg',
        47: 'helmet-photo.jpg',
        48: 'motorcycle-rims.svg',
    };
    const productIllustrations = {
        1: ['wrench-10', '10 mm'],
        2: ['wrench-12', '12 mm'],
        3: ['hex-keys', '9 pcs'],
        4: ['screwdriver-plus', '+'],
        5: ['screwdriver-minus', '-'],
        6: ['pliers', 'kombinasi'],
        7: ['cutters', 'potong'],
        8: ['long-pliers', 'jepit'],
        9: ['adjustable-wrench', '8 in'],
        10: ['spark-socket', '21 mm'],
        13: ['oil-bottle', 'gardan'],
        15: ['brake-pad-rear', 'belakang'],
        18: ['inner-tube', '14 in'],
        19: ['patch-kit', 'tambal ban'],
        20: ['air-pump', 'mini'],
        22: ['headlight', 'LED'],
        24: ['grip', 'handle'],
        25: ['throttle-cable', 'gas'],
        26: ['brake-cable', 'rem'],
        28: ['oil-filter', 'oli'],
        29: ['clutch', 'kampas'],
        30: ['spring', 'kopling'],
        31: ['bearing', 'roda'],
        32: ['seal', 'shock'],
        33: ['fluid', 'minyak rem'],
        34: ['coolant', 'radiator'],
        36: ['spray', 'pelumas'],
        37: ['cloth', 'microfiber'],
        38: ['chain-brush', 'rantai'],
        40: ['multimeter', 'digital'],
        41: ['glove', 'mekanik'],
        42: ['rain-suit', 'jas hujan'],
        43: ['motorcycle-cover', 'cover'],
        44: ['iridium-plug', 'iridium'],
        45: ['horn', 'klakson'],
    };
    const productShapes = {
        'wrench-10': '<path d="M216 84h80v45h-25l-20-20-21 20h-14zM230 127h52v220h-52z" fill="#548b83"/><path d="m216 84-37-34 20-20 57 58M296 84l37-34-20-20-57 58" fill="none" stroke="#53696c" stroke-width="17" stroke-linecap="round" stroke-linejoin="round"/><path d="M237 147h38" stroke="#d5e1dc" stroke-width="8" stroke-linecap="round"/>',
        'wrench-12': '<path d="M174 167a65 65 0 0 0 83 82l95 95-36 36-95-95a65 65 0 0 0-82-83l43 43-42 42-43-43a65 65 0 0 0 77 82l91 91" fill="none" stroke="#53696c" stroke-width="28" stroke-linecap="round" stroke-linejoin="round"/><path d="M169 159l42 43-42 42-43-42a65 65 0 0 1 43-43Z" fill="#d95743"/>',
        'hex-keys': '<path d="M174 182v118h80M224 148v121h76M279 168v111h65M327 190v90h54" fill="none" stroke="#647d80" stroke-width="18" stroke-linecap="round" stroke-linejoin="round"/><circle cx="174" cy="182" r="12" fill="#d95743"/><circle cx="224" cy="148" r="12" fill="#d95743"/><circle cx="279" cy="168" r="12" fill="#d95743"/>',
        'screwdriver-plus': '<path d="M251 130h40v82l-19 22v124h-28V234l-19-22v-82h26Z" fill="#d95743"/><path d="M240 354h50v27h-50z" fill="#53696c"/><path d="M270 236v114" stroke="#d7e0dd" stroke-width="6"/><path d="M256 380v31M242 395h28" stroke="#d95743" stroke-width="9" stroke-linecap="round"/>',
        'screwdriver-minus': '<path d="M251 130h40v82l-19 22v124h-28V234l-19-22v-82h26Z" fill="#548b83"/><path d="M240 354h50v27h-50z" fill="#53696c"/><path d="M270 236v114" stroke="#d7e0dd" stroke-width="6"/><path d="M239 396h34" stroke="#548b83" stroke-width="10" stroke-linecap="round"/>',
        pliers: '<path d="M207 151 252 250 208 363M305 151 261 250 306 363" fill="none" stroke="#596f72" stroke-width="24" stroke-linecap="round" stroke-linejoin="round"/><circle cx="256" cy="250" r="25" fill="#d95743"/><path d="m207 151-27-43 59 30 17 58M305 151l27-43-59 30-17 58" fill="#98aaa7" stroke="#596f72" stroke-width="12" stroke-linejoin="round"/>',
        cutters: '<path d="m208 162 49 95-41 112M304 162l-49 95 41 112" fill="none" stroke="#53696c" stroke-width="25" stroke-linecap="round"/><path d="m208 162-51-53 89 27 21 80M304 162l51-53-89 27-21 80" fill="#d95743" stroke="#53696c" stroke-width="10" stroke-linejoin="round"/><circle cx="257" cy="256" r="21" fill="#e6b953"/>',
        'long-pliers': '<path d="m207 169 49 91-48 117M305 169l-49 91 48 117" fill="none" stroke="#53696c" stroke-width="20" stroke-linecap="round"/><path d="m207 169-16-93 60 107M305 169l16-93-60 107" fill="#a3b3b0" stroke="#53696c" stroke-width="11" stroke-linejoin="round"/><circle cx="256" cy="260" r="19" fill="#d95743"/>',
        'adjustable-wrench': '<path d="M168 145a74 74 0 0 0 87 91l105 105-42 42-105-105a74 74 0 0 0-82-88l47 47-43 43-47-47a74 74 0 0 0 80 86l100 100" fill="none" stroke="#586e71" stroke-width="28" stroke-linecap="round" stroke-linejoin="round"/><path d="m163 135 47 47-43 43-47-47a74 74 0 0 1 43-43Z" fill="#e3b84e"/>',
        'spark-socket': '<path d="M213 117h86v47h-14v67h-58v-67h-14z" fill="#687d7f"/><path d="M228 231h56v83h-56z" fill="#aebcba"/><path d="M239 314h34v45h-34zM245 359h22v39h-22z" fill="#53696c"/><path d="M244 134h24M236 249h40" stroke="#d9e2df" stroke-width="8" stroke-linecap="round"/>',
        'spark-plug': '<path d="M219 121a25 25 0 0 1 25-25h24a25 25 0 0 1 25 25v40h-74z" fill="#f2f4ef" stroke="#718381" stroke-width="8"/><path d="M214 162h84v91h-84z" fill="#eef1ed" stroke="#718381" stroke-width="8"/><path d="M214 185h84M214 207h84M214 229h84" stroke="#aebbb8" stroke-width="7"/><path d="M200 251h112v34H200z" fill="#d95743"/><path d="M217 285h78l-12 72h-54z" fill="#9baaa7"/><path d="M236 357h40v41h-40zM247 398h18v31h-18z" fill="#53696c"/><path d="M256 429v24h19" stroke="#e0af48" stroke-width="8" stroke-linecap="round"/>',
        'iridium-plug': '<path d="M222 118a23 23 0 0 1 23-23h22a23 23 0 0 1 23 23v39h-68z" fill="#53696c"/><path d="M214 157h84v94h-84z" fill="#d9e1dc" stroke="#738481" stroke-width="8"/><path d="M214 181h84M214 207h84M214 231h84" stroke="#91a19d" stroke-width="7"/><path d="M200 250h112v35H200z" fill="#8d6f99"/><path d="M217 285h78l-12 72h-54z" fill="#8b9996"/><path d="M234 357h44v43h-44z" fill="#e6bd55"/><path d="M246 400h20v31h-20z" fill="#53696c"/><path d="M256 431v22h23" stroke="#e6bd55" stroke-width="8" stroke-linecap="round"/>',
        'oil-bottle': '<path d="M233 111h47v42l25 25v177a25 25 0 0 1-25 25h-48a25 25 0 0 1-25-25V178l26-25z" fill="#4d7270"/><path d="M232 105h49v22h-49z" fill="#d95743"/><path d="M222 240h70v73h-70z" fill="#f3f2e8"/><path d="M238 260h38M238 278h38M238 296h25" stroke="#d95743" stroke-width="8" stroke-linecap="round"/>',
        'brake-pad-front': '<path d="M167 176h72v158h-72zM273 176h72v158h-72z" fill="#53696c"/><path d="M177 190h52v111h-52zM283 190h52v111h-52z" fill="#b96c48"/><path d="M174 322h59M280 322h59" stroke="#d4dedb" stroke-width="12" stroke-linecap="round"/><path d="M197 176v-22h42M315 176v-22h-42" stroke="#d95743" stroke-width="10" stroke-linejoin="round"/>',
        'brake-pad-rear': '<path d="M177 320a103 103 0 1 1 158 0l-38-35a54 54 0 1 0-82 0l-38 35Z" fill="#53696c"/><path d="M190 296a83 83 0 1 1 132 0l-23-22a53 53 0 1 0-86 0l-23 22Z" fill="#b96c48"/><circle cx="256" cy="248" r="21" fill="#d7e1dd"/><path d="M179 318h44M289 318h44" stroke="#d95743" stroke-width="12" stroke-linecap="round"/>',
        gear: '<circle cx="256" cy="256" r="118" fill="#788b89"/><circle cx="256" cy="256" r="88" fill="#eaf0ec"/><circle cx="256" cy="256" r="49" fill="#566c6f"/><circle cx="256" cy="256" r="20" fill="#eaf0ec"/><path d="M245 122h22v37h-22zM245 353h22v37h-22zM122 245h37v22h-37zM353 245h37v22h-37zM158 158l27 27-16 16-27-27zM343 343l27 27-16 16-27-27zM343 169l16-16 27 27-16 16zM142 343l27-27 16 16-27 27z" fill="#d95743"/>',
        'inner-tube': '<circle cx="256" cy="252" r="119" fill="none" stroke="#303d3f" stroke-width="43"/><circle cx="256" cy="252" r="74" fill="#eaf0ec"/><path d="M362 323l26 25-20 27-30-5" fill="none" stroke="#d95743" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"/>',
        'patch-kit': '<rect x="148" y="151" width="220" height="190" rx="18" fill="#53696c"/><rect x="164" y="169" width="188" height="150" rx="10" fill="#f3f2e8"/><path d="M207 133h102v37H207z" fill="#d95743"/><circle cx="216" cy="220" r="22" fill="#e1b44b"/><circle cx="279" cy="220" r="22" fill="#d95743"/><circle cx="242" cy="273" r="22" fill="#5e8d85"/><path d="M316 215v71" stroke="#53696c" stroke-width="12" stroke-linecap="round"/>',
        'air-pump': '<rect x="222" y="129" width="68" height="226" rx="16" fill="#657a7d"/><path d="M202 129h108v28H202zM211 355h90v24h-90z" fill="#d95743"/><path d="M256 105v-31M256 74h57M289 74v-24" stroke="#53696c" stroke-width="12" stroke-linecap="round"/><path d="M289 50v-17" stroke="#d95743" stroke-width="9" stroke-linecap="round"/><path d="M239 174h34M239 197h34M239 220h34M239 243h34" stroke="#afbfbc" stroke-width="7"/>',
        battery: '<rect x="152" y="153" width="208" height="205" rx="24" fill="#34484b"/><path d="M184 153v-35h48v35M280 153v-35h48v35" fill="#53696c"/><rect x="188" y="105" width="38" height="18" rx="5" fill="#d95743"/><rect x="284" y="105" width="38" height="18" rx="5" fill="#303d3f"/><rect x="180" y="195" width="152" height="111" rx="12" fill="#eaf0ec"/><text x="256" y="265" text-anchor="middle" font-size="47" font-weight="700" fill="#34484b">12V</text>',
        headlight: '<path d="M170 198h78l32-37h49l38 42v108l-38 42h-49l-32-37h-78z" fill="#52696c"/><path d="M329 173c40 12 66 44 66 84s-26 72-66 84V173Z" fill="#efc34f"/><path d="M340 196c23 13 37 34 37 61s-14 48-37 61V196Z" fill="#fff1bf"/><path d="M192 221v76M215 221v76" stroke="#b6c4c1" stroke-width="9"/>',
        grip: '<path d="M169 187h175a37 37 0 0 1 37 37v52a37 37 0 0 1-37 37H169z" fill="#34484b"/><path d="M188 199v102M210 196v108M232 196v108M254 196v108M276 196v108M298 196v108" stroke="#78908d" stroke-width="9"/><path d="M157 185h20v130h-20zM369 214h32v70h-32z" fill="#d95743"/>',
        'throttle-cable': '<path d="M166 319c0-126 46-161 102-161 58 0 65 74 91 103 17 19 36 24 60 24" fill="none" stroke="#53696c" stroke-width="16" stroke-linecap="round"/><path d="M154 301h48v52h-48z" fill="#d95743"/><path d="M395 267h37v37h-37z" fill="#e4b84e"/><path d="M238 171h44M319 212h35" stroke="#b8c6c3" stroke-width="8" stroke-linecap="round"/>',
        'brake-cable': '<path d="M169 175c102 8 62 183 171 187 35 1 50-25 50-54" fill="none" stroke="#53696c" stroke-width="17" stroke-linecap="round"/><path d="M151 153h53v43h-53z" fill="#548b83"/><path d="M369 300h42v42h-42z" fill="#d95743"/><path d="M178 175h33M328 354h37" stroke="#b8c6c3" stroke-width="8" stroke-linecap="round"/>',
        'air-filter': '<path d="M179 161h154l34 38v134l-34 38H179l-34-38V199z" fill="#d95743"/><path d="M193 191v151M216 185v164M239 185v164M262 185v164M285 185v164M308 191v151" stroke="#f4df9b" stroke-width="13"/><path d="M149 214h218M149 319h218" stroke="#53696c" stroke-width="9"/>',
        'oil-filter': '<path d="M202 137h108l24 29v159l-24 29H202l-24-29V166z" fill="#d95743"/><path d="M210 163v166M232 158v176M254 158v176M276 158v176M298 163v166" stroke="#f2f2e9" stroke-width="12"/><path d="M192 137h128M192 354h128" stroke="#53696c" stroke-width="12"/>',
        clutch: '<circle cx="256" cy="250" r="115" fill="#677c7f"/><circle cx="256" cy="250" r="83" fill="#d95743"/><circle cx="256" cy="250" r="54" fill="#eaf0ec"/><circle cx="256" cy="250" r="29" fill="#53696c"/><circle cx="256" cy="250" r="10" fill="#eaf0ec"/><path d="M256 135v34M256 331v34M141 250h34M337 250h34M174 168l24 24M314 308l24 24M338 168l-24 24M198 308l-24 24" stroke="#eaf0ec" stroke-width="12"/>',
        spring: '<path d="M177 151h158M177 362h158" stroke="#53696c" stroke-width="20" stroke-linecap="round"/><path d="M256 151l-72 26 144 27-144 27 144 27-144 27 144 27-72 50" fill="none" stroke="#d95743" stroke-width="18" stroke-linejoin="round"/>',
        bearing: '<circle cx="256" cy="250" r="116" fill="#677c7f"/><circle cx="256" cy="250" r="83" fill="#eaf0ec"/><circle cx="256" cy="250" r="47" fill="#53696c"/><circle cx="256" cy="250" r="22" fill="#eaf0ec"/><circle cx="256" cy="165" r="11" fill="#d95743"/><circle cx="316" cy="190" r="11" fill="#d95743"/><circle cx="341" cy="250" r="11" fill="#d95743"/><circle cx="316" cy="310" r="11" fill="#d95743"/><circle cx="256" cy="335" r="11" fill="#d95743"/><circle cx="196" cy="310" r="11" fill="#d95743"/><circle cx="171" cy="250" r="11" fill="#d95743"/><circle cx="196" cy="190" r="11" fill="#d95743"/>',
        seal: '<circle cx="256" cy="250" r="116" fill="#334649"/><circle cx="256" cy="250" r="78" fill="#eaf0ec"/><circle cx="256" cy="250" r="57" fill="#8c9d99"/><circle cx="256" cy="250" r="35" fill="#eaf0ec"/><path d="M162 213l28 11M350 213l-28 11M162 287l28-11M350 287l-28-11" stroke="#d95743" stroke-width="12" stroke-linecap="round"/>',
        fluid: '<path d="M218 116h70v45l25 24v158a24 24 0 0 1-24 24h-72a24 24 0 0 1-24-24V185l25-24z" fill="#e5bb4e"/><path d="M217 107h73v25h-73z" fill="#53696c"/><path d="M203 239h100v72H203z" fill="#f2f1e8"/><path d="M224 260h58M224 282h38" stroke="#d95743" stroke-width="8" stroke-linecap="round"/>',
        coolant: '<path d="M206 130h99v38l34 27v148a27 27 0 0 1-27 27h-112a27 27 0 0 1-27-27V195l33-27z" fill="#5d9384"/><path d="M206 119h99v28h-99z" fill="#d95743"/><path d="M190 244h132v77H190z" fill="#eaf0ec"/><path d="M213 267h85M213 289h60" stroke="#5d9384" stroke-width="9" stroke-linecap="round"/>',
        spray: '<path d="M222 150h93v212h-93z" fill="#568c80"/><path d="M234 117h70v33h-70z" fill="#d95743"/><path d="M252 97h68v20h-68zM304 100h53v12h-53" fill="#53696c"/><path d="M238 195h61v77h-61z" fill="#eaf0ec"/><path d="M253 219h31M253 241h31" stroke="#d95743" stroke-width="8" stroke-linecap="round"/>',
        cloth: '<path d="M146 202 300 139l66 167-155 64z" fill="#5c9290"/><path d="m146 202 89 104-24 64-89-111z" fill="#81aaa5"/><path d="m300 139 66 167-75-37-44-129z" fill="#3f7776"/><path d="m168 224 128-52M190 270l128-52M212 316l128-52" stroke="#cde0d9" stroke-width="8"/>',
        'chain-brush': '<path d="M172 171c92-74 177 21 96 76-69 47-33 100 67 74" fill="none" stroke="#53696c" stroke-width="18" stroke-linecap="round"/><path d="M160 169h74v65h-74z" fill="#d95743"/><path d="M152 157v-25M169 157v-25M186 157v-25M203 157v-25M220 157v-25" stroke="#53696c" stroke-width="7"/><path d="M331 306h68v35h-68z" fill="#e2b64d"/>',
        multimeter: '<path d="M194 109h124l31 34v213l-31 34H194l-31-34V143z" fill="#e4a940"/><rect x="191" y="151" width="130" height="76" rx="8" fill="#34484b"/><rect x="203" y="163" width="106" height="52" rx="5" fill="#d8e9d4"/><text x="256" y="198" text-anchor="middle" font-size="26" font-weight="700" fill="#45634f">12.6</text><circle cx="256" cy="285" r="39" fill="#53696c"/><circle cx="256" cy="285" r="22" fill="#eaf0ec"/><path d="m256 285 20-20" stroke="#d95743" stroke-width="7" stroke-linecap="round"/><path d="M220 359c0 29-36 31-55 51M292 359c0 29 36 31 55 51" fill="none" stroke="#53696c" stroke-width="8" stroke-linecap="round"/>',
        glove: '<path d="M191 359 169 260l5-90c1-17 25-18 27-1l7 55 7-113c1-19 28-18 28 1v104l10-133c2-19 29-16 28 3l-5 130 16-100c3-18 29-12 25 7l-16 117 25-65c8-17 31-6 23 12l-34 101-49 51-79 20Z" fill="#53696c"/><path d="m194 300 119-24" stroke="#d95743" stroke-width="13" stroke-linecap="round"/>',
        'rain-suit': '<path d="m199 115 57-25 57 25 50 77-44 23-23-39v146H216V176l-23 39-44-23z" fill="#e4b943" stroke="#957c34" stroke-width="9" stroke-linejoin="round"/><path d="M256 115v182M216 207h80" stroke="#f6e8b4" stroke-width="8"/><path d="M216 319h80l-10 67h-53z" fill="#34484b"/>',
        'motorcycle-cover': '<circle cx="173" cy="337" r="39" fill="#34484b"/><circle cx="338" cy="337" r="39" fill="#34484b"/><path d="M132 334c7-58 47-92 96-106l32-58 57 3 28 60c34 15 53 48 53 101l-28 20H151z" fill="#637d80" stroke="#405a5e" stroke-width="9"/><path d="m225 229-37 71h143l-29-71z" fill="#96aaa6"/><path d="M150 329c54 15 157 15 218 0" stroke="#d6e0dc" stroke-width="8"/>',
        horn: '<path d="M256 101c-66 0-111 50-111 114v112h222V215c0-64-45-114-111-114Z" fill="#53696c"/><circle cx="256" cy="218" r="82" fill="#e6ba50" stroke="#7c8d8b" stroke-width="12"/><circle cx="256" cy="218" r="48" fill="#f7e4a0"/><path d="M224 326v49h64v-49M224 375l-28 35M288 375l28 35" stroke="#53696c" stroke-width="14" stroke-linecap="round"/><path d="m156 157-34-19M356 157l34-19M143 216h-38M369 216h38" stroke="#d95743" stroke-width="8" stroke-linecap="round"/>',
    };

    function createProductIllustration(product, kind, detail) {
        const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><rect width="512" height="512" rx="36" fill="#edf3f0"/><ellipse cx="256" cy="407" rx="150" ry="22" fill="#d6e1dc"/><g>${productShapes[kind]}</g><rect x="150" y="420" width="212" height="38" rx="19" fill="#34484b"/><text x="256" y="446" text-anchor="middle" font-family="Arial,sans-serif" font-size="18" font-weight="700" fill="#fff">${escapeHtml(detail.toUpperCase())}</text></svg>`;
        return `data:image/svg+xml;charset=UTF-8,${encodeURIComponent(svg)}`;
    }

    function getProductImage(product) {
        const photo = product && productPhotos[Number(product.id)];
        if (photo) return `${productImageBase}/${photo}`;

        const illustration = product && productIllustrations[Number(product.id)];
        if (illustration) return createProductIllustration(product, illustration[0], illustration[1]);

        if (product && product.image) return product.image.startsWith('/') ? `${appUrl}${product.image}` : product.image;
        return defaultProductImage;
    }

    async function loadProductsFromServer() {
        try {
            const response = await fetch(`${appUrl}/products`, { headers: { Accept: 'application/json' } });
            if (!response.ok) return;
            const serverProducts = await response.json();
            serverProducts.forEach((product) => {
                const existing = products.find((item) => item.id === Number(product.id) || item.code === product.code || item.barcode === product.barcode);
                if (!existing) {
                    products.push({
                        id: Number(product.id),
                        code: product.code,
                        barcode: product.barcode || '',
                        name: product.name,
                        price: Number(product.price),
                        stock: Number(product.stock || 0),
                        image: product.image ? (product.image.startsWith('/') ? `${appUrl}${product.image}` : product.image) : defaultProductImage,
                    });
                }
            });
        } catch {
            // Keep fallback product catalog when the backend is unavailable.
        }
    }

    function isAllowedProductImage(image) {
        try {
            return ['http:', 'https:'].includes(new URL(image, window.location.origin).protocol);
        } catch {
            return false;
        }
    }

    function loadCustomProducts() {
        try {
            const savedProducts = JSON.parse(localStorage.getItem(customProductStorageKey) || '[]');
            if (!Array.isArray(savedProducts)) return [];
            return savedProducts.filter((product) => product && Number.isSafeInteger(product.id) && product.id > 0
                && typeof product.name === 'string' && product.name.trim()
                && typeof product.code === 'string' && typeof product.barcode === 'string'
                && Number.isFinite(product.price) && product.price > 0
                && typeof product.image === 'string' && isAllowedProductImage(product.image));
        } catch {
            return [];
        }
    }

    loadCustomProducts().forEach((product) => {
        if (!products.some((existing) => existing.id === product.id || existing.code === product.code || existing.barcode === product.barcode)) {
            products.push({ ...product, isManual: true });
        }
    });
    const savedCartStorageKey = 'vitomart-saved-cart';

    function loadSavedCart() {
        try {
            const items = JSON.parse(localStorage.getItem(savedCartStorageKey) || '[]');
            if (!Array.isArray(items)) return [];
            return items.filter((item) => item && Number.isSafeInteger(item.id) && item.id > 0
                && typeof item.name === 'string' && typeof item.code === 'string'
                && Number.isFinite(item.price) && item.price > 0
                && Number.isSafeInteger(item.qty) && item.qty > 0);
        } catch {
            return [];
        }
    }

    const cart = [];
    const savedCart = loadSavedCart();
    const searchInput = document.getElementById('searchProduct');
    const resultBox = document.getElementById('productResults');
    const rupiah = (value) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(value);
    const escapeHtml = (value) => String(value).replace(/[&<>"']/g, (character) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[character]);

    function newTransactionNumber() {
        const date = new Date();
        const stamp = [date.getFullYear(), String(date.getMonth() + 1).padStart(2, '0'), String(date.getDate()).padStart(2, '0')].join('');
        return `TRX-${stamp}-${String(Math.floor(Math.random() * 900) + 100)}`;
    }

    function handleProductImageErrors(container) {
        container.querySelectorAll('.product-photo, .saved-cart-photo').forEach((image) => {
            image.addEventListener('error', () => {
                if (image.dataset.fallbackApplied) {
                    image.removeAttribute('src');
                    return;
                }

                image.dataset.fallbackApplied = 'true';
                image.src = defaultProductImage;
            });
        });
    }

    function renderProductResults(matches) {
        resultBox.innerHTML = matches.length ? matches.map((product) => {
            const image = getProductImage(product);
            return `
            <button class="product-result" type="button" data-product-id="${product.id}" aria-label="Tambah ${escapeHtml(product.name)}, ${rupiah(product.price)}">
                <span class="product-art"><img class="product-photo" src="${escapeHtml(image)}" alt="${escapeHtml(product.name)}" loading="lazy" decoding="async"></span>
                <span class="product-info">
                    <span class="product-name">${escapeHtml(product.name)}</span>
                    <span class="product-code">${escapeHtml(product.code)}</span>
                    <span class="product-price">${rupiah(product.price)}</span>
                </span>
            </button>`;
        }).join('') : '<div class="product-empty">Produk tidak ditemukan</div>';
        handleProductImageErrors(resultBox);
        document.getElementById('productCount').textContent = `${matches.length} Produk`;
        resultBox.querySelectorAll('[data-product-id]').forEach((result) => {
            result.addEventListener('click', () => addToCart(Number(result.dataset.productId)));
        });
    }

    function showAllProducts() {
        renderProductResults(products);
    }

    function searchProducts() {
        const keyword = searchInput.value.trim().toLocaleLowerCase('id');
        if (!keyword) {
            showAllProducts();
            return;
        }
        const matches = products.filter((product) => [product.name, product.code, product.barcode].some((value) => value.toLocaleLowerCase('id').includes(keyword)));
        const exactBarcode = products.find((product) => product.barcode === keyword || product.code.toLocaleLowerCase('id') === keyword);
        if (exactBarcode && /^\d+$/.test(keyword)) {
            addToCart(exactBarcode.id);
            return;
        }
        renderProductResults(matches);
    }

    function addToCart(productId) {
        const product = products.find((item) => item.id === productId);
        if (!product) return;
        const existing = cart.find((item) => item.id === productId);
        if (existing) existing.qty += 1;
        else cart.push({ ...product, qty: 1 });
        searchInput.value = '';
        showAllProducts();
        renderCart();
        searchInput.focus();
    }

    function renderCart() {
        const body = document.getElementById('cartBody');
        if (!cart.length) {
            body.innerHTML = '<tr><td colspan="6" class="empty-cart">Keranjang masih kosong.<br>Pilih produk di katalog atau scan barcode.</td></tr>';
        } else {
            body.innerHTML = cart.map((item, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td><div class="cart-name">${escapeHtml(item.name)}</div><div class="cart-code">${escapeHtml(item.code)}</div></td>
                    <td class="text-right">${rupiah(item.price)}</td>
                    <td><div class="qty-control"><button type="button" aria-label="Kurangi ${escapeHtml(item.name)}" data-change="-1" data-id="${item.id}">−</button><input type="number" min="1" value="${item.qty}" aria-label="Jumlah ${escapeHtml(item.name)}" data-qty-id="${item.id}"><button type="button" aria-label="Tambah ${escapeHtml(item.name)}" data-change="1" data-id="${item.id}">+</button></div></td>
                    <td class="text-right"><strong>${rupiah(item.price * item.qty)}</strong></td>
                    <td class="text-center"><div class="cart-actions"><button class="save-item-button" type="button" data-save-id="${item.id}">Simpan</button><button class="remove-button" type="button" aria-label="Hapus ${escapeHtml(item.name)} dari checkout" data-remove-id="${item.id}">×</button></div></td>
                </tr>`).join('');
            body.querySelectorAll('[data-change]').forEach((button) => button.addEventListener('click', () => changeQty(Number(button.dataset.id), Number(button.dataset.change))));
            body.querySelectorAll('[data-qty-id]').forEach((input) => input.addEventListener('change', () => updateQty(Number(input.dataset.qtyId), input.value)));
            body.querySelectorAll('[data-remove-id]').forEach((button) => button.addEventListener('click', () => removeItem(Number(button.dataset.removeId))));
            body.querySelectorAll('[data-save-id]').forEach((button) => button.addEventListener('click', () => saveForLater(Number(button.dataset.saveId))));
        }
        calculateTotal();
    }

    function persistSavedCart() {
        try {
            localStorage.setItem(savedCartStorageKey, JSON.stringify(savedCart));
            return true;
        } catch {
            document.getElementById('savedCartList').setAttribute('data-error', 'Penyimpanan browser penuh. Produk belum disimpan.');
            return false;
        }
    }

    function renderSavedCart() {
        const list = document.getElementById('savedCartList');
        list.removeAttribute('data-error');
        document.getElementById('savedItemCount').textContent = `${savedCart.reduce((sum, item) => sum + item.qty, 0)} Produk`;
        if (!savedCart.length) {
            list.innerHTML = '<div class="saved-cart-empty">Belum ada produk yang disimpan.</div>';
            return;
        }
        list.innerHTML = savedCart.map((item) => {
            const image = getProductImage(item);
            return `<div class="saved-cart-item">
                <img class="saved-cart-photo" src="${escapeHtml(image)}" alt="${escapeHtml(item.name)}" loading="lazy">
                <div class="saved-cart-info"><strong>${escapeHtml(item.name)}</strong><span>${item.qty} × ${rupiah(item.price)} · ${rupiah(item.qty * item.price)}</span></div>
                <div class="saved-cart-actions"><button class="restore-saved-button" type="button" data-restore-id="${item.id}">Checkout</button><button class="remove-button" type="button" aria-label="Hapus ${escapeHtml(item.name)} dari simpan nanti" data-delete-saved-id="${item.id}">×</button></div>
            </div>`;
        }).join('');
        handleProductImageErrors(list);
        list.querySelectorAll('[data-restore-id]').forEach((button) => button.addEventListener('click', () => restoreSavedItem(Number(button.dataset.restoreId))));
        list.querySelectorAll('[data-delete-saved-id]').forEach((button) => button.addEventListener('click', () => deleteSavedItem(Number(button.dataset.deleteSavedId))));
    }

    function saveForLater(id) {
        const cartIndex = cart.findIndex((item) => item.id === id);
        if (cartIndex === -1) return;
        const item = cart[cartIndex];
        const savedItem = savedCart.find((entry) => entry.id === id);
        if (savedItem) savedItem.qty += item.qty;
        else savedCart.push({ ...item });
        if (!persistSavedCart()) {
            if (savedItem) savedItem.qty -= item.qty;
            else savedCart.pop();
            return;
        }
        cart.splice(cartIndex, 1);
        renderCart();
        renderSavedCart();
    }

    function restoreSavedItem(id) {
        const savedIndex = savedCart.findIndex((item) => item.id === id);
        if (savedIndex === -1) return;
        const item = savedCart[savedIndex];
        const cartItem = cart.find((entry) => entry.id === id);
        if (cartItem) cartItem.qty += item.qty;
        else cart.push({ ...item });
        savedCart.splice(savedIndex, 1);
        if (!persistSavedCart()) {
            if (cartItem) cartItem.qty -= item.qty;
            else cart.pop();
            savedCart.splice(savedIndex, 0, item);
            return;
        }
        renderCart();
        renderSavedCart();
    }

    function deleteSavedItem(id) {
        const savedIndex = savedCart.findIndex((item) => item.id === id);
        if (savedIndex === -1) return;
        const [item] = savedCart.splice(savedIndex, 1);
        if (!persistSavedCart()) {
            savedCart.splice(savedIndex, 0, item);
            return;
        }
        renderSavedCart();
    }

    function changeQty(id, amount) {
        const item = cart.find((entry) => entry.id === id);
        if (!item) return;
        item.qty += amount;
        if (item.qty <= 0) removeItem(id);
        else renderCart();
    }

    function updateQty(id, value) {
        const item = cart.find((entry) => entry.id === id);
        if (!item) return;
        item.qty = Math.max(1, Number.parseInt(value, 10) || 1);
        renderCart();
    }

    function removeItem(id) {
        const index = cart.findIndex((entry) => entry.id === id);
        if (index !== -1) cart.splice(index, 1);
        renderCart();
    }

    function getTotals() {
        const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
        const percent = Math.min(100, Math.max(0, Number(document.getElementById('discountPercent').value) || 0));
        const discount = subtotal * percent / 100 + Math.max(0, Number(document.getElementById('discountAmount').value) || 0);
        const tax = Math.max(0, Number(document.getElementById('tax').value) || 0);
        const fee = Math.max(0, Number(document.getElementById('otherFee').value) || 0);
        return { subtotal, grandTotal: Math.max(0, Math.round(subtotal - discount + tax + fee)), qty: cart.reduce((sum, item) => sum + item.qty, 0) };
    }

    function calculateTotal() {
        const totals = getTotals();
        document.getElementById('totalQty').textContent = totals.qty;
        document.getElementById('itemCount').textContent = `${totals.qty} Item`;
        document.getElementById('subtotal').textContent = rupiah(totals.subtotal);
        document.getElementById('grandTotal').textContent = rupiah(totals.grandTotal);
        calculateChange();
    }

    function calculateChange() {
        const total = getTotals().grandTotal;
        const isEwallet = document.querySelector('.payment-method button.active').textContent.trim() === 'E-Wallet';
        const paymentInput = document.getElementById('payment');
        const changeBox = document.getElementById('changeBox');
        document.getElementById('paymentLabel').textContent = isEwallet ? 'Total E-Wallet' : 'Uang Dibayar';
        paymentInput.readOnly = isEwallet;
        if (isEwallet) {
            paymentInput.value = total;
            changeBox.hidden = true;
            return;
        }
        changeBox.hidden = false;
        const payment = Math.max(0, Number(document.getElementById('payment').value) || 0);
        const difference = payment - total;
        changeBox.classList.toggle('short-payment', difference < 0 && payment > 0);
        document.getElementById('changeLabel').textContent = difference < 0 && payment > 0 ? 'UANG KURANG' : 'KEMBALIAN';
        document.getElementById('change').textContent = rupiah(Math.abs(difference));
    }

    function resetTransaction() {
        cart.splice(0, cart.length);
        ['payment', 'discountPercent', 'discountAmount', 'tax', 'otherFee', 'customerPhone'].forEach((id) => {
            const input = document.getElementById(id);
            input.value = id === 'customerPhone' ? '' : '0';
        });
        document.getElementById('customerType').selectedIndex = 0;
        document.querySelectorAll('.payment-method button').forEach((button) => button.classList.toggle('active', button.textContent.trim() === 'Tunai'));
        document.getElementById('ewalletPanel').hidden = true;
        document.getElementById('ewalletDialog').close();
        renderCart();
        document.getElementById('transactionNumber').textContent = newTransactionNumber();
    }

    function holdTransaction() {
        if (!cart.length) {
            alert('Tidak ada transaksi untuk ditahan.');
            return;
        }
        const held = JSON.parse(localStorage.getItem('kasir-held-transactions') || '[]');
        held.push({ number: document.getElementById('transactionNumber').textContent, items: cart.map((item) => ({ ...item })), customer: document.getElementById('customerType').value, createdAt: new Date().toISOString() });
        localStorage.setItem('kasir-held-transactions', JSON.stringify(held));
        alert('Transaksi disimpan di browser. Silakan lanjutkan dengan transaksi baru.');
        resetTransaction();
    }

    function cancelTransaction() {
        if (!cart.length && !Number(document.getElementById('payment').value)) return;
        if (!confirm('Batalkan transaksi ini?')) return;
        resetTransaction();
    }

    async function recordSale(method, paid) {
        const totals = getTotals();
        const response = await fetch(document.querySelector('.pos-shell').dataset.saleUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                transaction_number: document.getElementById('transactionNumber').textContent,
                payment_method: method,
                customer_type: document.getElementById('customerType').value,
                discount_percent: Number(document.getElementById('discountPercent').value) || 0,
                discount_amount: Number(document.getElementById('discountAmount').value) || 0,
                tax: Number(document.getElementById('tax').value) || 0,
                other_fee: Number(document.getElementById('otherFee').value) || 0,
                paid,
                items: cart.map(({ id, code, name, price, qty }) => ({ id, code, name, price, qty })),
            }),
        });
        const result = await response.json().catch(() => ({}));
        if (!response.ok) throw new Error(result.message || 'Penjualan gagal disimpan.');
        return result;
    }

    async function processPayment() {
        if (!cart.length) {
            alert('Keranjang masih kosong.');
            return;
        }
        const totals = getTotals();
        const method = document.querySelector('.payment-method button.active').textContent.trim();
        if (method === 'E-Wallet') {
            document.getElementById('dialogProvider').textContent = document.getElementById('ewalletProvider').value;
            document.getElementById('dialogAmount').textContent = rupiah(totals.grandTotal);
            document.getElementById('ewalletDialog').showModal();
            return;
        }
        const paid = Number(document.getElementById('payment').value) || 0;
        if (paid < totals.grandTotal) {
            document.getElementById('payment').focus();
            alert('Uang pembayaran masih kurang.');
            return;
        }
        const payButton = document.getElementById('payButton');
        payButton.disabled = true;
        const receiptWindow = window.open('about:blank', '_blank');
        try {
            const sale = await recordSale(method, paid);
            resetTransaction();
            if (receiptWindow) {
                receiptWindow.location.href = sale.receipt_url;
                receiptWindow.focus();
            } else {
                window.location.href = sale.receipt_url;
            }
        } catch (error) {
            receiptWindow?.close();
            alert(error.message || 'Penjualan belum tersimpan. Periksa koneksi lalu coba lagi.');
        } finally {
            payButton.disabled = false;
        }
    }

    async function initiateGatewayPayment(method, amount) {
        const response = await fetch('/payment/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                amount,
                order_id: document.getElementById('transactionNumber').textContent,
                customer_name: 'Customer',
                customer_email: 'customer@vitomart.local',
                customer_phone: document.getElementById('customerPhone').value || '',
                payment_method: method,
            }),
        });

        const result = await response.json().catch(() => ({}));
        if (!response.ok) throw new Error(result.message || 'Gateway pembayaran gagal diproses.');
        return result;
    }

    function completePayment(method, paid, isDemo = false) {
        const totals = getTotals();
        const receipt = document.getElementById('receipt');
        const demoNotice = isDemo ? '<p class="receipt-demo">SIMULASI - PEMBAYARAN TIDAK DIPROSES</p>' : '';
        receipt.innerHTML = `<h1>VITOMART</h1><p>Jl. Contoh No. 123 · Jember</p>${demoNotice}<div class="receipt-rule"></div><div class="receipt-row"><span>${escapeHtml(document.getElementById('transactionNumber').textContent)}</span><span>${new Date().toLocaleString('id-ID')}</span></div><div class="receipt-rule"></div>${cart.map((item) => `<div class="receipt-item"><div>${escapeHtml(item.name)} × ${item.qty}</div><div class="receipt-row"><span>${rupiah(item.price)} / item</span><strong>${rupiah(item.price * item.qty)}</strong></div></div>`).join('')}<div class="receipt-rule"></div><div class="receipt-row"><span>Subtotal</span><strong>${rupiah(totals.subtotal)}</strong></div><div class="receipt-row"><span>Total</span><strong>${rupiah(totals.grandTotal)}</strong></div><div class="receipt-row"><span>Bayar (${escapeHtml(method)})</span><strong>${rupiah(paid)}</strong></div>${isDemo ? '' : `<div class="receipt-row"><span>Kembalian</span><strong>${rupiah(paid - totals.grandTotal)}</strong></div>`}<div class="receipt-rule"></div><p>Terima kasih telah berbelanja</p>`;
        window.print();
    }

    document.getElementById('searchButton').addEventListener('click', searchProducts);
    searchInput.addEventListener('input', searchProducts);
    searchInput.addEventListener('focus', showAllProducts);
    document.getElementById('productForm').addEventListener('submit', (event) => {
        event.preventDefault();
        const name = document.getElementById('newProductName').value.trim();
        const price = Number(document.getElementById('newProductPrice').value);
        const id = Math.max(...products.map((product) => product.id), 0) + 1;
        const code = document.getElementById('newProductCode').value.trim() || `BRG${String(id).padStart(3, '0')}`;
        const barcode = document.getElementById('newProductBarcode').value.trim() || `899123456${String(id).padStart(3, '0')}`;
        const imageInput = document.getElementById('newProductImage').value.trim();
        const image = imageInput ? new URL(imageInput).href : defaultProductImage;
        const status = document.getElementById('productFormStatus');

        if (!Number.isFinite(price) || price <= 0) {
            status.textContent = 'Harga harus lebih dari Rp 0.';
            return;
        }
        if (products.some((product) => product.code.toLocaleLowerCase('id') === code.toLocaleLowerCase('id') || product.barcode === barcode)) {
            status.textContent = 'Kode produk atau barcode sudah digunakan.';
            return;
        }
        if (!name || (imageInput && !isAllowedProductImage(image))) {
            status.textContent = 'Periksa nama produk dan URL foto.';
            return;
        }

        const product = { id, code, barcode, name, price, image, isManual: true };
        const savedProducts = products.filter((item) => item.isManual).concat(product);
        try {
            localStorage.setItem(customProductStorageKey, JSON.stringify(savedProducts));
        } catch {
            status.textContent = 'Produk tidak tersimpan. Penyimpanan browser mungkin penuh.';
            return;
        }
        products.push(product);
        document.getElementById('productForm').reset();
        status.textContent = `${name} berhasil ditambahkan.`;
        searchInput.value = '';
        showAllProducts();
    });
    searchInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            const exact = products.find((product) => product.barcode === searchInput.value.trim() || product.code.toLocaleLowerCase('id') === searchInput.value.trim().toLocaleLowerCase('id'));
            if (exact) addToCart(exact.id);
            else searchProducts();
        }
        if (event.key === 'ArrowDown') resultBox.querySelector('.product-result[tabindex]')?.focus();
    });
    ['discountPercent', 'discountAmount', 'tax', 'otherFee'].forEach((id) => document.getElementById(id).addEventListener('input', calculateTotal));
    document.getElementById('payment').addEventListener('input', calculateChange);
    document.querySelectorAll('.payment-method button').forEach((button) => button.addEventListener('click', () => {
        const wasEwallet = document.querySelector('.payment-method button.active').textContent.trim() === 'E-Wallet';
        document.querySelectorAll('.payment-method button').forEach((option) => option.classList.remove('active'));
        button.classList.add('active');
        const isEwallet = button.textContent.trim() === 'E-Wallet';
        document.getElementById('ewalletPanel').hidden = !isEwallet;
        if (!isEwallet && wasEwallet) document.getElementById('payment').value = '';
        calculateChange();
    }));
    document.getElementById('cancelEwalletButton').addEventListener('click', () => document.getElementById('ewalletDialog').close());
    document.getElementById('confirmEwalletButton').addEventListener('click', async () => {
        const provider = document.getElementById('ewalletProvider').value;
        const total = getTotals().grandTotal;
        document.getElementById('ewalletDialog').close();
        const payButton = document.getElementById('payButton');
        payButton.disabled = true;

        try {
            const result = await initiateGatewayPayment(`E-Wallet ${provider}`, total);
            if (result && result.demo) {
                completePayment(`E-Wallet ${provider} (Demo)`, total, true);
                return;
            }

            if (result && result.token) {
                alert('Gateway Midtrans berhasil dibuat. Pembayaran akan dilanjutkan ke halaman Midtrans.');
                if (result.redirect_url) {
                    window.location.href = result.redirect_url;
                    return;
                }
            }

            completePayment(`E-Wallet ${provider}`, total, false);
        } catch (error) {
            alert(error.message || 'Pembayaran e-wallet gagal diproses.');
        } finally {
            payButton.disabled = false;
        }
    });
    document.getElementById('holdButton').addEventListener('click', holdTransaction);
    document.getElementById('cancelButton').addEventListener('click', cancelTransaction);
    document.getElementById('payButton').addEventListener('click', processPayment);
    document.addEventListener('keydown', (event) => {
        if (event.key === 'F2') { event.preventDefault(); searchInput.focus(); }
        if (event.key === 'F4') { event.preventDefault(); document.getElementById('payment').focus(); }
        if (event.key === 'Escape') cancelTransaction();
    });
    window.addEventListener('afterprint', resetTransaction);
    document.getElementById('transactionNumber').textContent = newTransactionNumber();
    document.getElementById('currentDate').textContent = new Date().toLocaleString('id-ID');
    loadProductsFromServer().finally(() => {
        showAllProducts();
        renderCart();
        renderSavedCart();
    });
