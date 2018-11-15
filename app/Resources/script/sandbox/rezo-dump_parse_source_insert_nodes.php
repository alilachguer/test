<?php

require './phpsqliteconnect/vendor/autoload.php';

use App\SQLiteConnection;
use App\MySQLConnection;

echo "<p>Begin source parsing</p>";

//$src = file_get_contents("rezo-dump_source_cheval.html");
$src = "// les noeuds/termes (Entries) : e;eid;'name';type;w;'formated name' 

e;145246;'cheval';1;3186
e;3739399;'cabriole>83824';1;0;'cabriole>équitation'
e;3750932;'piqueur>83824';1;0;'piqueur>équitation'
e;9915574;'montée>113767>83824';1;0;'montée>monter>équitation'
e;9915407;'montée>113767';1;0;'montée>monter'
e;9259312;'zain>171869';1;0;'zain>Adj:'
e;7567571;'=rush=';1;0
e;237639;'en selle';1;10
e;10457257;'tendon>145246';1;0;'tendon>cheval'
e;11151738;'pincer>83824';1;0;'pincer>équitation'
e;11150723;'voltiger>249281>83824';1;0;'voltiger>arts du spectacle>équitation'
e;11158780;'embrasser>83824';1;0;'embrasser>équitation'
e;2408702;'cheval de peleur';1;0
e;48551;'galope';1;50
e;7568784;'=vertical=';1;0
e;8035177;'=croupier=';1;0
e;5626;'carogne';1;52
e;11136155;'assiette>57791>83824';1;0;'assiette>position>équitation'
e;11137387;'démonter>83824';1;0;'démonter>équitation'
e;237765;'patte>141795';1;50;'patte>membre'
e;6226;'trop';1;378
e;152623;'cheval d'arçon';1;54
e;225477;'cheval de retour';1;50
e;306059;'cheval de somme';777;50
e;343537;'cheval de fatigue';1;50
e;343545;'cheval de trot';1;50
e;343542;'cheval de polo';1;50
e;343519;'cheval alimentaire';1;50
e;343528;'cheval cauchois';1;50
e;343562;'cheval à deux fins';1;50
e;343539;'cheval de harnais';1;50
e;343526;'cheval cabré';1;50
e;343529;'cheval comtois';1;50
e;343538;'cheval de fiacre';1;50
e;343555;'cheval normand';1;50
e;343588;'cheval tigré';1;50
e;343531;'cheval courtaud';1;50
e;343535;'cheval de chasse';1;50
e;343585;'cheval courant';1;50
e;343524;'cheval bien mis';1;50
e;343558;'cheval russe';1;50
e;343561;'cheval turc';1;50
e;343533;'cheval danois';1;50
e;343579;'cheval andalou';1;50
e;343557;'cheval public';1;50
e;343556;'cheval picard';1;50
e;343525;'cheval breton';1;50
e;343554;'cheval mongol';1;50
e;343548;'cheval flamand';1;50
e;343530;'cheval couronné';1;50
e;343587;'cheval noble';1;50
e;343541;'cheval de manège';1;50
e;343522;'cheval ardennais';1;50
e;343527;'cheval campé du derrière';1;50
e;343552;'cheval kirghiz';1;50
e;343546;'cheval effréné';1;50
e;2337848;'cheval de bois>104321';1;0;'cheval de bois>manège'
e;4309726;'talon>83824';1;0;'talon>équitation'
e;122544;'hanche';1;84
e;63622;'cob';1;52
e;117557;'piquer';1;1060
e;27937;'barde';1;254
e;64474;'aplomb';1;76
e;679184;'appuyer>146882';1;0;'appuyer>Ver:Inf'
e;106081;'arrêt';1;614
e;71951;'parer';1;88
e;145500;'allure';1;176
e;133793;'pincer';1;284
e;164926;'viandard';1;58
e;45321;'débrider';1;56
e;1723;'pirouette';1;80
e;51568;'pelote';1;186
e;7904;'étourneau';1;92
e;135648;'lacune';1;56
e;35158;'embouchure';1;86
e;1795710;'canon>171869';1;0;'canon>Adj:'
e;1232304;'étourneau>171869';1;0;'étourneau>Adj:'
e;134474;'piscine';1;1562
e;65540;'gentleman-rider';1;50
e;1874093;'CV>181496';1;0;'CV>cheval fiscal'
e;2366419;'cv';1;2
e;91875;'CV';1;112
e;238551;'véhicule>152778';1;122;'véhicule>moyen de transport'
e;1770034;'administration>118113';1;0;'administration>fourniture'
e;252355;'automobile>123745';1;144;'automobile>véhicule'
e;105058;'fiscal';1;88
e;52212;'fisc';1;224
e;234543;'certificat d'immatriculation';1;52
e;4658;'moteur';1;2064
e;14003;'taxe';1;256
e;374408;'puissance fiscale';1;52
e;64226;'administration';1;300
e;182153;'droit fiscal';1;4
e;53317;'appareil digestif';1;104
e;44659;'intestins';1;112
e;304847;'cheval minorquin';777;50
e;343523;'cheval barbe';1;50
e;343559;'cheval savant';1;50
e;343536;'cheval de cérémonie';1;50
e;343584;'cheval chevillé';1;50
e;343560;'cheval tartare';1;50
e;343586;'cheval miroité';1;50
e;343583;'cheval caparaçonné';1;50
e;2399662;'cheval de trait comtois';1;0
e;2399152;'cheval de selle français';1;0
e;2403985;'cheval camargue';1;0
e;2404642;'cheval percheron';1;0
e;17557;'ramener';1;158
e;1964608;'bouchonné>161702';1;0;'bouchonné>Ver:PPas'
e;1964609;'bouchonné>171869';1;0;'bouchonné>Adj:'
e;589327;'barde>146881';1;0;'barde>Nom:Fem+SG'
e;595330;'à cheval>146889';1;0;'à cheval>Adv:'
e;124104;'gourmander';1;60
e;1859440;'monté>161702';1;0;'monté>Ver:PPas'
e;1859441;'monté>171869';1;0;'monté>Adj:'
e;35110;'monté';1;84
e;130891;'emballement';1;60
e;143578;'mettre le pied à l'étrier';1;52
e;220043;'être à cheval';1;50
e;1088197;'animal herbivore';1;0
e;175328;'cheval du bon dieu';1;50
e;220653;'cheval de guerre';1;50
e;343534;'cheval de carrousel';1;50
e;261258;'cheval pif';1;50
e;1787748;'cheval fou';1;0
e;2364718;'cheval ariégeois';1;0
e;2367665;'cheval edelweiss';1;0
e;2581543;'cheval celte';777;0
e;72867;'manier';1;84
e;58822;'relever';1;156
e;34122;'peser';1;246
e;98412;'barrage';1;262
e;8994;'piste';1;1358
e;123526;'tenir';1;872
e;86976;'appui';1;98
e;99889;'retenir';1;238
e;1644943;'gourmer>80291';1;0;'gourmer>brider'
e;3712;'traverser';1;390
e;18699;'remonter';1;152
e;97447;'pommade';1;130
e;5454;'placer';1;388
e;30627;'poussif';1;56
e;41313;'carrière';1;168
e;99262;'éperonner';1;50
e;5502057;'bavette>83824';1;0;'bavette>équitation'
e;8005151;'caracoler>83824';1;0;'caracoler>équitation'
e;40184;'siège';1;1322
e;172824;'cheval marin';1;50
e;272453;'cheval nain';777;50
e;572167;'cheval dans la mythologie nordique';777;50
e;115647;'haut-le-corps';1;52
e;457043;'poussif>171869';1;50;'poussif>Adj:'
e;1935893;'cheval australien';777;0
e;197530;'cheval à bascule';1;54
e;108358;'cheval roux';1;50
e;2490095;'cheval tarpan';1;0
e;2690953;'boucle>83824';1;0;'boucle>équitation'
e;84200;'porteur';1;196
e;369712;'perle noire';1;50
e;588431;'équin>171869';1;0;'équin>Adj:'
e;84321;'faucher';1;118
e;422596;'welsh';1;50
e;29786;'ferme';1;2022
e;156964;'ferme>146881';1;50;'ferme>Nom:Fem+SG'
e;154448;'Equitation';1;62
e;185825;'cheval à deux mains';1;50
e;216333;'cheval fondu';1;50
e;254255;'cheval d'arson';1;50
e;2568724;'cheval des rois';1;0
e;2568314;'cheval camarguais';1;0
e;2523142;'cheval de pelleur';1;0
e;2522618;'cheval de terre';1;0
e;2511637;'cheval cob normand';1;0
e;2509285;'cheval sauvage de Mongolie';1;0
e;2504339;'cheval de réforme';1;0
e;2492947;'cheval de mer';1;0
e;343589;'cheval à roulettes';1;50
e;587452;'chopper>146882';1;0;'chopper>Ver:Inf'
e;120527;'zain';1;50
e;36245;'traquenard';1;60
e;104105;'poinçon';1;70
e;64060;'puissance';1;434
e;6681909;'carogne>145246';1;0;'carogne>cheval'
e;235207;'cheval de bataille>46872';1;50;'cheval de bataille>destrier'
e;2506214;'cheval Criollo';1;0
e;88269;'apprivoisé';1;96
e;218574;'cavalerie>218573';1;30;'cavalerie>unité militaire'
e;343532;'cheval d'attelage';1;50
e;181494;'cheval de bât';1;50
e;181498;'cheval qui boit dans son blanc';1;50
e;2499872;'cheval en arbalète';1;0
e;2383407;'cheval lorrain';1;0
e;49309;'entier';1;418
e;128475;'happelourde';1;52
e;7112;'fanon';1;74
e;261320;'cheval de sang';1;50
e;261254;'cheval de spectacle';1;50
e;261257;'cheval de boucherie';1;50
e;3765270;'welsh>145246';1;0;'welsh>cheval'
e;98324;'battue';1;88
e;233138;'tête>390963';1;42;'tête>extrémité supérieure du corps'
e;116980;'squelette';1;1070
e;245399;'cheval de Troie>104993';1;2;'cheval de Troie>informatique'
e;261252;'cheval de concours';1;50
e;2385460;'cheval de plumeur';1;0
e;3707804;'croisière>83824';1;0;'croisière>équitation'
e;3760354;'faucher>145246';1;0;'faucher>cheval'
e;116134;'selles';1;76
e;32735;'poumons';1;250
e;240720;'squelette>112609';1;102;'squelette>anatomie'
e;187622;'patte antérieure';1;8
e;152125;'Zoologie';1;208
e;1803228;'norfolk';1;0
e;343553;'cheval long-jointé';1;50
e;84395;'cheval-arçons';1;50
e;152552;'Cuisine';1;156
e;261282;'manger du cheval';1;2
e;23775;'derby';1;52
e;217056;'agrès>56413';1;6;'agrès>gymnastique'
e;39345;'agrès';1;82
e;225934;'oeil>330323';1;106;'oeil>organe de la vue'
e;187620;'patte postérieure';1;6
e;241352;'ventre>112609';1;44;'ventre>anatomie'
e;36886;'faune';1;380
e;126388;'articulation';1;600
e;39031;'cerveau';1;1628
e;1482014;'cheval du Namib';777;0
e;1694670;'cheval de selle marocain';1;0
e;1859219;'cheval de l'Amour';777;0
e;396247;'individu>24956';1;62;'individu>être humain'
e;243451;'steak de cheval';1;24
e;103311;'système nerveux';1;246
e;83944;'nerf';1;810
e;120157;'règne animal';1;72
e;57875;'tube digestif';1;108
e;135652;'viscères';1;98
e;261305;'garrot>17559';1;52;'garrot>animal'
e;214988;'langue>213791';1;214;'langue>organe musculaire'
e;298405;'crinière>117095';1;50;'crinière>zoologie'
e;233032;'jambe>141795';1;72;'jambe>membre'
e;216283;'dent>45311';1;234;'dent>dentaire'
e;215821;'cuisse>142086';1;36;'cuisse>jambe'
e;86561;'crâne';1;616
e;3376;'membres';1;148
e;222595;'mâchoire>112609';1;32;'mâchoire>anatomie'
e;213792;'coeur>213791';1;92;'coeur>organe musculaire'
e;74558;'os';1;2570
e;218086;'organe sexuel';1;64
e;141795;'membre';1;640
e;241862;'oreille>117095';1;50;'oreille>zoologie'
e;213644;'os>116980';1;280;'os>squelette'
e;225756;'dos>112609';1;60;'dos>anatomie'
e;261225;'pattes>248747';1;52;'pattes>membres inférieurs'
e;213864;'sabot>141705';1;8;'sabot>ongle'
e;22889;'intestin';1;560
e;390927;'tête>112609';1;60;'tête>anatomie'
e;343582;'cheval berrichon';1;50
e;45191;'diligence';1;86
e;139779;'ADN';1;662
e;3265934;'poinçon>83824';1;0;'poinçon>équitation'
e;113750;'genre humain';1;72
e;47319;'colonne vertébrale';1;260
e;152844;'sang chaud';1;80
e;343581;'cheval auvergnat';1;50
e;3284571;'débrider>145246';1;0;'débrider>cheval'
e;77424;'oeil';1;2966
e;25891;'genou';1;662
e;76046;'oreilles';1;494
e;108463;'ventre';1;956
e;74846;'corps';1;4616
e;153276;'fer à cheval';1;142
e;87862;'ganache';1;70
e;147184;'dents';1;1246
e;261256;'cheval de parade';1;50
e;25397;'haridelle';1;66
e;76271;'Cheval';1;56
e;151709;'Sports';1;214
e;63158;'écuyer';1;130
e;153860;'queue de cheval';1;72
e;1375963;'breton>145246';1;0;'breton>cheval'
e;220060;'étalon>145246';1;60;'étalon>cheval'
e;1787742;'emballement>145246';1;0;'emballement>cheval'
e;59797;'arçon';1;50
e;84360;'bouchonner';1;94
e;121458;'seller';1;70
e;26152;'frein';1;488
e;17960;'casaque';1;58
e;51095;'tord-nez';1;50
e;321828;'haut-le-corps>83824';1;50;'haut-le-corps>équitation'
e;233383;'étrier>83824';1;50;'étrier>équitation'
e;69729;'bai';1;54
e;140774;'isabelle';1;54
e;80626;'louvet';1;50
e;2321324;'cheval de loisir';1;0
e;144862;'genet';1;50
e;57420;'rossard';1;52
e;83677;'cavale';1;122
e;17834;'favori';1;162
e;21457;'coureur';1;460
e;2945147;'terrain>83824';1;0;'terrain>équitation'
e;140715;'jambes';1;668
e;3130629;'perle noire>145246';1;0;'perle noire>cheval'
e;3147348;'chopper>145246';1;0;'chopper>cheval'
e;3176075;'embouchure>83824';1;0;'embouchure>équitation'
e;2498159;'open ditch';1;0
e;2514673;'battre la poudre à courbettes';1;0
e;144350;'parade';1;124
e;92675;'bringue';1;60
e;19309;'asseoir';1;88
e;86910;'guêtre';1;50
e;246146;'engrainer';1;50
e;33977;'virevolter';1;68
e;5193;'désunir';1;94
e;109640;'embrasser';1;1314
e;436376;'oulak';1;50
e;94197;'appartenance';1;108
e;9512;'entrepas';1;50
e;37569;'badiner';1;84
e;107960;'furieux';1;80
e;59186;'se pointer';1;50
e;195377;'à cru';1;50
e;2361704;'en amazone';1;0
e;264530;'tenir la corde';1;50
e;2363750;'équitation de pleine nature';1;0
e;2375520;'tride';1;0
e;2439138;'techniques de randonnée équestre de compétition';1;0
e;2460014;'cheval de main';1;0
e;2461557;'écavessade';1;0
e;2468772;'contre-galop';1;0
e;2425824;'mézair';1;0
e;2474641;'sougorge';1;0
e;58768;'organisme';1;244
e;108062;'placentaire';1;58
e;265226;'thérien';1;4
e;140026;'jeune fille';1;416
e;68439;'individu';1;5782
e;10919;'laideur';1;240
e;55572;'steak';1;502
e;218746;'boucherie>140100';1;108;'boucherie>viande'
e;106653;'hippophage';1;60
e;36367;'boulet';1;220
e;35925;'terrain';1;1672
e;289240;'horse';777;50
e;166771;'Arabesque';1;50
e;303895;'Viatka';777;50
e;118539;'poils';1;834
e;216504;'cheval blanc';1;56
e;32595;'trotteur';1;66
e;52119;'langue';1;3932
e;96211;'coeur';1;2120
e;51331;'rosse';1;64
e;16747;'adn';1;156
e;256196;'fjord>145246';1;50;'fjord>cheval'
e;1366654;'palomino>145246';1;0;'palomino>cheval'
e;116368;'écuyère';1;54
e;89902;'chevauchée';1;72
e;68274;'cow-boy';1;168
e;113278;'poitrail';1;66
e;34958;'se dérober';1;58
e;143834;'bride';1;62
e;32903;'têtière';1;52
e;119019;'voltige';1;74
e;187255;'monter à cru';1;2
e;28879;'cowboy';1;160
e;102447;'fer-à-cheval';1;64
e;228478;'être en selle';1;50
e;322500;'volte>83824';1;50;'volte>équitation'
e;218677;'aplomb>83824';1;50;'aplomb>équitation'
e;52566;'bête de boucherie';1;50
e;233478;'triple galop';1;50
e;3175276;'lacune>145246';1;0;'lacune>cheval'
e;3177221;'étourneau>145246';1;0;'étourneau>cheval'
e;3224783;'allure>83824';1;0;'allure>équitation'
e;2535570;'course de cheval';1;0
e;40991;'bond';1;90
e;112716;'australiennes';1;50
e;74500;'saccader';1;52
e;1803110;'TREC';1;0
e;68580;'ballotade';1;50
e;139243;'ligne';1;962
e;32931;'raccourcir';1;164
e;62923;'virevolte';1;66
e;84447;'serpentine';1;60
e;73667;'portemanteau';1;58
e;94836;'harnachement';1;68
e;28778;'arrêter';1;788
e;2359779;'demi-air';1;0
e;261321;'brassicourt';1;50
e;127343;'meneur';1;154
e;21896;'chevaler';1;54
e;91174;'étrivière';1;50
e;28499;'pion';1;516
e;96034;'rush';1;62
e;104430;'pesade';1;50
e;134132;'allégir';1;50
e;95989;'chapelet';1;108
e;381038;'sport équestre';1;50
e;2403644;'main de la bride';1;0
e;39675;'quintain';1;50
e;2530628;'quintan';1;0
e;69733;'ongulé';1;92
e;321099;'chanfrein>27265';1;50;'chanfrein>hippologie'
e;228289;'sexe>218086';1;168;'sexe>organe sexuel'
e;20965;'nourriture';1;3280
e;1001;'chanfrein';1;56
e;145457;'boucle';1;210
e;4315718;'chapelet>83824';1;0;'chapelet>équitation'
e;19356;'sexe';1;5094
e;2509844;'pursang';1;0
e;1531;'cuvette';1;230
e;123745;'véhicule';1;2058
e;16110;'bouche';1;4174
e;220000;'Rossinante';1;14
e;101938;'estomac';1;804
e;326146;'système nerveux en position dorsale';1;56
e;128428;'coursier';1;56
e;1636805;'oeil>44335';1;50;'oeil>organe'
e;240929;'salière>145246';1;50;'salière>cheval'
e;267306;'frison>145246';1;50;'frison>cheval'
e;7651;'pommeau';1;102
e;113414;'bookmaker';1;50
e;320549;'caracole>83824';1;50;'caracole>équitation'
e;248459;'hanche>83824';1;50;'hanche>équitation'
e;239778;'gourmette>83824';1;50;'gourmette>équitation'
e;129803;'rouan';1;56
e;2483510;'cheval à sang froid';1;0
e;55614;'haquenée';1;50
e;124572;'criquet';1;72
e;124761;'bête de somme';1;74
e;3228305;'canon>145246';1;0;'canon>cheval'
e;2526813;'lâcher la main';1;0
e;2552042;'créat';1;0
e;2566687;'gogue fixe';1;0
e;124550;'tirer';1;2086
e;12210;'rabaisser';1;76
e;32890;'dedans';1;164
e;14338;'attaquer';1;500
e;23076;'brise-cou';1;50
e;10881;'bouton';1;972
e;1994736;'aubiner';1;0
e;130202;'gymkhana';1;50
e;40328;'encapuchonner';1;50
e;7264;'croisière';1;200
e;49450;'aide';1;784
e;124050;'détraquer';1;52
e;107254;'genette';1;50
e;141457;'bande';1;342
e;171571;'haut la main';1;50
e;2379164;'capriole';1;0
e;2396021;'passéger';1;0
e;2400190;'licol-drisse';1;0
e;2444265;'course de trot attelé';1;0
e;2479193;'point to point steeplechase';1;0
e;2435555;'ballottade';1;0
e;238180;'aliment périssable';1;20
e;108648;'emballé';1;68
e;7872;'bonnet';1;402
e;133660;'étriers';1;52
e;58876;'cuisse';1;716
e;95422;'cou';1;988
e;56280;'oreille';1;1783
e;151867;'pattes';1;1098
e;145756;'cheval d'arçons';1;54
e;109785;'peau';1;3118
e;126285;'dos';1;952
e;223332;'Incitatus';1;2
e;25835;'grasset';1;52
e;1859384;'monté>145246';1;0;'monté>cheval'
e;181495;'cheval de remonte';1;50
e;85840;'broncher';1;50
e;344611;'coup de caveçon';1;50
e;87775;'amble';1;50
e;234119;'manège>83824';1;4;'manège>équitation'
e;267361;'éperonner>83824';1;50;'éperonner>équitation'
e;57874;'mazette';1;52
e;128771;'vieille bique';1;58
e;113;'tarpan';1;50
e;2549;'aubert';1;50
e;2933517;'barrage>83824';1;0;'barrage>équitation'
e;2951532;'assurer>83824';1;0;'assurer>équitation'
e;2951547;'avertir>83824';1;0;'avertir>équitation'
e;2505580;'peser à la main';1;0
e;2555739;'se délicoter';1;0
e;2559487;'oxer';1;0
e;110365;'gogue';1;50
e;808;'rueur';1;50
e;91081;'appuyer';1;196
e;68004;'piqueur';1;98
e;107499;'bavette';1;100
e;76596;'palanque';1;50
e;74587;'parader';1;62
e;19474;'caracole';1;50
e;93313;'croupade';1;50
e;37099;'harper';1;50
e;101307;'étrécir';1;50
e;7716;'touchette';1;56
e;223358;'calade';666;50
e;112622;'pilier';1;124
e;81924;'rassembler';1;224
e;115005;'tête-à-queue';1;50
e;186921;'tirer à la main';1;50
e;344913;'course au clocher';1;50
e;121644;'à poil';1;300
e;185813;'changer de main';1;50
e;256147;'course à cheval';1;50
e;2427436;'peaux de mouton';1;0
e;2459273;'main de la lance';1;0
e;2478228;'écouteux';1;0
e;2445674;'serpentiner';1;0
e;2488887;'battre à la main';1;0
e;2512779;'gogs';1;0
e;3707999;'passage>83824';1;0;'passage>équitation'
e;108827;'protéines';1;102
e;311963;'mauvais cheval';1;52
e;24365;'piaffement';1;54
e;3973;'assurer';1;176
e;99970;'chopper';1;50
e;5069639;'andalou>145246';1;0;'andalou>cheval'
e;20625;'andalou';1;58
e;218261;'dada>145246';1;52;'dada>cheval'
e;140989;'PMU';1;92
e;153974;'crotin';1;50
e;106187;'équestre';1;96
e;81477;'hennir';1;50
e;137390;'zèbre';1;212
e;229416;'monter>83824';1;52;'monter>équitation'
e;84753;'équin';1;54
e;71624;'être vivant';1;1842
e;117584;'garrot';1;72
e;71864;'museau';1;346
e;23332;'encolure';1;140
e;228983;'boulet>27265';1;50;'boulet>hippologie'
e;237616;'à cheval>83824';1;50;'à cheval>équitation'
e;155696;'chevaline';1;148
e;227359;'carne>145246';1;58;'carne>cheval'
e;261311;'jument>145246';1;18;'jument>cheval'
e;244480;'entier>145246';1;50;'entier>cheval'
e;251989;'chatouilleux>145246';1;50;'chatouilleux>cheval'
e;128209;'jouer';1;3618
e;102895;'pesage';1;50
e;109989;'volte';1;50
e;187254;'monter en croupe';1;52
e;229274;'cravacher>34954';1;50;'cravacher>frapper'
e;322680;'commencer>83824';1;50;'commencer>équitation'
e;1745759;'ramener>83824';1;0;'ramener>équitation'
e;324200;'selles>83824';1;50;'selles>équitation'
e;241809;'balancine>83824';1;50;'balancine>équitation'
e;1934148;'cheval polyvalent';1;0
e;1934143;'crème ou cremello';1;0
e;64238;'noir';1;3675
e;142894;'pie';1;332
e;1934145;'rabicano';1;6
e;136310;'califourchon';1;60
e;3232161;'pirouette>83824';1;0;'pirouette>équitation'
e;3301075;'zain>145246';1;0;'zain>cheval'
e;2501406;'lever du devant';1;0
e;68515;'molette';1;68
e;5130;'étalonner';1;58
e;96896;'avant-train';1;52
e;88209;'billarder';1;50
e;46904;'sous-barbe';1;50
e;148358;'goussaut';1;50
e;85287;'jumper';1;50
e;66567;'steeple-chase';1;50
e;73559;'longe';1;90
e;419450;'hack';1;50
e;25300;'musette';1;84
e;37664;'bipède';1;124
e;143139;'remonte';1;50
e;15049;'groom';1;94
e;34850;'escapade';1;74
e;12380;'potence';1;76
e;23919;'plier';1;242
e;186722;'piquer des deux';1;50
e;185459;'acheminer un cheval';1;50
e;2364526;'technique de randonnée équestre de compétition';1;0
e;357584;'haute école';1;52
e;250852;'en avoir plein les bras';1;2
e;24276;'forcer la main';1;54
e;2377223;'bozkachi';777;0
e;2493247;'goussant';1;0
e;96436;'licol';1;58
e;103641;'fronteau';1;52
e;123430;'jeux';1;860
e;34898;'pied';1;4032
e;221019;'bouche>112609';1;158;'bouche>anatomie'
e;5765;'paturon';1;50
e;120225;'châtaigne';1;146
e;588817;'emballé>171869';1;0;'emballé>Adj:'
e;596603;'chevalin>171869';1;0;'chevalin>Adj:'
e;273169;'Equus caballus';777;50
e;135591;'poil';1;2532
e;49318;'loisir';1;714
e;2915;'crottin';1;84
e;101947;'camarguais';1;66
e;28517;'lad';1;64
e;225707;'zèbre>112511';1;26;'zèbre>quadrupède'
e;91526;'percheron';1;60
e;241002;'cheval ailé';1;50
e;245398;'cheval de Troie>32303';1;10;'cheval de Troie>mythologie'
e;18491;'cheval de bataille';1;60
e;32699;'palefroi';1;58
e;219363;'corps>112609';1;148;'corps>anatomie'
e;105041;'narine';1;536
e;103791;'poumon';1;926
e;223942;'paddock>50346';1;2;'paddock>hippisme'
e;129294;'crack';1;62
e;65682;'bourrin';1;58
e;330964;'cordé>117095';1;36;'cordé>zoologie'
e;329657;'choano-organisme';1;62
e;106165;'appendice';1;160
e;153253;'Astronomie';1;132
e;114327;'acide désoxyribonucléique';1;136
e;240293;'fanon>145246';1;50;'fanon>cheval'
e;250449;'poussif>145246';1;50;'poussif>cheval'
e;181497;'cheval jarretier';1;50
e;56865;'sport';1;4546
e;93210;'amazone';1;74
e;81674;'cravache';1;98
e;16521;'cravacher';1;54
e;80291;'brider';1;70
e;77928;'ventrière';1;50
e;1733624;'bouchonné>146395';1;0;'bouchonné>frotté'
e;1824461;'commencé>83824';1;0;'commencé>équitation'
e;330671;'pilier>83824';1;50;'pilier>équitation'
e;322691;'mettre le pied à l'étrier>83824';1;50;'mettre le pied à l'étrier>équitation'
e;253190;'battue>83824';1;50;'battue>équitation'
e;218350;'carrière>83824';1;50;'carrière>équitation'
e;140862;'note';1;1250
e;1934146;'cheval de sport';1;0
e;1934147;'cheval de travail';1;0
e;2739991;'bonnet>83824';1;0;'bonnet>équitation'
e;3224501;'se dérober>83824';1;0;'se dérober>équitation'
e;2517265;'tranchefil';1;0
e;2529802;'trait-track';1;0
e;2547876;'tölt';1;0
e;2557965;'randonnée à cheval';1;0
e;2558705;'croix à courbettes';1;0
e;2563386;'écaveçade';1;0
e;2570260;'hackamore';1;0
e;143637;'s'abandonner';1;56
e;110045;'terre-à-terre';1;50
e;10983;'attelage';1;120
e;93222;'bronco';1;50
e;74162;'aubin';1;50
e;128464;'mésair';1;50
e;135347;'galopade';1;52
e;86020;'horse-ball';1;50
e;53698;'caveçon';1;50
e;52548;'talon';1;322
e;108557;'balancine';1;54
e;27672;'pas';1;254
e;13791;'gueulard';1;74
e;53531;'picoter';1;58
e;79475;'quintaine';1;50
e;174793;'bidoris';1;50
e;93299;'réaction';1;420
e;24646;'attraper';1;786
e;2342162;'sous-gorge';1;0
e;2365421;'trot monté';1;0
e;1664808;'aller bride en main';1;0
e;2377222;'bouzkachi';1;0
e;2384152;'changement de main';1;0
e;2418104;'escaveçade';1;0
e;123978;'terre à terre';1;68
e;2432643;'soubarbe';1;0
e;2469541;'escavessade';1;0
e;145953;'visage';1;2330
e;7430;'sein';1;892
e;93927;'fesses';1;522
e;30238;'jeune femme';1;100
e;6874;'mocheté';1;134
e;123418;'ingrédient';1;126
e;91657;'nutrition';1;344
e;8482;'menton';1;244
e;60384;'jarret';1;82
e;604323;'rosse>171869';1;0;'rosse>Adj:'
e;597913;'piaffer>146882';1;0;'piaffer>Ver:Inf'
e;1415;'répondre';1;262
e;60498;'chatouilleux';1;58
e;6306390;'equus przewalskii';1;0
e;35143;'biologie';1;1808
e;110160;'robe';1;1008
e;214340;'robe>138092';1;70;'robe>pelage'
e;152386;'sabots';1;106
e;154115;'naseaux';1;86
e;117095;'zoologie';1;1542
e;220046;'selle>145246';1;54;'selle>cheval'
e;61793;'hongre';1;52
e;225759;'haridelle>145246';1;50;'haridelle>cheval'
e;138092;'pelage';1;312
e;247057;'symétrie bilatérale';1;6
e;343520;'cheval anglais';1;50
e;232537;'écurie>65524';1;24;'écurie>bâtiment'
e;315479;'queue de cheval>145246';1;50;'queue de cheval>cheval'
e;1880656;'piaffer>145246';1;0;'piaffer>cheval'
e;85206;'bat-flanc';1;54
e;74569;'désarçonner';1;50
e;3122;'caparaçon';1;56
e;41351;'van';1;70
e;11386;'maquignon';1;50
e;251540;'bottes cavalières';1;2
e;320442;'être à cheval>83824';1;50;'être à cheval>équitation'
e;254331;'passade>83824';1;50;'passade>équitation'
e;152487;'Loisir';1;52
e;65683;'favoris';1;54
e;31531;'roussin';1;52
e;92287;'sauteur';1;76
e;86582;'bourrique';1;82
e;2434809;'câbrer';1;0
e;3259762;'Kyz kuu';1;0
e;46211;'dérober';1;298
e;117795;'piaffer';1;68
e;43658;'forger';1;196
e;14734;'alléger';1;140
e;63655;'assouplir';1;76
e;17155;'chambrière';1;78
e;121309;'caracoler';1;76
e;129436;'recommencer';1;256
e;105194;'martingale';1;52
e;47424;'délicoter';1;50
e;64862;'passage';1;562
e;15345;'tisonné';1;50
e;122391;'passade';1;66
e;1654922;'nerférer';1;0
e;4607;'estrapasser';1;50
e;243303;'neigeur';1;50
e;186195;'faire feu des quatre fers';1;50
e;385113;'trot attelé';1;50
e;2417864;'CSO';1;0
e;3307540;'viandard>145246';1;0;'viandard>cheval'
e;2405830;'cavesson';1;0
e;51970;'représentation';1;302
e;191814;'fille laide';1;52
e;114637;'aliment';1;1304
e;26363;'bras';1;3644
e;54769;'commencé';1;58
e;116927;'salière';1;206
e;6685208;'cheval>145556';1;0;'cheval>jeu d'échecs'
e;9105788;'=equus caballus=';1;0
e;87034;'commissionnaire';1;56
e;46872;'destrier';1;64
e;13331;'concours';1;570
e;263820;'chevalin>145246';1;50;'chevalin>cheval'
e;27154;'animal domestique';1;324
e;71026;'flanc';1;106
e;65257;'croupe';1;90
e;139578;'muscle';1;1518
e;142412;'canon';1;712
e;45635;'rein';1;320
e;227494;'galop>145500';1;52;'galop>allure'
e;65081;'organisme vivant';1;116
e;251539;'promenade à cheval';1;2
e;325703;'robe du cheval';1;50
e;246495;'cob>145246';1;50;'cob>cheval'
e;568574;'osselet>145246';1;50;'osselet>cheval'
e;1880679;'piaffement>145246';1;0;'piaffement>cheval'
e;146878;'championne';1;154
e;81062;'balzane';1;50
e;41950;'croupière';1;50
e;28781;'démonter';1;146
e;18433;'sellerie';1;68
e;80589;'carrousel';1;56
e;187253;'monter en amazone';1;50
e;216644;'cheval>83824';1;36;'cheval>équitation'
e;8431;'commencer';1;310
e;52740;'gourmer';1;50
e;3573;'bouchonné';1;56
e;393017;'bond>83824';1;50;'bond>équitation'
e;234282;'piquer>83824';1;50;'piquer>équitation'
e;332866;'derby>83824';1;50;'derby>équitation'
e;1934144;'pangaré';1;0
e;57956;'grande bringue';1;50
e;98737;'outsider';1;50
e;46856;'bique';1;62
e;56983;'carcan';1;62
e;3232231;'pelote>145246';1;0;'pelote>cheval'
e;2509876;'hors la main';1;0
e;2526389;'courbette en place';1;0
e;2537193;'enjarreté';1;0
e;2537912;'enseller';1;0
e;2547670;'ennasure';1;0
e;2436627;'beau-partir';1;0
e;1873780;'gourmander>1974';1;2;'gourmander>réprimander'
e;25997;'armer';1;184
e;125260;'renfermer';1;70
e;331683;'courbetter';1;50
e;45941;'volter';1;50
e;121235;'abandonner';1;636
e;96339;'gaule';1;60
e;148194;'fortraiture';1;50
e;70283;'travail';1;4074
e;57973;'éperon';1;56
e;418332;'bouté';1;50
e;158397;'spa';1;78
e;133021;'flot';1;102
e;186227;'faire le pont-levis';1;50
e;151864;'course de haies';1;50
e;2399633;'tenir la bride haute';1;0
e;2401650;'partir de la main';1;0
e;2424817;'long-jointé';1;0
e;2460258;'reining';1;0
e;2484408;'le pas et le saut';1;0
e;3306551;'neigeur>83824';1;0;'neigeur>équitation'
e;246420;'molette>57973';1;50;'molette>éperon'
e;2391311;'balotade';1;0
e;154784;'porte-manteau';1;112
e;3422340;'Cheval à sang chaud';777;0
e;85802;'poulinière';1;52
e;103416;'euthérien';1;58
e;50869;'seins';1;556
e;158456;'laide';1;200
e;218942;'alimentation>20621';1;84;'alimentation>aliments'
e;395092;'chair animale';1;50
e;136559;'produit alimentaire';1;60
e;187788;'pointe du jarret';1;50
e;81934;'main';1;6486
e;774;'osselet';1;64
e;589632;'anglo-arabe>171869';1;0;'anglo-arabe>Adj:'
e;2583840;'commencé>161702';1;0;'commencé>Ver:PPas'
e;2583841;'commencé>171869';1;0;'commencé>Adj:'
e;4330867;'cavalière>83824>61490';1;0;'cavalière>équitation>femme'
e;137652;'messager';1;116
e;58170;'hauteur';1;468
e;93095;'chevalerie';1;194
e;161908;'faire du cheval';1;58
e;69001;'pouliche';1;86
e;189981;'ingrédient de cuisine';1;66
e;159898;'garot';1;50
e;152622;'cheval de trait';1;64
e;59907;'cavalerie';1;156
e;13115;'mâchoire';1;418
e;158433;'saut d'obstacle';1;58
e;152578;'Vétérinaire';1;198
e;159468;'espèce animale';1;108
e;1344457;'mauvais cheval>145246';1;0;'mauvais cheval>cheval'
e;48304;'échecs';1;712
e;243571;'happelourde>145246';1;50;'happelourde>cheval'
e;322595;'emballé>145246';1;50;'emballé>cheval'
e;62735;'assiette';1;1602
e;58356;'box';1;182
e;50867;'cabrer';1;52
e;45177;'trotter';1;182
e;37561;'caparaçonner';1;52
e;258404;'appuyer>83824';1;50;'appuyer>équitation'
e;246239;'piscine>83824';1;50;'piscine>équitation'
e;219309;'barde>83824';1;50;'barde>équitation'
e;116466;'café au lait';1;132
e;16033;'cuisine';1;10514
e;2371251;'porteur>145246';1;0;'porteur>cheval'
e;2431458;'roussin de la Hague';1;0
e;3223326;'voltige>83824';1;0;'voltige>équitation'
e;3301171;'traquenard>83824';1;0;'traquenard>équitation'
e;2490644;'qualiteux';1;0
e;2507294;'point to point';1;0
e;2523383;'se défendre des lèvres';1;0
e;2533101;'oeillères australiennes';1;0
e;1925639;'horseball';1;0
e;55866;'déjuger';1;60
e;4529;'châtier';1;96
e;85682;'montoir';1;50
e;241139;'équin>102206';1;50;'équin>médecine'
e;105331;'enrênement';1;50
e;116198;'demi-volte';1;50
e;133639;'gourmette';1;112
e;65049;'cabriole';1;52
e;111649;'charbon';1;540
e;22764;'acculer';1;56
e;32408;'vertical';1;74
e;46724;'licou';1;58
e;79420;'driver';1;52
e;119690;'débourrement';1;50
e;2363112;'branche hardie';1;0
e;59659;'sous la main';1;50
e;2358575;'course de plat';1;0
e;172574;'appel de la langue';1;50
e;273261;'randonnée équestre';777;50
e;2374516;'course de trot monté';1;0
e;2396628;'sport à cheval';1;0
e;2426273;'tenir la main';1;0
e;2433646;'cheval à sang chaud';1;0
e;3306264;'pion>83824';1;0;'pion>équitation'
e;273348;'Terre à terre';777;50
e;214275;'cuisine>143757';1;1650;'cuisine>art culinaire'
e;261312;'steack de cheval';1;16
e;67365;'avertir';1;356
e;3299497;'748';1;0
e;2087603;'watts';2;0
e;6424425;'espèces équines';1;0
e;6685207;'cheval>1816';1;0;'cheval>héraldique'
e;143607;'nature';1;1534
e;95009;'brouter';1;116
e;139827;'carne';1;82
e;135190;'lieu';1;1448
e;210227;'animal d'élevage';1;54
e;107477;'nez';1;2539
e;9849;'pégase';1;52
e;219240;'cavalier>83824';1;14;'cavalier>équitation'
e;7589;'femelle';1;654
e;60361;'loisirs';1;304
e;171067;'à califourchon';1;2
e;2550137;'temps de galop';1;0
e;16167;'enterrer';1;706
e;265633;'animal terrestre';1;2
e;225916;'personne>24956';1;574;'personne>être humain'
e;116477;'personne';1;9826
e;24956;'être humain';1;738
e;244620;'être humain>74860';1;102;'être humain>homme'
e;115393;'scandale';1;368
e;1816;'héraldique';1;80
e;6947336;'=horse=';1;0
e;139352;'beauté';1;1128
e;261625;'Findus';1;16
e;50776;'paddock';1;66
e;74743;'lasagne';1;66
e;110223;'queue-de-cheval';1;50
e;250395;'cavalière>83824';1;6;'cavalière>équitation'
e;270876;'petit cheval';1;50
e;245172;'cheval de Przewalski';1;18
e;253153;'bidet>145246';1;52;'bidet>cheval'
e;56005;'rossinante';1;60
e;100188;'aubère';1;50
e;237445;'être>68439';1;28;'être>individu'
e;396522;'cheval du delta du Danube';1;50
e;396513;'cheval marron';777;50
e;396520;'cheval de Namibie';1;50
e;437800;'mammifère herbivore';1;50
e;43729;'médecine vétérinaire';1;64
e;388132;'à califourchon sur';1;50
e;2559437;'passège';1;0
e;1664797;'aller à courbette';1;0
e;118839;'turf';1;54
e;262905;'chevaucher>93073';1;50;'chevaucher>aller à cheval'
e;154184;'cheval vapeur';1;52
e;396512;'cheval sauvage';1;4
e;237617;'à cheval>32505';1;50;'à cheval>pointilleux'
e;52099;'hipposandale';1;50
e;32851;'mammifères';1;144
e;234453;'monter à cheval';1;14
e;220061;'étalon>25626';1;58;'étalon>reproducteur'
e;153026;'cheval de bois';1;56
e;142086;'jambe';1;3142
e;161656;'grand cheval';1;52
e;266173;'pouliche>6070';1;60;'pouliche>jument'
e;215439;'bombe>215438';1;4;'bombe>casque d'équitation'
e;290585;'cheval de Prjevalski';777;50
e;180116;'véhicule hippomobile';1;12
e;16644;'astronomie';1;1402
e;3674;'botanique';1;1700
e;140949;'équidés';1;60
e;2949884;'répondre>83824';1;0;'répondre>équitation'
e;1690547;'cavale>6070';1;0;'cavale>jument'
e;2392633;'embouchement';1;0
e;140573;'s'enterrer';1;50
e;53095;'courbette';1;58
e;37963;'débourrer';1;52
e;1664818;'aller par haut';1;0
e;273168;'Equus ferus caballus';777;50
e;115751;'unicorne';1;52
e;241138;'équin>145246';1;50;'équin>cheval'
e;260820;'entité vivante';1;64
e;64437;'boucherie';1;962
e;113902;'alimentation';1;1302
e;4327573;'puissance mécanique';1;0
e;145556;'jeu d'échecs';1;194
e;214455;'fer>102447';1;54;'fer>fer-à-cheval'
e;152778;'moyen de transport';1;428
e;9397;'ars';1;50
e;153433;'cheval de course';1;70
e;330438;'rosse>145246';1;50;'rosse>cheval'
e;1499;'hippique';1;68
e;343550;'cheval hollandais';1;50
e;13712;'transport';1;1562
e;95706;'automobile';1;2280
e;156371;'mamifère';1;50
e;63192;'transports';1;228
e;240049;'isabelle>145246';1;50;'isabelle>cheval'
e;228897;'viande bovine';1;98
e;191706;'course hippique';1;4
e;60902;'dent';1;3318
e;152432;'steack';1;154
e;122787;'solipède';1;52
e;216643;'cheval>17559';1;244;'cheval>animal'
e;2571331;'CCE';1;0
e;220013;'femme>4333487';1;468;'femme>être humain de sexe féminin'
e;155779;'véhicules';1;72
e;139303;'drogue';1;1562
e;112511;'quadrupède';1;380
e;49200;'cheval-vapeur';1;52
e;343521;'cheval arabe';1;50
e;95245;'fille';1;5694
e;61490;'femme';1;29472
e;112773;'pur-sang';1;68
e;136775;'cheval de Troie';1;128
e;343549;'cheval gai';1;50
e;343544;'cheval de tirage';1;50
e;291460;'cheval de la Caspienne';777;50
e;42188;'filet';1;642
e;252222;'alezan>145246';1;50;'alezan>cheval'
e;159734;'viande de cheval';1;128
e;162733;'boucherie chevaline';1;138
e;267584;'::>66:145246>17:70853';8;50;'cheval [carac] cabré'
e;256965;'cheval de halage';1;4
e;34960;'shetland';1;74
e;112441;'landais';1;52
e;176638;'animal de trait';1;22
e;143669;'vertébrés';1;80
e;189880;'pièce d'échecs';1;64
e;153936;'viande rouge';1;296
e;50346;'hippisme';1;81
e;3314;'bombe';1;1140
e;21480;'palomino';1;52
e;38916;'pottok';1;52
e;145513;'quarté';1;54
e;142978;'Pégase';1;56
e;108082;'lusitanien';1;160
e;395076;'carcan>311963';1;50;'carcan>mauvais cheval'
e;343551;'cheval irlandais';1;50
e;259852;'cheval pie';1;52
e;122139;'naseau';1;122
e;74625;'hippophagie';1;102
e;36294;'herbivore';1;200
e;28277;'Equus';1;50
e;12960;'haflinger';1;50
e;40461;'breton';1;330
e;116045;'bidet';1;126
e;261738;'viande>20965';1;148;'viande>nourriture'
e;35762;'saut';1;460
e;33645;'obstacle';1;300
e;106558;'laideron';1;64
e;86640;'vertébré';1;840
e;96222;'ardennais';1;50
e;391075;'shetland>145246';1;50;'shetland>cheval'
e;268332;'bucéphale';1;4
e;114815;'protéine';1;324
e;34085;'courses';1;192
e;248081;'chordé';1;222
e;64473;'Bucéphale';1;68
e;134084;'mustang';1;52
e;148450;'hanovrien';1;50
e;227063;'cheval de selle';1;58
e;343547;'cheval entier';1;50
e;343543;'cheval de race';1;50
e;251159;'viande chevaline';1;72
e;104321;'manège';1;258
e;247920;'obstacles';1;58
e;48656;'selle français';1;50
e;87828;'frison';1;54
e;153541;'pur sang';1;70
e;343540;'cheval de labour';1;50
e;270170;'cheval lourd';1;50
e;416700;'Tinker';1;50
e;113426;'hippodrome';1;80
e;16399;'islandais';1;58
e;21980;'yearling';1;50
e;63238;'comtois';1;50
e;143179;'boulonnais';1;54
e;53696;'fjord';1;64
e;261255;'cheval de corrida';1;50
e;18324;'cavalière';1;190
e;128215;'mors';1;74
e;166206;'troie';1;50
e;239996;'poulain>145246';1;12;'poulain>cheval'
e;140433;'morgan';1;50
e;143401;'barbe';1;1082
e;317285;'anglo-arabe>145246';1;50;'anglo-arabe>cheval'
e;21791;'jockey';1;122
e;121186;'trot';1;114
e;102933;'alezan';1;54
e;153605;'Jolly Jumper';1;158
e;71539;'animaux';1;1378
e;2100;'anglo-arabe';1;52
e;302067;'pur-sang anglais';777;50
e;76247;'vétérinaire';1;552
e;73685;'sports';1;492
e;115304;'deutérostomien';1;110
e;124092;'fer';1;1258
e;58461;'périssodactyle';1;50
e;264880;'bilatérien';1;64
e;181496;'cheval fiscal';1;50
e;264881;'crânié';1;48
e;110773;'amniote';1;78
e;265839;'synapside';1;28
e;89812;'canasson';1;84
e;55766;'chevalin';1;130
e;135631;'crin';1;130
e;142602;'cordé';1;100
e;55823;'métazoaire';1;154
e;225847;'organisme>71624';1;64;'organisme>être vivant'
e;234036;'être vivant>123933';1;248;'être vivant>entité'
e;317929;'olfactorien';1;32
e;264908;'eumétazoaire';1;58
e;91794;'tétrapode';1;88
e;265277;'crâniate';1;52
e;54794;'eucaryote';1;188
e;101018;'gnathostome';1;74
e;325741;'choanobionte';1;70
e;325738;'filozoaire';1;62
e;56413;'gymnastique';1;282
e;233133;'animal>117095';1;646;'animal>zoologie'
e;325736;'holozoaire';1;54
e;85095;'chevaucher';1;128
e;325731;'opisthoconte';1;68
e;140100;'viande';1;4436
e;153027;'à cheval';1;74
e;325728;'uniconte';1;38
e;218873;'monture>17559';1;4;'monture>animal'
e;265220;'épineurien';1;20
e;69492;'galop';1;98
e;109426;'galoper';1;172
e;28652;'étrier';1;94
e;4026;'tiercé';1;148
e;14227;'dressage';1;96
e;104460;'chevaux';1;262
e;89801;'poney';1;218
e;113767;'monter';1;1154
e;88493;'fumier';1;300
e;94958;'poulain';1;252
e;144846;'tête';1;5442
e;77008;'yeux';1;4012
e;63235;'mammifère';1;3541
e;8990;'patte';1;1758
e;26806;'monture';1;216
e;38295;'équidé';1;280
e;123350;'sabot';1;418
e;32211;'étalon';1;210
e;61393;'chevalier';1;898
e;97335;'écurie';1;436
e;34872;'dada';1;154
e;95256;'queue';1;2446
e;17559;'animal';1;13291
e;106252;'crinière';1;518
e;130808;'course';1;2079
e;83824;'équitation';1;448
e;6070;'jument';1;482
e;146071;'selle';1;684
e;141471;'cavalier';1;858
e;239128;'_COM';36;50
e;4327574;'cheval>4327573';1;0;'cheval>puissance mécanique'
e;2948624;'cheval>139303';1;0;'cheval>drogue'
e;216646;'cheval>106558';1;50;'cheval>laideron'
e;2948625;'cheval>181496';1;0;'cheval>cheval fiscal'
e;216645;'cheval>140100';1;48;'cheval>viande'
e;2948626;'cheval>56413';1;0;'cheval>gymnastique'
e;2586627;'Gender:Mas';4;0
e;2586629;'Number:Sing';4;0
e;146885;'Nom:Mas+SG';4;50
e;171870;'Nom:';4;50
e;1642;'gaye';1;50
e;115423;'mileur';1;50
e;141168;'domestique';1;486
e;64227;'anomalie';1;126
e;396146;'thérapside';1;54
e;157284;'lieu>68467';1;56;'lieu>poisson'
e;34933;'moyen';1;350
e;213700;'fromage>114637';1;506;'fromage>aliment'
e;157007;'être>146885';1;50;'être>Nom:Mas+SG'
e;13369;'être';1;806
e;4874313;'femme>24956';1;4;'femme>être humain'
e;89723;'unité administrative';1;50
e;228898;'animal de ferme';1;16
e;2464206;'quadripède';1;0
e;6693947;'appareil gymnique';1;0
e;87789;'coelomate';1;50
e;391009;'célomate';1;50
e;391010;'coelomé';1;50
e;6912626;'=domestic animal=';1;0
e;316850;'entité physique';1;50
e;30321;'figure';1;662
e;267642;'organisme animal';1;4
e;96851;'pièce';1;3056
e;396042;'tétrapode>86640';1;50;'tétrapode>vertébré'
e;396149;'cynodonte';1;62
e;436570;'entité biologique';1;50
e;3378472;'animal mâle';1;0
e;106265;'appareil';1;1008
e;220062;'étalon>52255';1;50;'étalon>arbre'
e;172709;'cheval de frise';1;50
e;105872;'éléphant';1;840
e;312989;'Lou Drapé';777;50
e;10754437;'each uisge';777;0
e;10754438;'each uisce';777;0
e;10754439;'aughisky';777;0
e;10754491;'Sivko-Bourko';777;0
e;10754492;'Sivka-Bourka';777;0
e;11237038;'cheval de Heck';777;0
e;11303345;'cheval crétois';777;0
e;11130574;'cheval durant les guerres napoléoniennes';777;0
e;11155854;'Atout d'Isigny';777;0
e;11156372;'Jerich Parzival';777;0
e;11156425;'Itot du Château';777;0
e;11156426;'Palloubet d'Halong';777;0
e;11071648;'cheval de Corlay';777;0
e;139369;'Arion';1;50
e;11080545;'Areion';777;0
e;3298565;'Oligo';777;0
e;280981;'pottock';777;50
e;1995733;'badinant';2;0
e;2424911;'roncin';1;0
e;2453083;'kabardin';1;0
e;2493018;'quiledin';1;0
e;89605;'limonier';1;50
e;29911;'galopeur';1;50
e;2941277;'Cheval normand';777;0
e;235208;'cheval de bataille>96738';1;50;'cheval de bataille>argument'
e;2451914;'cheval turkmène';1;4
e;2472567;'cheval sauvage du Gobi';1;0
e;5944914;'cheval gris du Comte de Veldenz';777;0
e;8472346;'=morgan=';1;0
e;89934;'bricolier';1;50
e;1948815;'trojan';1;50
e;98590;'housser';1;50
e;145179;'hunter';1;50
e;76248;'camionneur';1;86
e;3298000;'cheval marin>648';1;0;'cheval marin>morse'
e;3298001;'cheval marin>57125';1;0;'cheval marin>animal fabuleux'
e;223693;'hippocampe>32303';1;50;'hippocampe>mythologie'
e;2453032;'cheval à vapeur';1;0
e;2464147;'cheval appaloosa';1;0
e;2463738;'cheval à toutes mains';1;0
e;2473045;'cheval souffleur';1;0
e;3420977;'cheval de main>171870';1;0;'cheval de main>Nom:'
e;3420978;'cheval de main>146889';1;0;'cheval de main>Adv:'
e;2598931;'cheval proche du sang';777;0
e;2602446;'cheval de mérens';777;0
e;7298;'siffleur';1;64
e;124820;'ambleur';1;50
e;83373;'brancardier';1;84
e;40080;'tocard';1;66
e;195915;'améliorateur';1;50
e;286138;'Gigolo FRH';777;50
e;4805;'catogan';1;52
e;126044;'chevillier';1;50
e;75482;'cheviller';1;52
e;9838;'carrossier';1;62
e;1792640;'placé>4026';1;0;'placé>tiercé'
e;3698900;'cheval de cirque';1;0
e;2571258;'australian kelpie';1;0
e;67093;'collier';1;612
e;2523188;'embleur';1;0
e;146916;'cadogan';1;50
e;143076;'placé';1;86
e;2508002;'kelpie';1;0
e;197531;'cheval de saut';1;50
e;23653;'berrichon';1;52
e;1745669;'Hans le Malin';1;0
e;5945077;'Uchchaihshravas';777;0
e;5945051;'Cheval de la Giara';777;0
e;412874;'Bonfire';1;50
e;5945025;'Calvaro V';777;0
e;5944953;'Pluto Calcedona';777;0
e;4277113;'Deister';1;0
e;5944921;'Rochet M';777;0
e;5944894;'cheval de Riwoché';777;0
e;5944878;'Roan Barbary';777;0
e;5944852;'Morvark';777;0
e;5944807;'Lièvre Rouge';777;0
e;5944711;'Salinero';777;0
e;5944705;'Galoubet A';777;0
e;5944670;'Galan de Sauvagère';777;0
e;5944663;'Shabdiz';777;0
e;5945446;'Rakhsh';777;0
e;5945445;'Princesse d'Anjou';777;0
e;5945440;'Ready Cash';777;0
e;5945438;'Hadol du Vivier';777;0
e;5945436;'Tzimin-Chac';777;0
e;5945359;'bäckahäst';777;0
e;5945393;'bækhesten';777;0
e;5945323;'Jorky';777;0
e;5945286;'cheval de Ferghana';777;0
e;5945256;'cheval de fiction';777;0
e;5945231;'cheval baroque';777;0
e;5945502;'rhénan sang froid';777;0
e;5944922;'Rochet Rouge';777;0
e;5944727;'Flying Fox';777;0
e;5945362;'bäckahästen';777;0
e;5680737;'Trigger';1;0
e;5944919;'Hildago de l'Île';777;0
e;5944715;'Maharajah';777;0
e;5945344;'Tchal-Kouyrouk';777;0
e;269629;'aquilain';1;50
e;5945322;'Cheval sauvage';777;0
e;5808419;'cheval des montagnes du Pays basque';777;0
e;5945455;'cheval chez les peuples celtes';777;0
e;5945450;'cheval noir bâtisseur';777;0
e;5945433;'cheval limousin';777;0
e;5945426;'cheval du Morvan';777;0
e;5945232;'cheval au Moyen Âge';777;0
e;5945224;'cheval de Catria';777;0
e;5945158;'cheval de sport américain';777;0
e;5945103;'cheval sans papiers';777;0
e;5945017;'cheval des Marquises';777;0
e;5944835;'cheval Barraquand';777;0
e;5945145;'cheval du vent';777;0
e;5945138;'cheval crème';777;0
e;5944958;'cheval de selle américain';777;0
e;5944742;'cheval castillonnais';777;0
e;5945506;'cheval de Schwytz';777;0
e;5945448;'cheval miniature américain';777;0
e;5945431;'cheval guide d'aveugle';777;0
e;5945113;'cheval chilien';777;0
e;5945090;'cheval de sport brésilien';777;0
e;5945059;'cheval d'Auvergne';777;0
e;5944979;'cheval du Don';777;0
e;5944611;'cheval de la baie de Somme';777;0
e;5945410;'cheval circassien';777;0
e;5945400;'cheval de Nangchen';777;0
e;5945325;'cheval dans la guerre';777;0
e;5945291;'cheval de Hesse';777;0
e;5945287;'cheval finnois';777;0
e;5945271;'cheval de l'île de Marajo';777;0
e;5945241;'cheval dans l'Antiquité';777;0
e;5945200;'cheval de Ban'ei';777;0
e;5945160;'cheval de sport belge';777;0
e;5945137;'cheval dalécarlien';777;0
e;5945136;'cheval de Dalécarlie';777;0
e;5945116;'cheval Pampa';777;0
e;5945037;'cheval de Rochefort';777;0
e;5944948;'cheval de cauchemar';777;0
e;5944898;'cheval bâton';777;0
e;5944775;'cheval bourguignon';777;0
e;5808414;'cheval Burguete';777;0
e;5808394;'cheval navarrais';777;0
e;5808048;'cheval iakoute';777;0
e;5945268;'cheval sauvage de Romeira';777;0
e;5945055;'cheval péruvien';777;0
e;5945032;'cheval de Bresse';777;0
e;5944836;'cheval du Vercors';777;0
e;5944774;'cheval charolais';777;0
e;5944743;'cheval de Castillon';777;0
e;6424917;'cheval trotteur américain';1;0
e;6430418;'cheval shire';1;0
e;5945432;'cheval au XVIe siècle';777;0
e;5945421;'cheval navarrin';777;0
e;5945308;'cheval dans les mines';777;0
e;5944950;'cheval Napolitain';777;0
e;5837004;'cheval canadien';777;0
e;5562872;'cheval de sang belge';777;0
e;111528;'gail';1;50
e;2361818;'mallier';1;0
e;2376978;'fingard';1;0
e;2409114;'champonnier';1;0
e;151009;'tiqueur';1;50
e;6397463;'cheval belge';1;0
e;9105416;'=belgian horse=';1;0
e;407150;'Miyako';1;50
e;8772529;'=norfolk=';1;0
e;10325515;'camionneur>152622';1;0;'camionneur>cheval de trait'
e;10314460;'Gullfaxi';777;0
e;10456934;'Aralusian';777;0
e;10546893;'cheval colonial espagnol';777;0
e;10546897;'genet d'Espagne';777;0
e;10546877;'Drum Horse';777;0
e;3297999;'cheval marin>59638';1;0;'cheval marin>hippocampe'
e;59638;'hippocampe';1;64
e;2339340;'cheval en bois';1;0
e;214339;'robe>120949';1;66;'robe>vêtement'
e;215896;'aile>117095>140176';1;80;'aile>zoologie>oiseau'
e;214518;'tronc>112609';1;2;'tronc>anatomie'
e;277403;'chin';777;50
e;74082;'nageoire';1;312
e;115352;'griffe';1;1032
e;217417;'défense>60902';1;22;'défense>dent'
e;147138;'cornes';1;122
e;215135;'griffe>141705';1;50;'griffe>ongle'
e;215534;'cellule>35143';1;100;'cellule>biologie'
e;86296;'lait';1;3344
e;155320;'leg';1;56
e;7548;'col';1;686
e;39149;'cuir';1;824
e;136630;'paupière';1;174
e;390958;'patte arrière';1;50
e;421273;'mord';1;50
e;152290;'machoire';1;218
e;34503;'pénis';1;972
e;27120;'train';1;3188
e;227867;'mâchoire inférieure';1;50
e;67957;'lèvre';1;444
e;62706;'doigt';1;2694
e;105675;'antérieur';1;156
e;56636;'postérieur';1;182
e;20414;'frange';1;66
e;75069;'incisive';1;1254
e;155377;'incisives';1;84
e;134670;'fourchette';1;1458
e;2488318;'garo';1;0
e;155941;'genoux';1;106
e;126886;'panse';1;88
e;156123;'cuisses';1;134
e;48225;'échine';1;64
e;153999;'narines';1;94
e;144104;'couronne';1;1072
e;109348;'groin';1;132
e;56362;'gras';1;1844
e;57895;'grain';1;652
e;9014;'patin';1;158
e;2394252;'paton';1;0
e;124071;'graisse';1;769
e;2447617;'graal';1;2
e;23178;'grand';1;2098
e;9122;'flan';1;98
e;41417;'coup';1;1266
e;48881;'couilles';1;104
e;141949;'côte';1;374
e;140644;'coude';1;384
e;163022;'chataigne';1;60
e;40826;'arrière-train';1;100
e;133921;'dentition';1;386
e;64313;'abdomen';1;448
e;61835;'chair';1;380
e;68277;'avant-bras';1;230
e;112560;'torse';1;192
e;569188;'corp';777;50
e;271596;'intestine';1;50
e;72657;'reins';1;122
e;27826;'arrière';1;216
e;6800176;'=heart=';1;0
e;152803;'pate';1;52
e;145569;'gorge';1;396
e;298613;'flancs';777;50
e;152747;'pates';1;82
e;6842217;'=intestine=';1;0
e;6807211;'=lung=';1;0
e;77810;'tchin tchin';1;50
e;69764;'tchin';1;54
e;405965;'hair';1;54
e;7298996;'=chin=';1;0
e;52075;'crins';1;62
e;77727;'gueule';1;650
e;3723;'épaule';1;334
e;125807;'bite';1;536
e;126687;'fesse';1;428
e;6840985;'=mentum=';1;0
e;6912949;'=hair=';1;0
e;9023410;'=teeth=';1;0
e;6797233;'=vertebra=';1;0
e;5984733;'teeth';777;2
e;10844654;'matrice utérine';1;0
e;6880460;'=muscle=';1;0
e;141814;'vertèbre';1;310
e;51126;'cheveux';1;2796
e;6799188;'=leg=';1;0
e;214602;'queue>214624';1;56;'queue>queue d'animal'
e;13197;'légion';1;206
e;83208;'cirque';1;1468
e;47541;'carrosse';1;116
e;218381;'diligence>123745';1;8;'diligence>véhicule'
e;104337;'corbillard';1;86
e;32774;'Équidés';1;50
e;10821931;'Fer-à-cheval';1;0
e;10876453;'finale féminine au saut de cheval';777;0
e;10986107;'régiment de chasseurs à cheval';1;0
e;5685424;'queue du cheval';777;0
e;10592326;'Comme un cheval fou';777;0
e;10587053;'L'Amour à cheval';777;0
e;10914838;'Fédération nationale du cheval';777;0
e;2371093;'étripe-cheval';1;0
e;2400855;'cheval-garou';1;0
e;2403032;'trompe-cheval';1;0
e;2419913;'passe-cheval';1;0
e;3867566;'dent-de-cheval';1;0
e;5808447;'abattage du cheval';777;0
e;6425549;'lésion traumatique de la queue de cheval sans lésion vertébrale';1;0
e;9958649;'1er régiment de chasseurs à cheval';777;0
e;11029976;'technique de la conduite du cheval';1;0
e;5680178;'dos du cheval';777;0
e;5680157;'dentition du cheval';777;0
e;6439041;'maladie de l'herbe du cheval';1;0
e;9980420;'se trouver sous les sabots d'un cheval';1;0
e;9980419;'se trouver sous le pas d'un cheval';1;0
e;9980418;'se trouver pas sous le sabot d'un cheval';1;0
e;10583654;'grotte du cheval';777;0
e;10902436;'dresser un cheval';1;0
e;10992069;'circulation à cheval';777;0
e;5631672;'fraude à la viande de cheval de 2013';777;0
e;5680253;'race de petit cheval de trait';1;0
e;5680252;'race de petit cheval';1;0
e;5679155;'éthique du cheval';777;0
e;5830401;'Skelid. Chez le cheval';777;0
e;5828832;'Donald et le cheval';777;0
e;5837539;'domestication du cheval';777;0
e;5911243;'crottin de cheval';777;0
e;10961323;'avoir cheval';1;0
e;11071831;'reproduction du cheval';777;0
e;1837929;'lipome de la queue de cheval';1;0
e;4001151;'cheval-jupon';1;0
e;10850912;'carabiniers à cheval';777;0
e;10850888;'régiments de chasseurs à cheval';777;0
e;5518185;'cheval-bâton';1;0
e;5921584;'harnachement du cheval';777;0
e;5944260;'le cheval venu de la mer';777;0
e;10851021;'31e régiment de chasseurs à cheval';777;0
e;10851020;'30e régiment de chasseurs à cheval';777;0
e;10851019;'29e régiment de chasseurs à cheval';777;0
e;10851018;'28e régiment de chasseurs à cheval';777;0
e;10851011;'23e régiment de chasseurs à cheval';777;0
e;10851009;'22e régiment de chasseurs à cheval';777;0
e;10851007;'21e régiment de chasseurs à cheval';777;0
e;10851003;'19e régiment de chasseurs à cheval';777;0
e;10851000;'18e régiment de chasseurs à cheval';777;0
e;10850996;'15e régiment de chasseurs à cheval';777;0
e;10850993;'14e régiment de chasseurs à cheval';777;0
e;10850990;'13e régiment de chasseurs à cheval';777;0
e;10850987;'12e régiment de chasseurs à cheval';777;0
e;10850985;'10e régiment de chasseurs à cheval';777;0
e;10850983;'9e régiment de chasseurs à cheval';777;0
e;10850980;'8e régiment de chasseurs à cheval';777;0
e;10850977;'7e régiment de chasseurs à cheval';777;0
e;10850963;'régiments français de chasseurs à cheval';777;0
e;5945132;'type de cheval';777;0
e;5967682;'franc à cheval';777;0
e;6429731;'maladies du cheval';1;0
e;6425804;'tumeur métastatique de la queue de cheval';1;0
e;10328231;'L'Affaire du cheval sans tête';777;0
e;10828119;'moustache en fer à cheval';777;0
e;10851016;'27e régiment de chasseurs à cheval';777;0
e;10851015;'26e régiment de chasseurs à cheval';777;0
e;10851013;'25e régiment de chasseurs à cheval';777;0
e;10851012;'24e régiment de chasseurs à cheval';777;0
e;10851005;'20e régiment de chasseurs à cheval';777;0
e;10850967;'4e régiment de chasseurs à cheval';777;0
e;2392785;'passer à cheval';1;0
e;5685655;'système respiratoire du cheval';777;0
e;5807913;'race de cheval de trait';1;0
e;5944608;'Le cheval Bayard';777;0
e;6442755;'section de l'isthme du rein en fer à cheval';1;0
e;6430405;'fracture ouverte du sacrum et du coccyx avec lésion traumatique précisée de la queue de cheval';1;0
e;5713069;'fer à cheval doré';777;0
e;5808441;'race de cheval lourd';1;0
e;6443811;'virus de l'artérite virale du cheval';1;0
e;10060999;'Trois hommes sur un cheval';777;0
e;10060993;'Un cheval pour deux';777;0
e;11100846;'se faire une queue de cheval';1;0
e;2444806;'changer de cheval au milieu du gué';1;0
e;5945211;'petit cheval du Guangxi';777;0
e;5945091;'Le cheval du Cap';777;0
e;10189119;'À cheval !';777;0
e;10421551;'liste des médaillées de l'épreuve de saut de cheval aux championnats d'Europe de gymnastique artistique';777;0
e;10777708;'race de cheval de selle';1;0
e;2378792;'pied de cheval';1;0
e;5945246;'le rôle du cheval';777;0
e;5855689;'orbite en fer à cheval';777;0
e;2403416;'mords-cheval';1;0
e;5944984;'robe blanche du cheval';777;0
e;6424720;'tumeur maligne de la queue de cheval';1;0
e;10094138;'Elle descend de la montagne à cheval';777;0
e;10099970;'Plumes de cheval';777;0
e;10095996;'La Taverne du cheval rouge';777;0
e;2427104;'à méchant cheval bon éperon';1;0
e;5944550;'armes à cheval';777;0
e;10184955;'Le Fer à cheval';777;0
e;10456917;'masse corporelle du cheval';777;0
e;2427939;'un cheval boit la bride';1;0
e;2431240;'miser sur le bon cheval';1;0
e;5945449;'le cheval';777;0
e;10138348;'De la bouche du cheval';777;0
e;5945079;'La Chute de cheval';777;0
e;10431827;'2e régiment de chasseurs à cheval';777;0
e;10431822;'5e régiment de chasseurs à cheval';777;0
e;5944952;'symbolique du cheval';777;0
e;10433096;'3e régiment de chasseurs à cheval';777;0
e;10431825;'11e régiment de chasseurs à cheval';777;0
e;6003750;'Un cheval dans la salle de bains';777;0
e;6447970;'synovite chronique de l'articulation tibio-tarsienne du cheval';1;0
e;5945327;'historien du cheval';777;0
e;5944797;'cheval de la Forêt-Noire';777;0
e;2364812;'en parler à son cheval';1;0
e;8758285;'chevaucher un cheval';1;0
e;9453499;'races chez le cheval';777;0
e;9465731;'viande de cheval hachée';1;0
e;9491564;'bifteck de cheval';1;0
e;9695729;'bruit du cheval qui galope';1;0
e;9747390;'cheval de Miquelon';777;0
e;11121990;'oeil de cheval';777;0
e;11125307;'liste les records des sports équestres et du monde du cheval';777;0
e;1781321;'dresseur de cheval';1;0
e;2489546;'tourisme à cheval';1;0
e;3369941;'steak de cheval au paprika';1;0
e;462961;'rein en fer en cheval';1;50
e;566198;'antilope cheval';777;50
e;579374;'mouche à cheval';777;0
e;4345198;'À cheval';777;0
e;3245861;'robe grise du cheval';777;0
e;3727915;'seller un cheval';1;0
e;1804189;'médecine de cheval';1;0
e;1899598;'combat à cheval';1;0
e;2581303;'c'est la mort du petit cheval';1;0
e;2811420;'réforme du cheval';777;0
e;3319355;'maïs dent de cheval';1;0
e;3364389;'médaillons de cheval';1;0
e;1472832;'robe palomino du cheval';1;0
e;2581166;'cheval anglo-arabe';1;0
e;2590782;'ne pas se trouver sous les sabots d'un cheval';1;0
e;395068;'Le cheval de Saint-Nicolas';1;50
e;1763340;'santé du cheval';1;0
e;2605889;'à cheval donné, on ne regarde pas la bride';1;0
e;5389137;'bottes de cheval';1;0
e;39835;'monter sur ses grands chevaux';1;52
e;1803230;'race de cheval';1;0
e;1822088;'tumeur de la queue de cheval';1;0
e;2558824;'à cheval donné on ne regarde pas les dents';1;0
e;2530138;'dose de cheval';1;4
e;2507531;'à cheval donné on ne regarde pas la denture';1;0
e;2411359;'cheval demi-sang';1;0
e;2606116;'il n'y a si bon cheval qui ne bronche';1;0
e;1561998;'mettre un cheval à l'amble';1;0
e;1739202;'rein en fer à cheval';1;0
e;1899868;'poumon en fer à cheval';1;0
e;2523177;'cheval-heure';1;0
e;3322576;'cheval carrossier';1;0
e;3369942;'steak de cheval aux épices';1;0
e;1814534;'élevage du cheval en France';1;0
e;1934470;'robes du cheval';1;0
e;2244291;'pieds-de-cheval';2;0
e;2580096;'monter un cheval';1;0
e;3245862;'grisonnement du cheval';777;0
e;462939;'fibrolipome de la queue de cheval';1;50
e;1730183;'ne pas se trouver pas sous le sabot d'un cheval';1;0
e;1732010;'ce n'est pas la mort du petit cheval';1;0
e;2953687;'Queue de cheval';777;0
e;1814532;'élevage du cheval en Italie';1;0
e;1890150;'habronémose du cheval';1;0
e;1849002;'aorte à cheval';1;0
e;2075351;'queues-de-cheval';2;0
e;1814533;'élevage du cheval en Hongrie';1;0
e;1920478;'anatomie du cheval';1;0
e;378289;'sabot de cheval';1;50
e;345195;'crinière de cheval';1;50
e;344872;'courrier à cheval';1;50
e;341643;'carcasse de cheval';1;50
e;378780;'saut de cheval';1;50
e;380407;'sortie de cheval d'arçon';1;50
e;358051;'houe à cheval';1;50
e;357786;'hippobosque du cheval';1;50
e;345606;'cuisse de cheval';1;50
e;339723;'botte de cheval';1;50
e;333149;'accident de cheval';1;50
e;388157;'à cheval sur';1;50
e;342965;'charcuterie de cheval';1;50
e;339843;'bouillon de cheval';1;50
e;337295;'au cheval d'arçon';1;50
e;388158;'à cheval sur l'étiquette';1;50
e;369282;'patte de cheval';1;50
e;368277;'pantalon de cheval';1;50
e;353889;'fiacre à cheval';1;50
e;352547;'estafette à cheval';1;50
e;347008;'dent de cheval';1;50
e;384490;'traitement de cheval';1;50
e;341572;'carabinier à cheval';1;50
e;390512;'étude de cheval';1;50
e;384785;'travail de cheval';1;50
e;357925;'homme de cheval';1;50
e;347928;'divinité anthropomorphe à tête de cheval';1;50
e;336188;'archer à cheval';1;50
e;378746;'saucisson de cheval';1;50
e;216334;'cheval-fondu';1;50
e;174350;'tête-de-cheval';1;50
e;149673;'pied-de-cheval';1;50
e;146086;'cheval-d'arçons';1;50
e;317124;'cuir de cheval';1;50
e;195400;'à étripe-cheval';1;50
e;220121;'La mort du petit cheval';1;88
e;224323;'syndrome de la queue de cheval';1;50
e;237619;'à dos de cheval';1;50
e;208584;'sur cheval';1;50
e;211349;'ne pas se trouver sous le pas d'un cheval';1;50
e;218227;'robe de cheval';1;32
e;219651;'cheval de bois>117579';1;6;'cheval de bois>jouet'
e;219652;'cheval de bois>87925';1;2;'cheval de bois>aviation'
e;219653;'cheval de bois>7197';1;2;'cheval de bois>tréteau'
e;222438;'fumier de cheval';1;58
e;230457;'chasseur à cheval';1;50
e;245518;'voiture à cheval';1;80
e;251390;'oeuf à cheval';1;50
e;251442;'veste de cheval';1;4
e;260800;'chanter comme un cheval de cirque';1;50
e;261300;'monté comme un cheval';1;50
e;26488;'en fer à cheval';1;50
e;29451;'Le Champ de course ou la Mort sur un cheval pâle';1;50
e;47818;'la Mort du petit cheval';1;50
e;83873;'grand rhinolophe fer à cheval';1;50
e;93073;'aller à cheval';1;76
e;156282;'de cheval';1;50
e;265509;'La Mort du petit cheval';1;50
e;268965;'tête de cheval';1;50
e;40827;'Pourquoi as-tu laissé le cheval à sa solitude';1;50
e;54365;'Tête de cheval';1;50
e;74518;'À cheval vers la mer';1;50
e;75220;'femme de cheval';1;50
e;136888;'L'Auberge du cheval blanc';1;50
e;137783;'c'est son cheval de bataille';1;50
e;140244;'Traité de l'art de combattre à cheval et des machines de guerre';1;50
e;142654;'Traité sur l'art de lancer le javelot à cheval';1;50
e;155834;'selle de cheval';1;120
e;177304;'steak à cheval';1;50
e;180579;'petit fer à cheval';1;50
e;180580;'grand fer à cheval';1;2
e;183418;'œuf à cheval';1;50
e;184050;'remède de cheval';1;4
e;186030;'être à cheval sur les principes';1;50
e;195361;'à cheval donné, il ne faut point regarder la bouche';1;50
e;264112;'tenue de cheval';1;4
e;264248;'chute de cheval';1;50
e;264686;'retenir un cheval';1;50
e;264851;'balade à cheval';1;50
e;265354;'anges à cheval';1;50
e;268969;'somnifère de cheval';1;50
e;278084;'morphologie du cheval';777;50
e;283100;'escadron des cent-gardes à cheval';777;50
e;286558;'arc en fer à cheval';777;50
e;299451;'marques du cheval';777;50
e;305343;'avoir une fièvre de cheval';1;50
e;306010;'Petit rhinolophe fer à cheval';777;50
e;310534;'Société d'encouragement du cheval français';777;50
e;310535;'Société d'encouragement à l'élevage du cheval français';777;50
e;134102;'troupes à cheval';1;50
e;186517;'miser sur le mauvais cheval';1;50
e;186860;'rompre l'eau à un cheval';1;50
e;187282;'accoutumer un cheval au feu';1;50
e;13036;'À cheval sur la mer';1;50
e;198204;'culotte de cheval';1;52
e;6200;'Officier de chasseurs à cheval de la garde impériale chargeant';1;50
e;311964;'bon cheval';1;50
e;51854;'fièvre de cheval';1;142
e;151567;'_FL:3';6;50
e;157147;'_FL:30';6;50
e;151767;'_FL:17';6;50
e;152842;'_FL:25';6;50
e;195139;'_FL:42';6;50
e;153835;'_FL:32';6;50
e;151550;'_FL:8';6;50
e;151568;'_FL:11';6;50
e;153037;'_FL:26';6;50
e;152836;'_FL:24';6;50
e;151587;'_FL:10';6;50
e;152813;'_FL:28';6;50
e;151663;'_FL:15';6;50
e;152012;'_FL:21';6;50
e;152011;'_FL:20';6;50
e;151576;'_FL:6';6;50
e;152254;'_FL:22';6;50
e;151553;'_FL:0';6;50
e;151522;'_FL:9';6;50
e;225696;'maison>65524';1;134;'maison>bâtiment'
e;20713;'planète';1;2692
e;4920;'savane';1;832
e;146632;'forêt';1;4266
e;243185;'faroueste';1;50
e;64698;'corral';1;54
e;163503;'Far-West';1;56
e;254100;'forêt>254099';1;112;'forêt>terrain planté d'arbres'
e;6890;'voiture';1;10908
e;214276;'cuisine>96851';1;292;'cuisine>pièce'
e;158725;'far west';1;72
e;36026;'Far West';1;92
e;164963;'farwest';1;80
e;249255;'hippodrome de Longchamp';1;50
e;233119;'Meetik';1;50
e;28716;'étable';1;314
e;215637;'van>48289';1;12;'van>camionnette'
e;136786;'ville';1;8650
e;6399;'Mongolie';1;118
e;162417;'centre équestre';1;72
e;144366;'désert';1;1138
e;249912;'champs de course';1;58
e;5955;'parc';1;962
e;131370;'haras';1;86
e;155898;'champ de course';1;64
e;17757;'champ de courses';1;60
e;79444;'campagne';1;2786
e;135974;'prairie';1;220
e;58926;'champs de courses';1;64
e;95605;'champ';1;1974
e;121889;'pré';1;870
e;218224;'pie>140176';1;48;'pie>oiseau'
e;139388;'mobile';1;594
e;596663;'poilu>171869';1;0;'poilu>Adj:'
e;596517;'pie>171869';1;0;'pie>Adj:'
e;600043;'gris>171869';1;0;'gris>Adj:'
e;107689;'poilu';1;238
e;6905240;'=male=';1;0
e;599490;'domestique>171869';1;0;'domestique>Adj:'
e;52265;'superbe';1;176
e;21431;'famélique';1;58
e;63736;'imaginaire';1;250
e;55135;'blonde';1;1306
e;125088;'moche';1;434
e;113963;'mangeable';1;126
e;247812;'non vivant';1;58
e;2506953;'leyte';1;0
e;79847;'khâgneux';1;78
e;586;'fougueux';1;104
e;48900;'rétif';1;56
e;105621;'vivipare';1;64
e;19150;'chaud';1;2126
e;1384;'vivant';1;584
e;237782;'domestique>88269';1;66;'domestique>apprivoisé'
e;222644;'gris>40056';1;44;'gris>couleur'
e;218223;'pie>138092';1;4;'pie>pelage'
e;217380;'blanc>40056';1;170;'blanc>couleur'
e;2673;'bringé';1;50
e;99220;'hétérotrophe';1;62
e;60448;'mâle';1;502
e;37632;'laid';1;410
e;151711;'grande';1;1016
e;136290;'cagneux';1;52
e;107388;'panard';1;54
e;49803;'froid';1;3901
e;44194;'lette';1;50
e;133424;'endotherme';1;50
e;439415;'alezan>40056>171869';1;50;'alezan>couleur>Adj:'
e;2399084;'laitte';1;0
e;36621;'docile';1;108
e;10595;'malade';1;2804
e;18858;'enfermé';1;134
e;28510;'orgueilleux';1;228
e;117828;'difficile';1;708
e;8770544;'=leyte=';1;0
e;224885;'poilu>81436';1;16;'poilu>velu'
e;31046;'têtu';1;170
e;29326;'domestiqué';1;66
e;82844;'comestible';1;244
e;122864;'mort';1;6336
e;54186;'fort';1;1384
e;245092;'fort en bouche';1;50
e;214240;'rapide>114133';1;42;'rapide>rapidité'
e;74183;'doux';1;1578
e;48496;'sauvage';1;686
e;110732;'rapide';1;914
e;330215;'bilatéralement symétrique';1;20
e;162250;'male';1;64
e;106625;'perdu';1;306
e;93245;'gracieux';1;120
e;34629;'fier';1;304
e;81384;'lent';1;458
e;53029;'marqué';1;90
e;132002;'magique';1;370
e;28466;'jeune';1;1502
e;21590;'nain';1;652
e;74582;'racé';1;62
e;47420;'obéissant';1;112
e;132479;'marron';1;664
e;108166;'beau';1;1072
e;107310;'colérique';1;162
e;7781;'blessé';1;512
e;44575;'vieux';1;1969
e;11111;'endiablé';1;50
e;86711;'jaune';1;2570
e;50889;'gris';1;862
e;88096;'gros';1;1570
e;55222;'petit';1;3276
e;15196;'blanc';1;4284
e;3576104;'Morpho:nospace';18;50
e;3575927;'Morpho:min';18;50
e;187275;'Langage:argot';18;50
e;187307;'Langage:péjoratif';18;50
e;91884;'troupeau';1;320
e;238619;'vieille carne';1;2
e;8324;'foetus';1;250
e;48795;'âne';1;752
e;127802;'mulet';1;132
e;317466;'cavalant';1;52
e;20718;'enchevaucher';1;54
e;300177;'chevauchées';777;8
e;9640;'chevalement';1;60
e;163755;'chevauché';1;56
e;60218;'chevauchant';1;62
e;317467;'chevalins';1;58
e;87945;'chevauchement';1;78
e;122460;'chevaliers';1;90
e;10525;'chevalet';1;150
e;127297;'cavalièrement';1;66
e;35060;'cavalcade';1;98
e;267603;'chevalines';1;68
e;79723;'chevalière';1;154
e;57788;'cavaler';1;136
e;121369;'chevaleresque';1;128
e;36548;'rugir';1;312
e;48625;'jeter';1;434
e;206919;'remuer la queue';1;50
e;239950;'mordre>135544';1;34;'mordre>morsure'
e;26193;'sentir';1;1034
e;164136;'::>14:61283>29:130164>13';9;50;'Qui pourrait manger un pain ?'
e;43404;'porter';1;636
e;102610;'éviter';1;128
e;4653;'courir';1;1982
e;326927;'::>14:61283>29:130164';8;50;'manger [objet] pain'
e;16964;'marcher';1;2236
e;49560;'cracher';1;212
e;5435;'ronfler';1;288
e;130164;'manger';1;9612
e;43601;'se reproduire';1;478
e;2442;'vivre';1;2192
e;124600;'mourir';1;1758
e;43253;'dormir';1;5992
e;251694;'mourir>126720';1;156;'mourir>cesser de vivre'
e;259820;'vivre>160251';1;50;'vivre>être en vie'
e;47918;'boire';1;4328
e;124196;'se désunir';1;50
e;115220;'boiter';1;90
e;39576;'se cabrer';1;52
e;224422;'manger>113902>119570';1;196;'manger>alimentation>absorber'
e;135887;'mordiller';1;78
e;64513;'mordre';1;538
e;79364;'sauter';1;970
e;2234;'copuler';1;172
e;139304;'s'accoupler';1;120
e;45338;'se rassembler';1;54
e;33882;'se nourrir';1;370
e;327250;'::>13:145246>29:4653';8;50;'courir [sujet] cheval'
e;91463;'gambader';1;74
e;115385;'détendre';1;124
e;137923;'s'embarrer';1;50
e;2525613;'embler';1;0
e;2692;'se juger';1;50
e;4267;'passager';1;320
e;63831;'taper';1;1306
e;80612;'se méjuger';1;50
e;102035;'pirouetter';1;50
e;110155;'se durcir';1;50
e;7943;'tuer';1;3898
e;135929;'avancer';1;598
e;225252;'marcher>59303';1;54;'marcher>se déplacer'
e;59303;'se déplacer';1;590
e;233198;'boire>86872';1;50;'boire>se désaltérer'
e;140318;'parler';1;3792
e;58135;'chanter';1;1810
e;261646;'s'écraser>76052';1;50;'s'écraser>se soumettre'
e;47803;'subir';1;86
e;20939;'rigoler';1;360
e;5070;'grossir';1;954
e;14385;'jouir';1;502
e;262778;'avoir des gros lolos';1;50
e;6681658;'manger>113902';1;10;'manger>alimentation'
e;239264;'brouter>58913';1;2;'brouter>paître'
e;195889;'allonger le pas';1;50
e;144826;'s'écraser';1;96
e;65362;'ambler';1;50
e;95038;'corner';1;82
e;105961;'ruer';1;78
e;241418;'tirer>92953';1;54;'tirer>traction'
e;109710;'labourer';1;336
e;34284;'brosser';1;300
e;2666;'coucher';1;386
e;329309;'::>16:73888>29:119162';8;50;'battre [avec] fouet'
e;264745;'::>16:73888>29:119162>14';9;50;'Que pourrait-on battre avec un fouet ?'
e;326999;'::>13:74860>29:20537';8;50;'attacher [sujet] homme'
e;157598;'::>13:74860>29:20537>14';9;50;'Qu'est-ce qu'un homme pourrait attacher ?'
e;328397;'::>16:144950>29:80122';8;50;'liquider [avec] revolver'
e;328592;'::>14:145246>29:34284';8;50;'brosser [objet] cheval'
e;326960;'::>16:8595>29:20537';8;50;'attacher [avec] corde'
e;219822;'::>16:144950>29:80122>14';9;50;'Que pourrait-on liquider avec un revolver ?'
e;100448;'freiner';1;680
e;85880;'atteler';1;62
e;45711;'fouetter';1;200
e;20537;'attacher';1;852
e;87633;'abattre';1;256
e;234303;'équarrir>53335';1;50;'équarrir>dépecer'
e;73697;'équarrir';1;58
e;74325;'entraver';1;72
e;157513;'::>16:8595>29:20537>14';9;50;'Que pourrait-on attacher avec une corde ?'
e;78823;'flatter';1;188
e;97571;'consommer';1;154
e;85513;'curer';1;136
e;134189;'panser';1;146
e;238495;'fouetter>34954';1;50;'fouetter>frapper'
e;3714266;'::>14:145246>29:20537';8;0;'attacher [objet] cheval'
e;320486;'dresser>17559';1;52;'dresser>animal'
e;1733629;'bouchonner>7427';1;0;'bouchonner>frotter'
e;43485;'dresser';1;264
e;139655;'roi';1;4176
e;212940;'frères Dalton';666;80
e;128519;'étriller';1;62
e;151591;'***';0;6584
e;102345;'plaisir';1;3188
e;37298;'amour';1;6754
e;57221;'joie';1;3690
e;11439;'grâce';1;250
e;102778;'élégance';1;228
e;120892;'méfiance';1;480
e;49337;'crainte';1;1142
e;83871;'fougue';1;112
e;39448;'passion';1;1136
e;88662;'liberté';1;1416
e;91691;'surprise';1;1060
e;14330;'satisfaction';1;516
e;28453;'bonheur';1;2090
e;103405;'indifférence';1;456
e;254878;'_POL-NEG_PC';36;50
e;191667;'_INFO-SEM-THING-ARTEFACT';36;242
e;317322;'_POLIT_1ECO';36;50
e;317329;'_POLIT_7NOPOL';36;50
e;248197;'_SEX_YES';36;50
e;276096;'_INFO-WIKI-YES';36;50
e;163151;'_INFO-SEM-SUBST';36;286
e;223172;'_POL-NEG';36;50
e;248198;'_SEX_NO';36;50
e;162761;'_INFO-SEM-PERS';36;732
e;1912988;'_INFO-COUNTABLE-NO';36;0
e;214534;'_INFO-MEANING-FIGURED';36;50
e;254876;'_POL-POS_PC';36;50
e;251717;'_INFO-MEANING-LITERAL';36;50
e;250117;'_INFO-SEM-PERS-FEM';36;50
e;191741;'_INFO-VOC-COMMON';36;50
e;458629;'_INFO-SEM-PLACE-HUMAN';36;504
e;162759;'_INFO-SEM-PLACE';36;504
e;191669;'_INFO-SEM-LIVING-BEING';36;160
e;217817;'_INFO-POLYSEMIC';36;50
e;163012;'_INFO-NO-MORE-QUESTION';36;6094
e;2585996;'_INFO-CNRTL-YES';36;50
e;254877;'_POL-NEUTRE_PC';36;50
e;162763;'_INFO-SEM-THING-CONCRETE';36;1238
e;223173;'_POL-POS';36;50
e;241794;'_POL-NEUTRE';36;50
e;144850;'armée';1;2414
e;145044;'évolution';1;522
e;79042;'naissance';1;1318
e;18412;'élevage';1;824
e;127650;'féconder';1;230
e;73135;'naître';1;692
e;49149;'saillie';1;60
e;88491;'reproduction';1;632
e;34030;'fécondation';1;488
e;158190;'::>13:145246>29:4653>15';9;50;'Où un cheval pourrait courir ?'
e;162065;'::>13:145246>29:4653>34';9;50;'De quelle manière un cheval pourrait courir ?'
e;3710574;'::>14:145246>29:20537>34';9;50;'De quelle manière pourrait-on attacher un cheval ?'
e;165673;'::>14:145246>29:34284>15';9;50;'Où pourrait-on brosser un cheval ?'
e;120994;'arrière-main';1;50
e;21008;'avant-main';1;50
e;75672;'Hunter';1;50
e;5945084;'Flicka';777;0
e;5944829;'Charisma';777;0
e;97942;'Milton';1;50
e;213466;'chat>63235';1;546;'chat>mammifère'
e;215739;'herbe>145941';1;24;'herbe>plante'
e;138874;'herbe';1;1676
e;130547;'pommelé';1;76
e;136539;'violet';1;596
e;145583;'rose';1;1712
e;26976;'vert';1;2658
e;81997;'tacheté';1;82
e;14189;'brun';1;352
e;8542;'beige';1;134
e;1019078;':r14074891';10;0
e;1074851;':r8861966';10;0
e;1249819;':r2378848';10;0
e;1375980;':r2376534';10;0
e;1552340;':r2377207';10;0
e;1556012;':r9367232';10;0
e;1771909;':r2375961';10;0
e;1809209;':r11770153';10;0
e;1881663;':r28029846';10;0
e;2318174;':r33170123';10;0
e;2339103;':r33229979';10;0
e;7620898;':r34294868';10;0
e;2582708;':r53276550';10;0
e;2608961;':r55898869';10;0
e;2830555;':r52472093';10;0
e;2933616;':r11785693';10;0
e;5574888;':r110002468';10;0
e;9477091;':r213792341';10;0
e;9485226;':r213925674';10;0
e;9488785;':r3172636';10;0
e;9627702;':r216479322';10;0
e;9733080;':r217898294';10;0
e;10150984;':r9976128';10;0
e;10150985;':r235016';10;0
e;10186659;':r11023295';10;0
e;10186660;':r228665';10;0
e;10186661;':r368940';10;0
e;10186662;':r1710562';10;0
e;10186663;':r9977397';10;0
e;443759;':r146013';10;50
e;443766;':r380602';10;50
e;443770;':r11357786';10;50
e;443771;':r11357787';10;50
e;443796;':r144409';10;50
e;443798;':r160638';10;50
e;443933;':r11357429';10;50
e;444001;':r11357064';10;50
e;444325;':r11353630';10;50
e;635111;':r2377782';10;0
e;696059;':r2374844';10;0
e;1018648;':r14170794';10;0
e;1504626;':r11357029';10;0
e;1529033;':r11357140';10;0
e;1535176;':r8996557';10;0
e;1546895;':r11357141';10;0
e;1547849;':r11357430';10;0
e;1556681;':r2374506';10;0
e;1629576;':r11357649';10;0
e;1641329;':r11353629';10;0
e;1656589;':r2377135';10;0
e;1691529;':r2377195';10;0
e;1691778;':r2374405';10;0
e;1698757;':r9987290';10;0
e;1794701;':r9976926';10;0
e;1809140;':r2375956';10;0
e;2337413;':r34241615';10;0
e;2348819;':r9976997';10;0
e;4943079;':r97422115';10;0
e;4943080;':r97422117';10;0
e;10150986;':r179815';10;0
e;4624223;':r15830953';10;0
e;446059;':r197055';10;50
e;453767;':r69757';10;50
e;611631;':r121058';10;0
e;684250;':r2377831';10;0
e;1025114;':r14039087';10;0
e;1277756;':r2492426';10;0
e;1304799;':r178755';10;0
e;1383330;':r2058033';10;0
e;1391373;':r3089987';10;0
e;1504899;':r2377806';10;0
e;2339339;':r28705439';10;0
e;2591434;':r563624';10;0
e;2591435;':r563630';10;0
e;2591436;':r563635';10;0
e;2591437;':r563637';10;0
e;2591438;':r563639';10;0
e;2591439;':r563641';10;0
e;2591440;':r563642';10;0
e;2591441;':r563644';10;0
e;2591442;':r1964073';10;0
e;2591443;':r2023484';10;0
e;2591444;':r2023485';10;0
e;2591445;':r2023487';10;0
e;2591446;':r2023488';10;0
e;2591447;':r2489488';10;0
e;2591448;':r13620012';10;0
e;2591449;':r54678319';10;0
e;2591450;':r54678322';10;0
e;9614289;':r216480195';10;0
e;11137222;':r452554';10;0
e;11137223;':r1547941';10;0
e;11137224;':r2635653';10;0
e;11137225;':r1547940';10;0
e;11137226;':r437160';10;0
e;11137227;':r395440';10;0
e;11137228;':r2842618';10;0
e;11137229;':r265516';10;0
e;445028;':r5090048';10;50
e;688219;':r2379345';10;0
e;1144163;':r2376480';10;0
e;1146802;':r13027810';10;0
e;1187199;':r2379505';10;0
e;1743597;':r10933726';10;0
e;10688188;':r83331459';10;0
e;1484081;':r2361744';10;0
e;4858272;':r98581774';10;0
e;8757579;':r177332296';10;0
e;9271827;':r212801886';10;0
e;9488779;':r93257952';10;0
e;9488781;':r2489503';10;0
e;4508153;':r97755534';10;0
e;8751648;':r177322038';10;0
e;9488780;':r3172647';10;0
e;9488787;':r214015732';10;0
e;9518094;':r213790438';10;0
e;9614256;':r216480147';10;0
e;4485874;':r97755538';10;0
e;4485873;':r97755537';10;0
e;4485872;':r97755535';10;0
e;4483860;':r97422121';10;0
e;4483747;':r97755539';10;0
e;10961841;':r386796';10;0
e;10681450;':r97142039';10;0
e;4500709;':r97755536';10;0
e;4363315;':r97755540';10;0
e;4370317;':r97755542';10;0
e;4374136;':r97422113';10;0
e;4507561;':r97414462';10;0
e;4370175;':r97322321';10;0
e;4387979;':r97419249';10;0
e;4357965;':r95740802';10;0
e;4357695;':r97422119';10;0
e;4357683;':r97419593';10;0
e;11317743;':r1376991';10;0
e;4356488;':r97422124';10;0
e;5607387;':r3172578';10;0
e;7923202;':r124544957';10;0
e;7922951;':r3172724';10;0
e;4358503;':r97414640';10;0
e;7923194;':r125750577';10;0
e;9236134;':r97053795';10;0
e;9217539;':r11023311';10;0
e;9217540;':r10000591';10;0
e;9217542;':r9977069';10;0
e;9217544;':r9976531';10;0
e;9217545;':r9976976';10;0
e;9217547;':r2172429';10;0
e;9217541;':r9976089';10;0
e;9217543;':r10352522';10;0
e;9217546;':r1982084';10;0
e;9217548;':r151654';10;0
e;10851233;':r1956112';10;0
e;10851234;':r10766766';10;0
e;10851235;':r99237';10;0
e;10851236;':r167808';10;0
e;10851237;':r79487';10;0
e;10851238;':r179250';10;0
e;9217549;':r429608';10;0
e;2584471;':r9980110';10;0
e;10830423;':r1716377';10;0
e;10830424;':r2613169';10;0
e;10830425;':r2645328';10;0
e;10830426;':r2662701';10;0
e;10830427;':r2686740';10;0
e;10830428;':r2738385';10;0
e;10830429;':r2800602';10;0
e;10830430;':r2919550';10;0
e;10830431;':r3074081';10;0
e;10830432;':r3172589';10;0
e;10830433;':r3172655';10;0
e;10830434;':r14425993';10;0
e;5248574;':r9976924';10;0
e;10687694;':r83921693';10;0
e;10687695;':r78636797';10;0
e;10687696;':r83347768';10;0
e;10687697;':r83902960';10;0
e;10687698;':r96543880';10;0
e;10687699;':r153065';10;0
e;10687700;':r8996585';10;0
e;10687701;':r8996584';10;0
e;10687702;':r631858';10;0
e;10687703;':r13514609';10;0
e;10687704;':r13976590';10;0
e;10687705;':r14026303';10;0
e;10687706;':r11148415';10;0
e;10687707;':r10926963';10;0
e;10687708;':r11141794';10;0
e;10687709;':r11135176';10;0
e;10687710;':r11128472';10;0
e;10687711;':r11119002';10;0
e;10687712;':r14414086';10;0
e;10687713;':r8996577';10;0
e;10687714;':r1530642';10;0
e;10687715;':r10778968';10;0
e;10687716;':r10755123';10;0
e;10687717;':r10749836';10;0
e;10687718;':r11253729';10;0
e;10687719;':r12050418';10;0
e;10687720;':r2895560';10;0
e;10687721;':r8996576';10;0
e;10687722;':r10784230';10;0
e;10687723;':r10861862';10;0
e;10687724;':r2821765';10;0
e;10687725;':r10789417';10;0
e;10687726;':r10777733';10;0
e;10687727;':r10765518';10;0
e;10687728;':r10760283';10;0
e;10687729;':r99236';10;0
e;10687730;':r2379137';10;0
e;10687731;':r2869689';10;0
e;10687732;':r2929146';10;0
e;10687733;':r2934501';10;0
e;10687734;':r2939545';10;0
e;10687735;':r2959551';10;0
e;10687736;':r2965962';10;0
e;10687737;':r2971001';10;0
e;10687738;':r3038292';10;0
e;10687739;':r3172694';10;0
e;10687740;':r3172697';10;0
e;10687741;':r10772522';10;0
e;10687742;':r11688568';10;0
e;10687743;':r2739389';10;0
e;10687744;':r2746304';10;0
e;10687745;':r2761420';10;0
e;8747620;':r2984987';10;0
e;10687746;':r11259588';10;0
e;10687747;':r25779189';10;0
e;10687748;':r12997163';10;0
e;10687749;':r2777849';10;0
e;10687750;':r2740408';10;0
e;10687751;':r14711253';10;0
e;10687752;':r2840000';10;0
e;10687753;':r2809253';10;0
e;10687754;':r2697739';10;0
e;10687755;':r15869806';10;0
e;10687756;':r54502229';10;0
e;10687757;':r2350387';10;0
e;10687758;':r2845581';10;0
e;10687759;':r155422';10;0
e;10687760;':r214261';10;0
e;10687761;':r79563';10;0
e;10687762;':r81177';10;0
e;10687763;':r106743';10;0
e;10687764;':r79830';10;0
e;10687765;':r79485';10;0
e;10687766;':r79831';10;0
e;10687767;':r222445';10;0
e;10687768;':r2700332';10;0
e;10687769;':r78263869';10;0
e;10687770;':r2867407';10;0
e;10687771;':r2878624';10;0
e;10687772;':r11827335';10;0
e;4412111;':r97053838';10;0
e;5403588;':r97950523';10;0
e;7904517;':r125655748';10;0
e;5248573;':r3110200';10;0
e;7778293;':r123530914';10;0
e;8884238;':r9976996';10;0
e;3306555;':r34665205';10;0
e;3327725;':r2046200';10;0
e;3327726;':r99233';10;0
e;265182;'sarcoptérygien';1;54
e;6685202;'bn:18302621n';444;0
e;6685203;'bn:20209681n';444;0
e;6685204;'bn:13590700n';444;0
e;6685205;'bn:17863019n';444;0
e;6685206;'bn:05666988n';444;0
e;3983257;'dbnary:fra:__ws_1_cheval__nom__1';444;0
e;4006720;'dbnary:fra:__ws_2_cheval__nom__1';444;0
e;4029942;'dbnary:fra:__ws_3_cheval__nom__1';444;0
e;4053528;'dbnary:fra:__ws_4_cheval__nom__1';444;0
e;4077107;'dbnary:fra:__ws_5_cheval__nom__1';444;0
e;4100507;'dbnary:fra:__ws_6_cheval__nom__1';444;0
e;4123709;'dbnary:fra:__ws_7_cheval__nom__1';444;0
e;3717074;'bn:00042378n';444;0
e;3717073;'bn:00031345n';444;0
e;3228593;'wiki:@';444;0
e;3717079;'bn:00211764n';444;0
e;6135616;'umls:C1541715';444;0
e;3761846;'bn:02856852n';444;0
e;3717076;'bn:02131026n';444;0
e;3717077;'bn:00044819n';444;0
e;3388776;'bn:00613762n';444;0
e;3717078;'bn:03990759n';444;0
e;6094341;'umls:C0019944';444;0
e;2983124;'_SW';36;50
e;127703;'fers';1;58
e;153269;'cow boy';1;60
e;183380;'nom binominal';1;50
e;25137;'Carl von Linné';1;50
e;195043;'ongulés';1;50
e;272360;'Espèce';777;50
e;135538;'espèces';1;94
e;65095;'évolué';1;64
e;25019;'prédateur';1;502
e;271117;'prédateurs';1;8
e;51617;'gestation';1;132
e;229363;'Poulain';666;50
e;112201;'Eurasie';1;58
e;143945;'Homme';1;60
e;112609;'anatomie';1;2714
e;125402;'morphologie';1;120
e;40056;'couleur';1;4452
e;145360;'race';1;364
e;141130;'Allure';1;50
e;141074;'locomotion';1;82
e;16718;'comportement';1;460
e;152253;'Commerce';1;218
e;49615;'commerce';1;2836
e;271938;'Colonisation des Amériques';777;50
e;27822;'mythe';1;514
e;161317;'mythes';1;56
e;141402;'Encyclopédie';1;58
e;94236;'encyclopédies';1;50
e;153225;'Art';1;60
e;3695;'art';1;2424
e;153445;'métiers';1;68
e;44126;'sport hippique';1;76
e;57230;'compétition';1;1008
e;80574;'thérapie';1;236
e;152150;'animal de compagnie';1;448
e;129938;'urine';1;320
e;153176;'Agriculture';1;92
e;50567;'agriculture';1;1676
e;152338;'Transport';1;66
e;33377;'matériel';1;182
e;27265;'hippologie';1;56
e;203161;'Logos';1;50
e;58733;'anatomique';1;72
e;139836;'Âne';1;50
e;44525;'sous-espèce';1;54
e;234990;'alphabet phonétique international';1;50
e;38788;'espèce';1;356
e;63348;'marronnage';1;54
e;162083;'sauvages';1;70
e;14485;'castration';1;106
e;109931;'castré';1;86
e;138412;'Shetland';1;50
e;54613;'chromosome';1;384
e;44092;'chromosomes';1;144
e;81595;'génome';1;228
e;219944;'théorie de l'évolution';1;58
e;80252;'Plaine';1;50
e;106848;'plaines';1;50
e;78164;'steppe';1;74
e;121794;'pléistocène';1;52
e;20507;'spéciation';1;88
e;212614;'ânes';1;50
e;28088;'zèbres';1;50
e;152210;'Archéologie';1;66
e;96098;'archéologie';1;292
e;76064;'biotope';1;90
e;5967;'domestication';1;50
e;146085;'Tête';1;50
e;149242;'muscles';1;164
e;68577;'tendon';1;184
e;163046;'tendons';1;76
e;234743;'système digestif';1;32
e;204377;'niche écologique';1;94
e;139957;'Gris';1;50
e;278551;'Equidae';777;4
e;275142;'races';1;50
e;195975;'animaux domestiques';1;60
e;179763;'Arabe';1;50
e;121150;'Camargue';1;144
e;173188;'Islandais';1;52
e;142316;'Troupeau';1;50
e;31388;'États-Unis';1;544
e;119768;'Australie';1;337
e;72177;'Bardot';1;84
e;38079;'ânesse';1;80
e;161452;'robes';1;66
e;140927;'Noir';1;54
e;8408;'Épi';1;50
e;67510;'épis';1;56
e;51380;'grégaire';1;54
e;12013;'hardes';1;58
e;135972;'harem';1;72
e;246125;'langage corporel';666;4
e;64389;'hennissement';1;54
e;156471;'sommeil paradoxal';1;100
e;42931;'rêver';1;836
e;41524;'insémination artificielle';1;62
e;122865;'sperme';1;442
e;144829;'Printemps';1;50
e;98798;'printemps';1;1478
e;31349;'colostrum';1;58
e;109157;'ruade';1;74
e;272309;'airs relevés';777;50
e;117598;'levade';1;50
e;137971;'Sens';1;50
e;30369;'sens';1;1316
e;208244;'sixième sens';1;50
e;110902;'odorat';1;702
e;50751;'ouïe';1;360
e;82900;'toucher';1;1206
e;102816;'vue';1;1122
e;51990;'Tremblement de terre';1;50
e;13393;'tremblements de terre';1;52
e;110310;'ultrasons';1;56
e;272197;'organe de Jacobson';777;52
e;34179;'mouches';1;92
e;154768;'Alimentation';1;54
e;7418;'herbivores';1;52
e;265947;'ruminants';1;54
e;65828;'foin';1;416
e;44210;'micro-organismes';1;72
e;3020;'cæcum';1;60
e;38028;'cellulose';1;78
e;24388;'régurgiter';1;98
e;116746;'vomir';1;370
e;143483;'côlon';1;130
e;176120;'flore intestinale';1;30
e;151907;'Biologie';1;306
e;70984;'biologiquement';1;72
e;83174;'demi-sang';1;50
e;100993;'tempérament';1;226
e;2957;'Barbe';1;50
e;77735;'Europe';1;830
e;41873;'Moyen-Orient';1;104
e;61414;'Afrique du Nord';1;76
e;267539;'à sang froid';1;50
e;29048;'Shire';1;50
e;44059;'argile';1;320
e;208443;'sports équestres';1;50
e;211810;'saut d'obstacles';1;54
e;234742;'années 1970';1;78
e;284737;'biotopes';777;18
e;285548;'vibrisses';777;54
e;429336;'Étalon';1;50
e;431412;'Jument';1;50
e;406552;'juments';1;50
e;404539;'Concept';1;50
e;412816;'concepts';1;50
e;406612;'Morphologie';1;50
e;429653;'Robe';1;50
e;402430;'Race';1;50
e;418470;'Mythe';1;50
e;430267;'Cuir';1;50
e;412263;'Mustang';1;50
e;429276;'Hongre';1;50
e;412258;'Chromosome';1;50
e;413580;'Steppe';1;50
e;410516;'steppes';1;50
e;412342;'Pied';1;50
e;331177;'élevage sélectif';1;50
e;430415;'Poil';1;50
e;401746;'Muscle';1;50
e;400969;'fanons';1;50
e;420937;'poneys';1;52
e;405122;'Frison';1;50
e;123836;'poids';1;1308
e;2231136;'mustangs';2;0
e;2577435;'Entier';1;0
e;2456497;'Tendon';1;0
e;3290442;'Percheron';1;0
e;152685;'Animal';1;50
e;2044066;'hippiques';2;0
e;3759908;'Fjord';1;0
e;397722;'Faucon';1;50
e;109841;'Évolution';1;50
e;5626013;'Équitation';777;0
e;81744;'Cavalier';1;50
e;45620;'mater';1;276
e;176592;'Unicode';1;50
e;22048;'HTML';1;72
e;292126;'International Standard Book Number';777;54
e;142939;'ISBN';1;60
e;2925034;'Presses universitaires de France';777;0
e;19347;'Échiquier';1;50
e;237899;'art grec';1;50
e;281643;'Renaissance artistique';777;50
e;143415;'Renaissance';1;170
e;5570478;'Baroque';1;0
e;96876;'baroque';1;126
e;5944717;'George Stubbs';777;0
e;189403;'Pablo Picasso';1;108
e;155238;'Peinture';1;54
e;52184;'peintures';1;86
e;159574;'sculptures';1;64
e;136773;'dessins';1;76
e;161419;'grotte Chauvet';1;50
e;34983;'grotte de Lascaux';1;90
e;1382420;'chamanique';1;0
e;12413;'Assyrie';1;70
e;62298;'Ninive';1;52
e;216164;'Égypte antique';1;16
e;5881468;'Égyptiens';1;4
e;91292;'Étrusques';1;54
e;406577;'gauloises';1;50
e;2534520;'Romaines';1;0
e;93700;'romaines';1;50
e;2012712;'carthaginoises';2;0
e;3401175;'Palmier';1;0
e;1906;'palmier';1;184
e;105028;'Angleterre';1;1056
e;116205;'Phidias';1;66
e;151850;'Anatomie';1;292
e;2932052;'Époque classique';777;0
e;234757;'époque classique';1;50
e;4931;'Frise';1;50
e;5040;'frises';1;50
e;18784;'Marathon';1;84
e;101538;'Quirinal';1;56
e;34423;'Chevaux de Marly';1;50
e;118420;'Sidon';1;50
e;46867;'Constantinople';1;134
e;13625;'quadrige';1;50
e;53969;'Syracuse';1;92
e;135191;'Venise';1;294
e;2005981;'bas-reliefs';2;0
e;431879;'Aurige';1;50
e;126954;'aurige';1;50
e;61281;'Rome';1;1144
e;69199;'Michel-Ange';1;82
e;46648;'Lysippe';1;50
e;143291;'Chine';1;1154
e;1746148;'dynastie Han';1;0
e;413716;'Hirondelle';1;50
e;13292;'hirondelle';1;254
e;1010675;'dynastie Tang';777;0
e;425403;'Sacrifice';1;50
e;421801;'sacrifices';1;50
e;126982;'grandeur nature';1;50
e;44103;'ronde-bosse';1;50
e;36365;'Tang Taizong';1;50
e;100640;'roman';1;4495
e;81764;'harnais';1;80
e;271732;'Martin de Tours';1;50
e;246727;'Georges de Lydda';1;50
e;49065;'Dragon';1;50
e;142558;'dragon';1;268
e;2324605;'Christianisme';1;0
e;114568;'christianisme';1;246
e;2039071;'enluminures';2;0
e;14959;'Bestiaire';1;50
e;2011788;'bestiaires';2;0
e;407368;'Sceau';1;50
e;166273;'sceaux';1;52
e;124680;'Jean de Bourgogne';1;50
e;138588;'Jean';1;80
e;189823;'Marie de Bourgogne';1;50
e;139011;'Charlemagne';1;98
e;232250;'Tapisserie de Bayeux';1;10
e;306662;'Jean Fouquet';777;50
e;93788;'Paolo Uccello';1;50
e;84026;'Benozzo Gozzoli';1;50
e;244807;'Renaissance italienne';1;64
e;111051;'faire-valoir';1;50
e;419888;'Galop';1;50
e;274073;'Eadweard Muybridge';777;50
e;231506;'Walt Disney Pictures';1;22
e;264797;'studios Disney';1;54
e;164326;'Mickey Mouse';1;78
e;143467;'Fantasia';1;50
e;3729818;'Cartoon';1;0
e;2013109;'cartoons';2;0
e;142561;'Cendrillon';1;236
e;215477;'La Belle au bois dormant';1;28
e;142097;'Hercule';1;218
e;140324;'Zeus';1;376
e;5939313;'La ferme se rebelle';777;0
e;217600;'Raiponce';1;38
e;215301;'Shrek';666;38
e;5808784;'Shrek 2';777;0
e;229921;'Osamu Tezuka';666;50
e;5944969;'Magie Bleue';777;0
e;420715;'Licorne';1;50
e;105146;'licorne';1;102
e;219498;'La Ferme des animaux';1;12
e;111092;'faucon';1;94
e;2435830;'Bellerive-sur-Allier';1;2
e;2517853;'La Brillanne';1;0
e;226480;'Basse-Saxe';1;6
e;80898;'Stuttgart';1;50
e;1890194;'Écu';1;0
e;2934553;'Blasonnement';777;0
e;5945321;'Equus ferus';777;0
e;5950994;'Pouliche';1;0
e;5950883;'Poney';1;0
e;8448;'jeu de go';1;56
e;5893117;'xiangqi';777;0
e;10964970;'Échecs';1;0
e;11029119;'Vlastimil Hort';777;0
e;10195521;'Échec et mat';777;0
e;11153644;'variante Svechnikov';777;0
e;9486172;'Biotope';1;0
e;6260357;'Squelette';1;0
e;6280951;'cobs';1;0
e;10334513;'École nationale vétérinaire d'Alfort';777;0
e;10353558;'Maurizio Cattelan';777;0
e;10334848;'courses hippiques';1;0
e;10345167;'Sculpture';1;0
e;10519458;'Assyriens';1;0
e;5965711;'Gauloises';1;0
e;6529955;'Enluminure';1;0
e;10551451;'Cob';1;0
e;10600840;'?????';777;0
e;10846073;'Haflinger';1;0
e;10909496;'Sport hippique';777;0
e;10929174;'steppe eurasiatique';777;0
e;234035;'être vivant>2442';1;4;'être vivant>vivre'
e;239538;'terrain>239537';1;12;'terrain>espace de terre'
e;2945146;'terrain>280570';1;0;'terrain>facteurs'
e;2945287;'terrain>35841';1;0;'terrain>peinture'
e;239532;'terrain>65526';1;6;'terrain>bataille'
e;239536;'terrain>110707';1;50;'terrain>immobilier'
e;239531;'terrain>92878';1;54;'terrain>géologie'
e;239535;'terrain>102206';1;2;'terrain>médecine'
e;239533;'terrain>56865';1;50;'terrain>sport'
e;239534;'terrain>81161';1;54;'terrain>domaine'
e;11160791;'monter>32912';1;0;'monter>assaut'
e;11160792;'monter>101793';1;0;'monter>déplacer'
e;11160793;'monter>87709';1;0;'monter>tonalité'
e;11160794;'monter>143757';1;0;'monter>art culinaire'
e;11160795;'monter>139303';1;0;'monter>drogue'
e;11160796;'monter>29994';1;0;'monter>intensité'
e;11160798;'monter>31920';1;0;'monter>accouplement'
e;11160916;'monter>114040';1;0;'monter>notoriété'
e;11160926;'monter>20175';1;0;'monter>surenchérir'
e;11160928;'monter>88344';1;0;'monter>prostitution'
e;11160932;'monter>50567';1;0;'monter>agriculture'
e;11160790;'monter>25405';1;0;'monter>voyager'
e;11178381;'zèbre>68467';1;0;'zèbre>poisson'
e;5500836;'queue>123430';1;0;'queue>jeux'
e;5500825;'queue>16644';1;0;'queue>astronomie'
e;5500831;'queue>93523';1;0;'queue>reliure'
e;5500832;'queue>123258';1;0;'queue>traîne'
e;5500545;'queue>104993';1;0;'queue>informatique'
e;5500835;'queue>98040';1;0;'queue>architecture'
e;2949052;'queue>16033';1;0;'queue>cuisine'
e;5500532;'queue>87852';1;0;'queue>typographie'
e;5500529;'queue>61407';1;0;'queue>coiffure'
e;5500834;'queue>456379';1;0;'queue>partie terminale'
e;216624;'prix>128855';1;50;'prix>importance'
e;216623;'prix>31900';1;24;'prix>récompense'
e;216626;'prix>106679';1;6;'prix>récipiendaire'
e;216622;'prix>40940';1;80;'prix>coût'
e;214601;'queue>214624>68467';1;16;'queue>queue d'animal>poisson'
e;214603;'queue>214624>140176';1;50;'queue>queue d'animal>oiseau'
e;214629;'queue>3674>87286';1;10;'queue>botanique>fruit'
e;225846;'organisme>332175';1;52;'organisme>ensemble des organes'
e;225849;'organisme>86627';1;50;'organisme>organisation'
e;228981;'boulet>125647';1;50;'boulet>forçat'
e;228984;'boulet>116477';1;50;'boulet>personne'
e;228980;'boulet>142412';1;50;'boulet>canon'
e;228982;'boulet>111649';1;50;'boulet>charbon'
e;214598;'queue>36811';1;50;'queue>billard'
e;214599;'queue>34503';1;54;'queue>pénis'
e;214600;'queue>140786';1;52;'queue>file'
e;214604;'queue>233174';1;50;'queue>partie postérieure'
e;214625;'queue>59085';1;2;'queue>empennage'
e;214631;'queue>3674';1;60;'queue>botanique'
e;214671;'queue>117787';1;56;'queue>poignée'
e;2586122;'robe>79727';1;0;'robe>magistrat'
e;2586121;'robe>140216';1;6;'robe>ecclésiastique'
e;3707803;'croisière>143712';1;0;'croisière>marine'
e;3707802;'croisière>156324';1;2;'croisière>voyage d'agrément'
e;3182923;'boucle>54944';1;0;'boucle>enchaînement'
e;217287;'boucle>104993';1;12;'boucle>informatique'
e;2690947;'boucle>70527';1;0;'boucle>musique'
e;2690950;'boucle>266016';1;0;'boucle>théorie des graphes'
e;2690952;'boucle>87925';1;0;'boucle>aviation'
e;2690954;'boucle>105559';1;0;'boucle>doublage'
e;2690955;'boucle>143712';1;0;'boucle>marine'
e;2690956;'boucle>98040';1;0;'boucle>architecture'
e;217288;'boucle>51126';1;10;'boucle>cheveux'
e;217284;'boucle>153295';1;2;'boucle>boucle d'oreille'
e;217286;'boucle>72560';1;50;'boucle>itinéraire'
e;217285;'boucle>203030';1;50;'boucle>ligne courbe'
e;217283;'boucle>76657';1;50;'boucle>ceinture'
e;330673;'pilier>105649';1;50;'pilier>horlogerie'
e;330672;'pilier>33701';1;50;'pilier>soutien'
e;330670;'pilier>62165';1;50;'pilier>rugby'
e;330674;'pilier>112609';1;50;'pilier>anatomie'
e;330669;'pilier>98040';1;50;'pilier>architecture'
e;3224782;'allure>83772';1;0;'allure>tournure'
e;216701;'allure>143712';1;2;'allure>marine'
e;216700;'allure>80897';1;12;'allure>apparence'
e;234120;'manège>153245';1;52;'manège>fête foraine'
e;234121;'manège>142511';1;52;'manège>intrigue'
e;218348;'carrière>140613';1;18;'carrière>mine'
e;218349;'carrière>103465';1;52;'carrière>profession'
e;3171902;'monter>32278';1;0;'monter>équiper'
e;229414;'monter>123745';1;50;'monter>véhicule'
e;1859432;'monter>105197';1;0;'monter>ourdir'
e;1859433;'monter>104353';1;0;'monter>sertir'
e;1859434;'monter>128589';1;0;'monter>organiser'
e;229415;'monter>24656';1;88;'monter>assembler'
e;229418;'monter>104993';1;50;'monter>informatique'
e;229413;'monter>137774';1;50;'monter>s'élever'
e;229417;'monter>61938';1;52;'monter>croître'
e;229412;'monter>229406';1;22;'monter>aller en haut'
e;225708;'zèbre>68439';1;50;'zèbre>individu'
e;225709;'zèbre>106872';1;50;'zèbre>pitre'
e;3184658;'pie>269839';1;0;'pie>blanc et noir'
e;261310;'jument>61490';1;50;'jument>femme'
e;3308355;'bombe>50333';1;0;'bombe>plongeon'
e;3308358;'bombe>88799';1;0;'bombe>bonbonne'
e;3308359;'bombe>143712';1;0;'bombe>marine'
e;215441;'bombe>76862';1;70;'bombe>aérosol'
e;246490;'bombe>144647';1;50;'bombe>fête'
e;215446;'bombe>25966';1;50;'bombe>pâtisserie'
e;215440;'bombe>213845>151629';1;58;'bombe>engin explosif>bombe atomique'
e;215447;'bombe>115393';1;4;'bombe>scandale'
e;215445;'bombe>215444';1;42;'bombe>belle femme'
e;215442;'bombe>213845';1;56;'bombe>engin explosif'
e;215443;'bombe>213845>71198';1;6;'bombe>engin explosif>projectile'
e;2976251;'chasseur>16033';1;0;'chasseur>cuisine'
e;2976287;'chasseur>184412';1;0;'chasseur>système d'armes'
e;2976323;'chasseur>143712';1;0;'chasseur>marine'
e;2976329;'chasseur>2976328';1;0;'chasseur>qui recherche'
e;214231;'chasseur>87925';1;24;'chasseur>aviation'
e;214232;'chasseur>103453';1;42;'chasseur>cynégétique'
e;225848;'organisme>118203';1;50;'organisme>corps humain'
e;237441;'être>85728';1;6;'être>exister'
e;237443;'être>37229';1;52;'être>se trouver'
e;232532;'bardeau>52335';1;50;'bardeau>imprimerie'
e;232531;'bardeau>120728';1;50;'bardeau>planche'
e;218874;'monture>104729';1;2;'monture>lunettes'
e;218875;'monture>44386';1;50;'monture>support'
e;3265929;'poinçon>87852';1;0;'poinçon>typographie'
e;3265932;'poinçon>98040';1;0;'poinçon>architecture'
e;3265933;'poinçon>30843';1;0;'poinçon>outil'
e;3265931;'poinçon>117244';1;0;'poinçon>authentification'
e;3265930;'poinçon>72044';1;0;'poinçon>tonneau'
e;246238;'piscine>73890';1;50;'piscine>religion'
e;246240;'piscine>126343';1;50;'piscine>pisciculture'
e;246241;'piscine>101085';1;50;'piscine>centrale nucléaire'
e;10960062;'piscine>53688';1;0;'piscine>activité'
e;246237;'piscine>10960027';1;72;'piscine>bassin de natation'
e;250321;'pelote>36204';1;50;'pelote>balle'
e;250320;'pelote>4415';1;50;'pelote>régurgitation'
e;250319;'pelote>143462';1;50;'pelote>couture'
e;250322;'pelote>97977';1;50;'pelote>chistera'
e;250318;'pelote>250317';1;54;'pelote>boule de fil'
e;2933518;'barrage>348384';1;0;'barrage>droit de péage'
e;215968;'barrage>45887';1;54;'barrage>barrière'
e;215969;'barrage>67170';1;52;'barrage>rocher'
e;226393;'barrage>189915';1;50;'barrage>match de barrage'
e;226394;'barrage>216556';1;52;'barrage>tir de barrage'
e;213913;'barrage>143468';1;6;'barrage>ouvrage d'art'
e;4491655;'baie>104993';1;0;'baie>informatique'
e;9024895;'bonnet>80524';1;0;'bonnet>scaphandre'
e;2739992;'bonnet>16033';1;0;'bonnet>cuisine'
e;217491;'bonnet>34161';1;30;'bonnet>soutien-gorge'
e;217489;'bonnet>61407';1;44;'bonnet>coiffure'
e;1375965;'breton>11298';1;2;'breton>Bretagne'
e;317041;'breton>52119';1;52;'breton>langue'
e;1375964;'breton>106042';1;0;'breton>bovin'
e;11151531;'garrot>85891';1;0;'garrot>arbalète'
e;261306;'garrot>140176';1;50;'garrot>oiseau'
e;323512;'garrot>126167';1;50;'garrot>supplice'
e;261307;'garrot>151524';1;50;'garrot>morceau de bois'
e;261308;'garrot>5707';1;50;'garrot>jardinage'
e;261309;'garrot>102206';1;52;'garrot>médecine'
e;240934;'dada>197530';1;50;'dada>cheval à bascule'
e;3707998;'passage>134503';1;0;'passage>servitude'
e;3708004;'passage>70405';1;0;'passage>migration'
e;233712;'passage>115416';1;50;'passage>venue'
e;233715;'passage>27890';1;50;'passage>transformation'
e;233714;'passage>134788';1;50;'passage>couloir'
e;233710;'passage>135190';1;50;'passage>lieu'
e;3708003;'passage>140429';1;0;'passage>chasse'
e;233717;'passage>131055';1;4;'passage>extrait'
e;3708035;'passage>65364';1;0;'passage>morceau'
e;233713;'passage>164552';1;2;'passage>voie de communication'
e;233718;'passage>16644';1;50;'passage>astronomie'
e;233711;'passage>8';1;50;'passage>traversée'
e;233716;'passage>13225';1;50;'passage>péage'
e;263480;'passage>20595';1;50;'passage>admission'
e;233709;'passage>28108';1;6;'passage>passer'
e;214338;'robe>139743';1;2;'robe>enveloppe'
e;214342;'robe>214341';1;50;'robe>couleur du vin'
e;330963;'cordé>3674';1;50;'cordé>botanique'
e;239664;'étourneau>51688';1;4;'étourneau>étourdi'
e;2863228;'baie>116367';1;0;'baie>tromperie'
e;213406;'baie>87286';1;58;'baie>fruit'
e;213410;'baie>141906';1;2;'baie>fenêtre'
e;213411;'baie>144174';1;6;'baie>golfe'
e;246421;'molette>117604';1;50;'molette>mécanisme'
e;321555;'répondre>144102';1;50;'répondre>téléphone'
e;3324719;'molette>39922';1;0;'molette>cépage'
e;246423;'molette>130400';1;50;'molette>maladie'
e;246422;'molette>104993';1;50;'molette>informatique'
e;239663;'étourneau>140176';1;52;'étourneau>oiseau'
e;7710038;'bardot>68467';1;0;'bardot>poisson'
e;7710039;'bardot>74860';1;0;'bardot>homme'
e;3739398;'cabriole>400694';1;0;'cabriole>grimaces'
e;3739397;'cabriole>35762';1;0;'cabriole>saut'
e;4330870;'cavalière>98040';1;0;'cavalière>architecture'
e;250393;'cavalière>60933';1;50;'cavalière>désinvolte'
e;250394;'cavalière>12107';1;50;'cavalière>danseuse'
e;218572;'cavalerie>18114';1;50;'cavalerie>escroquerie'
e;393015;'bond>146050';1;50;'bond>militaire'
e;393016;'bond>46277';1;50;'bond>progrès'
e;393018;'bond>76578';1;50;'bond>réseaux informatiques'
e;253188;'battue>108983';1;52;'battue>battu'
e;253189;'battue>140429';1;50;'battue>chasse'
e;3016795;'battue>94555';1;0;'battue>phonétique'
e;253191;'battue>94609';1;50;'battue>textile'
e;253192;'battue>117095';1;50;'battue>zoologie'
e;245419;'avertir>108043';1;24;'avertir>informer'
e;2949879;'répondre>123450';1;0;'répondre>se porter garant'
e;2949882;'répondre>15966';1;0;'répondre>réagir'
e;2949883;'répondre>207507';1;0;'répondre>satisfaire à'
e;321554;'répondre>158040';1;52;'répondre>répartie'
e;321556;'répondre>50646';1;52;'répondre>question'
e;321558;'répondre>40923';1;4;'répondre>courrier'
e;321557;'répondre>43568';1;54;'répondre>insolence'
e;4309725;'talon>1776122';1;0;'talon>cartes à jouer'
e;4309728;'talon>92632';1;0;'talon>ornement'
e;4309729;'talon>36811';1;0;'talon>billard'
e;4309727;'talon>143712';1;0;'talon>marine'
e;214818;'talon>104204';1;2;'talon>souche'
e;214821;'talon>65364';1;2;'talon>morceau'
e;214820;'talon>75377';1;30;'talon>chaussure'
e;214819;'talon>34898';1;14;'talon>pied'
e;244479;'entier>23255';1;50;'entier>mathématiques'
e;244481;'entier>3674';1;50;'entier>botanique'
e;244482;'entier>59103';1;6;'entier>totalité'
e;244483;'entier>33726';1;50;'entier>intact'
e;1671383;'entier>104993';1;0;'entier>informatique'
e;1792528;'talonner>259337';1;0;'talonner>sport de ballon'
e;1792529;'talonner>143712';1;0;'talonner>marine'
e;1792530;'talonner>59413';1;0;'talonner>harceler'
e;1792527;'talonner>1789063';1;0;'talonner>suivre de près'
e;322676;'commencer>137532';1;50;'commencer>prendre l'initiative'
e;322677;'commencer>322675';1;52;'commencer>être situé au début'
e;322684;'commencer>28838';1;50;'commencer>apprendre'
e;322688;'commencer>91525';1;58;'commencer>débuter'
e;1745764;'ramener>1745763';1;0;'ramener>réduire à'
e;1745762;'ramener>9261';1;0;'ramener>rétablir'
e;1745758;'ramener>113507';1;0;'ramener>rapporter'
e;1745760;'ramener>79307';1;0;'ramener>faire revenir'
e;1745761;'ramener>49479';1;2;'ramener>reconduire'
e;264691;'parer>98818';1;50;'parer>faire face'
e;264693;'parer>85101';1;50;'parer>auréoler'
e;264689;'parer>121747';1;50;'parer>esquiver'
e;264687;'parer>36246';1;50;'parer>préparer'
e;264692;'parer>33744';1;50;'parer>défendre'
e;264688;'parer>131531';1;50;'parer>orner'
e;220048;'selle>133393';1;50;'selle>sculpture'
e;3727918;'selle>47356';1;0;'selle>tabouret'
e;220049;'selle>64437';1;50;'selle>boucherie'
e;220047;'selle>80196';1;2;'selle>deux-roues'
e;223546;'étrille>132425';1;50;'étrille>crabe'
e;10045011;'sabot>87852';1;0;'sabot>typographie'
e;10045012;'sabot>113968';1;0;'sabot>dentelle'
e;10045016;'sabot>30143';1;0;'sabot>zootechnie'
e;226369;'sabot>24743';1;50;'sabot>mollusque'
e;10045013;'sabot>154716';1;0;'sabot>mauvaise qualité'
e;10045014;'sabot>74580';1;0;'sabot>tondeuse'
e;9021646;'sabot>87729';1;0;'sabot>jeu de cartes'
e;214956;'char>108274';1;50;'char>carnaval'
e;214957;'char>151696';1;34;'char>char d'assaut'
e;214954;'char>87872';1;50;'char>chariot'
e;3306263;'pion>3306260';1;0;'pion>pièce de centrage'
e;3306262;'pion>2494399';1;0;'pion>Lavoine'
e;213739;'pion>15127';1;50;'pion>particule'
e;213742;'pion>213741';1;50;'pion>personne sans importance'
e;213738;'pion>85109';1;14;'pion>surveillant'
e;252295;'pion>123430';1;50;'pion>jeux'
e;256195;'fjord>39022';1;50;'fjord>crique'
e;213863;'sabot>75377';1;22;'sabot>chaussure'
e;226370;'sabot>131237';1;2;'sabot>toupie'
e;243615;'sabot>132716';1;50;'sabot>baignoire'
e;243616;'sabot>57803';1;50;'sabot>garniture'
e;243621;'sabot>243617';1;2;'sabot>sabot de Denver'
e;1792633;'placé>5454';1;0;'placé>placer'
e;1792634;'placé>39214';1;0;'placé>disposé'
e;1792637;'placé>1792636';1;0;'placé>confié'
e;1792635;'placé>135128';1;0;'placé>finances'
e;239779;'gourmette>82823';1;2;'gourmette>bracelet'
e;5502054;'bavette>79073';1;0;'bavette>oie'
e;5502055;'bavette>95706';1;0;'bavette>automobile'
e;5502056;'bavette>98040';1;0;'bavette>architecture'
e;242730;'bavette>3218';1;50;'bavette>bavarde'
e;242728;'bavette>94672';1;50;'bavette>bavoir'
e;242729;'bavette>140100';1;62;'bavette>viande'
e;3176076;'embouchure>70527';1;0;'embouchure>musique'
e;3176074;'embouchure>142412';1;0;'embouchure>canon'
e;3176073;'embouchure>137865';1;0;'embouchure>cours d'eau'
e;227361;'carne>5290';1;50;'carne>angle'
e;241808;'balancine>15229';1;50;'balancine>aéronautique'
e;241807;'balancine>2022';1;50;'balancine>cordage'
e;261628;'corbillard>47638';1;2;'corbillard>véhicule automobile'
e;320548;'caracole>98040';1;50;'caracole>architecture'
e;320550;'caracole>146050';1;50;'caracole>militaire'
e;218707;'pirouette>98040';1;50;'pirouette>architecture'
e;3232162;'pirouette>75285';1;0;'pirouette>dérobade'
e;3232165;'pirouette>3232164';1;0;'pirouette>tour sur soi'
e;237973;'assurer>86078';1;52;'assurer>affermir'
e;2951530;'assurer>96775';1;0;'assurer>fournir'
e;2951531;'assurer>143712';1;0;'assurer>marine'
e;2951533;'assurer>238677';1;0;'assurer>être à la hauteur'
e;237971;'assurer>130358';1;50;'assurer>alpinisme'
e;318480;'assurer>239507';1;50;'assurer>prendre en charge'
e;237972;'assurer>106290';1;4;'assurer>assurance'
e;237969;'assurer>9146';1;52;'assurer>certifier'
e;237970;'assurer>85307';1;4;'assurer>garantir'
e;219310;'barde>59430';1;50;'barde>lard'
e;219308;'barde>96387';1;64;'barde>chanteur'
e;1587446;'barde>74659';1;0;'barde>armure'
e;234278;'piquer>234276';1;56;'piquer>faire une piqûre'
e;234280;'piquer>245371';1;18;'piquer>euthanasier'
e;234283;'piquer>97236';1;50;'piquer>plonger'
e;234284;'piquer>86306';1;18;'piquer>prendre'
e;234287;'piquer>53531';1;50;'piquer>picoter'
e;234286;'piquer>25296';1;50;'piquer>impressionner'
e;234279;'piquer>82827';1;52;'piquer>coudre'
e;234285;'piquer>26142';1;50;'piquer>agacer'
e;234288;'piquer>70527';1;50;'piquer>musique'
e;2589217;'piquer>16033';1;0;'piquer>cuisine'
e;234277;'piquer>26738';1;50;'piquer>percer'
e;234281;'piquer>30265';1;4;'piquer>darder'
e;241567;'chopper>2710';1;50;'chopper>silex'
e;241568;'chopper>68620';1;50;'chopper>moto'
e;233387;'étrier>112609';1;52;'étrier>anatomie'
e;1909767;'étrier>216183';1;0;'étrier>pièce mécanique'
e;233385;'étrier>102206';1;28;'étrier>médecine'
e;233386;'étrier>73685';1;50;'étrier>sports'
e;233384;'étrier>130358';1;50;'étrier>alpinisme'
e;233388;'étrier>139869';1;50;'étrier>charpente'
e;5069641;'andalou>66007';1;0;'andalou>Andalousie'
e;5069640;'andalou>131059';1;0;'andalou>dialecte'
e;238496;'fouetter>16033';1;50;'fouetter>cuisine'
e;3171665;'frison>3674';1;0;'frison>botanique'
e;267309;'frison>267308';1;50;'frison>Frise néerlandaise'
e;267310;'frison>138501';1;50;'frison>vache'
e;267307;'frison>41574';1;50;'frison>rabotage'
e;267304;'frison>94609';1;50;'frison>textile'
e;267305;'frison>23157';1;50;'frison>linguistique'
e;267303;'frison>264229';1;50;'frison>boucle de cheveux'
e;2371254;'porteur>143712';1;0;'porteur>marine'
e;2371247;'porteur>102206';1;0;'porteur>médecine'
e;2371248;'porteur>66368';1;0;'porteur>détenteur'
e;2371249;'porteur>33701';1;0;'porteur>soutien'
e;2371250;'porteur>126724';1;0;'porteur>métier'
e;2371252;'porteur>51589';1;0;'porteur>finance'
e;2371253;'porteur>119133';1;0;'porteur>favorable'
e;2371258;'porteur>52119';1;0;'porteur>langue'
e;2371327;'porteur>162161';1;0;'porteur>biologie moléculaire'
e;227391;'longe>140100';1;52;'longe>viande'
e;251990;'chatouilleux>104757';1;50;'chatouilleux>délicat'
e;251991;'chatouilleux>63894';1;50;'chatouilleux>susceptible'
e;251992;'chatouilleux>108606';1;50;'chatouilleux>chatouillement'
e;254333;'passade>10683';1;2;'passade>caprice'
e;254332;'passade>30397';1;50;'passade>natation'
e;254334;'passade>28108';1;50;'passade>passer'
e;240928;'salière>25728';1;50;'salière>clavicule'
e;240927;'salière>13260';1;50;'salière>sel'
e;1366655;'palomino>39922';1;0;'palomino>cépage'
e;3731540;'isabelle>39922';1;0;'isabelle>cépage'
e;240048;'isabelle>40056';1;52;'isabelle>couleur'
e;240050;'isabelle>18285';1;50;'isabelle>papillon'
e;391073;'shetland>94609';1;50;'shetland>textile'
e;391074;'shetland>4455';1;50;'shetland>chien'
e;5409890;'poulain>68467';1;0;'poulain>poisson'
e;236399;'faucher>87633';1;50;'faucher>abattre'
e;236400;'faucher>71325';1;8;'faucher>renverser'
e;236397;'faucher>128828';1;50;'faucher>couper'
e;2609737;'osselet>53314';1;0;'osselet>jeu'
e;568573;'osselet>112609';1;54;'osselet>anatomie'
e;267360;'éperonner>143712';1;50;'éperonner>marine'
e;267359;'éperonner>9928';1;50;'éperonner>stimuler'
e;3750934;'piqueur>85109';1;0;'piqueur>surveillant'
e;261015;'piqueur>69797';1;50;'piqueur>ouvrier'
e;261016;'piqueur>102641';1;50;'piqueur>voleur'
e;261018;'piqueur>140429';1;50;'piqueur>chasse'
e;261017;'piqueur>71926';1;52;'piqueur>insecte'
e;3750944;'piqueur>61208';1;0;'piqueur>valet'
e;218320;'ferrer>145624';1;50;'ferrer>pêche'
e;218318;'ferrer>25997';1;50;'ferrer>armer'
e;218319;'ferrer>13017';1;50;'ferrer>appâter'
e;1873781;'gourmander>6451';1;0;'gourmander>larder'
e;238497;'fouetter>9928';1;50;'fouetter>stimuler'
e;238498;'fouetter>84625';1;2;'fouetter>avoir peur'
e;238499;'fouetter>66946';1;14;'fouetter>puer'
e;3224502;'se dérober>207968';1;2;'se dérober>se soustraire à'
e;3224503;'se dérober>53031';1;0;'se dérober>flageoler'
e;229275;'cravacher>69550';1;50;'cravacher>travailler'
e;237444;'être>94160';1;50;'être>existence'
e;8740476;'galop>313901';1;0;'galop>auscultation cardiaque'
e;227496;'galop>124091';1;50;'galop>réprimande'
e;227495;'galop>145605';1;50;'galop>danse'
e;1344458;'mauvais cheval>116477';1;0;'mauvais cheval>personne'
e;322499;'volte>81057';1;50;'volte>escrime'
e;322501;'volte>145605';1;50;'volte>danse'
e;322497;'volte>13662';1;50;'volte>fauconnerie'
e;322498;'volte>143712';1;50;'volte>marine'
e;1787694;'emballement>134263';1;0;'emballement>emballage'
e;1787696;'emballement>4658';1;0;'emballement>moteur'
e;1787693;'emballement>141641';1;2;'emballement>enthousiasme'
e;243573;'happelourde>25008';1;50;'happelourde>pierre'
e;243572;'happelourde>116477';1;50;'happelourde>personne'
e;243570;'happelourde>119008';1;50;'happelourde>illusion'
e;3130628;'perle noire>139228';1;0;'perle noire>perle'
e;218679;'aplomb>218678';1;8;'aplomb>confiance en soi'
e;218675;'aplomb>93050';1;50;'aplomb>verticalité'
e;218676;'aplomb>117003';1;50;'aplomb>stabilité'
e;1733628;'bouchonner>112269';1;0;'bouchonner>câliner'
e;1733630;'bouchonner>97650';1;0;'bouchonner>chiffonner'
e;8005152;'caracoler>143326';1;0;'caracoler>fierté'
e;1644944;'gourmer>119162';1;2;'gourmer>battre'
e;1969356;'lampas>140902';1;2;'lampas>étoffe'
e;324199;'selles>39009';1;50;'selles>excréments'
e;3284573;'débrider>143757';1;0;'débrider>art culinaire'
e;3284568;'débrider>35167';1;0;'débrider>défaire'
e;3284569;'débrider>67368';1;0;'débrider>mécanique'
e;3284570;'débrider>9549';1;0;'débrider>chirurgie'
e;3284572;'débrider>107206';1;0;'débrider>cesser'
e;4315722;'chapelet>156181';1;0;'chapelet>couronne de fleurs'
e;4315720;'chapelet>98040';1;0;'chapelet>architecture'
e;4315721;'chapelet>37544';1;0;'chapelet>hydraulique'
e;4315719;'chapelet>391919';1;0;'chapelet>suite d'éléments'
e;4315717;'chapelet>73890';1;0;'chapelet>religion'
e;4309872;'fanon>1816';1;0;'fanon>héraldique'
e;240294;'fanon>13872';1;50;'fanon>liturgie'
e;240291;'fanon>240290';1;50;'fanon>pli de peau'
e;240292;'fanon>38485';1;12;'fanon>baleine'
e;218225;'pie>43384';1;4;'pie>bavard'
e;230196;'pie>99340';1;50;'pie>assolement'
e;258257;'pie>2149';1;50;'pie>gâteau'
e;3301169;'traquenard>143741';1;0;'traquenard>piège'
e;320441;'être à cheval>57791';1;50;'être à cheval>position'
e;3301170;'traquenard>140429';1;0;'traquenard>chasse'
e;3301172;'traquenard>145605';1;0;'traquenard>danse'
e;332865;'derby>35220';1;50;'derby>match'
e;332867;'derby>75377';1;50;'derby>chaussure'
e;2356066;'derby>141687';1;0;'derby>fromage'
e;3307542;'viandard>102641';1;0;'viandard>voleur'
e;3307543;'viandard>37555';1;0;'viandard>exploiteur'
e;3307548;'viandard>30459';1;0;'viandard>chasseur'
e;3307541;'viandard>109337';1;0;'viandard>mangeur'
e;9915572;'montée>113767>143757';1;0;'montée>monter>art culinaire'
e;9915735;'montée>113767>88491';1;0;'montée>monter>reproduction'
e;9915573;'montée>113767>10564';1;0;'montée>monter>déplacement'
e;6681912;'carogne>61490';1;0;'carogne>femme'
e;220064;'étalon>39816';1;2;'étalon>modèle'
e;220063;'étalon>81845';1;50;'étalon>cheville'
e;3765269;'welsh>16033';1;0;'welsh>cuisine'
e;231560;'landau>47643';1;2;'landau>poussette'
e;239997;'poulain>109785';1;50;'poulain>peau'
e;239998;'poulain>74848';1;50;'poulain>débutant'
e;239999;'poulain>79169';1;50;'poulain>rampe'
e;266169;'poulain>124543';1;50;'poulain>bubon'
e;266170;'poulain>143712';1;50;'poulain>marine'
e;266171;'poulain>79616';1;50;'poulain>traîneau'
e;266172;'poulain>115507';1;50;'poulain>échelle'
e;3306552;'neigeur>3699';1;0;'neigeur>neige'
e;322690;'mettre le pied à l'étrier>10378';1;50;'mettre le pied à l'étrier>aider'
e;321827;'haut-le-corps>57562';1;50;'haut-le-corps>sursaut'
e;3228306;'canon>87852';1;0;'canon>typographie'
e;217844;'canon>73890';1;52;'canon>religion'
e;217845;'canon>139352';1;74;'canon>beauté'
e;223944;'paddock>71578';1;6;'paddock>lit'
e;223943;'paddock>219167';1;50;'paddock>sport mécanique'
e;223941;'paddock>31164';1;2;'paddock>enclos'
e;1899589;'coupe-jarret>75466';1;0;'coupe-jarret>brigand'
e;315481;'queue de cheval>61407';1;4;'queue de cheval>coiffure'
e;225760;'haridelle>61490';1;52;'haridelle>femme'
e;1880678;'piaffement>69306';1;0;'piaffement>agitation'
e;215636;'van>19126';1;50;'van>tamis'
e;11013686;'centaure>16644';1;0;'centaure>astronomie'
e;269342;'centaure>3674';1;50;'centaure>botanique'
e;252221;'alezan>40056';1;2;'alezan>couleur'
e;253156;'bidet>253154';1;26;'bidet>appareil sanitaire'
e;218564;'roi>60';1;50;'roi>bleu'
e;218563;'roi>87729';1;10;'roi>jeu de cartes'
e;218561;'roi>39531';1;244;'roi>souverain'
e;258403;'appuyer>104624';1;50;'appuyer>soutenir'
e;258405;'appuyer>70527';1;50;'appuyer>musique'
e;258406;'appuyer>159300';1;52;'appuyer>exercer une pression'
e;258407;'appuyer>36329';1;50;'appuyer>insister'
e;258408;'appuyer>146050';1;50;'appuyer>militaire'
e;258409;'appuyer>25800';1;50;'appuyer>chemin de fer'
e;258410;'appuyer>115066';1;50;'appuyer>prononciation'
e;263821;'chevalin>80897';1;50;'chevalin>apparence'
e;330440;'rosse>330439';1;54;'rosse>personne méchante'
e;1796766;'capricieux>91664>116477';1;0;'capricieux>caractère>personne'
e;1880657;'piaffer>138099';1;0;'piaffer>s'agiter'
e;1880662;'piaffer>1880658';1;0;'piaffer>faire de l'esbroufe'
e;1796764;'capricieux>84931';1;0;'capricieux>fonctionnement'
e;3301077;'zain>4455';1;0;'zain>chien'
e;3301076;'zain>28993';1;0;'zain>taureau'
e;241566;'chopper>59813';1;50;'chopper>heurter'
e;3147349;'chopper>59471';1;0;'chopper>erreur'
e;257991;'pie>242270';1;50;'pie>pieuse'
e;322596;'emballé>6566';1;50;'emballé>empaqueté'
e;322597;'emballé>52757';1;50;'emballé>enthousiaste'
e;322598;'emballé>4658';1;50;'emballé>moteur'
e;222564;'onagre>145941';1;50;'onagre>plante'
e;222565;'onagre>203247';1;52;'onagre>machine de guerre'
e;1733622;'bouchonné>1733620';1;0;'bouchonné>câliné'
e;1733621;'bouchonné>35798';1;0;'bouchonné>vin'
e;1733623;'bouchonné>121707';1;0;'bouchonné>chiffonné'
e;1859380;'monté>100457';1;0;'monté>ourdi'
e;1859383;'monté>73406';1;0;'monté>surélevé'
e;1859385;'monté>113767';1;0;'monté>monter'
e;1859388;'monté>37460';1;2;'monté>membré'
e;1859381;'monté>92532';1;0;'monté>serti'
e;1859382;'monté>66909';1;0;'monté>spectacle'
e;1859386;'monté>218995';1;0;'monté>grimpé'
e;1859387;'monté>31207';1;0;'monté>assemblé'
e;1859389;'monté>3674';1;0;'monté>botanique'
e;250448;'poussif>81384';1;50;'poussif>lent'
e;250450;'poussif>4658';1;50;'poussif>moteur'
e;250451;'poussif>94337';1;52;'poussif>essoufflé'
e;1824459;'commencé>42056';1;0;'commencé>ordre'
e;1824460;'commencé>266163';1;0;'commencé>débuté'
e;1824617;'commencé>8431';1;0;'commencé>commencer'
e;1792312;'talonné>13488';1;0;'talonné>talonner'
e;1792313;'talonné>1789069';1;0;'talonné>suivi de près'
e;11136749;':gLeandro';1002;0
e;44320;'adouber';1;66
e;148157;'fiord';1;50
e;6796162;'=kidney=';1;0
e;182413;'faux départ';1;50
e;11254601;'relever>83824';1;0;'relever>équitation'
e;11237210;'meneur>83824';1;0;'meneur>équitation'
e;3762435;'ingrédient de recette de cuisine';1;2
e;40668;'voltiger';1;64
e;18305;'duc';1;138
e;55687;'tic';1;126
e;12489;'morelle';1;50
e;11148211;'voltiger>249281';1;0;'voltiger>arts du spectacle'
e;7574;'autre';1;156
e;684613;'passager>146882';1;0;'passager>Ver:Inf'
e;7905;'bardeau';1;50
e;73407;'montée';1;230
e;216599;'assiette>57791';1;8;'assiette>position'
e;585799;'talonné>171869';1;0;'talonné>Adj:'
e;1792314;'talonné>161702';1;0;'talonné>Ver:PPas'
e;6947917;'=vertebrata=';1;0
e;13488;'talonner';1;70
e;162384;'messagère';1;72
e;11028580;'épreuve équestre';1;0
e;11062194;'pur-sang>145246';1;0;'pur-sang>cheval'
e;11254206;'serré>145246';1;0;'serré>cheval'
e;4189;'serré';1;168
e;11304038;'autre>145246';1;0;'autre>cheval'
e;217001;'passager>105849';1;50;'passager>faire marcher'
e;180127;'clarence';1;50
e;131040;'prix';1;1196
e;4325714;'morelle>64238';1;0;'morelle>noir'
e;225617;'duc>180116';1;50;'duc>véhicule hippomobile'
e;49446;'Yakoutes';1;50
e;107505;'chevals';1;50
e;150831;'talonné';1;50
e;214467;'dressage>98271';1;50;'dressage>domptage'
e;318124;'statue équestre de Jeanne d'Arc';777;50
e;48242;'boute-en-train';1;52
e;362977;'mammifère quadrupède';1;50
e;11529;'char';1;284
e;1796788;'capricieux>91664>171869';1;0;'capricieux>caractère>Adj:'
e;323515;'articulation du genou';1;6
e;6823795;'=dourine=';1;0
e;220219;'élevage équin';1;50
e;236818;'Game of Thrones';1;10
e;329353;'tic>76247';1;50;'tic>vétérinaire'
e;3155022;'an:94958:?:57444:150';12;50
e;53958;'canter';1;50
e;24386;'dourine';1;50
e;1657862;'long abducteur du bras';1;0
e;130669;'coupe-jarret';1;50
e;594657;'capricieux>171869';1;0;'capricieux>Adj:'
e;75577;'capricieux';1;110
e;108952;'baie';1;310
e;269341;'centaure>32303';1;50;'centaure>mythologie'
e;1792526;'talonner>99262';1;0;'talonner>éperonner'
e;3154522;'an:140176:43853:?:8990';12;50
e;213108;'course de chars';1;6
e;30459;'chasseur';1;668
e;43442;'ho';1;76
e;218321;'ferrer>136249';1;50;'ferrer>maréchal-ferrant'
e;149641;'phalère';1;50
e;33866;'animaux de ferme';1;54
e;269343;'centaure>141471';1;50;'centaure>cavalier'
e;232533;'bardeau>38295';1;50;'bardeau>équidé'
e;7710037;'bardot>38295';1;0;'bardot>équidé'
e;175720;'Mammalia';1;50
e;223545;'étrille>71818';1;50;'étrille>grattoir'
e;265864;'agaceur';1;2
e;2925816;'Gerbille de Przewalski';777;0
e;39277;'oestre';1;50
e;175815;'œstre';1;50
e;73271;'boute-selle';1;50
e;676910;'baie>171869';1;0;'baie>Adj:'
e;141009;'landau';1;124
e;1796765;'capricieux>91664';1;0;'capricieux>caractère'
e;94431;'neck';1;50
e;214955;'char>145971';1;52;'char>antiquité'
e;235349;'sombral';1;50
e;122532;'anticoeur';1;50
e;264690;'parer>264686';1;50;'parer>retenir un cheval'
e;267581;'portrait équestre';1;50
e;31673;'hippomobile';1;50
e;55942;'voiture hippomobile';1;64
e;285847;'statue équestre';1;50
e;394276;'coup de sabot';1;50
e;48053;'Kirghizistan';1;50
e;3155133;'an:94958:?:14758:4455';12;50
e;105109;'embarrure';1;50
e;12632;'onagre';1;70
e;115864;'lampas';1;54
e;50043;'étrille';1;54
e;6798394;'=neck=';1;0
e;91544;'rouer';1;130
e;3155072;'an:4455:7705:?:6070';12;50
e;453402;'onagre>146885';1;50;'onagre>Nom:Mas+SG'
e;143334;'Mammifères';1;52
e;2398372;'corricolo';1;0
e;3249127;'anémie infectieuse équine';1;0
e;6358775;'articulations des genoux';1;0
e;6385566;'articulation des genoux';1;0
e;6341497;'articulations du genou';1;0
e;191636;'police montée';1;52
e;1899588;'coupe-jarret>180300';1;0;'coupe-jarret>histoire militaire'
e;1792311;'talonné>229083';1;0;'talonné>éperonné'
e;2488439;'hippalectryon';1;0
e;1796767;'capricieux>91664>17559';1;0;'capricieux>caractère>animal'
e;1969357;'lampas>43729';1;0;'lampas>médecine vétérinaire'
e;212602;'animaux de la ferme';666;2
e;42406;'La Jument verte';1;50
e;2524623;'sellinger';1;0
e;2940778;'voiture>2940777';1;18;'voiture>véhicule de transport à roues'
e;268681;'tourisme équestre';1;50
e;8035175;'=bookmaker=';1;0
e;21331;'quinté';1;52
e;89027;'Gobi';1;76
e;18800;'arion';1;50
e;314115;'poivre d'âne';1;50
e;322341;'jouer au tiercé';1;50
e;322368;'jouer aux courses';1;50
e;61365;'ânon';1;54
e;139177;'rodéo';1;64
e;144217;'cocher';1;82
e;79616;'traîneau';1;62
e;153486;'dos d'âne';1;124
e;263822;'chevalin>263816';1;50;'chevalin>hippotrague rouan'
e;153696;'traineau';1;62
e;137141;'dos-d'âne';1;62
e;264176;'animal de cirque';1;6
e;70460;'Tabanidés';1;50
e;208743;'tabanidés';1;50
e;257864;'jouet en bois';1;50
e;248625;'art du cirque';1;50
e;239237;'bête de trait';1;50
e;16962;'âne bâté';1;56
e;314109;'âne rouge';1;50
e;2863229;'baie>40056';1;0;'baie>couleur'
e;330439;'personne méchante';1;50
e;330577;'animal de bât';1;50
e;2424381;'séneçon de Jacob';1;0
e;3706941;'aller chercher sa fille au poney';1;0
e;106921;'Prudence de Troyes';1;50
e;64090;'Épona';1;50
e;216625;'prix>130808';1;50;'prix>course'
e;27191;'ferré';1;76
e;119583;'Hippone';1;52
e;87694;'regimbeur';1;50
e;57834;'Yvain ou le Chevalier au lion';1;50
e;227390;'longe>8595';1;50;'longe>corde'
e;3157590;'an:74860:61490:?:6070';12;50
e;145979;'shire';1;50
e;5235;'trotte';1;50
e;79598;'Monte là-dessus';1;50
e;230919;'Chevauchée des Walkyries';1;26
e;3172314;'chevauchée des Walkyries';777;0
e;3171947;'os vomer';1;0
e;139942;'botte';1;490
e;121147;'abreuver';1;96
e;89216;'Lancelot';1;108
e;217596;'La Petite Gardeuse d'oies';1;36
e;213044;'Ralph Lauren';1;50
e;1875651;'pas espagnol';1;0
e;3727772;'van>3727771';1;0;'van>transport des chevaux'
e;7609067;'=bottom=';1;0
e;136249;'maréchal-ferrant';1;76
e;78759;'rubican';1;50
e;3156322;'an:58356:?:32820:145295';12;50
e;2365371;'attrapaïres';1;0
e;77747;'ferrage';1;58
e;73119;'saloon';1;106
e;232400;'L'Homme qui murmurait à l'oreille des chevaux';1;50
e;3155635;'an:75377:74860:?:153276';12;50
e;52704;'trois';1;2346
e;2569;'bât';1;62
e;23145;'mousquetaire';1;388
e;152248;'terre battue';1;92
e;10879;'tour';1;1702
e;121735;'regimber';1;52
e;162197;'les animaux';1;50
e;222563;'onagre>48795';1;16;'onagre>âne'
e;231561;'landau>180116';1;4;'landau>véhicule hippomobile'
e;263816;'hippotrague rouan';1;50
e;145911;'equus';1;54
e;436410;'robe alezane';1;50
e;3157468;'an:97335:?:50306:71135';12;50
e;270825;'cavalier sans tête';1;4
e;1882286;'gerbille de Przewalski';1;0
e;214234;'chasseur>102633';1;4;'chasseur>soldat'
e;335445;'animal de bois peint';1;50
e;3157631;'an:110160:?:3508:145168';12;50
e;7083422;'=sioux=';1;0
e;3155632;'an:75377:74860:?:124092';12;50
e;55381;'sioux';1;86
e;141945;'roulotte';1;128
e;2363605;'hippotomie';1;0
e;6400303;'articulation du grasset';1;0
e;18117;'carriole';1;52
e;25141;'chasse à courre';1;86
e;162276;'cowboys';1;50
e;3157274;'an:37194:117146:6070:?';12;50
e;6819546;'=knee joint=';1;0
e;145682;'ferrer';1;84
e;176685;'brûle-queue';1;50
e;46231;'déferrer';1;54
e;19679;'Ferrari';1;176
e;217606;'Tom Pouce';1;12
e;137798;'centaure';1;66
e;19271;'lunatique';1;162
e;6948258;'=mammalia=';1;0
e;148494;'hippiatrique';1;50
e;144770;'bardot';1;52
e;34961;'déferrage';1;50
e;2405930;'nerf-férure';1;0
e;3443;'toréador';1;102
e;1881032;'tauréador';1;0
e;179831;'toreador';1;50
e;64693;'polo';1;116
e;5897;'charrette';1;106
e;219999;'Sancho Panza';1;24
e;6905985;'=equine infectious anemia=';1;0
e;3249386;'anémie infectieuse des équidés';777;0
e;261627;'corbillard>180116';1;50;'corbillard>véhicule hippomobile'
e;218562;'roi>145556';1;84;'roi>jeu d'échecs'
e;228048;'chevalier Bayard';1;32
e;3156334;'an:120842:4455:97335:?';12;50
e;6795768;'=horseshoe kidney=';1;0
e;28801;'Troie';1;198
e;2432615;'cataclop';1;0
e;2442414;'cataclope';1;0
e;60062;'grand écuyer';1;50
e;21729;'prince charmant';1;314
e;152227;'Zorro';1;332
e;64442;'western';1;318
e;11286019;'placer>83824';1;0;'placer>équitation'
e;11305608;'pommeau>83824';1;0;'pommeau>équitation'
e;223691;'hippocampe>68467';1;50;'hippocampe>poisson'
e;1934159;'stock horse';777;0
e;233274;'collier>81764';1;50;'collier>harnais'
e;595857;'Rocinante';777;0
e;2446663;'guilledin';1;0
e;95102;'stupide';1;532
e;233136;'animal>101438';1;52;'animal>inhumain'
e;104855;'hippopotame';1;148
e;233137;'animal>44977';1;52;'animal>charnel'
e;233134;'animal>66517';1;8;'animal>monstre'
e;117579;'jouet';1;976
e;221983;'homme>24956';1;158;'homme>être humain'
e;233145;'tête>24682';1;50;'tête>haut'
e;123573;'sommet';1;762
e;27332;'gambette';1;66
e;233143;'tête>141659';1;50;'tête>vie'
e;233146;'tête>134768';1;4;'tête>dirigeant'
e;6800353;'=nervous system=';1;0
e;157137;'::>13:61490>29:79364>16';9;50;'Avec quoi une femme pourrait sauter ?'
e;161742;'::>14:17559>29:13368>16';9;50;'Avec quoi pourrait-on déloger un animal ?'
e;326819;'::>13:61490>29:79364';8;50;'sauter [sujet] femme'
e;327948;'::>14:17559>29:13368';8;50;'déloger [objet] animal'
e;258468;'aller bosser';1;102
e;153956;'aller au boulot';1;74
e;222212;'aller au travail';1;88
e;254122;'aller travailler';1;16
e;118970;'pourchasser';1;74
e;22824;'aller';1;524
e;7724;'charger';1;530
e;160192;'::>14:6890>29:86792>16';9;50;'Avec quoi pourrait-on doubler une voiture ?'
e;326596;'::>14:6890>29:86792';8;50;'doubler [objet] voiture'
e;51520;'promener';1;172
e;158902;'::>13:101083>29:39895>16';9;50;'Avec quoi un policier pourrait poursuivre ?'
e;327426;'::>13:101083>29:39895';8;50;'poursuivre [sujet] policier'
e;157702;'::>13:74860>29:29690>16';9;50;'Avec quoi un homme pourrait fuir ?'
e;326771;'::>13:74860>29:29690';8;50;'fuir [sujet] homme'
e;10314012;'=heterotroph=';1;0
e;96256;'bois';1;4700
e;150;'chat';1;5062
e;120483;'fièvre aphteuse';1;54
e;28993;'taureau';1;862
e;138501;'vache';1;2224
e;8008;'agriculteur';1;686
e;58380;'hongreur';1;50
e;224925;'postillon>144217';1;50;'postillon>cocher'
e;81877;'basculer';1;52
e;39494;'houssine';1;50
e;142883;'ibérique';1;86
e;15669;'je';1;302
e;391763;'Guerre de Troie';666;54
e;191892;'guerre de Troie';1;130
e;191808;'Gengis Khan';1;16
e;75805;'avoine';1;180
e;44223;'hippogriffe';1;52
e;4455;'chien';1;5278
e;56572;'caca';1;560
e;47170;'encéphalopathie spongiforme bovine';1;58
e;33229;'ESB';1;86
e;73643;'cervidés';1;68
e;142460;'Cervidés';1;50
e;181180;'boite crânienne';1;6
e;148456;'harnois';1;50
e;140613;'mine';1;808
e;54090;'Tintin';1;1690
e;123492;'statue';1;623
e;12182;'psychopompe';1;58
e;107179;'ski';1;1116
e;87987;'France';1;2580
e;94184;'morve';1;222
e;45320;'chameau';1;248
e;139065;'sports d'hiver';1;118
e;90865;'exploitation minière';1;64
e;2680;'sang';1;3046
e;8352;'vérité';1;416
e;236554;'Harley-Davidson';1;2
e;139383;'crotte';1;346
e;110980;'Léonard de Vinci';1;98
e;44397;'pantalon';1;1466
e;59781;'dromadaire';1;138
e;7587;'Biscarrosse';1;50
e;145987;'furet';1;102
e;152983;'sport d'hiver';1;66
e;145715;'poste';1;1104
e;271889;'opérateur postal';777;50
e;42723;'montagnes Rocheuses';1;50
e;271903;'Montagnes Rocheuses';777;50
e;9553;'bleu de méthylène';1;52
e;19554;'paysan';1;954
e;272452;'ponette';777;50
e;64585;'vrai';1;512
e;66856;'Hernán Cortés';1;60
e;272789;'cortez';777;50
e;272790;'Fernando Cortés de Monroy Pizarro Altamirano';777;50
e;144792;'bongo';1;52
e;273055;'bongó';777;50
e;142381;'barre';1;490
e;145919;'Barre';1;52
e;34296;'saucisson';1;432
e;121129;'bouchon';1;588
e;106718;'matières fécales';1;56
e;273954;'fæces';777;50
e;108962;'fèces';1;72
e;273955;'étrons';777;50
e;48241;'fécal';1;52
e;274074;'Edward James Muybridge';777;50
e;155613;'Messenger';1;50
e;118027;'hybride';1;118
e;274276;'parent mâle de l'hybridation';777;50
e;274277;'Parent femelle de l'hybridation';777;50
e;125918;'mule';1;108
e;274291;'univers de Harry Potter';777;50
e;274292;'Ordre du phénix';777;68
e;274393;'impulsion ou';777;50
e;176106;'classification classique';1;50
e;1798;'clonage';1;82
e;106785;'futal';1;50
e;4928;'Clint Eastwood';1;66
e;2582;'civière';1;86
e;64836;'brancard';1;140
e;275330;'chameau d'Arabie';777;50
e;275349;'mammifere';777;50
e;274822;'en danger critique d'extinction';777;50
e;275458;'Pétrel de Bourbon';777;50
e;275459;'Pétrel noir de Bourbon';777;50
e;275460;'Pétrel de La Réunion';777;50
e;122852;'douleur';1;2526
e;147012;'chiens';1;146
e;275725;'théâtre grec antique';1;50
e;89299;'Bataves';1;50
e;59020;'tragédie';1;518
e;18215;'tragédien';1;62
e;126;'barbillon';1;54
e;1500;'portage';1;76
e;276748;'portageur';777;50
e;276896;'Jean-Baptiste Noulet';777;50
e;2254;'noulet';1;50
e;2962;'vénerie';1;54
e;277360;'vènerie';777;50
e;2989;'hygromètre';1;60
e;3781;'service postal';1;52
e;277975;'vermicompost';777;50
e;5261;'lombricompostage';1;50
e;5465;'névrectomie';1;50
e;64529;'Érinyes';1;50
e;200158;'Euménides';1;50
e;188704;'Furies';1;50
e;7281;'tisiphone';1;50
e;7705;'chienne';1;308
e;8474;'Érinye';1;50
e;278640;'rinye';777;50
e;137127;'Dionysos';1;92
e;78886;'Théodore Géricault';1;56
e;91481;'douloureux';1;278
e;9756;'perruque';1;120
e;10262;'indolore';1;66
e;279654;'hyksôs';777;50
e;20312;'Hyksos';1;50
e;279855;'artus';777;50
e;20707;'Arthus';1;50
e;79400;'pinceau';1;898
e;127211;'statuette';1;84
e;273472;'Origine';777;50
e;272722;'Adresse';777;50
e;143853;'Famille';1;50
e;272362;'Entourage';777;50
e;74161;'Huns';1;62
e;148542;'hunnique';1;52
e;117057;'ahimsa';1;62
e;222873;'cerf élaphe';1;50
e;280498;'cerf de Bactriane';777;50
e;280499;'cerf du Turkestan';777;50
e;72813;'cerf';1;166
e;56188;'périssodactyles';1;50
e;280729;'Perissodactyla';777;50
e;60108;'mésaxonien';1;50
e;121335;'hippanthrope';1;50
e;136161;'bétail';1;128
e;201604;'gros bétail';1;50
e;280864;'petit bétail';777;50
e;70685;'trichinose';1;50
e;180254;'trichinellose';1;50
e;152708;'chat domestique';1;154
e;217629;'CHAT';1;50
e;33081;'Cronos';1;70
e;282401;'Kronos';777;50
e;141238;'cronos';1;50
e;282558;'grotte Chauvet-Pont-d'Arc';777;50
e;282560;'grotte de la Combe d'Arc';777;50
e;282662;'Girolamo Francesco Maria Mazzola';777;50
e;282663;'Mazzuoli';777;50
e;282664;'parmigianino';777;50
e;55167;'Francesco Mazzola';1;50
e;143186;'Bucentaure';1;50
e;33468;'écuries';1;50
e;282728;'curies';777;2
e;112087;'thylacine';1;50
e;282917;'loup marsupial';777;50
e;269927;'loup de Tasmanie';1;50
e;18423;'crânien';1;94
e;216064;'matière fécale';1;86
e;49844;'émasculation';1;68
e;283087;'masculation';777;50
e;283365;'Martha Canary';777;50
e;223275;'Calamity Jane';1;4
e;225231;'Martha Jane Cannary';1;56
e;223177;'espèce éteinte';1;52
e;283364;'extinction des espèces';777;50
e;270113;'Mittelbergheim';1;50
e;30517;'psychromètre';1;50
e;30873;'comportementaliste';1;50
e;69235;'Muybridge';1;50
e;50752;'champignonnière';1;52
e;51470;'canin';1;140
e;51772;'Gygès';1;52
e;54142;'garde forestier';1;58
e;45738;'vibrisse';1;62
e;45796;'muserolle';1;50
e;46686;'Gandharva';1;50
e;219964;'maladie de la vache folle';1;32
e;272145;'Tamurt Lezzayer';777;50
e;11981;'Algérie';1;218
e;272147;'République algérienne démocratique et populaire';777;50
e;272148;'radp';777;50
e;133903;'gale';1;86
e;286544;'scabiose';777;50
e;223251;'palais de Westminster';1;10
e;286936;'Maisons du Parlement';777;50
e;228045;'matière de France';1;50
e;287565;'Cycle carolingien';777;50
e;32071;'blé';1;1202
e;287793;'Triticum';777;50
e;138087;'Orne';1;60
e;288478;'Histoire évolutive des équidés';777;50
e;72272;'Isabelle';1;60
e;144116;'Gétules';1;50
e;61747;'Lucky Luke';1;294
e;159506;'pied bot';1;60
e;149672;'pied-bot';1;64
e;41035;'Histoire de la France';1;50
e;164828;'croissant fertile';1;58
e;39899;'rationnement';1;52
e;290318;'rouannage';777;50
e;55740;'paysannerie';1;100
e;272186;'En danger';777;50
e;191784;'Pas de printemps pour Marnie';1;4
e;155633;'viande blanche';1;250
e;290804;'Nouvel an du calendrier chinois';777;50
e;230900;'nouvel an lunaire';1;4
e;290805;'fête du printemps';777;50
e;230899;'nouvel an chinois';1;4
e;291103;'furet albinos';777;50
e;291104;'furet putoisé';777;50
e;291105;'Mustela putorius furo';777;50
e;141655;'Cassandre';1;56
e;127191;'Alexandra';1;50
e;57383;'chicaneur';1;62
e;168562;'coracle';1;50
e;291907;'nord-amérindiens';777;50
e;291908;'Indiens d'Amérique du Nord';777;50
e;230324;'Nord-Amérindien';1;2
e;138604;'Roussin';1;50
e;37722;'Le Figuier';1;52
e;146603;'Cheval-vapeur';1;50
e;225668;'Bisounours';1;16
e;266283;'Calinours';1;4
e;106958;'Irlande';1;226
e;158679;'irlandaise';1;56
e;166464;'raquette à neige';1;50
e;59550;'raquette';1;416
e;177242;'goulash';1;4
e;60863;'goulache';1;52
e;292739;'soupe de goulash';777;50
e;292753;'Cervidae';777;50
e;142735;'Xénophon';1;50
e;181181;'boîte crânienne';1;16
e;11487;'Histoire de France';1;50
e;293647;'culture d'Andronovo';777;50
e;11701;'Andronovo';1;50
e;13040;'Richard Francis Burton';1;50
e;122824;'phalange';1;590
e;14625;'phalange macédonienne';1;52
e;16380;'cloche-pied';1;50
e;17568;'Bongo';1;50
e;294329;'Herbert Graf';777;50
e;18430;'Petit Hans';1;50
e;190283;'cavalier professionnel';1;50
e;141479;'garçon d'écurie';1;52
e;23134;'hampe';1;68
e;294815;'grande douve du foie';1;14
e;294823;'Fasciola hepatica';1;10
e;66901;'miracidium';1;50
e;91638;'rédie';1;50
e;20471;'cercaire';1;56
e;24992;'Felis catus';1;50
e;295053;'fasciolose';1;2
e;295054;'fasciolase';777;50
e;295055;'distomatose hépatique';777;50
e;28497;'Tom Thumb';1;52
e;31302;'bucentaure';1;50
e;31835;'Savigny-le-Temple';1;52
e;32928;'Bourganeuf';1;50
e;33225;'vraie';1;60
e;159315;'blancs';1;144
e;34709;'Blancs';1;52
e;36997;'art sassanide';1;50
e;126854;'débourrage';1;50
e;37571;'fiente';1;104
e;296247;'lansquenets';777;50
e;39247;'lansquenet';1;50
e;40853;'sanglant';1;124
e;48335;'catégories';1;54
e;50033;'hallali';1;54
e;49544;'Maïkop';1;50
e;55984;'Fulrad';1;50
e;297239;'Fulrade';777;50
e;56609;'Pie';1;52
e;56614;'Rocheuses';1;50
e;57481;'Shoshones';1;50
e;142297;'Éperon';1;50
e;58693;'bongos';1;50
e;59495;'bidoche';1;64
e;143594;'alecto';1;50
e;60014;'Alecto';1;50
e;66505;'racial';1;62
e;298267;'rallye-papier';777;50
e;298268;'rallie-papier';777;50
e;67719;'Thylacinus cynocephalus';1;50
e;298498;'Ungulata';777;50
e;298499;'ongul';777;50
e;298607;'Nation Comanche';777;50
e;70796;'Comanches';1;50
e;73692;'cirques';1;50
e;73876;'perruquier';1;54
e;73913;'tarasque';1;50
e;74780;'Hans';1;50
e;75228;'Hénin-Beaumont';1;50
e;76661;'Amish';1;54
e;78497;'faon';1;84
e;81718;'surdent';1;50
e;83951;'vache folle';1;108
e;84212;'Cuirassier blessé quittant le feu';1;56
e;86453;'humidimètre';1;50
e;148416;'guêtres';1;50
e;87429;'monohybridisme';1;52
e;87654;'bricole';1;68
e;88744;'mégère';1;90
e;90961;'hoplite';1;58
e;91315;'laboureur';1;70
e;144089;'Laboureur';1;50
e;95402;'anatomie comparée';1;52
e;96227;'roquet';1;52
e;31417;'archet';1;80
e;99986;'archetier';1;50
e;101579;'courre';1;74
e;101957;'Géricault';1;64
e;301257;'alezan brûlé';777;50
e;301492;'martingale à anneaux';777;50
e;301493;'enrênements';777;50
e;105533;'sports de glace';1;50
e;105835;'catgut';1;60
e;301518;'boyau de chat';777;50
e;105929;'denture';1;66
e;201174;'formule dentaire';1;52
e;229855;'paysans';1;68
e;105973;'Paysans';1;50
e;301546;'questre';777;50
e;107444;'Cassandra';1;50
e;144097;'Araméens';1;50
e;301923;'Antoine-Henri-Philippe-Léon Cartier';777;50
e;301924;'d'Aure';777;50
e;110954;'auriste';1;50
e;112880;'furies';1;50
e;273800;'quasi menacé';777;50
e;302193;'Répartition du condor des Andes';777;50
e;113694;'condor des Andes';1;50
e;151430;'zoothérapie';1;50
e;114889;'Grand Canyon';1;54
e;115556;'moumoute';1;52
e;115734;'Hippias majeur';1;50
e;152822;'moldu';1;158
e;152914;'Cirque';1;52
e;153245;'fête foraine';1;240
e;302678;'Christopher D'Olier Reeve';777;50
e;302679;'Christopher Reeve';777;50
e;153272;'Christopher Reeves';1;50
e;117684;'mulassier';1;50
e;117929;'véracité';1;62
e;155074;'sang de bourbe';1;56
e;155205;'paysanne';1;168
e;155309;'histoire de France';1;76
e;121354;'féral';1;50
e;155557;'postale';1;76
e;123397;'digestibilité';1;50
e;124714;'Jerry Spring';1;50
e;128123;'apprivoisement';1;50
e;129557;'dihybridisme';1;52
e;136010;'fumure';1;56
e;138505;'Chien';1;50
e;304645;'le disparu';777;50
e;142806;'complexe d'OEdipe';1;52
e;142851;'Vérité';1;50
e;148519;'hoplites';1;50
e;159088;'théâtre grec';1;68
e;305079;'club d'équitation';777;50
e;305080;'poney club';777;50
e;168262;'loup-marsupial';1;50
e;175314;'Chat';1;50
e;175543;'Felis silvestris catus';1;50
e;306123;'qilin';777;50
e;306124;'kilin';777;50
e;306125;'kirin';777;50
e;186895;'tailler des croupières';1;50
e;148568;'hyperalgésie';1;50
e;159614;'théâtre antique';1;70
e;168776;'carnyx';1;50
e;306953;'carnynx';777;50
e;306954;'carnux';777;50
e;158788;'crânienne';1;56
e;197619;'classification linnéenne';1;50
e;23710;'grisonnement';1;50
e;201595;'gris fer';1;50
e;168321;'tigre de Tasmanie';1;50
e;179343;'latin vulgaire';1;28
e;226792;'latin populaire';1;4
e;227419;'gentilé';1;22
e;227598;'Thierry la Fronde';1;52
e;187830;'grand-bi';1;52
e;228452;'chiennes';1;92
e;194394;'pétrel de Bourbon';1;50
e;234857;'tragédie grecque';1;16
e;236797;'danse du soleil';1;50
e;237259;'fourchelangue';1;12
e;308958;'éléphants de guerre';777;50
e;237318;'éléphant de guerre';1;50
e;238504;'poulinage';1;50
e;242965;'bisounours';1;10
e;254734;'douleur chronique';1;50
e;201814;'histoire des techniques';1;50
e;209106;'Tisiphone';1;50
e;198177;'critère de vérité';1;50
e;209692;'vérité historique';1;50
e;223663;'lombricomposteur';666;50
e;226486;'chocobo';1;50
e;234203;'Animagus';1;38
e;234978;'Fifi Brindacier';1;4
e;226891;'Poudlard Express';666;50
e;229673;'Helhest';1;50
e;310787;'Helhestr';777;50
e;231185;'Mangemort';1;176
e;231673;'fourchelang';666;2
e;231187;'patronus';1;104
e;246899;'tragédienne';1;58
e;230901;'calendrier chinois';1;2
e;259824;'ressources minières';1;50
e;258154;'pure race';1;50
e;260953;'bouchons';1;58
e;246729;'saint Georges';666;50
e;254735;'douleurs chroniques';1;50
e;311879;'Laurence Kerr Olivier';777;50
e;265306;'Laurence Olivier';1;52
e;312345;'élevage laitier';1;52
e;315222;'ehrlichiose';777;50
e;314679;'anaplasmose';1;50
e;314855;'gale sarcoptique';1;2
e;314854;'gale psoroptique';1;2
e;314852;'gale de Naples';1;2
e;133866;'impulsion';1;138
e;393151;'Gazette du Sorcier';777;50
e;141634;'Chevalier';1;50
e;393350;'Cavale';1;50
e;436350;'club hippique';1;50
e;4511063;'Érinnyes';777;0
e;378544;'sang humain';1;50
e;378743;'saucisse sèche';1;50
e;403119;'Acinetobacter';1;50
e;345800;'cycle carolingien';1;50
e;402432;'Horse';1;50
e;461526;'famille des cultures d'Andronovo';777;50
e;465097;'En selle !';777;50
e;566569;'pur-sang arabe';777;50
e;566568;'Hunter irlandais';777;50
e;566567;'ish';777;50
e;566566;'Irish Sport Horse';777;50
e;338195;'bain de sable';1;50
e;566333;'bain de';777;52
e;336562;'art forain';1;50
e;390742;'mammalofaune';1;50
e;390744;'mammofaune';1;50
e;389737;'éleveur de chevaux';1;50
e;352481;'espèce rare';1;50
e;567034;'haras nationaux';777;50
e;357485;'haras national';1;50
e;359589;'interdit alimentaire';1;50
e;567123;'Religion et alimentation';777;50
e;567432;'goudron de Norvège';777;50
e;367353;'onguent noir';1;50
e;567688;'liste des races chevalines';777;50
e;375072;'race équine';1;50
e;567691;'races de chevaux';777;50
e;375067;'race chevaline';1;50
e;383713;'ticket de rationnement';1;50
e;568170;'âne commun';777;50
e;568171;'equus asinus';777;50
e;568172;'Equus africanus asinus';777;50
e;422584;'Baudet';1;50
e;389138;'âne domestique';1;50
e;568710;'marquage au fer';777;50
e;397221;'Sang';1;50
e;39009;'excréments';1;84
e;569253;'fientes';777;50
e;399696;'fécale';1;50
e;400394;'viandes';1;50
e;401288;'barbillons';1;58
e;402202;'crânes';1;50
e;18094;'bifteck';1;94
e;404070;'cranienne';1;50
e;404861;'Isabel';1;50
e;406454;'Marbourg';1;50
e;407394;'Blé';1;50
e;315940;'groupe statuaire';1;70
e;411218;'Louvet';1;50
e;412349;'arthus';1;50
e;413504;'Saut';1;50
e;415439;'Bai';1;50
e;417811;'néarctique';1;50
e;418983;'cranien';1;50
e;420241;'Kelpie';1;50
e;420160;'criollo';1;50
e;571427;'criollo argentin';777;50
e;571428;'crioulo';777;50
e;571429;'criollo chilien';777;50
e;421764;'éperons';1;50
e;422833;'Tragédie';1;50
e;423194;'Erinyes';1;50
e;425641;'Assiette';1;52
e;343132;'chasse à bruit';1;50
e;425964;'Goti';1;50
e;426151;'Paysan';1;50
e;427048;'Driver';1;50
e;428109;'Manticore';1;50
e;428537;'Pantalon';1;50
e;429088;'Tarasque';1;50
e;430269;'Jockeys';1;50
e;572542;'dragon oriental';777;50
e;430662;'Yong';1;50
e;62880;'économique';1;136
e;431208;'oeconomicus';1;50
e;431750;'brancards';1;50
e;568213;'asinus';1;50
e;63340;'chronophotographie';1;50
e;142389;'Périssodactyles';1;50
e;575878;'mésaxoniens';777;50
e;139752;'Blanc';1;54
e;161695;'jeu de piste';1;58
e;237804;'chasse au trésor';1;2
e;12164;'acrodonte';1;50
e;120062;'pleurodonte';1;50
e;72150;'Hécate';1;50
e;579698;'big bear';777;0
e;579699;'Mistahimaskwa';777;0
e;167612;'gros ours';1;50
e;404282;'Année';1;50
e;144329;'Père';1;50
e;146510;'Mère';1;50
e;581450;'Gens du serpent';777;0
e;581881;'Edward James Muggeridge';777;0
e;167055;'Les Bisounours';1;50
e;168814;'cor d'harmonie';1;4
e;591211;'Phalia';777;0
e;591212;'Mandi Bahauddin';777;0
e;592209;'Camelus dromedarius';777;0
e;404667;'Cortez';1;50
e;317769;'paysannes';1;56
e;119715;'glycémie';1;104
e;208456;'steak tartare';1;104
e;608469;'Harley Davidson';1;0
e;618102;'lombricompost';777;0
e;734673;'tir parthe';777;0
e;182483;'flèche du Parthe';1;50
e;182993;'licorne chinoise';1;50
e;287711;'ema';777;50
e;356287;'glycémie capillaire';1;50
e;356837;'grippe équine';1;50
e;23803;'ordonnance';1;456
e;132167;'sacrifice';1;186
e;378343;'sacrifice rituel';1;50
e;399771;'sibylline';1;52
e;125904;'Marnie';1;50
e;245174;'Przewalski';1;8
e;41698;'chronophotographe';1;50
e;177238;'filet américain';1;50
e;387872;'vérité générale';1;50
e;32123;'Hyracotherium';1;50
e;168830;'cuica';1;2
e;289002;'puita';777;50
e;289003;'omelê';777;50
e;289004;'zambomba';777;50
e;289005;'Rommelpot';777;50
e;289006;'roncador';777;50
e;109288;'souffleur';1;80
e;1574269;'grotte ornée du Pont-d'Arc';777;0
e;335446;'animal préhistorique';1;50
e;367178;'officier d'ordonnance';1;50
e;1649881;'hypertype';1;0
e;1655120;'saltatrice';1;0
e;1499074;'ghette';777;0
e;1499075;'gaiter';777;0
e;1499076;'gamasche';777;0
e;1499077;'polaina';777;0
e;1661666;'syriaques';777;0
e;1664942;'clenbuterol';1;0
e;1695715;'feces';1;0
e;1745638;'effet Hans le Malin';1;0
e;1745672;'Oskar Pfungst';1;0
e;1747711;'goudron de Stockolm';777;0
e;1747712;'goudron de pin';777;0
e;1747713;'goudron officinal';777;0
e;1747714;'goudron végétal';777;0
e;1747715;'poix liquide';777;0
e;1761309;'equitation';1;0
e;1761316;'horse ball';1;0
e;1763423;'jeux de pistes immersifs';777;0
e;1763424;'Theatrical Scavenger Hunt';777;0
e;1763425;'Live City Game';777;0
e;1764874;'antivenin';777;0
e;169441;'anti-venin';1;50
e;1745583;'autres pages à fusionner';777;0
e;1663416;'Rang';1;0
e;1767447;'tabou alimentaire';1;0
e;289810;'Pied bot équin';777;50
e;138119;'Caune de l'Arago';1;50
e;17704;'Poséidon';1;72
e;1814541;'élevage de chevaux';1;0
e;1857303;'épidermolyse bulleuse jonctionnelle létale';777;0
e;1839121;'monohybride';1;0
e;1874070;'sous-race';1;0
e;1880370;'anaplasmose humaine';1;0
e;1899799;'grotte ornée du Pont d'Arc';777;0
e;1899800;'grotte Chauvet-Pont d'Arc';777;0
e;146549;'Poseidon';1;50
e;1914810;'struvite';1;0
e;1934860;'gène crème';777;0
e;1934393;'cremello';1;0
e;2262109;'ratatinage';1;0
e;390235;'équitation de loisir';1;50
e;400382;'mulassière';1;50
e;2052223;'jockeys';2;0
e;1655770;'pliohippus';1;0
e;1655899;'zébroïde';1;0
e;1656013;'zorse';777;0
e;462418;'zonkey';777;50
e;1656014;'zebra mule';777;0
e;1656015;'zebrule';777;0
e;1656016;'zedonk';777;0
e;1656017;'zebra hinny';777;0
e;2119548;'rocheuses';2;0
e;59743;'bridon';1;50
e;75571;'vaquero';1;50
e;2357885;'polocrosse';1;0
e;2360544;'espece';1;0
e;2367285;'équithérapie';777;0
e;2367284;'hippothérapie';1;0
e;2372817;'ta race';1;0
e;2377548;'fjordhest';777;0
e;2377546;'fjording';1;0
e;264288;'signe de Babinski';1;52
e;594059;'bloc de branche gauche';1;0
e;2379302;'shoshone';1;0
e;2380397;'monocéros';1;0
e;2388221;'Terdeghem';1;0
e;2395860;'exodos';1;0
e;2399066;'Brosville';1;0
e;2400747;'peon';1;0
e;2583437;'concours complet d'équitation';777;0
e;2402245;'concours complet';1;0
e;2455894;'Rossfeld';1;0
e;2403151;'cowdriose';1;0
e;2408914;'Juillan';1;0
e;2413102;'parodos';1;0
e;2413211;'Ciboure';1;0
e;2413342;'classification traditionnelle';1;0
e;2414049;'Les Orres';1;0
e;2587679;'Yakima Canutt';1;0
e;2587682;'Enos Edward Canutt';777;0
e;2418592;'Aubure';1;0
e;2422725;'Pitgam';1;0
e;2430673;'Plouaret';1;0
e;173025;'Carignan';1;50
e;2434548;'Brucourt';1;0
e;2435995;'Léhon';1;0
e;2436554;'Vergranne';1;0
e;2436743;'Saint-Martin-Château';1;0
e;2437820;'Cheylade';1;0
e;2437698;'Saint-Lumine-de-Coutais';1;0
e;2444827;'Saint-Pardoux-Morterolles';1;0
e;2446568;'Bouchon';1;0
e;2454628;'Etalon';1;0
e;2460800;'turc de Van';1;0
e;2526630;'chat du lac de Van';1;0
e;2461490;'Quevauvillers';1;0
e;2468774;'Ménerbes';1;0
e;2469196;'Palau-de-Cerdagne';1;0
e;2472795;'Saint-Pierre-Bellevue';1;0
e;2473892;'La Cavalerie';1;0
e;2475434;'Ploegsteert';1;0
e;2476886;'Faux-Mazuras';1;0
e;2477312;'gentiléen';1;0
e;2478089;'tintinophile';1;0
e;2478076;'Beaumont-de-Lomagne';1;0
e;2700986;'hippalektryon';777;0
e;2491357;'hippologue';1;0
e;2489524;'hippomancie';1;0
e;2493843;'guêtrier';1;0
e;2736024;'L'Europe est également à l'origine de plusieurs bouleversements historiques majeurs';777;0
e;153117;'européenne';1;166
e;2499207;'charrúa';1;0
e;2501071;'Croissant fertile';1;0
e;2503401;'clenbutérol';1;0
e;2507936;'étalonnier';1;0
e;2508612;'Cavalaire-sur-Mer';1;0
e;2507957;'Arnac-Pompadour';1;0
e;144760;'Pompadour';1;52
e;2858447;'Elasmotherium';777;0
e;2858444;'rhinocéros unicorne géant';1;2
e;2527557;'Saint-Junien-la-Bregère';1;0
e;340124;'boîte osseuse';1;50
e;2934113;'goudron de Stockholm';777;0
e;89390;'cytochrome';1;54
e;2601675;'Quasi menacé';777;0
e;2952638;'féralisation';777;0
e;666127;'Sakas';777;0
e;131883;'Saces';1;50
e;138549;'L'Amérique';1;50
e;2953346;'complexe d'oedipe';777;0
e;168815;'cor moderne';1;50
e;2955960;'qílín';777;0
e;2957100;'Jawad';1;0
e;2956275;'Artus';1;0
e;2956918;'Hampe';1;0
e;2961653;'Sibylline';1;0
e;209265;'traction animale';1;56
e;3170365;'animaux de trait';777;0
e;3170438;'Catégories';777;0
e;2608106;'En danger critique d'extinction';777;0
e;175310;'chameau de Bactriane';1;56
e;305844;'Camelus bactrianus';777;50
e;76125;'chamelle';1;80
e;3185520;'Pliohippus';777;0
e;2886328;'Parent mâle de l'hybridation';777;0
e;2574135;'Criollo';1;0
e;3225428;'Chameau d'Arabie';777;0
e;2576329;'Yvoy';1;0
e;3239430;'Isabelle se fête le 22 février';777;0
e;2863587;'Zèbre';1;0
e;129774;'vassalité';1;56
e;3259765;'Kyz kuumai';777;0
e;3298409;'Ponyta';1;0
e;3298410;'Galopa';1;0
e;3298485;'rapidash';777;0
e;3298554;'Gros Ours';777;0
e;3304579;'Nouvel an chinois';777;0
e;3310317;'manège de chevaux de bois';777;0
e;3313308;'ski attelé';777;0
e;2550991;'Les Ventes-de-Bourse';1;0
e;3348643;'cuisine québécoise';1;0
e;2567788;'Assebroek';1;0
e;2548246;'Zuidlaren';1;0
e;2549325;'Faoug';1;0
e;49947;'Sienne';1;72
e;3548983;'peonage';777;0
e;3548984;'peón';777;0
e;190145;'marronnier commun';1;50
e;139046;'marronnier d'Inde';1;52
e;300658;'marronnier blanc';777;50
e;300659;'Aesculus hippocastanum';777;50
e;18293;'sinon';1;68
e;573968;'Écouter cet article';777;50
e;230578;'blond vénitien';1;66
e;3762593;'virus de l'encéphalomyélite équine de l'Est';777;0
e;1831236;'Culicoides';1;0
e;1801929;'maladie de Hirschsprung';1;0
e;282588;'maladie de';777;50
e;20797;'tartare';1;98
e;5468824;'licol éthologique';1;0
e;5468825;'licol américain';777;0
e;5468826;'licol à noeuds';777;0
e;5498773;'équitation western';1;0
e;431226;'Rebelle';1;50
e;5516512;'soudjouk';1;0
e;5516530;'soudjour';777;0
e;5519383;'Eclipse';777;0
e;335271;'anatomie artistique';1;50
e;5635603;'PATSY Award';777;0
e;2414119;'Jal';1;0
e;5563793;'procession du Saint-Sang';777;0
e;73888;'fouet';1;608
e;5534862;'Mise en garde médicale';777;0
e;5599226;'Cairngorm';777;0
e;5534981;'améliorer cet article';777;0
e;5534983;'page de discussion';777;0
e;5553081;'notes de bas de page';777;0
e;5634537;'agressivité chez les animaux';777;0
e;5634594;'bain de poussière ou de sable';777;0
e;165309;'molaires';1;78
e;5679237;'Lanzelet';777;0
e;5671767;'Hengist';777;0
e;5629709;'Horsa';1;0
e;5678411;'Manimal';777;0
e;5679390;'allantoplacenta';777;0
e;5679966;'Jean-Baptiste Auguste Chauveau';777;0
e;5534856;'Découvrez comment faire';777;0
e;5684656;'hypothèse du coureur de fond';777;0
e;5685171;'omphalo-placenta';777;0
e;5685610;'Carlo Ruini';777;0
e;5687784;'ADN fossile';777;0
e;5784693;'idiotismes animaliers';777;0
e;5797288;'styles calligraphiques arabes';777;0
e;5797540;'tabeldite';777;0
e;300599;'chelha';777;50
e;2478591;'tramezzino';1;0
e;5802665;'extraction de l'huile d'olive';777;0
e;5802671;'extrait de viande';777;0
e;88450;'goulasch';1;52
e;5804834;'soupe de goulasch';777;0
e;2382893;'grangeon';1;0
e;5807258;'kazy';777;0
e;5807259;'kazi';777;0
e;5808881;'blacksad';777;0
e;52862;'bicolore';1;52
e;5809346;'particolore';777;0
e;5809347;'à panachure blanche';777;0
e;5809365;'chapalu';777;0
e;5809366;'Capalu';777;0
e;5809367;'Capalus';777;0
e;5809368;'Cath Paluc';777;0
e;5809369;'Cath Palug';777;0
e;5809370;'Cath Balug';777;0
e;22077;'ambre';1;64
e;5809371;'x-color';777;0
e;5809489;'chat rex';777;0
e;5809490;'chat à poil frisé';777;0
e;5811330;'Bornavirus';777;0
e;5811331;'Borna disease virus';777;0
e;5811332;'maladie de Borna';777;0
e;5811370;'ICTV';777;0
e;5811448;'Virus de l'encéphalomyélite équine de l'Est';777;0
e;5818644;'mosaïque du seigneur Julius';777;0
e;5835434;'collier d'épaule';777;0
e;5835539;'électrificateur de clôture';777;0
e;5835655;'tumeur sarcoïde';777;0
e;5835812;'chinampa';777;0
e;5836448;'échange colombien';777;0
e;5836449;'le grand échange';777;0
e;5836565;'Maureen Catherine Connolly';777;0
e;5836566;'Brinker';777;0
e;45303;'faucheuse';1;86
e;5870842;'mythologie japonaise';777;0
e;5870886;'Musée national d'anthropologie de Mexico';777;0
e;5870887;'Museo Nacional de Antropología';777;0
e;5870888;'mna';777;0
e;398117;'Vultur';1;50
e;5872399;'Vultur gryphus';777;0
e;5781132;'Sleipnir';777;0
e;3813863;'fumonisine';1;0
e;5893405;'épreuve de travail';777;0
e;5893799;'teremok';777;0
e;5893800;'La Maison de la mouche';777;0
e;144205;'Méduse';1;74
e;172847;'Gorgo';1;50
e;5895068;'cervidae';777;0
e;1764095;'cytochrome c';1;0
e;155741;'religions';1;72
e;5916856;'chymotrypsine C';777;0
e;5917692;'PARP-1';777;0
e;5918299;'chirurgie dans l'Égypte antique';777;0
e;5918729;'le brancard';777;0
e;52943;'blaireau';1;88
e;78776;'cacolet';1;52
e;143045;'brosse';1;712
e;118972;'davier';1;102
e;5920173;'mein davied';777;0
e;5920175;'koat davied';777;0
e;5907150;'Dromadaire';777;0
e;5923279;'Equus asinus';777;0
e;5926797;'La Chapelle-aux-Saints 1';777;0
e;5939303;'bonnacon';777;0
e;5939304;'Bonacon';777;0
e;424233;'bonasus';1;50
e;2958767;'Aura';1;0
e;135722;'roulage';1;66
e;5942410;'yabusame';777;0
e;5944546;'Alastyn';777;0
e;5944547;'glashtyn';777;0
e;5944548;'Cabyll-ushtey';777;0
e;5944566;'Fjording';777;0
e;5944568;'Equus ferus przewalskii';777;0
e;5944606;'François Robichon de la Guérinière';777;0
e;3729820;'Equidia';1;0
e;1986626;'allures';2;0
e;5944639;'asturcón';777;0
e;5944649;'Godolphin Arabian';777;0
e;5944678;'serko';777;0
e;5944679;'Black Beauty';777;0
e;40965;'Jamin';1;50
e;5944684;'shagya';777;0
e;5944685;'arabe shagya';777;0
e;5944686;'shagya arabe';777;0
e;5944708;'Pat Parelli';777;0
e;5943895;'Huaso';777;0
e;5944716;'crin-blanc';777;0
e;5944745;'kannan';777;0
e;5944755;'Cheval de Léonard';777;0
e;5944772;'konik';777;0
e;5944773;'konik polski';777;0
e;2516722;'cruzado';1;0
e;4934424;'Hispano';1;0
e;5944785;'Welsh cob';777;0
e;5944786;'Welsh D';777;0
e;5944787;'cob gallois';777;0
e;4276566;'Dales';1;0
e;152537;'recyclé';1;60
e;5944856;'Mack Lobell';777;0
e;5944857;'Tidalium Pelo';777;0
e;24793;'Toulon';1;76
e;5944879;'jappeloup';777;0
e;5944881;'Pierre-Alfred Dedreux';777;0
e;5944882;'Alfred De Dreux';777;0
e;5944891;'Gaston d'Illiers';777;0
e;1857757;'Heartland';1;0
e;5944901;'Monty Roberts';777;0
e;5944912;'bajutsu';777;0
e;42807;'Sampson';1;50
e;168266;'Mammouth';1;50
e;5944985;'dans la culture';777;0
e;5945014;'selle argentin';777;0
e;5945015;'silla argentino';777;0
e;2523680;'oldenbourg';1;0
e;2423315;'oldenburg';1;0
e;5814668;'Stormy';1;0
e;5945076;'Hale's Stormy Brown Sugar';777;0
e;5945085;'thumbelina';777;0
e;5945105;'gène flaxen';777;0
e;5945106;'alezan crins lavés';777;0
e;5945126;'Académie Pégase';777;0
e;5945128;'Marine Oussedik';777;0
e;230715;'bruns';1;60
e;5945140;'Haras de la Cense';777;0
e;5945165;'équitation éthologique';777;0
e;5945167;'équitation naturelle';777;0
e;5945208;'castilian';777;0
e;5831717;'Arborescence du monde équestre';777;0
e;5625743;'Arborescence de l'histoire militaire';777;0
e;5945230;'Cheval du Ventasso';777;0
e;10679;'Première Guerre mondiale';1;128
e;153043;'14-18';1;58
e;153153;'première guerre mondiale';1;80
e;5945348;'Misaki';777;0
e;5945396;'Liste des chevaux de fiction';777;0
e;5945397;'liste des chevaux mythiques et légendaires';777;0
e;3357155;'Overdose';777;0
e;5945456;'Tarkshya';777;0
e;5953206;'chatrang';777;0
e;5953207;'Shatranj';777;0
e;5954380;'langues tokhariennes';777;0
e;111652;'La Mort';1;52
e;5954512;'garulfo';777;0
e;5960993;'Träpriset Award';777;0
e;51217;'puck';1;50
e;5973872;'John Whitaker';777;0
e;5974755;'transmission de la grippe entre animaux';777;0
e;5975121;'Virus de l'encéphalite équine de l'est';777;0
e;5975152;'myopathie à stockage de polysaccharides';777;0
e;5975153;'PSSM';777;0
e;5975155;'EPSM';777;0
e;5986663;'Cascade des Jarrauds';777;0
e;5987606;'biodiversité de la Nouvelle-Calédonie';777;0
e;5990913;'Blondine au pays de l'arc-en-ciel';777;0
e;6004028;'chronologie du statut juridique des femmes';777;0
e;6004537;'histoire de la Provence';777;0
e;230482;'Link';1;46
e;2434547;'Cambes';1;0
e;6065211;'concours de saut d'obstacles';777;0
e;162913;'acteurs';1;150
e;6065225;'Gilles Bertrán de Balanda';777;0
e;6065323;'équitation handisport';777;0
e;6065559;'pony-games';777;0
e;6065560;'mounted-games';777;0
e;6066437;'svarog';777;0
e;6066438;'Svarojitch';777;0
e;6066439;'Dajbog';777;0
e;6066440;'Radigost';777;0
e;6083242;'histoire de la police';777;0
e;6015996;'Persival';1;0
e;3332970;'robe pie';1;0
e;167569;'assiette fiscale';1;50
e;6594547;'liste des périphrases désignant des villes';777;0
e;52109;'épicène';1;52
e;64115;'archétype';1;66
e;5776922;'26 septembre';777;0
e;9946577;'expédition conjointe contre Franklin';777;0
e;9945445;'jardins botaniques royaux de Kew';777;0
e;9945444;'jardins de Kew';777;0
e;9945403;'érable de Virginie';777;0
e;9945402;'plaine rouge';777;0
e;145636;'plaine';1;202
e;6303832;'érable rouge';1;0
e;9945401;'Acer rubrum';777;0
e;9944332;'chameau sauvage de Tartarie';777;0
e;9944331;'Camelus bactrianus ferus';777;0
e;2371519;'choual';1;0
e;53556;'joual';1;52
e;9907416;'Poncas';777;0
e;7900385;'Version pour appareil mobile';777;0
e;5534151;'Wikipédia en bref';777;0
e;5534155;'principes fondateurs';777;0
e;5534152;'Portails thématiques';777;0
e;7807938;'Accueil de la communauté';777;0
e;5534153;'Comment contribuer';777;0
e;135044;'poser une question';1;58
e;5557903;'Kamikaze';777;0
e;8851771;'Neopalpa donaldtrumpi';777;0
e;6529914;'Rouan';1;0
e;6361227;'chameau à deux bosses';1;0
e;110434;'chamelon';1;56
e;5060923;'animal de rente';1;0
e;2373220;'animal de production';1;0
e;9103601;'Siegfried Samuel Marcus';777;0
e;145045;'Batak';1;50
e;429513;'Rosamund';1;50
e;109611;'Rosemonde';1;50
e;1777146;'Rosamond';1;0
e;9506416;'Rosamunde';777;0
e;143452;'parnasse';1;50
e;591473;'Alces americanus';777;0
e;2872080;'Préoccupation mineure';777;0
e;115486;'orignal';1;70
e;39726;'Mapuches';1;50
e;9740410;'Nouvel An chinois';777;0
e;9740411;'Nouvel An du calendrier chinois';777;0
e;9740412;'Nouvel An lunaire';777;0
e;9267656;'Contenus de qualité';777;0
e;9267657;'Bons contenus';777;0
e;5951228;'Sélection';1;0
e;411314;'Programme';1;50
e;6064954;'George Weah';777;0
e;5942519;'tamahagane';777;0
e;2561708;'huarizo';1;0
e;249004;'nom vernaculaire';1;4
e;6533103;'Lama glama';1;0
e;275350;'Vicugna pacos';777;50
e;9957325;'Azabu';777;0
e;9959732;'Horse Guards';777;0
e;9968700;'pays d'Oz';777;0
e;73878;'homologie';1;54
e;418352;'homologues';1;50
e;217582;'La Belle et la Bête';1;12
e;92053;'foire';1;308
e;10007020;'Goopy Geer';777;0
e;10047495;'L'histoire du territoire actuellement occupé par le département de l'Isère';777;0
e;10047498;'Les armes du département de l'Isère se blasonnent ainsi';777;0
e;10050492;'tramway en Suisse';777;0
e;227196;'La Poste';1;56
e;10055060;'La Poste Suisse SA';777;0
e;10056109;'histoire des chemins de fer français';777;0
e;10056430;'Sallie Gardner at a Gallop';777;0
e;311363;'Le Tribunal des flagrants délires';777;50
e;9944526;'IIe millénaire av. J.-C';777;0
e;10068653;'XVe siècle av. J.-C';777;0
e;5965905;'Nord-Amérindiens';1;0
e;10082964;'Saint Georges de Lydda';777;0
e;5954185;'Le Monde perdu';777;0
e;32497;'XXe siècle';1;50
e;10105953;'l'année 1925';777;0
e;9946519;'aux États-Unis';777;0
e;10106141;'Travellers';777;0
e;10033552;'Le Pacte';777;0
e;10039037;'monument à Victor-Emmanuel II';777;0
e;10159033;'100 milles';777;0
e;10159034;'100-milers';777;0
e;10190629;'glorfindel';777;0
e;10190722;'brego';777;0
e;10384079;'Heimotion';777;0
e;10384080;'heimo';777;0
e;10251792;'XXVe siècle av. J.-C';777;0
e;5894499;'IIIe millénaire av. J.-C';777;0
e;425896;'Albon';1;50
e;10297406;'éléphants de combat';777;0
e;9944977;'chasse par force';777;0
e;10962994;'Benoît Brisefer';777;0
e;10962798;'bornaviridae';777;0
e;10314443;'crocotta';777;0
e;10314444;'corocotta';777;0
e;10314445;'leucrotta';777;0
e;10314446;'yena';777;0
e;137886;'Drac';1;50
e;10314546;'diable de Jersey';777;0
e;5534178;'Bouraq';1;0
e;2434481;'Yvois';1;0
e;10426346;'Comté de Kildare';777;0
e;10428315;'La flore et la faune d'Algérie';777;0
e;4050258;'Bad Kötzting';1;0
e;38765;'hispano-arabe';1;50
e;123164;'chronologique';1;52
e;10459744;'2019 en sports équestres';777;0
e;10459745;'2018 en sports équestres';777;0
e;10459746;'2017 en sports équestres';777;0
e;10152415;'2016 en sports équestres';777;0
e;10459747;'2015 en sports équestres';777;0
e;10086427;'1996 en sport';777;0
e;10106218;'Chronologie des sports équestres';777;0
e;10459832;'1996 en sports équestres';777;0
e;10511992;'Le Retour des Mousquetaires';777;0
e;10518062;'sceau du roi Denis';777;0
e;5945298;'poney des Amériques';777;0
e;5944579;'L'Étalon noir';777;0
e;5534855;'citer vos sources';777;0
e;26200;'endurance';1;112
e;10551996;'Chocobo';1;0
e;10583688;'grotte des Trois-Frères';777;0
e;10583695;'grotte d'Aurignac';777;0
e;10583696;'abri d'Aurignac';777;0
e;10583717;'grotte du Lazaret';777;0
e;10583735;'grotte de Coliboaia';777;0
e;2393617;'Lésigny';1;0
e;10611870;'Pic Pic';777;0
e;136378;'André';1;52
e;10611871;'Pic Pic André Shoow';777;0
e;10618678;'histoire de la Norvège';777;0
e;51177;'Clyde';1;54
e;10675833;'jeu d'élevage';777;0
e;86816;'Árpád';1;50
e;426452;'Snakes';1;50
e;10822505;'histoire des routes de Gaule au Haut Moyen Âge';777;0
e;10822926;'paroisse de Cardwell';777;0
e;103993;'Parnasse';1;64
e;10847554;'Jean Milhet-Fontarabie';777;0
e;10844910;'Michel Dennemont';777;0
e;10844911;'Nassimah Dindar';777;0
e;10844912;'Jean-Louis Lagourgue';777;0
e;10844913;'Viviane Malet';777;0
e;2933594;'liste des personnages';777;0
e;10863923;'Digimon Tamers';777;0
e;430281;'Minas';1;50
e;10896109;'Pampa de Achala';777;0
e;10896279;'Pékin-Paris';777;0
e;10903567;'cavalerie française pendant la Première Guerre mondiale';777;0
e;10905548;'lac Qinghai';777;0
e;3179742;'Kokonor';777;0
e;10905549;'khökh nuur';777;0
e;10905550;'Tso Ngönpo';777;0
e;10908410;'Fédération équestre internationale';777;0
e;10908414;'Marco Kutscher';777;0
e;10908465;'Nick Skelton';777;0
e;10908508;'Jos Lansink';777;0
e;10909797;'château de La Roche-Guyon';777;0
e;10909948;'armoiries du Venezuela';777;0
e;10909968;'Grand Sceau du Dakota du Nord';777;0
e;10909987;'sceau de l'État du New Jersey';777;0
e;10916341;'XVIIIe siècle av. J.-C';777;0
e;10918349;'ehwaz';777;0
e;10936270;'histoire de la Creuse';777;0
e;264800;'Woody';1;50
e;10942959;'team chasing';777;0
e;10969833;'mot épicène';777;0
e;10970294;'cuisine norvégienne';777;0
e;10985912;'spats';777;0
e;10987371;'Imparidigités';777;0
e;10988484;'Grand Cañon';777;0
e;10995358;'histoire du jeu d'échecs';777;0
e;11001667;'jeux gardians';777;0
e;284853;'Autres thèmes';777;50
e;11001715;'coupelles tauromachiques';777;0
e;11004778;'sentier cathare';777;0
e;11006883;'Amalur';777;0
e;11006884;'Ama Lur';777;0
e;11007429;'Etsai';777;0
e;11007471;'Ubelteso';777;0
e;11007482;'bataille de Padura';777;0
e;3891269;'Arrigorriaga';1;0
e;11007530;'kutun';777;0
e;139975;'Hélène';1;168
e;11009775;'Kankurô';777;0
e;2554427;'Dardilly';1;0
e;2375227;'équitation d'extérieur';1;0
e;11027739;'voltige en cercle';777;0
e;11027751;'Équifun';777;0
e;11027752;'voltige cosaque';777;0
e;11027753;'djigitovka';777;0
e;11027754;'voltige en ligne';777;0
e;104162;'fantasia';1;50
e;11029157;'bandes de polo';777;0
e;11033036;'égale considération des intérêts';777;0
e;2393958;'panenthéisme';1;0
e;11050103;'christianisme en Islande';777;0
e;11061475;'sergent Chesterfield';777;0
e;11061476;'Cornélius M. Chesterfield';777;0
e;11061487;'Les Cavaliers du ciel';777;0
e;11061529;'Capitaine Stark';777;0
e;11061530;'Chargez !';777;0
e;191368;'border terrier';1;50
e;11070943;'Jeanne de Flandre';777;0
e;11070944;'Jeanne de Hainaut';777;0
e;11070945;'Jeanne de Constantinople';777;0
e;11071391;'Hestur';777;0
e;11071392;'Hestoy';777;0
e;11082368;'Philippe Lejeune';777;0
e;10862995;'Cruzado';1;0
e;11090149;'liste de ses inventions';777;0
e;11100880;'sous-races';777;0
e;276460;'Equus ferus gmelini';777;50
e;5944631;'Pieter Boddaert - 1785';777;0
e;276459;'Equus ferus ferus';777;50
e;48534;'Cluny';1;56
e;11105600;'parc naturel régional du Massif des Bauges';777;0
e;11105602;'parc naturel régional du Perche';777;0
e;11106560;'guerre maroco-songhaï';777;0
e;11107770;'Ahmed Ier';777;0
e;10554721;'histoire de l'Égypte';777;0
e;11108774;'géographie de l'Aurès';777;0
e;11125305;'règles de concours de saut d'obstacles';777;0
e;11129269;'Le pinceau de calligraphie';777;0
e;11129270;'pinceau à lavis';777;0
e;11129324;'ancien palais d'été';777;0
e;11129325;'parc Yuanming';777;0
e;11130177;'religion nordique ancienne';777;0
e;11130178;'paganisme nordique';777;0
e;11156369;'valegro';777;0
e;11156379;'Edwina Tops-Alexander';777;0
e;1766559;'Proche-Orient ancien';1;0
e;364788;'monde animal';1;50
e;10160249;'Cette section peut contenir un travail inédit ou des déclarations non vérifiées';777;0
e;11159015;'Xianbei';777;0
e;11159033;'Equus caballus przewalskii';777;0
e;11159083;'shagai';777;0
e;11159084;'chükö';777;0
e;11159085;'asyk';777;0
e;11159086;'ashyk';777;0
e;11159087;'oshuq';777;0
e;11172696;'impulsion ou impulsivité';777;0
e;11172697;'impulsion ou moment linéaire';777;0
e;11172698;'impulsion de fonte';777;0
e;57209;'impulsion spécifique';1;50
e;5983626;'attelage de tradition';777;0
e;11216875;'chlorure de méthylthioninium';777;0
e;11252396;'caverne du Pont-d'Arc';777;0
e;208801;'Taranis';1;60
e;11330301;'Grotte Guattari';777;0
e;44468;'Messapiens';1;50
e;296691;'Messapes';777;50";

