
let base_url = 'http://localhost:8080' //untuk php spark serve
// let base_url = 'http://192.168.248.67:80/pariangan-master/public/'
let userPosition, userMarker, directionsRenderer, infoWindow, circle, map
let markerArray = []
let markerNearby
let geomArray = []
let geomParianganArray = []
// let geomSumbar = {"type":"Polygon","coordinates":[[[99.17835126627628,0.21076553534998096],[99.19483075846378,0.2876690989551999],[99.25800214518253,0.3343603042917253],[99.31293378580753,0.3371068391701154],[99.33765302408878,0.37006519548431277],[99.36511884440128,0.42774201782218885],[99.38434491862003,0.46619299551329973],[99.42554364908878,0.48816488960694554],[99.46399579752628,0.5183761261063307],[99.51343427408878,0.5403478444227927],[99.56561933268253,0.5101367119103833],[99.61780439127628,0.5321084591927038],[99.64527021158878,0.5540801282231124],[99.65900312174503,0.5128831844896459],[99.68097577799503,0.4771789513319652],[99.70569501627628,0.4634465038647417],[99.73316083658878,0.46070001115127035],[99.77435956705753,0.48816488960694554],[99.80457196940128,0.4826719226876505],[99.83203778971378,0.4634465038647417],[99.88147626627628,0.4634465038647417],[99.91718183268253,0.4799254375612143],[99.95014081705753,0.5046437632415437],[99.96936689127628,0.5513336739841367],[99.94190107096378,0.5897839151746955],[99.91443525065128,0.6282338907469042],[99.91992841471378,0.6721763725151011],[99.89795575846378,0.6941474667440013],[99.85675702799503,0.6804155446080657],[99.82929120768253,0.7380893457396961],[99.84851728190128,0.762806463541919],[99.84851728190128,0.8122402686458721],[99.84027753580753,0.8671660079944127],[99.86499677408878,0.9056135543506701],[99.91168866862003,0.8836435766881487],[99.94464765299503,0.8836435766881487],[99.97211347330753,0.8534346459009013],[100.00781903971378,0.836956946749794],[100.04166163819818,0.822294089926112],[100.08286036866693,0.7975773215905024],[100.12405909913568,0.786592043299371],[100.15976466554193,0.7728604048181134],[100.19821681397943,0.7453969954609254],[100.22842921632318,0.7453969954609254],[100.23392238038568,0.6959624312599788],[100.20096339601068,0.652020160308208],[100.17899073976068,0.5998382175068337],[100.18723048585443,0.555895141142692],[100.23392238038568,0.5531486877444006],[100.21744288819818,0.5146982095814882],[100.23666896241693,0.4872334393904186],[100.25040187257318,0.4432895768367459],[100.27237452882318,0.4075849953134454],[100.33279933351068,0.39385242105511425],[100.37399806397943,0.3828663453201355],[100.41245021241693,0.4158245286800313],[100.45639552491693,0.4075849953134454],[100.49210109132318,0.38561286558933466],[100.51132716554193,0.35265456568198195],[100.54153956788568,0.31694960944056294],[100.56900538819818,0.28673762669678016],[100.59097804444818,0.25927211843374814],[100.61295070069818,0.2400462268248845],[100.64316310304193,0.2070874938113757],[100.67062892335443,0.19060810092590866],[100.69534816163568,0.2208203081872855],[100.72830714601068,0.2400462268248845],[100.76126613038568,0.2318065505921842],[100.78873195069818,0.2537790094297502],[100.82718409913568,0.2427927844743159],[100.84091700929193,0.21258062103352732],[100.84641017335443,0.16863555278603873],[100.82718409913568,0.135676685084474],[100.79147853272943,0.1137040810014207],[100.77774562257318,0.06701224582538941],[100.79971827882318,0.04778618134461322],[100.82718409913568,0.06426566559675506],[100.84915675538568,0.04778618134461322],[100.84091700929193,0.009334038405846123],[100.82718409913568,-0.020878363434576323],[100.80521144288568,-0.04010443484060323],[100.76675929444818,-0.015385199649238823],[100.75302638429193,-0.045597597364723574],[100.76401271241693,-0.11426207722174396],[100.76675929444818,-0.17194011754620345],[100.76675929444818,-0.22137830135717695],[100.79422511476068,-0.24060421924080638],[100.82169093507318,-0.2790559715686685],[100.83542384522943,-0.3147610579894528],[100.86288966554193,-0.3394798932004689],[100.89584864991693,-0.3367333589910131],[100.94803370851068,-0.32025413770579647],[100.98099269288568,-0.32025413770579647],[101.00571193116693,-0.3257472144784986],[101.03592433351068,-0.3532125524202448],[101.03317775147943,-0.3999034372697171],[101.03867091554193,-0.43835455616692187],[101.04965724366693,-0.46307302943637485],[101.06339015382318,-0.49877733746030517],[101.09085597413568,-0.5070167661564395],[101.12106837647943,-0.512509712805856],[101.17600001710443,-0.5482137489496111],[101.20071925538568,-0.5921568843379268],[101.23917140382318,-0.616874746577318],[101.28037013429193,-0.6306068429500821],[101.31882228272943,-0.6388460834364097],[101.35178126710443,-0.671802911566065],[101.39847316163568,-0.7157450014158309],[101.44241847413568,-0.7651793479707208],[101.48636378663568,-0.7953889483468253],[101.55502833741693,-0.8283446235410695],[101.60995997804193,-0.831090917586625],[101.64291896241693,-0.8283446235410695],[101.68686427491693,-0.861300024670759],[101.71982325929193,-0.8887626417265604],[101.69235743897943,-0.9381948336040457],[101.76376857179193,-0.9738954288489048],[101.79672755616693,-0.9684030538463954],[101.84616603272943,-0.9766416129970217],[101.82215751043952,-0.9936071037258166],[101.8262773834864,-1.0354859124845315],[101.82009757391609,-1.0622606000479526],[101.8262773834864,-1.0945272224227236],[101.83520377508796,-1.1151227579577376],[101.85305655829109,-1.0986463409303457],[101.86678946844734,-1.1144362424134844],[101.87983573309577,-1.0890350556153032],[101.88532889715827,-1.1329721056197601],[101.85516462216826,-1.1695094839289095],[101.81602582822295,-1.2216831795159144],[101.79336652646514,-1.220996690004298],[101.7748270977542,-1.2402183297030627],[101.73706159482451,-1.2360994185891825],[101.72264203916045,-1.2429642668856247],[101.70897550174986,-1.2751624568961213],[101.69592923710142,-1.2902648725411674],[101.70828885624205,-1.3266475945752],[101.72408170292174,-1.3561652596277811],[101.70828885624205,-1.3801910006562708],[101.69944984663208,-1.3910797097494354],[101.69738991010864,-1.4010331142443946],[101.70768959272583,-1.4154483146659425],[101.71833259809692,-1.4181940569947735],[101.72382576215942,-1.4336387967151274],[101.71489937055786,-1.4449648730188995],[101.7004798148938,-1.4583501630772677],[101.69224006880005,-1.4724217924156988],[101.68123187628548,-1.4886742632157413],[101.67402209845345,-1.4975976238860143],[101.66990222540657,-1.5089233754626594],[101.6606325110511,-1.5154442360106122],[101.65067615118782,-1.5181898556355393],[101.64655627814095,-1.5253970905438263],[101.63351001349251,-1.5353498990372136],[101.62973346319954,-1.5446162652947109],[101.61840381232064,-1.5497642291029243],[101.60741748419564,-1.5586873367021608],[101.58711520881234,-1.5751606666105096],[101.57338229865609,-1.576876631009331],[101.56411258430062,-1.5854564317514939],[101.56170932502327,-1.5930066269950147],[101.54969302863655,-1.593349817031447],[101.54419986457405,-1.6019295493269408],[101.53168870062409,-1.621148018997795],[101.5213890180069,-1.6386503951967992],[101.50971604437409,-1.6588980512456108],[101.50628281683503,-1.674684215714933],[101.50113297552643,-1.6798318506061225],[101.48019028753815,-1.672625157970081],[101.47504044622956,-1.6781159738140257],[101.46165085882721,-1.6815477258912088],[101.44757462591706,-1.686008994568584],[101.4393348798233,-1.6980200516487771],[101.42972184271393,-1.6870385166584645],[101.43040848822174,-1.680175025783754],[101.41358567328034,-1.6719388049081658],[101.40328599066315,-1.6781159738140257],[101.400196085878,-1.687724864415698],[101.38749314398346,-1.6890975592033315],[101.38097001165924,-1.6849794719342053],[101.37582017035065,-1.6904702530211502],[101.36552048773346,-1.692872464866378],[101.35281754583893,-1.6925292919277806],[101.34320450872956,-1.6897839062335154],[101.33633805365143,-1.6870385166584645],[101.33290482611237,-1.692872464866378],[101.3294715985733,-1.6973337075356707],[101.31917191595612,-1.6973337075356707],[101.30990220160065,-1.7007654256629132],[101.2851829633194,-1.6969905353877592],[101.2741966351944,-1.6942451560131924],[101.2635536298233,-1.6963041909092451],[101.25325394720612,-1.7045403085533537],[101.24226761908112,-1.7124332215708713],[101.23196793646393,-1.7247872809785256],[101.22578812689362,-1.7186102612653105],[101.21651841253815,-1.7258167823164063],[101.20518876165924,-1.718953429552016],[101.1969490155655,-1.7117468825967652],[101.19660569281159,-1.6980200516487771],[101.19420243353424,-1.6818909007672473],[101.18836594671784,-1.6764000955164453],[101.18184281439362,-1.6976768796226809],[101.1756630048233,-1.7045403085533537],[101.1698265180069,-1.7114037130175588],[101.15746689886628,-1.7021381112056284],[101.14957047552643,-1.6914997727476115],[101.136524210878,-1.6849794719342053],[101.13240433783112,-1.68566582041761],[101.1317176923233,-1.6976768796226809],[101.13119782970203,-1.7273811407041968],[101.13119782970203,-1.741794088849101],[101.1298245386864,-1.7634133040586248],[101.14184083507313,-1.785032268125317],[101.14355744884266,-1.7973858479363167],[101.15420045421375,-1.8052783690928442],[101.15832032726063,-1.8351323770400259],[101.17582978770984,-1.8574367707868429],[101.17479981944813,-1.8694467125440504],[101.1627835230614,-1.8838585341450484],[101.1627835230614,-1.8951820246606763],[101.14973725841297,-1.905476042701448],[101.14184083507313,-1.9023878437347543],[101.14527406261219,-1.9185150438479295],[101.14321412608875,-1.9253776361495707],[101.1514538721825,-1.9329264557629005],[101.16347016856922,-1.9428771212204765],[101.17479981944813,-1.9517983576615452],[101.18990602062,-1.972385645345443],[101.20432557628406,-1.9795911359864373],[101.20947541759266,-2.012187010173168],[101.23453797862781,-2.056104629498284],[101.25925721690906,-2.0917868065222427],[101.27299012706531,-2.1494255258340673],[101.28122987315906,-2.218040206590779],[101.29770936534656,-2.297629242790935],[101.24552430675281,-2.319584064919846],[101.20432557628406,-2.366236926489696],[101.14664735362781,-2.388190673042275],[101.08622254894031,-2.4320971104668327],[101.02030458019031,-2.489722136866309],[100.64951600597156,-3.542933540567191],[99.70469178722156,-3.323601472749874],[98.71592225597156,-1.699241260981684],[98.01279725597156,-0.6228179906803741],[98.05674256847156,0.12423995854831663],[98.38633241222156,0.3219922672632508],[99.11143006847156,0.34396455232365475],[99.1781922989041,0.2156081482000307],[99.17835126627628,0.21076553534998096]]]}
let geomSumbar = {"type":"MultiPolygon","coordinates":[[[[99.16198,0.231812],[99.235527,0.327712],[99.297096,0.337691],[99.331474,0.362899],[99.407265,0.493468],[99.499702,0.538817],[99.587463,0.516625],[99.640007,0.547226],[99.670876,0.481021],[99.716553,0.454064],[99.765022,0.481917],[99.82309,0.461878],[99.908188,0.474805],[99.964767,0.554445],[99.919365,0.605901],[99.914688,0.680979],[99.845169,0.686254],[99.845215,0.83873],[99.835236,0.889678],[99.881943,0.90572],[99.957077,0.875112],[100.083336,0.791869],[100.183716,0.761895],[100.25573,0.709395],[100.205925,0.593234],[100.219559,0.524918],[100.282326,0.408069],[100.281677,0.332958],[100.361946,0.354324],[100.394623,0.339763],[100.43718,0.247852],[100.464088,0.222191],[100.605743,0.183473],[100.687881,0.177849],[100.727119,0.193165],[100.778122,0.169268],[100.792191,0.120829],[100.753342,0.048535],[100.770103,-0.033094],[100.748398,-0.065219],[100.781006,-0.23042],[100.838776,-0.290596],[100.833672,-0.318377],[100.910423,-0.370743],[100.94133,-0.312437],[100.996368,-0.314363],[101.031708,-0.340868],[101.024826,-0.398442],[101.06768,-0.498227],[101.181267,-0.549494],[101.256569,-0.626754],[101.359833,-0.659254],[101.407272,-0.736848],[101.500015,-0.807856],[101.595917,-0.8512],[101.6539,-0.935173],[101.747887,-0.967631],[101.821533,-0.977189],[101.830315,-1.10193],[101.878525,-1.110225],[101.858885,-1.158166],[101.815407,-1.209807],[101.709229,-1.237597],[101.689585,-1.295043],[101.719172,-1.344921],[101.691318,-1.397239],[101.720899,-1.42113],[101.694035,-1.480637],[101.567154,-1.572305],[101.526581,-1.616804],[101.492464,-1.681019],[101.431198,-1.696775],[101.415512,-1.671203],[101.319626,-1.693206],[101.258324,-1.693337],[101.21579,-1.714355],[101.18763,-1.677177],[101.125816,-1.679094],[101.124443,-1.78474],[101.144699,-1.917723],[101.194092,-1.989151],[101.243668,-2.021798],[101.291611,-2.133106],[101.306076,-2.23891],[101.294159,-2.280203],[101.244644,-2.344946],[101.155373,-2.390157],[101.027755,-2.482182],[100.992081,-2.431542],[100.897308,-2.337769],[100.877205,-2.247514],[100.831245,-2.188847],[100.82914,-2.147044],[100.869568,-2.104535],[100.884331,-2.042843],[100.858192,-1.919218],[100.78273,-1.819229],[100.684204,-1.661846],[100.64151,-1.618727],[100.633499,-1.562898],[100.555435,-1.403785],[100.576469,-1.376961],[100.544067,-1.308304],[100.492241,-1.299992],[100.458786,-1.26039],[100.402206,-1.268252],[100.417633,-1.200178],[100.382729,-1.178114],[100.410194,-1.037552],[100.364952,-0.995286],[100.342545,-0.882115],[100.269402,-0.782622],[100.117134,-0.631379],[100.080696,-0.549656],[99.971771,-0.443441],[99.918625,-0.404366],[99.886421,-0.349305],[99.820641,-0.306837],[99.806374,-0.245461],[99.750984,-0.153287],[99.765541,-0.065272],[99.735329,-0.027319],[99.610626,0.069696],[99.471992,0.134715],[99.394257,0.152445],[99.353981,0.230505],[99.312424,0.238678],[99.253555,0.211412],[99.16198,0.231812]],[[100.148926,-0.294198],[100.165466,-0.310519],[100.165375,-0.388144],[100.218018,-0.396025],[100.226418,-0.288869],[100.194832,-0.252879],[100.148926,-0.294198]],[[100.500008,-0.534535],[100.487389,-0.577913],[100.540764,-0.666713],[100.59713,-0.680994],[100.544914,-0.55475],[100.500008,-0.534535]]],[[[99.263031,-1.718946],[99.241554,-1.791817],[99.170258,-1.775342],[99.104195,-1.809051],[99.009583,-1.762335],[98.872444,-1.675564],[98.81971,-1.61324],[98.831772,-1.58409],[98.798141,-1.519863],[98.686104,-1.357201],[98.628815,-1.283929],[98.597008,-1.222869],[98.64505,-1.10431],[98.65641,-0.979386],[98.715179,-0.94198],[98.786461,-0.954942],[98.905327,-0.907312],[98.901535,-0.943195],[98.930374,-1.056429],[98.997421,-1.109993],[99.003639,-1.159117],[99.029007,-1.183758],[99.069817,-1.264657],[99.095047,-1.360714],[99.162605,-1.427637],[99.159073,-1.492668],[99.192131,-1.505583],[99.193535,-1.554393],[99.22258,-1.605247],[99.258133,-1.590373],[99.280853,-1.628746],[99.263031,-1.718946]]],[[[100.432472,-3.000107],[100.465523,-3.033659],[100.468422,-3.144241],[100.394447,-3.149384],[100.389984,-3.197419],[100.475174,-3.334633],[100.421425,-3.310643],[100.342789,-3.24575],[100.325836,-3.212034],[100.332291,-3.129642],[100.296883,-3.080192],[100.228333,-3.045524],[100.186508,-2.986326],[100.200531,-2.933076],[100.17469,-2.801497],[100.23597,-2.778423],[100.261101,-2.820208],[100.354225,-2.895449],[100.432472,-3.000107]]],[[[99.995766,-2.749434],[100.004059,-2.723478],[99.970131,-2.509001],[99.994774,-2.498358],[100.070412,-2.575727],[100.168579,-2.640264],[100.221405,-2.740431],[100.11644,-2.831824],[100.015343,-2.805559],[99.995766,-2.749434]]],[[[99.822586,-2.306719],[99.833534,-2.360941],[99.793526,-2.368245],[99.74221,-2.344413],[99.673538,-2.286497],[99.598953,-2.281999],[99.52739,-2.152481],[99.571342,-2.143682],[99.545197,-2.067696],[99.565895,-2.036215],[99.618942,-2.025629],[99.689621,-2.074452],[99.710625,-2.154402],[99.783386,-2.28467],[99.822586,-2.306719]]]]}
let geomNearby
let atData, evData, cpData, spData, wpData, fData, hData,detailData
let atUrl, evUrl, cpUrl, spUrl, wpUrl, fUrl, detailUrl,hUrl
let selectedShape, selectedMarker, drawingManager, dataLayer
let mapStyles = [{ featureType: "poi", elementType: "labels", stylers: [{ visibility: "off" }] }]