// Pattern collection by node type
// generic node pattern : (^e;\d+;'.+';\d+;\d+(;'.+')?\n)+
// Node types :
// nt;0;'n_generic'
// nt;1;'n_term'
// nt;2;'n_form'
// nt;4;'n_pos'
// nt;6;'n_flpot'
// nt;8;'n_chunk'
// nt;9;'n_question'
// nt;10;'n_relation'
// nt;12;'n_analogy'
// nt;18;'n_data'
// nt;36;'n_data_pot'
// nt;444;'n_link'
// nt;666;'n_AKI'
// nt;777;'n_wikipedia'
// nt;1002;'n_group'

$node_types =  array_merge(range(0,12), array(18, 36, 444, 666, 777, 1002));
$nodes_from_types = array();

foreach ($node_types as $typeId) {

    $nodes_from_type_pattern = "/e;(\d+);'(.+?)';{$typeId};(\d+);('(.+?)')?\n?/";

    $matched = preg_match_all($nodes_from_type_pattern, $src, $matches, PREG_SET_ORDER);


    $nodes_from_types[$typeId] = $matches;

/*    echo "<pre>";
    print_r($matches);
    echo "</pre>";*/

}

/*echo "<pre>";
print_r($nodes_from_types);
echo "</pre>";*/

try {

    // SQLITE3
    //$conn = new SQLiteConnection();

    $conn = new MySQLConnection();
    $pdo = $conn->connect();

	if ($pdo != null) {

        //echo 'Connected to the SQLite database successfully!';
        echo 'Connected to the MySQL database successfully!';

		$insertStmt = $pdo->prepare("INSERT INTO node (id, name, id_type, weight, formatted_name) 
						                       VALUES (?, ?, ?, ?, ?)");

		// For each node type nodes array
		foreach ($nodes_from_types as $typeId => $nodes) {

            echo "<hr /><p>Nodes of type : <pre>$typeId</pre></p>";

            // e;3739399;'cabriole>83824';1;0;'cabriole>équitation'
            // /e;(\d+);'(.+?)';{$typeId};(\d+);('(.+?)')?\n?/

		    foreach ($nodes as $index => $nodeData) {


                $name = $nodeData[2] ?? null;
                $weight = $nodeData[3] ?? null;
                $formattedName = $nodeData[5] ?? null;

                echo "<p>Node ID = {$nodeData[1]}<br />";
                echo "Node \$name = $name<br />";
                echo "Node \$weight = $weight<br />";
                echo "Node \$formattedName = $formattedName</p>";

                $insertStmt->execute(array(/*id*/ $nodeData[1],
                    /*name*/ $name,
                    /*type*/ $typeId,
                    /*weight*/ $weight,
                    /*formatted_name*/ $formattedName)
                );
            }
        }

	}
	else {
        //echo 'Whoops, could not connect to the SQLite database!';
        echo 'Whoops, could not connect to the MySQL database!';
	}

} catch (\PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