function initMap() {
    showMap() //show map , polygon, legend
    directionsRenderer = new google.maps.DirectionsRenderer(); //render route
    if (datas && url) { loopingAllMarker(datas, url) } // detail object
    mata_angin() // mata angin compas on map
    highlightCurrentManualLocation() //highligth when button location not clicked
    showUpcoming()//showing upcoming 
}
function showMap() {
    map = new google.maps.Map(document.getElementById("map"), { center: { lat: latPariangan, lng: lngPariangan }, zoom: 6.8, clickableIcons: false});
    addParianganPolygon(geomPariangan, '#ffffff')
    addParianganPolygon(geomSumbar, '#000000')
    // remove unecessary button when in mobile
    if (window.location.pathname.split('/').pop() == 'mobile'){
        map.setOptions({ mapTypeControl: false });
    }
}
function panTo(lat,lng){
    map.panTo(lat,lng)
}

//show atraction gallery when url is in home
function showUpcoming() {
    $('#panel').html(`<div class="card-header"><h5 class="card-title text-center">UNIQE ATRACTION</h5></div><div class="card-body">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class=""></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" class=""></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active"><img src="${base_url}/assets/images/dashboard-images/kuburan_panjang.jpg" onclick="showObject('atraction','01')" style="cursor: pointer;" width="100%"></div>
            <div class="carousel-item"><img src="${base_url}/assets/images/dashboard-images/masjid_islah.jpg" onclick="showObject('atraction','02')" style="cursor: pointer;" width="100%"></div>
            <div class="carousel-item"><img src="${base_url}/assets/images/dashboard-images/batulantak3.jpg" onclick="showObject('atraction','03')" style="cursor: pointer;" width="100%"></div>
        </div>
        <a class=" carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div></div>`)
}
//show info on map
function showInfoOnMap(data, url) {
    const objectMarker = new google.maps.Marker({
        position: { lat: parseFloat(data.lat), lng: parseFloat(data.lng) },
        icon: checkIcon(url),
        opacity: 0.8,
        title: "info marker",
        map: map,
    })
    markerArray.push(objectMarker)
    objectMarker.addListener('click', () => { openInfoWindow(objectMarker, infoMarkerData(data, url)) }) //open infowindow when click
    openInfoWindow(objectMarker, infoMarkerData(data, url))
}

function showSupportModal(data, url) {
    let id = data.id
    $.ajax({
        url: base_url + "/" + "list_object" + "/" + url + "/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            let no = 0
            let data = response.objectData[0]
            let gallery = response.galleryData
            // let menu = response.menuData
            // let product = response.productData
            $('#supportTitle').html(data.name)
            $('#supportData').html
                (`
                ${(() => { if (data.owner) { return `<tr><td class="fw-bold">owner </td><td>: ${data.owner}</td></tr>` } else { return '' } })()}
                ${(() => { if (data.category) { return `<tr><td class="fw-bold">category</td><td>: ${data.category}</td></tr>` } else { return '' } })()}
                ${(() => { if (data.employe) { return `<tr><td class="fw-bold">employe</td><td>: ${data.employe}</td></tr>` } else { return '' } })()}
                ${(() => { if (data.area_size) { return `<tr><td class="fw-bold">area size</td><td>: ${data.area_size} m<sup>2</sup></td></tr>` } else { return '' } })()}
                ${(() => { if (data.open) { return `<tr><td class="fw-bold">open</td><td>: ${data.open}</td></tr>` } else { return '' } })()}
                ${(() => { if (data.close) { return `<tr><td class="fw-bold">close</td><td>: ${data.close}</td></tr>` } else { return '' } })()}
                ${(() => { if (data.contact_person) { return `<tr><td class="fw-bold">contact</td><td>: ${data.contact_person}</td></tr>` } else { return '' } })()}
                ${(() => { if (data.building_size) { return `<tr><td class="fw-bold">Building</td><td>: ${data.building_size} m<sup>2</sup></td></tr>` } else { return '' } })()}
                ${(() => { if (data.capacity) { return `<tr><td class="fw-bold">capacity</td><td>: ${data.capacity}</td></tr>` } else { return '' } })()}
                ${(() => { if (data.description) { return `<tr><td class="fw-bold">description</td><td>: ${data.description}</td></tr>` } else { return '' } })()}
                `)
            if (gallery.length != 0) {
                $('#carouselSupportIndicator').html('')
                $('#carouselSupportInner').html('')
                for (i in gallery) {
                    $('#carouselSupportIndicator').append(`<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="${no}" class="${(() => { if (no == 0) { return `active` } else { return '' } })()}"></li>`)
                    $('#carouselSupportInner').append(`<div class="carousel-item ${(() => { if (no == 0) { return `active` } else { return '' } })()}"><img class="d-block w-100" src="${base_url}/media/photos/${gallery[i].url}" style="cursor: pointer;"></div>`)
                    no++
                }
            }
            else {
                $('#carouselSupportInner').html(`<div class="carousel-item text-center active">no photo found!</div>`)
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}
//loping all marker
function loopingAllMarker(datas, url) {
    showPanelList(datas, url) // show list panel
    for (let i = 0; i < datas.length; i++) { addMarkerToMap(datas[i], url) }
}
//user manual marker
function manualLocation() {
    Swal.fire({
        text: 'Select your position on map',
        icon: 'success',
        showClass: { popup: 'animate__animated animate__fadeInUp' },
        timer: 1200,
        confirmButtonText: 'Oke'
    })

    google.maps.event.addListener(map, "click", (event) => {
        clearSlider()
        clearRadius()
        clearRoute()
        addUserMarkerToMap(event.latLng)
    })
}

// add geom on map
function addMarkerGeom(geoJson, color = null, pass = null) {
    // Construct the polygon.
    const a = { type: 'Feature', geometry: geoJson }
    const geom = new google.maps.Data()
    geom.addGeoJson(a)
    geom.setStyle({
        fillColor: color,
        strokeWeight: 0.3,
        strokeColor: '#00b300',
        fillOpacity: 0.3,
        clickable: false
    })
    if (!pass) { geomArray.push(geom) }
    else { geomNearby = geom }
    geom.setMap(map)

}
// clear geom on map
function clearGeom(pass = null) {
    if (!pass) {
        for (i in geomArray) { geomArray[i].setMap(null) }
        geomArray = []
    }
}
// clear pariangan geom on map
function clearParianganGeom(pass = null) {
    if (geomParianganArray) {
        for (i in geomParianganArray) {
            geomParianganArray[i].setMap(null)
            geomParianganArray = null
        }
    }
}
// Construct the polygon.
function addParianganPolygon(geoJson, color, opacity) {
    const a = { type: 'Feature', geometry: geoJson }
    const geom = new google.maps.Data()
    geom.addGeoJson(a)
    geom.setStyle({
        fillColor: '#00b300',
        strokeWeight: 0.5,
        strokeColor: color,
        fillOpacity: 0.1,
        clickable: false
    })
    geomParianganArray.push(geom)
    geom.setMap(map)
}

// move camera
function moveCamera(z = 17) {
    map.moveCamera({ zoom: z })
}
// add callroute
function calcRoute(lat, lng) {
    let destinationCord = { lat: lat, lng: lng }
    let directionsService = new google.maps.DirectionsService();
    if (!userPosition) {
        Swal.fire({
            text: 'Please determine your position first!',
            icon: 'warning',
            showClass: {
                popup: 'animate__animated animate__fadeInUp'
            },
            timer: 1500,
            confirmButtonText: 'Oke'
        })
        return setTimeout(() => {
            $('#currentLocation').addClass('highligth')
            $('#manualLocation').addClass('highligth')
            setTimeout(() => {
                $('#currentLocation').removeClass('highligth')
                $('#manualLocation').removeClass('highligth')
            }, 1000)
        }, 1400)
    }
    var request = { origin: userPosition, destination: destinationCord, travelMode: 'WALKING' }

    directionsService.route(request, function (response, status) {
        if (status == 'OK') {
            directionsRenderer.setMap(map)
            directionsRenderer.setDirections(response)
        } else {
            return Swal.fire({
                text: 'Sorry, Cannot recognize your rute! :( ',
                icon: 'error',
                confirmButtonText: 'Oke'
            })
        }
    })
    //Show detail rute at element you want
    // display.setPanel(document.getElementById());
}
// clear route
function clearRoute() {
    if (directionsRenderer) { return directionsRenderer.setMap(null) }
}
//check object marker icon
function checkIcon(icon) {
    if (icon == 'pariangan') { return icon = { url: base_url + "/assets/images/marker-icon/focus.png" } }
    if (icon == 'atraction') { return icon = { url: base_url + "/assets/images/marker-icon/marker-atraction.png" } }
    if (icon == 'event') { return icon = { url: base_url + "/assets/images/marker-icon/marker_ev.png" } }
    if (icon == 'culinary_place') { return icon = { url: base_url + "/assets/images/marker-icon/marker_cp.png" } }
    if (icon == 'worship_place') { return icon = { url: base_url + "/assets/images/marker-icon/marker_wp.png" } }
    if (icon == 'souvenir_place') { return icon = { url: base_url + "/assets/images/marker-icon/marker_sp.png" } }
    if (icon == 'facility') { return icon = { url: base_url + "/assets/images/marker-icon/f.png" } }
}

function infoMarkerData(data, url) {
    let id = data.id
    let name = data.name
    let category = data.category
    let dateStart = data.date_start
    // let dateEnd = data.date_end
    let lat = data.lat
    let lng = data.lng
    let infoMarker

    if (window.location.pathname.split('/').pop() == 'mobile') {
        infoMarker = `<div class="text-center mb-1">${name}</div>${(() => { if (url == 'event') { return `<div class="text-center mb-1"><i class="fa fa-calendar"></i> ${dateStart}</div>` } else { return '' } })()}${(() => { if (url == 'atraction') { return `<div class="text-center mb-1">${category}</div>` } else { return '' } })()}<div class="col-md text-center" id="infoWindowDiv" >${(() => { if (url == 'event' || url == 'atraction') { return `<a role ="button" title ="route here" class="btn btn-outline-primary" onclick ="calcRoute(${lat},${lng})"> <i class ="fa fa-road"> </i></a>` } else { return '' } })()}</div>`
    } else {
        infoMarker = `<div class="text-center mb-1">${name}</div>${(() => { if (url == 'event') { return `<div class="text-center mb-1"><i class="fa fa-calendar"></i> ${dateStart}</div>` } else { return '' } })()}${(() => { if (url == 'atraction') { return `<div class="text-center mb-1">${category}</div>` } else { return '' } })()}<div class="col-md text-center" id="infoWindowDiv" >${(() => { if (url == 'event' || url == 'atraction') { return `<a role ="button" title ="route here" class="btn btn-outline-primary" onclick ="calcRoute(${lat},${lng})"> <i class ="fa fa-road"> </i></a > <a href="${base_url}/detail_object/${url}/${id}" target="_blank" role="button" class="btn btn-outline-primary" title="detail information"> <i class="fa fa-info"></i></a>` } else { return '' } })()} ${(() => { if (url == 'atraction' || url == 'event') { return `<a onclick = "setNearby(${JSON.stringify(data).split('"').join("&quot;")},${JSON.stringify(url).split('"').join("&quot;")})" target="_blank" role = "button" class="btn btn-outline-primary" title="object arround you"><i class="fa fa-compass"></i></a >` } else { return '' } })()} </div>`
    }
    return infoMarker
}

// show list panel
function showPanelList(datas, url) {
    $('#panel').css('max-height', '74vh')
    let listPanel = []
    // if object is empty
    if (datas.length == 0) { listPanel.push(`<tr colspan="3"><td></td><td class="text-center">object not found!</td><td></td></tr>`) }

    for (let i = 0; i < datas.length; i++) {
        let data = datas[i]
        let id = datas[i].id
        let name = datas[i].name
        let lat = datas[i].lat
        let lng = datas[i].lng
        listPanel.push(`<tr><td>${i + 1}</td><td>${name} ${(() => { if (url == 'event') { return `<br>${data.date_start}` } else { return '' } })()}</td><td class="text-center"><button title="info on map" onclick="showInfoOnMap(${JSON.stringify(data).split('"').join("&quot;")},${JSON.stringify(url).split('"').join("&quot;")})" class="btn btn-primary btn-sm"><i class="fa fa-info fa-xs"></i></button> <button title="route" onclick="calcRoute(${lat},${lng})" class="btn btn-primary btn-sm"><i class="fa fa-road fa-xs"></i></button>${(() => { if (url != 'atraction' && url != 'event') { return ` <button title="detail" onclick="showSupportModal(${JSON.stringify(data).split('"').join("&quot;")},${JSON.stringify(url).split('"').join("&quot;")})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#supportModal"><i class="fa fa-eye fa-xs"></i></button>` } else { return '' } })()}</td></tr>`)
    }
    listPanel = listPanel.join('')
    if (url == 'atraction') {
        $('#panel').html(`<div class="card-header"><h5 class="card-title text-center">Atraction</h5></div><div class="card-body"><table class="table table-border overflow-auto" width="100%"><thead><tr><th>#</th><th>Name</th><th class="text-center">Action</th></tr></thead><tbody id="tbody">${listPanel}</tbody></table></div>`)
    }
    if (url == 'event') {
        $('#panel').html(`<div class="card-header"><h5 class="card-title text-center">List event</h5></div><div class="card-body"><table class="table table-border overflow-auto" width="100%"><thead><tr><th>#</th><th>Name</th><th class="text-center">Action</th></tr></thead><tbody id="tbody">${listPanel}</tbody></table></div>`)
    }
    if (url == 'culinary_place') {
        $('#panel').append(`<div class="card-header"><h5 class="card-title text-center">List culinary place</h5></div><div class="card-body"><table class="table table-border overflow-auto shadow" width="100%"><thead><tr><th>#</th><th>Name</th><th class="text-center">Action</th></tr></thead><tbody id="tbody">${listPanel}</tbody></table></div>`)
    }
    if (url == 'souvenir_place') {
        $('#panel').append(`<div class="card-header"><h5 class="card-title text-center">List souvenir place</h5></div><div class="card-body"><table class="table table-border overflow-auto shadow" width="100%"><thead><tr><th>#</th><th>Name</th><th class="text-center">Action</th></tr></thead><tbody id="tbody">${listPanel}</tbody></table></div>`)
    }
    if (url == 'worship_place') {
        $('#panel').append(`<div class="card-header"><h5 class="card-title text-center">List worship place</h5></div><div class="card-body"><table class="table table-border overflow-auto shadow" width="100%"><thead><tr><th>#</th><th>Name</th><th class="text-center">Action</th></tr></thead><tbody id="tbody">${listPanel}</tbody></table></div>`)
    }
    if (url == 'facility') {
        $('#panel').append(`<div class="card-header"><h5 class="card-title text-center">List facility</h5></div><div class="card-body"><table class="table table-border overflow-auto shadow" width="100%"><thead><tr><th>#</th><th>Name</th><th class="text-center">Action</th></tr></thead><tbody id="tbody">${listPanel}</tbody></table></div>`)
    }
    if (url == 'homestay') {
        $('#panel').append(`<div class="card-header"><h5 class="card-title text-center">List homestay</h5></div><div class="card-body"><table class="table table-border overflow-auto shadow" width="100%"><thead><tr><th>#</th><th>Name</th><th class="text-center">Action</th></tr></thead><tbody id="tbody">${listPanel}</tbody></table></div>`)
    }
}

// add Object Marker on Map
function addMarkerToMap(data, url = null, pass = null) {
    let lat = parseFloat(data.lat)
    let lng = parseFloat(data.lng)
    let geoJSON, color
    let anim

    if(!pass){
        anim = google.maps.Animation.DROP
    }else{
        anim = null
    }
    const objectMarker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        icon: checkIcon(url),
        opacity: 0.8,
        title: "info object",
        animation: anim,
        map: map,
    })
    // add geom to map
    if (data.geoJSON) {
        geoJSON = JSON.parse(data.geoJSON)
        if (url == 'atraction') { color = '#C45A55' }
        if (url == 'event') { color = '#8EFFCD' }
        if (url == 'culinary_place') { color = '#FA786D' }
        if (url == 'souvenir_place') { color = '#ED90C4' }
        if (url == 'worship_place') { color = '#42CB6F' }
        if (url == 'facility') { color = '#3f76f2' }
        if (url == 'homestay') { color = '#3f76f2' }
    }
    if (!pass) {
        markerArray.push(objectMarker)
        addMarkerGeom(geoJSON, color)
    } else {
        markerNearby = objectMarker
        addMarkerGeom(geoJSON, color, 'pass')
    }
    objectMarker.addListener('click', () => {
        if (window.location.pathname.split('/').pop() == 'list_object') {
            openInfoWindow(objectMarker, infoMarkerData(data, url))
        } else if (window.location.pathname.split('/').pop() == 'mobile') {
            openInfoWindow(objectMarker, infoMarkerData(data, url))
        } else {
            openInfoWindow(objectMarker, data.name)
        }
    })

}
// clear object marker on map
function clearMarker(pass = null) {
    for (i in markerArray) { markerArray[i].setMap(null); }
    markerArray = []
    clearGeom()
    if (!pass) { clearMarkerNearby() }
}
function clearMarkerNearby() {
    if (markerNearby) {
        markerNearby.setMap(null)
        markerNearby = null
    }
    if (geomNearby) {
        geomNearby.setMap(null)
        geomNearby = null
    }
}

//open infowindow
function openInfoWindow(marker, content = "Info Window") {
    if (infoWindow != null) { infoWindow.close() }
    infoWindow = new google.maps.InfoWindow({ content: content })
    infoWindow.open({ anchor: marker, map, shouldFocus: false, })
}
//close infowindow
function clearInfoWindow() {
    if (infoWindow) { infoWindow.close() }
}
//CurrentLocation on Map
function currentLocation() {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition
            ((position) => {
                const pos = { lat: position.coords.latitude, lng: position.coords.longitude };
                clearRadius()
                clearRoute()
                addUserMarkerToMap(pos);
                userPosition = pos
                panTo(userPosition)
            }, () => { handleLocationError(true, currentWindow, map.getCenter()); }
            )
    } else { handleLocationError(false, currentWindow, map.getCenter()); } // Browser doesn't support Geolocation
}
//Browser doesn't support Geolocation
function handleLocationError(browserHasGeolocation, currentWindow, pos) {
    currentWindow.setPosition(pos);
    currentWindow.setContent(
        browserHasGeolocation ?
            "Error: The Geolocation service failed." :
            "Error: Your browser doesn't support geolocation."
    )
    currentWindow.open(map);
}
// Add user marker
function addUserMarkerToMap(location) {
    if (userMarker) {
        userPosition = location
        userMarker.setPosition(userPosition)
    } else {
        userPosition = location
        userMarker = new google.maps.Marker({
            position: userPosition,
            opacity: 0.8,
            title: "your location",
            animation: google.maps.Animation.DROP,
            draggable: false,
            map: map,
        });

        content = `Your Location <div class="text-center"></div>`
        userMarker.addListener('click', () => { openInfoWindow(userMarker, content) })
    }
}
// delete user marker
function clearUser() {
    if (userMarker) {
        userMarker.setMap(null)
        userMarker = null
    }
}

// fit zoom to radius
function boundToRadius(userPosition, rad) {
    let userBound = new google.maps.LatLng(userPosition);
    const radiusCircle = new google.maps.Circle({
        center: userBound,
        radius: Number(rad)
    });
    map.fitBounds(radiusCircle.getBounds());
}
//function radius 
function radius(radius = null) {
    if (circle) { circle.setMap(null) }
    circle = new google.maps.Circle({
        strokeColor: "#FF0000",
        strokeOpacity: 0.4,
        strokeWeight: 1.5,
        fillColor: "#FF0000",
        fillOpacity: 0.15,
        map: map,
        center: userPosition,
        radius: radius
    });
     boundToRadius(userPosition, radius);
}


function clearRadius() {
    if (circle) { return circle.setMap(null) }
}
function clearSlider() {
    $('#atSlider').val("0")
    $('#evSlider').val("0")
    $('#atSliderVal').html("0" + " m")
    $('#evSliderVal').html("0" + " m")
    $('#radiusSlider').val("0")
    $('#sliderVal').html("0" + " m")

}
function setMainSliderToZero() {
    $('#atSliderVal').html("0" + " m")
    $('#atSlider').val("0")
    $('#evSliderVal').html("0" + " m")
    $('#evSlider').val("0")
}
function mainNearby(val, object) {
    if (!userMarker) {
        Swal.fire({
            text: 'Please determine your position first!',
            icon: 'warning',
            showClass: {
                popup: 'animate__animated animate__fadeInUp'
            },
            timer: 1500,
            confirmButtonText: 'Oke'
        })
        return setMainSliderToZero()
    }
    hideObjectArroundPanel()
    let distance = parseInt(val)
    const url = "list_object/search_main_nearby"
    $.ajax({
        url: base_url + "/" + url + "/" + distance,
        method: "get",
        data: { main: object, lng: userPosition.lng, lat: userPosition.lat },
        dataType: "json",
        success: function (response) {
            if (response) {
                if (response.atData && response.atUrl) {
                    atData = response.atData
                    atUrl = response.atUrl
                    $('#atSliderVal').html(distance + " m")
                    radius(distance)
                    clearMarker()
                    clearRoute()
                    activeMenu('atraction')
                    return loopingAllMarker(atData, atUrl)
                }
                if (response.evData && response.evUrl) {
                    evData = response.evData
                    evUrl = response.evUrl
                    $('#evSliderVal').html(distance + " m")
                    radius(distance)
                    clearMarker()
                    clearRoute()
                    activeMenu('event')
                    return loopingAllMarker(evData, evUrl)
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}

function setSupportSliderToZero() {
    $('#sliderVal').html("0" + " m")
    $('#radiusSlider').val("0")
}
//function slidervalue
function supportNearby(val = null) {
    let distance = parseFloat(val)
    let cp = $("#cpCheck").prop('checked') == true
    let wp = $("#wpCheck").prop('checked') == true
    let sp = $("#spCheck").prop('checked') == true
    let f = $("#fCheck").prop('checked') == true
    let h = $("#hCheck").prop('checked') == true

    $('#panel').html('')
    clearRadius()
    clearRoute()
    clearMarker('pass')
    if (cp == false && wp == false && sp == false && f == false && h == false) {
        Swal.fire({
            position: 'top-end',
            text: 'Please check the box!',
            icon: 'warning',
            showClass: { popup: 'animate__animated animate__fadeInDown' },
            timer: 1200,
            confirmButtonText: 'Oke'
        })
        return setSupportSliderToZero()
    }
    const url = "list_object/search_support_nearby"
    $.ajax({
        url: base_url + "/" + url + "/" + distance,
        method: "get",
        data: {
            cp: cp,
            wp: wp,
            sp: sp,
            f: f,
            h:h,
            lng: userPosition.lng,
            lat: userPosition.lat
        },
        dataType: "json",
        success: function (response) {
            if (response) {
                // Add support marker
                if (response.cpData && response.cpUrl) {
                    cpData = response.cpData
                    cpUrl = response.cpUrl
                    loopingAllMarker(cpData, cpUrl)
                }
                if (response.spData && response.spUrl) {
                    spData = response.spData
                    spUrl = response.spUrl
                    loopingAllMarker(spData, spUrl)
                }
                if (response.wpData && response.wpUrl) {
                    wpData = response.wpData
                    wpUrl = response.wpUrl
                    loopingAllMarker(wpData, wpUrl)
                }
                if (response.fData && response.fUrl) {
                    fData = response.fData
                    fUrl = response.fUrl
                    loopingAllMarker(fData, fUrl)
                }
                if (response.hData && response.hUrl) {
                    hData = response.hData
                    hUrl = response.hUrl
                    loopingAllMarker(hData, hUrl)
                }
                radius(distance)
                let pos = new google.maps.LatLng(userPosition.lat,userPosition.lng);
                panTo(pos)
                $('#sliderVal').html(distance + " m");
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}
function setNearby(data, url) {
    userPosition = { lat: parseFloat(data.lat), lng: parseFloat(data.lng) }
    let pos = new google.maps.LatLng(parseFloat(data.lat),userPosition.lng);
    panTo(pos)
    setSupportSliderToZero()
    setMainSliderToZero()
    clearUser()
    clearRoute()
    clearMarker()
    clearRadius()
    showObjectArroundPanel()
    return addMarkerToMap(data, url, 'pass')
}
// add mata angin 
function mata_angin() {
    const legendIcon = `${base_url}/assets/images/marker-icon/`
    const centerControlDiv = document.createElement("div");
    centerControlDiv.style.marginLeft = "10px";
    centerControlDiv.style.marginBottom = "-10px";
    centerControlDiv.innerHTML = `<div class="mb-4"><img src="${legendIcon}mata_angin.png" width="25"></img><div>`
    map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(centerControlDiv);
}

//add legend to map
function legend() {
    const legendIcon = `${base_url}/assets/images/marker-icon/`
    $('#legendButton').empty()
    $('#legendButton').append('<a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hide Legend" class="btn icon btn-primary mx-1" id="legend-map" onclick="hideLegend()"><span class="material-symbols-outlined">visibility_off</span></a>');

    let legend = document.createElement('div')
    legend.id = 'legendPanel'
    let content = []
    content.push('<h6 class="text-center">Legend</h6>')
    content.push(`<p><img src="https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png" width="15"></img> User</p>`)
    content.push(`<p><img src="${legendIcon}marker-atraction.png" width="15"></img> Atraction</p>`)
    content.push(`<p><img src="${legendIcon}marker_ev.png" width="15"></img> Event</p>`)
    content.push(`<p><img src="${legendIcon}marker_cp.png" width="15"></img> Culinary place</p>`)
    content.push(`<p><img src="${legendIcon}marker_wp.png" width="15"></img> Worship place</p>`)
    content.push(`<p><img src="${legendIcon}marker_sp.png" width="15"></img> Souvenir place</p>`)
    content.push(`<p><img src="${legendIcon}f.png" width="15"></img> Facility</p>`)
    legend.innerHTML = content.join('')
    legend.index = 1
    map.controls[google.maps.ControlPosition.LEFT_TOP].push(legend)
}
//Hide legend
function hideLegend() {
    $('#legendPanel').remove()
    $('#legendButton').empty()
    $('#legendButton').append('<a data-bs-toggle="tooltip" data-bs-placement="bottom" title="show legend" class="btn icon btn-primary mx-1" id="legend"  onclick="legend()"><span class="material-symbols-outlined">visibility</span></a>');
}
// highlight current and manual location before click the button
function highlightCurrentManualLocation() {
    google.maps.event.addListener(map, "click", (event) => {
        if (userPosition == null) {
            $('#currentLocation').addClass('highligth')
            $('#manualLocation').addClass('highligth')
            setTimeout(() => {
                $('#currentLocation').removeClass('highligth')
                $('#manualLocation').removeClass('highligth')
            }, 400)
        }
    })
}
function showObjectArroundPanel() {
    $('#panel').html('')
    $('#rowObjectArround').css("display", "block")
    $("#cpCheck").prop("checked", false)
    $("#wpCheck").prop("checked", false)
    $("#spCheck").prop("checked", false)
    $("#fCheck").prop("checked", false)
    $("#sliderVal").val("0")
}
function hideObjectArroundPanel() {
    $('#rowObjectArround').css("display", "none")
}
// search fitur, show list object on map
function showObject(object, id = null) {
    let url
    if (id != null) 
    {
         url = base_url + "/" + "list_object" + "/" + object + "/" + id 
    }
    else 
    {
         url = base_url + "/" + "list_object" + "/" + object
    }

    $.ajax({
        url: url,
        method: "get",
        dataType: "json",
        success: function (response) {
            moveCamera()  
            panTo({ lat: parseFloat(response.objectData[0].lat), lng: parseFloat(response.objectData[0].lng) })
            $('#rowObjectArround').css("display", "none")
            clearMarker()
            clearRadius()
            clearRoute()
          
            if (response.objectData && response.url) {
                if (response.objectData[0].id == '01') {
                    activeMenu('grave')
                } else if (response.objectData[0].id == '05') {
                    activeMenu('mosque')
                } 
                return loopingAllMarker(response.objectData, response.url)
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}

//batuuuu

function showStone() {
    let url = base_url + "/" + "list_object" + "/" + 'atraction_stone'
    $.ajax({
        url: url,
        method: "get",
        dataType: "json",
        success: function (response) {
            moveCamera()
            console.log(response)
            panTo({ lat: parseFloat(response.objectData[0].lat), lng: parseFloat(response.objectData[0].lng) })
            $('#rowObjectArround').css("display", "none")
            clearMarker()
            clearRadius()
            clearRoute()
          
            if (response.objectData && response.url) {
                if (response.objectData[0].id == '02') {
                    activeMenu('stone')
                } 
                return loopingAllMarker(response.objectData, response.url)
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}
//ordinary

function showOrdinary() {
    let url = base_url + "/" + "list_object" + "/" + 'atraction_ordinary'
    $.ajax({
        url: url,
        method: "get",
        dataType: "json",
        success: function (response) {
            moveCamera(z = 15)
            panTo({ lat: parseFloat(response.objectData[0].lat), lng: parseFloat(response.objectData[0].lng) })
            $('#rowObjectArround').css("display", "none")
            clearMarker()
            clearRadius()
            clearRoute()
          
            if (response.objectData && response.url) {
           
                if (response.objectData[0].category_atraction_id == '2') {
                    console.log("masuk sinikah")
                    activeMenu('ordinary')
                } 
                return loopingAllMarker(response.objectData, response.url)
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}
// Event
function showEvent() {
     let url = base_url + "/" + "list_object" + "/" + "event"
  
    $.ajax({
        url: url,
        method: "get",
        dataType: "json",
        success: function (response) {
            moveCamera()
            console.log(response)
            panTo({ lat: parseFloat(response.objectData[0].lat), lng: parseFloat(response.objectData[0].lng) })
            $('#rowObjectArround').css("display", "none")
            clearMarker()
            clearRadius()
            clearRoute()
          
            if (response.objectData && response.url) {
                if (response.objectData[0].id = '01') {
                    activeMenu('event')
                } 
                return loopingAllMarker(response.objectData, response.url)
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}

// set object name with ajax when sidemenu by name is clicked
function setObjectByName(object) {
    $.ajax({
        url: base_url + "/" + "list_object" + "/" + object,
        method: "get",
        dataType: "json",
        success: function (response) {
            let listObject = []
            let url = response.url
            if (url == 'atraction') {
                atData = response.objectData
                for (let i = 0; i < atData.length; i++) {
                    let name = atData[i].name
                    listObject.push(`<option>${name}</option>`)
                }
                return $('#basicSelect').html(`<option value="">Select ${url}</option>${listObject}`)
            } else if (url == 'event') {
                evData = response.objectData
                for (let i = 0; i < evData.length; i++) {
                    let name = evData[i].name
                    listObject.push(`<option>${name}</option>`)
                }
                return $('#basicSelect2').html(`<option value="">Select ${url}</option>${listObject}`)
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}
// search fitur, Show object on map by name
function getObjectByName(val = null, url) {
    let name = val
    if (!name) { return }

    let urlNow
    if (url == 'atraction') { urlNow = "atraction_by_name" }
    else if (url == 'event') { urlNow = "event_by_name" }

    $('#rowObjectArround').css("display", "none")
    $.ajax({
        url: base_url + "/" + "list_object" + "/" + urlNow + "/" + name,
        method: "get",
        dataType: "json",
        success: function (response) {
            panTo({ lat: latPariangan, lng: lngPariangan })
            clearMarker()
            clearRadius()
            clearRoute()
            loopingAllMarker(response.objectData, response.url)
            if (url == 'atraction') { activeMenu('atraction') } else if (url == 'event') { activeMenu('event') }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}
// search fitur, show object on map by rate
function getObjectByRate(val, url) {
    let urlNow
    $('#rowObjectArround').css("display", "none")
    if (url == 'atraction') { urlNow = "atraction_by_rate" }
    else if (url == 'event') { urlNow = "event_by_rate" }

    $.ajax({
        url: base_url + "/" + "list_object" + "/" + urlNow + "/" + val,
        method: "get",
        dataType: "json",
        success: function (response) {
            panTo({ lat: latPariangan, lng: lngPariangan })
            clearMarker()
            clearRadius()
            clearRoute()
            loopingAllMarker(response.objectData, response.url)
            if (url == 'atraction') {
                setStar(val)
                activeMenu('atraction')
            } else if (url == 'event') {
                setStar2(val)
                activeMenu('event')
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}
// Set star by user input
function setStar(star) {
    switch (star) {
        case '1':
            $("#star-1").addClass('star-checked')
            $("#star-2,#star-3,#star-4,#star-5").removeClass('star-checked')
            break
        case '2':
            $("#star-1,#star-2").addClass('star-checked')
            $("#star-3,#star-4,#star-5").removeClass('star-checked')
            break
        case '3':
            $("#star-1,#star-2,#star-3").addClass('star-checked')
            $("#star-4,#star-5").removeClass('star-checked')
            break
        case '4':
            $("#star-1,#star-2,#star-3,#star-4").addClass('star-checked')
            $("#star-5").removeClass('star-checked')
            break
        case '5':
            $("#star-1,#star-2,#star-3,#star-4,#star-5").addClass('star-checked')
            break
    }
}

// Set star by user input
function setStar2(star) {
    switch (star) {
        case '1':
            $("#sstar-1").addClass('star-checked')
            $("#sstar-2,#sstar-3,#sstar-4,#sstar-5").removeClass('star-checked')
            break
        case '2':
            $("#sstar-1,#sstar-2").addClass('star-checked')
            $("#sstar-3,#sstar-4,#sstar-5").removeClass('star-checked')
            break
        case '3':
            $("#sstar-1,#sstar-2,#sstar-3").addClass('star-checked')
            $("#sstar-4,#sstar-5").removeClass('star-checked')
            break
        case '4':
            $("#sstar-1,#sstar-2,#sstar-3,#sstar-4").addClass('star-checked')
            $("#sstar-5").removeClass('star-checked')
            break
        case '5':
            $("#sstar-1,#sstar-2,#sstar-3,#sstar-4,#sstar-5").addClass('star-checked')
            break
    }
}
function removeAllStar() {
    return $("#sstar-1,#sstar-2,#sstar-3,#sstar-4,#sstar-5,#star-1,#star-2,#star-3,#star-4,#star-5").removeClass('star-checked')
}

function setRating(user_id, object_id, val, url) {
    let urlN = base_url + "/" + "review" + "/" + url;
    let data = { 'user_id': user_id, 'rating': val }
    if (url == 'atraction') { 
        data.atraction_id = object_id 
    }
    else if (url == 'event') {
         data.event_id = object_id 
    } else if (url == 'package') {
        console.log("masuk sini ya")
         data.id_package = object_id 
    }
    $.ajax({
        url: urlN,
        method: "post",
        data: data,
        dataType: "json",
        success: function (response) {
            if (response) {
                let text
                // currentObjectRating()
                setStar(val)
                if (val <= 3) { text = 'Thanks for rated , We will imporove it!' }
                else { text = 'Thanks for rated, Hope you enjoy it!' }
                return Swal.fire({
                    text: text,
                    icon: 'success',
                    showClass: { popup: 'animate__animated animate__fadeInUp' },
                    timer: 5000,
                    confirmButtonText: 'Oke'
                })
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}

//  set object category with ajax when sidemenu by category is clicked
function setObjectByCategory() {
    $.ajax({
        url: base_url + "/" + "list_object" + "/" + "atraction_by_category",
        method: "get",
        dataType: "json",
        success: function (response) {
            let listObject = []
            atData = response.objectData
            for (i in atData) {
                let category = atData[i].category
                listObject.push(`<option>${category}</option>`)
            }
            return $('#categorySelect').html(`<option value="">Select category </option>${listObject}`)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}
// search fitur, Show object on map by name
function getObjectByCategory(val = null) {
    let category = val
    if (!category) { return }
    $('#rowObjectArround').css("display", "none")
    $.ajax({
        url: base_url + "/" + "list_object" + "/" + "atraction_by_category" + "/" + category,
        method: "get",
        dataType: "json",
        success: function (response) {
            panTo({ lat: latPariangan, lng: lngPariangan })
            clearMarker()
            clearRadius()
            clearRoute()
            activeMenu('atraction')
            loopingAllMarker(response.objectData, response.url)

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" +
                xhr.responseText + "\n" + thrownError);
        }
    });
}
// search fitur, Show event on map by date
function getObjectByDate(date_start = null,date_end=null) {
    $('#rowObjectArround').css("display", "none")
    let date_1 = $('#date_1').val()
    let date_2 = $('#date_2').val()

    if(date_start&&date_end){
        console.log(date_start)
        date_1 = date_start
        date_2 = date_end
    }
   
    if (date_1 && date_2) {
        $.ajax({
            url: base_url + "/" + "list_object" + "/" + "event_by_date" + "/" + date_1 + "/" + date_2,
            method: "get",
            dataType: "json",
            success: function (response) {
                panTo({ lat: latPariangan, lng: lngPariangan })
                clearMarker()
                clearRadius()
                clearRoute()
                activeMenu('event')
                loopingAllMarker(response.objectData, response.url)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" +
                    xhr.responseText + "\n" + thrownError);
            }
        });
    }
}
function activeMenu(url) {
    $('#indexMenu').removeClass('active');
    $('#uniqueMenu').removeClass('active');
    $('#graveMenu').removeClass('active');
    $('#stoneMenu').removeClass('active');
    $('#mosqueMenu').removeClass('active');
    $('#ordinaryMenu').removeClass('active');
    $('#eventMenu').removeClass('active');
    $('#adminMenu').removeClass('active');
    if (url == 'index') {
        $('#indexMenu').addClass('active');
    } else if (url == 'unique') {
        $('#uniqueMenu').addClass('active');
    } else if (url == 'grave') {
        $('#graveMenu').addClass('active');
    } else if (url == 'stone') {
        $('#stoneMenu').addClass('active');
    } else if (url == 'mosque') {
        $('#mosqueMenu').addClass('active');
    } else if (url == 'ordinary') {
        $('#ordinaryMenu').addClass('active');
    } else if (url == 'event') {
        $('#eventMenu').addClass('active');
    } else if (url == 'admin') {
        $('#adminMenu').addClass('active');
    }
}

//---------------------------------------------admin drawing manager------------------------------------------------
// Remove selected shape on maps
function clearGeomArea() {
    document.getElementById('geo-json').value = ''
    if (selectedShape) {
        selectedShape.setMap(null)
        selectedShape = null
    } else { clearGeom() }
}

// Initialize drawing manager on maps
function initDrawingManager(url = null) {
    drawingManager = new google.maps.drawing.DrawingManager()
    let color
    if (url == 'atraction') { color = '#C45A55' }
    if (url == 'event') { color = '#8EFFCD' }
    if (url == 'culinary_place') { color = '#FA786D' }
    if (url == 'souvenir_place') { color = '#ED90C4' }
    if (url == 'worship_place') { color = '#42CB6F' }
    if (url == 'facility') { color = '#3b6af9' }
    const drawingManagerOpts = {
        // drawingMode: google.maps.drawing.OverlayType.MARKER,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [google.maps.drawing.OverlayType.MARKER, google.maps.drawing.OverlayType.POLYGON]
        },
        markerOptions: { icon: checkIcon(url) },
        polygonOptions: {
            fillColor: color,
            strokeWeight: 2,
            strokeColor: color,
            editable: true,
        },
        map: map
    };
    drawingManager.setOptions(drawingManagerOpts);
    if (url) {
        google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
            switch (event.type) {
                case google.maps.drawing.OverlayType.MARKER:
                    drawingMarker = event
                    setMarker(event.overlay, url)
                    break
                case google.maps.drawing.OverlayType.POLYGON:
                    setPolygon(event.overlay);
                    break
            }
        });
    }

}

function setMarker(shape, url = null) {
    let lat = shape.getPosition().lat().toFixed(8)
    let lng = shape.getPosition().lng().toFixed(8)
    //clear marker
    for (i in markerArray) { markerArray[i].setMap(null); }
    if (selectedMarker) {
        selectedMarker.setMap(null)
        selectedMarker = null
    }
    selectedMarker = shape
    document.getElementById('latitude').value = lat
    document.getElementById('longitude').value = lng
}

function setPolygon(shape) {
    clearGeom()
    if (selectedShape) {
        selectedShape.setMap(null)
        selectedShape = null
    }
    selectedShape = shape;
    dataLayer = new google.maps.Data();
    dataLayer.add(new google.maps.Data.Feature({ geometry: new google.maps.Data.Polygon([selectedShape.getPath().getArray()]) }))
    dataLayer.toGeoJson(function (object) { document.getElementById('geo-json').value = JSON.stringify(object.features[0].geometry) })
}



